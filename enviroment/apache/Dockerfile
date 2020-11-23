FROM httpd:2.4.33-alpine

WORKDIR /var/www/html/
COPY . /var/www/html/

RUN sed -i '/LoadModule rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf

# Copy apache vhost file to proxy php requests to php-fpm container
COPY ./chat.apache.conf /usr/local/apache2/conf/chat.apache.conf
RUN echo "Include /usr/local/apache2/conf/chat.apache.conf" \
  >> /usr/local/apache2/conf/httpd.conf 
