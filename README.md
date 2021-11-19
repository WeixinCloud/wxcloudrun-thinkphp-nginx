# wxcloudrun-thinkphp
[![GitHub license](https://img.shields.io/github/license/WeixinCloud/wxcloudrun-express)](https://github.com/WeixinCloud/wxcloudrun-express)
![GitHub package.json dependency version (prod)](https://img.shields.io/badge/php-7.3-green)

## 简介
微信云托管 thinkphp 框架模版，通过示例创建一张 todo_list 表，并对其进行增删改查的操作，对应 POST/DELETE/PUT/GET 四种请求的实现。
该提供 nginx+fmp 和 apache 两个环境的构建方式，默认使用 Dockerfile 构建 nginx+fmp 环境，如需使用 apache 环境，显示指定 Dockerfile 文件名为 Dockerfile-Apache。

![](https://qcloudimg.tencent-cloud.cn/raw/3159427f92e66f3bd431c21e25f18793.png)


## 详细介绍：
1. 本示例中，使用的是 ThinkPHP 6.0.0，要求php版本大于 7.1.0，实际采用的是 php7.3。
   * 如需换用其他php版本，请到 Dockerfile 中修改基础镜像。
2. 本示例中，提供80端口。
   * 在代码中修改端口号之后，如果使用流水线部署版本，请确保 container.config.json 中的 containerPort 字段也同步修改；如果在微信云托管控制台手动「新建版本」，请确保“监听端口”字段与代码中端口号保持一致，否则会引发部署失败。
3. 在微信云托管控制台一键部署本示例，会同时自动开通环境内的MySQL服务并完成初始化，后续可直接使用。数据库的地址、帐号、密码、数据库会被作为环境变量默认注入，在 database.php 中直接引用。
   * 如不想使用微信云托管自带的 MySQL，请手动修改 databse.php 中数据库信息并在微信云托管控制台注销 MySQL。
   * 未通过一键部署按钮，而是直接使用本示例的代表进行部署，需要手动在微信云托管控制台中开通 MySQL，且数据库信息不会默认注入。在新建版本时需要手动将数据库信息作为环境变量填入。
   * 环境变量设置: MYSQL_ADDRESS(必填), MYSQL_PASSWORD(必填), MYSQL_USERNAME(必填), MYSQL_DATABASE(默认: thinkphp_demo)
4. 基于示例二次开发操作步骤：
   * 在微信云托管控制台一键部署，完成服务创建、MySQL 初始化、首个版本部署上线。
   * fork 示例代码到自己的代码仓库，在此基础上进行二次开发。
   * 服务的第二个及后续版本，基于自己的代码仓库进行部署。
5. 代码仓库中的 container.config.json 文件仅用于在微信云托管中创建流水线。如果不使用流水线，而是用本项目的代码在微信云托管控制台手动「新建版本」，则 container.config.json 配置文件不生效。最终版本部署效果以「新建版本」窗口中手动填写的值为准。


## 快速开始
前往 [微信云托管快速开始页面](https://developers.weixin.qq.com/miniprogram/dev/wxcloudrun/src/basic/guide.html)，选择相应语言的模板，根据引导完成部署。


## 目录结构
~~~
.
├── Dockerfile                  构建 nginx-fpm 环境镜像使用（默认）
├── Dockerfile-Apache           构建 apache 环境镜像使用（默认）
├── README.md                   README 文件
├── app                         应用目录
│   ├── controller              控制器目录
│   ├── model                   模型目录
│   └── view                    视图目录
├── conf                        配置文件
│   ├── apache.conf             apache 配置
│   └── nginx.conf              nginx 配置
├── config                      thinkphp 配置
├── container.config.json       微信云托管流水线配置
├── public                      WEB目录（对外访问目录）
│   ├── favicon.ico             图标
│   ├── index.php               入口文件       
│   └── router.php              快速测试文件 
├── route                       路由文件			
│   └── app.php                 定义应用路由
├── run.sh                      nginx、fpm 启动
├── runtime                     应用的运行时目录（可写，可定制）
├── think                       命令行入口文件
└── vendor                      第三方类库目录
~~~

## 示例API列表

1 查询所有 todo 项

* URL路径：
  ```/api/todos```
  
* 请求示例：
```
curl -X GET  http://{ip}:{port}/api/todos
```

* 响应示例：
```
{
  "code": 0,
  "errorMsg": "",
  "data": [{
    "id": 1,
    "title": "工作1",
    "status": "准备中",
    "create_time": "2021-11-09T08:45:40Z",
    "update_time": "2021-11-09T08:45:40Z"
  }, {
    "id": 2,
    "title": "工作2",
    "status": "已开始",
    "create_time": "2021-11-09T08:46:11Z",
    "update_time": "2021-11-09T08:46:11Z"
  }]
}
```


2 根据 ID 查询 todo 项

* URL路径：
  ```/api/todos/:id```
  
* 请求示例：
```
curl -X GET  http://{ip}:{port}/api/todos/1
```

* 响应示例：
```
{
  "code": 0,
  "errorMsg": "",
  "data": {
    "id": 1,
    "title": "工作1",
    "status": "准备中",
    "create_time": "2021-11-09T08:45:40Z",
    "update_time": "2021-11-09T08:45:40Z"
  }
}
```


3 新增 todo 项目

* URL路径：
  ```/api/todos```
  
* 请求示例：
```
curl http://{ip}:{port}/api/todos \
  -X POST \
  -H 'Content-Type: application/json' \
  -d '{  
    "title":"工作1",
    "status":"准备中"
  }'
```

* 响应示例：
```
{
  "code": 0,
  "errorMsg": "",
  "data": {
    "id": 1,
    "title": "工作1",
    "status": "准备中",
    "create_time": "2021-11-09T08:45:40Z",
    "update_time": "2021-11-09T08:45:40Z"
  }
}
```

4 根据 ID 修改 todo 项目

* URL路径：
  ```/api/todos```
  
* 请求示例：
```
curl http://{ip}:{port}/api/todos \
  -X PUT \
  -H 'Content-Type: application/json' \
  -d '{  
    "id":1,
    "status":"已完成"
  }'
```

* 响应示例：
```
{
  "code": 0,
  "errorMsg": ""
}
```

5 根据 ID 删除 todo 项

* URL路径：
  ```/api/todos/:id```
  
* 请求示例：
```
curl http://{ip}:{port}/api/todos/1 \
  -X DELETE \
  -H 'Content-Type: application/json' \
  -d '{   }'
```

* 响应示例：
```
{
  "code": 0,
  "errorMsg": ""
}
```

