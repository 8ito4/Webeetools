#!/bin/bash

# 🚀 Script de Instalação Automática - Webeetools
# Para Ubuntu 22.04 LTS na Digital Ocean

set -e

echo "🚀 Iniciando instalação do Webeetools..."

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Função para log
log() {
    echo -e "${GREEN}[$(date +'%Y-%m-%d %H:%M:%S')] $1${NC}"
}

warn() {
    echo -e "${YELLOW}[WARNING] $1${NC}"
}

error() {
    echo -e "${RED}[ERROR] $1${NC}"
}

# Verificar se é Ubuntu
if [ ! -f /etc/os-release ] || ! grep -q "Ubuntu" /etc/os-release; then
    error "Este script é para Ubuntu 22.04 LTS"
    exit 1
fi

# Solicitar informações
echo -e "${BLUE}📝 Configuração inicial${NC}"
read -p "Domínio (ex: webeetools.com): " DOMAIN
read -p "Email para SSL (ex: admin@webeetools.com): " EMAIL
read -p "Branch do Git (padrão: main): " BRANCH
BRANCH=${BRANCH:-main}

log "🔄 Atualizando sistema..."
apt update && apt upgrade -y

log "📦 Instalando utilitários básicos..."
apt install -y curl wget unzip git software-properties-common htop

log "🐘 Instalando PHP 8.2..."
add-apt-repository ppa:ondrej/php -y
apt update
apt install -y php8.2 php8.2-fpm php8.2-cli php8.2-common php8.2-mysql \
php8.2-zip php8.2-gd php8.2-mbstring php8.2-curl php8.2-xml \
php8.2-bcmath php8.2-json php8.2-tokenizer php8.2-fileinfo \
php8.2-intl php8.2-sqlite3

log "🎼 Instalando Composer..."
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
chmod +x /usr/local/bin/composer

log "🌐 Instalando Nginx..."
apt install -y nginx
systemctl start nginx
systemctl enable nginx

log "🔥 Configurando Firewall..."
ufw allow OpenSSH
ufw allow 'Nginx Full'
ufw --force enable

log "📁 Configurando projeto..."
mkdir -p /var/www/webeetools
cd /var/www/webeetools

log "📥 Clonando repositório..."
git clone https://github.com/8ito4/Webeetools.git .
git checkout $BRANCH

log "📦 Instalando dependências PHP..."
composer install --optimize-autoloader --no-dev

log "⚙️ Configurando Laravel..."
cp .env.example .env

# Configurar .env
sed -i "s|APP_NAME=.*|APP_NAME=Webeetools|" .env
sed -i "s|APP_ENV=.*|APP_ENV=production|" .env
sed -i "s|APP_DEBUG=.*|APP_DEBUG=false|" .env
sed -i "s|APP_URL=.*|APP_URL=https://$DOMAIN|" .env

# Gerar chave
php artisan key:generate

# Cache otimizado
php artisan config:cache
php artisan route:cache
php artisan view:cache

log "📝 Configurando Nginx..."
cat > /etc/nginx/sites-available/webeetools << EOF
server {
    listen 80;
    listen [::]:80;
    server_name $DOMAIN www.$DOMAIN;
    root /var/www/webeetools/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;
    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

# Habilitar site
ln -sf /etc/nginx/sites-available/webeetools /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default

# Testar configuração
nginx -t

log "🔧 Configurando permissões..."
chown -R www-data:www-data /var/www/webeetools
chmod -R 755 /var/www/webeetools
chmod -R 775 /var/www/webeetools/storage
chmod -R 775 /var/www/webeetools/bootstrap/cache

log "🔄 Reiniciando serviços..."
systemctl restart nginx
systemctl restart php8.2-fpm

log "🔒 Instalando SSL..."
apt install -y certbot python3-certbot-nginx

if [ ! -z "$DOMAIN" ] && [ ! -z "$EMAIL" ]; then
    certbot --nginx -d $DOMAIN -d www.$DOMAIN --email $EMAIL --agree-tos --non-interactive
    
    # Configurar renovação automática
    (crontab -l 2>/dev/null; echo "0 12 * * * /usr/bin/certbot renew --quiet") | crontab -
fi

log "📝 Criando script de deploy..."
cat > /var/www/webeetools/deploy.sh << 'EOF'
#!/bin/bash
cd /var/www/webeetools

echo "🔄 Iniciando deploy..."

# Modo manutenção
php artisan down

# Fazer pull
git pull origin main

# Instalar dependências
composer install --optimize-autoloader --no-dev

# Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Reiniciar PHP-FPM
systemctl reload php8.2-fpm

# Sair do modo manutenção
php artisan up

echo "✅ Deploy concluído!"
EOF

chmod +x /var/www/webeetools/deploy.sh

log "🔍 Testando instalação..."
sleep 3

# Testar API
if curl -f -s "http://localhost/api/v1/password/generate?length=8" > /dev/null; then
    log "✅ API funcionando!"
else
    warn "⚠️ API pode não estar funcionando. Verifique os logs."
fi

# Informações finais
echo ""
echo -e "${GREEN}🎉 Instalação concluída!${NC}"
echo -e "${BLUE}📋 Informações importantes:${NC}"
echo -e "🌐 Site: ${GREEN}https://$DOMAIN${NC}"
echo -e "📚 Documentação: ${GREEN}https://$DOMAIN/documentation${NC}"
echo -e "🔧 API Base: ${GREEN}https://$DOMAIN/api/v1${NC}"
echo ""
echo -e "${YELLOW}📝 Próximos passos:${NC}"
echo "1. Configure seu DNS para apontar para este servidor"
echo "2. Teste a API: curl https://$DOMAIN/api/v1/password/generate"
echo "3. Para deploy futuro: cd /var/www/webeetools && ./deploy.sh"
echo ""
echo -e "${BLUE}📊 Comandos úteis:${NC}"
echo "• Ver logs: tail -f /var/www/webeetools/storage/logs/laravel.log"
echo "• Status serviços: systemctl status nginx php8.2-fpm"
echo "• Reiniciar: systemctl restart nginx php8.2-fpm"
echo ""

log "🚀 Webeetools está rodando em produção!" 