FROM ubuntu:latest

#define variable enviroment to pre install programs
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=UTC

# Update install packeges to php and apache
RUN apt-cache search libapache2* && apt-get update && \
    apt-get install -y apache2 php libapache2-mod-php php-cli vim

#Enable PHP module in apache
RUN a2enmod php8.1

# Copy html files to Apache directory
COPY ./site /var/www/html

# Open port 80
EXPOSE 80

# Command for start apache to first plan
CMD ["apache2ctl", "-D", "FOREGROUND"]
