FROM nginx:1.17.10-alpine

COPY default.conf.template /etc/nginx/conf.d/default.conf.template

COPY entrypoint.sh /entrypoint.sh

# COPY --from=assets /app/public /var/www/app/public

RUN chmod +x /entrypoint.sh

# ARG API_HOST
# ARG API_PORT

# ENV API_HOST $API_HOST
# ENV API_PORT $API_PORT

ENTRYPOINT ["sh", "/entrypoint.sh"]

CMD ["nginx", "-g", "daemon off;"]