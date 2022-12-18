#!/bin/sh

# 后台启动php-fpm; 关闭nginx后台启动，hold住进程
php-fpm -D && nginx -g 'daemon off;'
