# 写在最前面：强烈建议先阅读官方教程[Dockerfile最佳实践]（https://docs.docker.com/develop/develop-images/dockerfile_best-practices/）
# 选择构建用基础镜像（选择原则：在包含所有用到的依赖前提下尽可能提及小）。如需更换，请到[dockerhub官方仓库](https://hub.docker.com/_/golang?tab=tags)自行选择后替换。
FROM  voyagerma/php7.4-fpm-mysql-nginx:beta2

# 设定工作目录
WORKDIR /app

#拷贝源码
COPY . /app

# 授权运行脚本
RUN chmod 777 /app/run.sh

# 容器启动执行脚本
ENTRYPOINT ["/app/run.sh"]

# 暴露端口
EXPOSE 80