# 🚀 Guia de Deploy - Webeetools na Digital Ocean

## 📋 Pré-requisitos
- Droplet Ubuntu 22.04 LTS (mínimo 1GB RAM)
- Acesso root via SSH
- Domínio configurado (opcional)

## 🔧 1. Atualizar o Sistema

```bash
# Conectar via SSH
ssh root@SEU_IP

# Atualizar pacotes
apt update && apt upgrade -y

# Instalar utilitários básicos
apt install -y curl wget unzip git software-properties-common
```

## 🐘 2. Instalar PHP 8.2

```bash
# Adicionar repositório PHP
add-apt-repository ppa:ondrej/php -y
apt update

# Instalar PHP e extensões necessárias
apt install -y php8.2 php8.2-fpm php8.2-cli php8.2-common php8.2-mysql \
php8.2-zip php8.2-gd php8.2-mbstring php8.2-curl php8.2-xml \
php8.2-bcmath php8.2-json php8.2-tokenizer php8.2-fileinfo \
php8.2-intl php8.2-sqlite3

# Verificar instalação
php -v
```

## 🎼 3. Instalar Composer

```bash
# Baixar e instalar Composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
chmod +x /usr/local/bin/composer

# Verificar instalação
composer --version
```

## 🗄️ 4. Instalar MySQL (Opcional - se usar banco)

```bash
# Instalar MySQL
apt install -y mysql-server

# Configurar MySQL
mysql_secure_installation

# Criar banco e usuário
mysql -u root -p
```

```sql
CREATE DATABASE webeetools;
CREATE USER 'webeetools'@'localhost' IDENTIFIED BY 'sua_senha_forte';
GRANT ALL PRIVILEGES ON webeetools.* TO 'webeetools'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

## 🌐 5. Instalar Nginx

```bash
# Instalar Nginx
apt install -y nginx

# Iniciar e habilitar
systemctl start nginx
systemctl enable nginx

# Verificar status
systemctl status nginx
```

## 📁 6. Configurar Projeto

```bash
# Criar diretório do projeto
mkdir -p /var/www/webeetools
cd /var/www/webeetools

# Clonar repositório
git clone https://github.com/8ito4/Webeetools.git .

# Instalar dependências
composer install --optimize-autoloader --no-dev

# Configurar permissões
chown -R www-data:www-data /var/www/webeetools
chmod -R 755 /var/www/webeetools
chmod -R 775 /var/www/webeetools/storage
chmod -R 775 /var/www/webeetools/bootstrap/cache
```

## ⚙️ 7. Configurar Environment

```bash
# Copiar arquivo de configuração
cp .env.example .env

# Editar configurações
nano .env
```

**Configurações essenciais no .env:**
```env
APP_NAME="Webeetools"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://seudominio.com

# Banco (se usar)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=webeetools
DB_USERNAME=webeetools
DB_PASSWORD=sua_senha_forte

# Cache
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

```bash
# Gerar chave da aplicação
php artisan key:generate

# Executar migrações (se houver)
php artisan migrate --force

# Limpar cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🔧 8. Configurar Nginx Virtual Host

```bash
# Criar configuração do site
nano /etc/nginx/sites-available/webeetools
```

**Configuração Nginx:**
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name seudominio.com www.seudominio.com;
    root /var/www/webeetools/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

```bash
# Habilitar site
ln -s /etc/nginx/sites-available/webeetools /etc/nginx/sites-enabled/
rm /etc/nginx/sites-enabled/default

# Testar configuração
nginx -t

# Reiniciar Nginx
systemctl restart nginx
```

## 🔒 9. Configurar SSL com Let's Encrypt

```bash
# Instalar Certbot
apt install -y certbot python3-certbot-nginx

# Obter certificado SSL
certbot --nginx -d seudominio.com -d www.seudominio.com

