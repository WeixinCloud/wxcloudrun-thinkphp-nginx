#!/bin/sh

# 后台启动
service php7.4-fpm start
# 关闭后台启动，hold住进程
nginx -g 'daemon off;'