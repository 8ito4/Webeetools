#!/bin/bash

# 🔍 Script de Verificação do Sistema - Webeetools
# Verifica se todos os componentes estão funcionando

# Cores
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

echo -e "${BLUE}🔍 Verificando sistema Webeetools...${NC}"
echo ""

# Função para verificar status
check_status() {
    if [ $1 -eq 0 ]; then
        echo -e "${GREEN}✅ $2${NC}"
        return 0
    else
        echo -e "${RED}❌ $2${NC}"
        return 1
    fi
}

# Verificar serviços
echo -e "${YELLOW}🔧 Verificando serviços...${NC}"

systemctl is-active --quiet nginx
check_status $? "Nginx rodando"

systemctl is-active --quiet php8.2-fpm
check_status $? "PHP-FPM rodando"

# Verificar arquivos
echo -e "\n${YELLOW}📁 Verificando arquivos...${NC}"

[ -f /var/www/webeetools/public/index.php ]
check_status $? "Arquivo index.php existe"

[ -f /var/www/webeetools/.env ]
check_status $? "Arquivo .env existe"

[ -d /var/www/webeetools/vendor ]
check_status $? "Dependências Composer instaladas"

# Verificar permissões
echo -e "\n${YELLOW}🔐 Verificando permissões...${NC}"

[ -w /var/www/webeetools/storage ]
check_status $? "Diretório storage gravável"

[ -w /var/www/webeetools/bootstrap/cache ]
check_status $? "Diretório cache gravável"

# Verificar configuração Nginx
echo -e "\n${YELLOW}🌐 Verificando Nginx...${NC}"

nginx -t >/dev/null 2>&1
check_status $? "Configuração Nginx válida"

# Verificar resposta HTTP
echo -e "\n${YELLOW}🌍 Testando respostas HTTP...${NC}"

curl -s -o /dev/null -w "%{http_code}" http://localhost | grep -q "200"
check_status $? "Site responde HTTP 200"

# Testar API endpoints
echo -e "\n${YELLOW}🔌 Testando API...${NC}"

# Password API
curl -s "http://localhost/api/v1/password/generate?length=8" | grep -q "password"
check_status $? "API Password Generator funcionando"

# WhatsApp API (teste POST)
response=$(curl -s -X POST "http://localhost/api/v1/whatsapp/generate" \
  -H "Content-Type: application/json" \
  -d '{"phone":"+5511999999999","message":"teste"}')
echo "$response" | grep -q "success"
check_status $? "API WhatsApp Generator funcionando"

# JSON API
response=$(curl -s -X POST "http://localhost/api/v1/json/format" \
  -H "Content-Type: application/json" \
  -d '{"json":"{\"test\":\"value\"}"}')
echo "$response" | grep -q "success"
check_status $? "API JSON Formatter funcionando"

# Lorem API
curl -s "http://localhost/api/v1/lorem/generate?count=1" | grep -q "lorem"
check_status $? "API Lorem Ipsum funcionando"

# Verificar logs
echo -e "\n${YELLOW}📋 Verificando logs...${NC}"

if [ -f /var/www/webeetools/storage/logs/laravel.log ]; then
    errors=$(tail -50 /var/www/webeetools/storage/logs/laravel.log | grep -i error | wc -l)
    if [ $errors -eq 0 ]; then
        echo -e "${GREEN}✅ Sem erros nos logs recentes${NC}"
    else
        echo -e "${RED}⚠️ $errors erros encontrados nos logs${NC}"
    fi
else
    echo -e "${YELLOW}⚠️ Arquivo de log não encontrado${NC}"
fi

# Verificar espaço em disco
echo -e "\n${YELLOW}💾 Verificando recursos...${NC}"

disk_usage=$(df /var/www/webeetools | awk 'NR==2 {print $5}' | sed 's/%//')
if [ $disk_usage -lt 80 ]; then
    echo -e "${GREEN}✅ Espaço em disco OK ($disk_usage% usado)${NC}"
else
    echo -e "${RED}⚠️ Espaço em disco baixo ($disk_usage% usado)${NC}"
fi

# Verificar memória
memory_usage=$(free | awk 'FNR==2{printf "%.0f", $3/($3+$4)*100}')
if [ $memory_usage -lt 80 ]; then
    echo -e "${GREEN}✅ Uso de memória OK ($memory_usage% usado)${NC}"
else
    echo -e "${YELLOW}⚠️ Uso de memória alto ($memory_usage% usado)${NC}"
fi

# Verificar SSL (se configurado)
echo -e "\n${YELLOW}🔒 Verificando SSL...${NC}"

if [ -f /etc/nginx/sites-available/webeetools ]; then
    if grep -q "ssl_certificate" /etc/nginx/sites-available/webeetools; then
        echo -e "${GREEN}✅ SSL configurado${NC}"
    else
        echo -e "${YELLOW}⚠️ SSL não configurado${NC}"
    fi
fi

# Resumo final
echo ""
echo -e "${BLUE}📊 Resumo da verificação:${NC}"
echo -e "• Site: ${GREEN}http://localhost${NC}"
echo -e "• Documentação: ${GREEN}http://localhost/documentation${NC}"
echo -e "• API: ${GREEN}http://localhost/api/v1${NC}"
echo ""
echo -e "${BLUE}🛠️ Comandos úteis:${NC}"
echo "• Reiniciar serviços: sudo systemctl restart nginx php8.2-fpm"
echo "• Ver logs: tail -f /var/www/webeetools/storage/logs/laravel.log"
echo "• Verificar status: systemctl status nginx php8.2-fpm"
echo "• Deploy: cd /var/www/webeetools && ./deploy.sh"
echo "" 