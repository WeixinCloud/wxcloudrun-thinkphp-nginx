# 写在最前面：强烈建议先阅读官方教程[Dockerfile最佳实践]（https://docs.docker.com/develop/develop-images/dockerfile_best-practices/）
# 选择构建用基础镜像（选择原则：在包含所有用到的依赖前提下尽可能提及小）。如需更换，请到[dockerhub官方仓库](https://hub.docker.com/_/golang?tab=tags)自行选择后替换。
FROM php:7.3-fpm-buster

## 安装nginx
RUN apt-get update && apt-get -y install nginx

# 安装pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql

# 设定工作目录
WORKDIR /app

#拷贝源码
COPY . .

# 暴露端口
EXPOSE 80

# 授权运行脚本 && 替换nginx配置
RUN chmod 755 /app/run.sh && cp /app/conf/nginx.conf /etc/nginx/sites-enabled/default

# 容器启动执行脚本
CMD ["sh", "run.sh"]