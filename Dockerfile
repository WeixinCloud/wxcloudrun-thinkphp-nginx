# 选择基础镜像。如需更换，请到(https://hub.docker.com/_/php?tab=tags) 选择后替换后缀。
FROM php:7.3-fpm

# 安装基本依赖
RUN apt-get update
RUN apt-get -y install software-properties-common
RUN add-apt-repository ppa:ondrej/php
RUN ln -sf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime && echo 'Asia/Shanghai' >/etc/timezone
RUN apt-get install -y php7.3
RUN docker-php-ext-install mysqli pdo_mysql

# 添加nginx配置
RUN apt-get install -y nginx

# 配置nginx
COPY thinkphp.conf /etc/nginx/sites-enabled/default

WORKDIR /app
COPY . /app

# 启动Nginx服务
CMD service nginx start

# 暴露端口
EXPOSE 80
