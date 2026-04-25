#!/bin/bash

# --- Secure-Talent ATS Professional Installer ---
# Actuando como DevOps Engineer de Élite

set -e

# Colores para la terminal
GREEN='\033[0;32m'
BLUE='\033[0;34m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${BLUE}==============================================${NC}"
echo -e "${BLUE}   SECURE-TALENT ATS - PRO INSTALLER        ${NC}"
echo -e "${BLUE}==============================================${NC}"

# 1. Verificar Docker
echo -e "\n${BLUE}[1/6] Verificando Docker...${NC}"
if ! [ -x "$(command -v docker)" ]; then
  echo -e "${RED}Error: Docker no está instalado.${NC}" >&2
  exit 1
fi
echo -e "${GREEN}✔ Docker detectado.${NC}"

# 2. Configurar Entorno (.env)
echo -e "\n${BLUE}[2/6] Configurando archivo .env...${NC}"
if [ ! -f .env ]; then
  cp .env.example .env
  echo -e "${GREEN}✔ .env creado desde .env.example.${NC}"
else
  echo -e "${BLUE}✔ El archivo .env ya existe.${NC}"
fi

# Generar Blind Index Key si no existe
if ! grep -q "BLIND_INDEX_KEY" .env; then
  BI_KEY=$(openssl rand -base64 32)
  echo "BLIND_INDEX_KEY=$BI_KEY" >> .env
  echo -e "${GREEN}✔ BLIND_INDEX_KEY generada.${NC}"
fi

# 3. Levantar Contenedores
echo -e "\n${BLUE}[3/6] Levantando infraestructura (Docker Compose)...${NC}"
docker compose up -d --build
echo -e "${GREEN}✔ Contenedores activos.${NC}"

# 4. Instalación de Dependencias (Composer & NPM)
echo -e "\n${BLUE}[4/6] Instalando dependencias internas...${NC}"
docker compose exec app composer install
docker compose exec app npm install
echo -e "${GREEN}✔ Dependencias instaladas.${NC}"

# 5. Configuración de Base de Datos
echo -e "\n${BLUE}[5/6] Preparando base de datos y llaves...${NC}"
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate:fresh --seed --force
echo -e "${GREEN}✔ Base de datos migrada y poblada con seeders.${NC}"

# 6. Compilación de Assets
echo -e "\n${BLUE}[6/6] Compilando assets de frontend...${NC}"
docker compose exec app npm run build
echo -e "${GREEN}✔ Assets compilados.${NC}"

echo -e "\n${GREEN}==============================================${NC}"
echo -e "${GREEN}   INSTALACIÓN COMPLETADA EXITOSAMENTE        ${NC}"
echo -e "${GREEN}==============================================${NC}"
echo -e "Accede al sistema en: ${BLUE}http://localhost${NC}"
echo -e "Credenciales Admin: ${BLUE}admin@secure-talent.com / password${NC}"
echo -e "${GREEN}==============================================${NC}"
