FROM nginx:1.23

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}
ENV NGINX_USER=laravel

RUN groupadd -g ${GID} ${NGINX_USER}
RUN useradd -u ${UID} -g ${GID} ${NGINX_USER} && \
    sed -i -E "s/^user\s+(www-data|nginx)/user\t${NGINX_USER}/" /etc/nginx/nginx.conf

EXPOSE 80
EXPOSE 5173
EXPOSE 8000
 
