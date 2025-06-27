# Usa imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instala dependências do sistema necessárias para Laravel
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libonig-dev \
    libzip-dev \
    zip \
    libpq-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath

# Ativa o módulo rewrite do Apache para URLs amigáveis
RUN a2enmod rewrite

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia todos os arquivos para dentro do container
COPY . .

# Instala as dependências PHP do Laravel via Composer
RUN composer install --no-dev --optimize-autoloader

# Ajusta permissões para storage e cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expõe a porta 80 para o container
EXPOSE 80

# Comando para iniciar o Apache em foreground
CMD ["apache2-foreground"]
