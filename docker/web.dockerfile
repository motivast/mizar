FROM nginx:1.10

ADD ./docker/virtualhost.conf /etc/nginx/conf.d/default.conf
