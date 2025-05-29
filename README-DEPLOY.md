# 🚀 Deploy Webeetools - Digital Ocean

## 📥 Instalação Rápida (1 Comando)

```bash
# Na sua máquina Digital Ocean (Ubuntu 22.04)
curl -sSL https://raw.githubusercontent.com/8ito4/Webeetools/main/install.sh | sudo bash
```

## 📋 O que você precisa:

### 🖥️ **Servidor**
- **Digital Ocean Droplet** (mínimo 1GB RAM)
- **Ubuntu 22.04 LTS**
- **Acesso root via SSH**

### 🌐 **Domínio (opcional)**
- Compre um domínio ou use subdomain
- Configure DNS para apontar para seu servidor
- Exemplo: `A record: @ → SEU_IP_DIGITAL_OCEAN`

## 🔧 **Componentes Instalados**

O script automático instala:

- ✅ **PHP 8.2** + todas extensões necessárias
- ✅ **Composer** (gerenciador de dependências)
- ✅ **Nginx** (servidor web)
- ✅ **Firewall** (UFW) configurado
- ✅ **SSL gratuito** (Let's Encrypt)
- ✅ **Projeto clonado** e configurado
- ✅ **Permissões** corretas
- ✅ **Scripts de manutenção**

## 📱 **Funcionalidades Disponíveis**

### 🌍 **Interface Web**
- Site principal: `https://seudominio.com`
- Documentação: `https://seudominio.com/documentation`
- Ferramentas interativas

### 🔌 **API REST**
- **Base URL**: `https://seudominio.com/api/v1`
- **Endpoints**: 4 APIs funcionais
- **Formato**: JSON responses
- **Rate Limit**: 1000 req/hora

### 🛠️ **Ferramentas**
- Gerador de Senhas
- Formatador JSON
- Gerador WhatsApp Links
- Lorem Ipsum Generator
- Teste de Conexão de Rede
- E mais...

## 🚀 **Passo a Passo Detalhado**

### 1️⃣ **Criar Droplet na Digital Ocean**

```bash
# Especificações mínimas
- OS: Ubuntu 22.04 LTS
- RAM: 1GB (recomendado 2GB)
- Storage: 25GB
- CPU: 1 vCPU
```

### 2️⃣ **Conectar via SSH**

```bash
ssh root@SEU_IP_DIGITAL_OCEAN
```

### 3️⃣ **Executar Instalação**

```bash
# Download e execução em uma linha
curl -sSL https://raw.githubusercontent.com/8ito4/Webeetools/main/install.sh | sudo bash
```

**Durante a instalação você será perguntado:**
- Domínio (ex: webeetools.com)
- Email para SSL (ex: admin@webeetools.com)
- Branch do Git (padrão: main)

### 4️⃣ **Configurar DNS**

No seu provedor de domínio:
```
Type: A
Name: @
Value: SEU_IP_DIGITAL_OCEAN
TTL: 3600

Type: A
Name: www
Value: SEU_IP_DIGITAL_OCEAN
TTL: 3600
```

### 5️⃣ **Verificar Instalação**

```bash
# Executar verificação do sistema
./check-system.sh

# Testar API
curl https://seudominio.com/api/v1/password/generate
```

## 📊 **Gerenciamento e Manutenção**

### 🔄 **Deploy de Atualizações**

```bash
# No servidor
cd /var/www/webeetools
./deploy.sh
```

### 📋 **Comandos Úteis**

```bash
# Ver logs em tempo real
tail -f /var/www/webeetools/storage/logs/laravel.log

# Status dos serviços
systemctl status nginx php8.2-fpm

# Reiniciar serviços
systemctl restart nginx php8.2-fpm

# Verificar uso de recursos
htop
df -h
```

### 🔍 **Monitoramento**

```bash
# Verificação completa do sistema
/var/www/webeetools/check-system.sh

# Logs do Nginx
tail -f /var/log/nginx/error.log
tail -f /var/log/nginx/access.log
```

## 🔒 **Segurança**

### ✅ **Já Configurado**
- Firewall UFW ativado
- SSL automático (Let's Encrypt)
- Renovação SSL automática
- Headers de segurança no Nginx
- Permissões adequadas nos arquivos

### 🛡️ **Recomendações Extras**

```bash
# Alterar porta SSH (opcional)
nano /etc/ssh/sshd_config
# Port 2222
systemctl restart ssh

# Adicionar usuário não-root
adduser webeeadmin
usermod -aG sudo webeeadmin
```

## 🚨 **Troubleshooting**

### ❌ **Site não carrega**

```bash
# Verificar status dos serviços
systemctl status nginx php8.2-fpm

# Verificar logs
tail -f /var/log/nginx/error.log
tail -f /var/www/webeetools/storage/logs/laravel.log

# Reiniciar tudo
systemctl restart nginx php8.2-fpm
```

### ❌ **API não funciona**

```bash
# Testar localmente
curl http://localhost/api/v1/password/generate

# Verificar permissões
chown -R www-data:www-data /var/www/webeetools
chmod -R 775 /var/www/webeetools/storage
```

### ❌ **SSL não funciona**

```bash
# Reconfigurar SSL
certbot --nginx -d seudominio.com -d www.seudominio.com

# Verificar renovação
certbot renew --dry-run
```

## 💰 **Custos Estimados**

### Digital Ocean
- **Droplet 1GB**: $6/mês
- **Droplet 2GB**: $12/mês (recomendado)

### Domínio
- **.com**: $10-15/ano
- **.dev**: $12-20/ano

### SSL
- **Let's Encrypt**: Gratuito! 🎉

**Total**: ~$6-12/mês + domínio

## 📞 **Suporte**

### 🐛 **Reportar Bugs**
- GitHub Issues: [github.com/8ito4/Webeetools](https://github.com/8ito4/Webeetools)

### 📧 **Contato**
- Email: 8ito4.contato@gmail.com

### 📚 **Documentação**
- Acesse: `https://seudominio.com/documentation`

---

## ✅ **Checklist de Deploy**

- [ ] Droplet criado na Digital Ocean
- [ ] SSH configurado e funcionando
- [ ] Script de instalação executado
- [ ] DNS configurado para o domínio
- [ ] SSL funcionando (https://)
- [ ] API testada e funcionando
- [ ] Verificação do sistema executada
- [ ] Backup do servidor configurado

🎉 **Pronto! Seu Webeetools está rodando em produção!** 