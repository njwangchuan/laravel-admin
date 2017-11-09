# Laravel Framework 5.3 Admin Site

--------------------------------------------------------------------------------

## 系统要求

```
PHP >= 5.6.4
OpenSSL PHP Extension
Mbstring PHP Extension
Tokenizer PHP Extension
SQL server(for example MySQL)
Composer
Node JS
```

--------------------------------------------------------------------------------

## 系统功能

- Laravel 5.3.x
- 后台

  - 用户管理
  - 角色管理
  - 权限管理（空）

- 前台

  - 用户登录
  - 用户注册
  - 首页（空）

- 组件

  - UI框架：sb-admin-2
  - 权限：entrust
  - 表单：laravel-datatables
  - 图形验证码
  - 标签颜色选择器
  - 语义化的form表单

--------------------------------------------------------------------------------

## 安装步骤:

- [Step 1: 获取代码](#step-1-获取代码)
- [Step 2: 生成配置文件](#step-2-生成配置文件)
- [Step 3: 新建数据库](#step-3-新建数据库)
- [Step 4: 初始化系统](#step-4-初始化系统)
- [Step 5: 创建表并生成数据](#step-5-创建表并生成数据)
- [Step 6: 访问页面](#step-6-访问页面)

--------------------------------------------------------------------------------

### Step 1: 获取代码

```
git clone https://github.com/njwangchuan/laravel-admin.git
```

### Step 2: 生成配置文件

拷贝`.env.example`文件为`.env`，根据实际情况配置`.env`中的变量

### Step 3: 新建数据库

根据步骤2中的配置信息，新建数据库，字符编码使用utf-8（(uft8_general_ci)

### Step 4: 初始化系统

在项目根目录执行：

```
composer update
```

然后：

```
php artisan key:generate
```

### Step 5 创建表并生成数据

创建表：

```
php artisan migrate
```

然后生成数据：

```
php artisan db:seed
```

修改web服务器访问配置，入口为：

```
http://localhost/laravel-admin/public
```

### Step 6: 访问页面

你现在可以登录系统，具有`admin`角色的用户登录后会跳转至后台，其余用户登录后会跳转至前台

```
username: admin
password: 123456
```

--------------------------------------------------------------------------------

## 故障排查

```
composer dump-autoload --optimize
```

或者

```
php artisan dump-autoload
```

--------------------------------------------------------------------------------

## License

MIT license
