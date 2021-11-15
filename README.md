# wxcloudrun-thinkphp
微信云托管 thinkphp 框架模版

## 简介

了解在微信云托管上如何用php语言创建简单的http服务。通过示例创建一张todo_list表，并对其进行增删改查的操作，对应POST/DELETE/PUT/GET四种请求的实现。
微信云托管thinkphp框架模版提供nginx+fmp和apache两个环境的构建方式，默认使用Dockerfile构建nginx+fmp环境，如需使用apache环境，显示指定Dockerfile文件名为Dockerfile-Apache。

## 详细介绍：

1. 本示例中，使用的是ThinkPHP 6.0.0，要求php版本大于7.1.0.实际采用的是php7.3。
   * 如需换用其他php版本，请到Dockerfile中修改基础镜像。
2. 本示例中，提供80端口。
   * 在代码中修改端口号之后，如果使用流水线部署版本，请确保container.config.json中的containerPort字段也同步修改；如果在微信云托管控制台手动「新建版本」，请确保“监听端口”字段与代码中端口号保持一致，否则会引发部署失败。
3. 在微信云托管控制台一键部署本示例，会同时自动开通环境内的MySQL服务并完成初始化，后续可直接使用。数据库的地址、帐号、密码、数据库会被作为环境变量默认注入，在database.php中直接引用。
   * 如不想使用微信云托管自带的MySQL，请手动修改databse.php中数据库信息并在微信云托管控制台注销MySQL。
   * 未通过一键部署按钮，而是直接使用本示例的代表进行部署，需要手动在微信云托管控制台中开通MySQL，且数据库信息不会默认注入。在新建版本时需要手动将数据库信息作为环境变量填入。
   * 环境变量设置: MYSQL_ADDRESS(必填),MYSQL_PASSWORD(必填),MYSQL_USERNAME(必填),MYSQL_DATABASE(默认:thinkphp_demo)
4. 基于示例二次开发操作步骤：
   * 在微信云托管控制台一键部署，完成服务创建、MySQL初始化、首个版本部署上线。
   * fork示例代码到自己的代码仓库，在此基础上进行二次开发。
   * 服务的第二个及后续版本，基于自己的代码仓库进行部署。
5. 代码仓库中的container.config.json文件仅用于在微信云托管中创建流水线。如果不使用流水线，而是用本项目的代码在微信云托管控制台手动「新建版本」，则container.config.json配置文件不生效。最终版本部署效果以「新建版本」窗口中手动填写的值为准。

## 目录结构
~~~
.
├── Dockerfile                  构建nginx-fpm环境镜像使用（默认）
├── Dockerfile-Apache           构建apache环境镜像使用（默认）
├── README.md                   README 文件
├── app                         应用目录
│   ├── controller              控制器目录
│   ├── model                   模型目录
│   └── view                    视图目录
├── conf                        配置文件
│   ├── apache.conf             apache配置
│   └── nginx.conf              nginx配置
├── config                      thinkphp配置
├── container.config.json       微信云托管流水线配置
├── public                      WEB目录（对外访问目录）
│   ├── favicon.ico             图标
│   ├── index.php               入口文件       
│   └── router.php              快速测试文件 
├── route                       路由文件			
│   └── app.php                 定义应用路由
├── run.sh                      nginx、fpm启动
├── runtime                     应用的运行时目录（可写，可定制）
├── think                       命令行入口文件
└── vendor                      第三方类库目录
~~~


## 示例API列表

1 查询所有todo项

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


2 根据ID查询todo项

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


3 新增todo项目

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

4 根据ID修改todo项目

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

5 根据ID删除todo项

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

