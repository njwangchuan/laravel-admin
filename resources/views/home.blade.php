@extends('layouts.app')

@section('styles')
@parent
<link href="{{ asset('css/site.css') }}" rel="stylesheet">
@endsection

@section('header')
<header>

</header>
@endsection

@section('content')
<section>
  <h2>欢迎使用 laravel admin </h1>
  <div class="alert alert-success">
    <p>laravel admin 是基于Laravel的管理后台原型项目，您正在使用的是Laravel 5.5 LTS 版本</p>
  </div>
  <h3>系统功能</h3>
  <h4>前台</h4>
  <ul>
    <li>首页</li>
    <li>用户<a href="register">注册</a></li>
    <li>用户<a href="login">登录</a></li>
  </ul>
  <h4>后台</h4>
  <ul>
    <li>用户管理</li>
    <li>角色管理</li>
    <li>权限管理</li>
  </ul>
  <h4>组件</h4>
  <ul>
    <li>sb-admin-2</li>
    <li>entrust</li>
    <li>laravel-datatables</li>
    <li>图形验证码</li>
    <li>标签颜色选择器</li>
    <li>语义化的form表单</li>
  </ul>
</section>
@endsection

@section('scripts')
@parent

@endsection
