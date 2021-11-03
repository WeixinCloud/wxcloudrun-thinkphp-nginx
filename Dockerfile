# 选择基础镜像。如需更换，请到(https://hub.docker.com/_/php?tab=tags) 选择后替换后缀。
FROM php:7.3-fpm

# 安装基本依赖
RUN apt-get update && \
    apt-get -y install software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get install -y php7.3  && \
    ln -sf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime && echo 'Asia/Shanghai' >/etc/timezone && \
    docker-php-ext-install mysqli pdo_mysql && \
    apt-get install -y nginx

# 配置nginx
COPY thinkphp.conf /etc/nginx/sites-enabled/default

WORKDIR /app
COPY . /app

RUN chmod 755 /app/run.sh
ENTRYPOINT ["/app/run.sh"]

# 暴露端口
EXPOSE 80