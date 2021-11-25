# 写在最前面：强烈建议先阅读官方教程[Dockerfile最佳实践]（https://docs.docker.com/develop/develop-images/dockerfile_best-practices/）
# 选择构建用基础镜像（选择原则：在包含所有用到的依赖前提下尽可能提及小）。如需更换，请到[dockerhub官方仓库](https://hub.docker.com/_/php?tab=tags)自行选择后替换。
FROM php:7.3-fpm-alpine3.13

# 安装依赖包
RUN apk --no-cache --update add nginx \
    && docker-php-ext-install pdo_mysql

# 设定工作目录
WORKDIR /app

# 将当前目录下所有文件拷贝到/app
COPY . /app

# 替换nginx配置
# /app/runtime 权限
RUN cp /app/conf/nginx.conf /etc/nginx/conf.d/default.conf \
    && mkdir -p /run/nginx \
    && chmod 777 /app/runtime

# 暴露端口
EXPOSE 80

# 容器启动执行脚本
CMD ["sh", "run.sh"]