# Configurar renovação automática
crontab -e
```

**Adicionar ao crontab:**
```bash
0 12 * * * /usr/bin/certbot renew --quiet
```

## 🔥 10. Configurar Firewall

```bash
# Configurar UFW
ufw allow OpenSSH
ufw allow 'Nginx Full'
ufw enable

# Verificar status
ufw status
```

## 📊 11. Configurar Monitoramento (Opcional)

```bash
# Instalar supervisor para processos
apt install -y supervisor

# Configurar worker Laravel (se usar queues)
nano /etc/supervisor/conf.d/webeetools-worker.conf
```

**Configuração Supervisor:**
```ini
[program:webeetools-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/webeetools/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/var/www/webeetools/storage/logs/worker.log
```

```bash
# Recarregar supervisor
supervisorctl reread
supervisorctl update
supervisorctl start webeetools-worker:*
```

## 🛠️ 12. Scripts de Manutenção

```bash
# Criar script de deploy
nano /var/www/webeetools/deploy.sh
```

**Script de Deploy:**
```bash
#!/bin/bash
cd /var/www/webeetools

# Entrar em modo de manutenção
php artisan down

# Fazer pull das alterações
git pull origin main

# Instalar dependências
composer install --optimize-autoloader --no-dev

# Executar migrações
php artisan migrate --force

# Limpar cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Reiniciar PHP-FPM
systemctl reload php8.2-fpm

# Sair do modo de manutenção
php artisan up

echo "Deploy concluído!"
```

```bash
# Tornar executável
chmod +x /var/www/webeetools/deploy.sh
```

## 📝 13. Logs e Debugging

```bash
# Verificar logs do Laravel
tail -f /var/www/webeetools/storage/logs/laravel.log

# Logs do Nginx
tail -f /var/log/nginx/error.log
tail -f /var/log/nginx/access.log

# Status dos serviços
systemctl status nginx
systemctl status php8.2-fpm
systemctl status mysql
```

## 🔍 14. Testes Finais

```bash
# Testar aplicação
curl -I http://seudominio.com

# Testar API
curl -X GET "http://seudominio.com/api/v1/password/generate?length=16"

# Testar WhatsApp API
curl -X POST "http://seudominio.com/api/v1/whatsapp/generate" \
  -H "Content-Type: application/json" \
  -d '{"phone":"+5511999999999","message":"Teste"}'
```

## 📱 15. Comandos Úteis

```bash
# Reiniciar todos os serviços
systemctl restart nginx php8.2-fpm mysql

# Ver uso de memória/CPU
htop

# Ver espaço em disco
df -h

# Backup do banco
mysqldump -u webeetools -p webeetools > backup_$(date +%Y%m%d).sql

# Atualizar projeto
cd /var/www/webeetools && ./deploy.sh
```

## 🚨 Troubleshooting

### Erro 500
```bash
# Verificar logs
tail -f /var/www/webeetools/storage/logs/laravel.log

# Verificar permissões
chown -R www-data:www-data /var/www/webeetools
chmod -R 775 /var/www/webeetools/storage
```

### Erro de Composer
```bash
# Aumentar limite de memória
echo "memory_limit = 512M" >> /etc/php/8.2/cli/php.ini
```

### Performance
```bash
# Instalar Redis (opcional)
apt install -y redis-server
systemctl enable redis-server

# Configurar no .env
CACHE_DRIVER=redis
SESSION_DRIVER=redis
```

---

## ✅ Checklist Final

- [ ] PHP 8.2 instalado com todas as extensões
- [ ] Composer instalado e funcionando
- [ ] Nginx configurado com virtual host
- [ ] SSL configurado (Let's Encrypt)
- [ ] Firewall configurado (UFW)
- [ ] Projeto clonado e dependências instaladas
- [ ] Arquivo .env configurado
- [ ] Permissões corretas definidas
- [ ] Cache gerado
- [ ] API testada e funcionando
- [ ] Logs configurados
- [ ] Script de deploy criado

🎉 **Seu Webeetools está rodando em produção!** 