# Usa uma imagem PHP com suporte para FPM
FROM php:8.2-fpm

# Instala extensões do PHP
RUN docker-php-ext-install pdo pdo_mysql

# Instala o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instala Node.js e npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia o código do Laravel para o contêiner
COPY . .

# Instala dependências do Laravel e do Vite
RUN composer install && npm install

# Permite que o Vite rode na porta 5173
EXPOSE 5173
