# 选择基础镜像。如需更换，请到(https://hub.docker.com/_/php?tab=tags) 选择后替换后缀。
FROM php:7.3-apache

# 创建工作目录，命名为app
RUN mkdir /app

# 将当前目录下所有文件添加到工作目录中
ADD . /app/

# 设置工作目录
WORKDIR /app

# 执行thinkphp启动命令 
CMD ["php", "think", "run"]
