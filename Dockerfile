# 写在最前面：强烈建议先阅读官方教程[Dockerfile最佳实践]（https://docs.docker.com/develop/develop-images/dockerfile_best-practices/）
# 选择构建用基础镜像（选择原则：在包含所有用到的依赖前提下尽可能提及小）。如需更换，请到[dockerhub官方仓库](https://hub.docker.com)自行选择后替换。
FROM ubuntu:xenial-20210804

# 拷贝软件源文件
COPY ./sources.list /etc/apt/sources.list

# 安装PHP运行环境需要的软件
RUN    apt-get update && apt-get install -y language-pack-en-base && locale-gen en_US.UTF-8 && apt-get install -y software-properties-common && LC_ALL=en_US.UTF-8  add-apt-repository ppa:ondrej/php &&  apt-get update
RUN apt-get install -y php7.4 php7.4-fpm  php7.4-pdo php7.4-mysql php7.4-gd php7.4-curl php7.4-xml nginx
RUN rm -Rf /var/lib/apt/lists/*

# 拷贝Nginx配置文件
COPY docker/thinkphp.conf /etc/nginx/sites-enabled/default

# 声明工作目录
WORKDIR /app

# 拷贝源码到docker容器中
COPY . /app/

# 服务启动脚本授权
RUN chmod 777 /app/run.sh

# 执行启动脚本
ENTRYPOINT ["/app/run.sh"]

# 暴露端口
EXPOSE 80