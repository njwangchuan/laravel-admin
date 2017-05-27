<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">

  <title>@section('title') Laravel Admin @show</title>
  @section('favicon')
  <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicon/apple-icon-57x57.png')}}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicon/apple-icon-60x60.png')}}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicon/apple-icon-72x72.png')}}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicon/apple-icon-76x76.png')}}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicon/apple-icon-114x114.png')}}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicon/apple-icon-120x120.png')}}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicon/apple-icon-144x144.png')}}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicon/apple-icon-152x152.png')}}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-icon-180x180.png')}}">
  <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('favicon/android-icon-192x192.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon/favicon-96x96.png')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
  <link rel="manifest" href="{{asset('favicon/manifest.json')}}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{asset('favicon/ms-icon-144x144.png')}}">
  <meta name="theme-color" content="#ffffff">
  @show
  @section('meta_keywords')
  <meta name="keywords" content="Laravel Admin"/>
  @show
  @section('meta_author')
  <meta name="author" content="njwangchun"/>
  @show
  @section('meta_description')
  <meta name="description"
  content="Laravel Admin"/>
  @show
  @section('styles')
  <link href="{{ asset('css/site.css') }}" rel="stylesheet">
  @show
</head>
<body id="{{ (Request::is('home')||Request::is('/') ? 'page-top' : 'index') }}">
  <nav id="mainNav" class="navbar navbar-default navbar-fixed-top {{ (Request::is('home') ? '' : 'affix') }}">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <a class="navbar-brand page-scroll" href="{{ (Request::is('home')||Request::is('/') ? '#page-top' : URL::to('home')) }}">
          <img alt="laravel" src="{{ asset('img/logo_transparent.jpg') }}" height="20">
        </a>
        <a class="navbar-brand page-scroll" href="{{ (Request::is('home')||Request::is('/') ? '#page-top' : URL::to('home')) }}">
          {!! trans('site/site.nav_title') !!}
        </a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          @if (Auth::guest())
          <li class="{{ (Request::is('login') ? 'active' : '') }}"><a
            href="{{ URL::to('login') }}">{!! trans("site/site.login") !!}</a>
          </li>
          <li class="{{ (Request::is('register') ? 'active' : '') }}"><a
            href="{{ URL::to('register') }}">{!! trans("site/site.sign_up") !!}</a>
          </li>
          @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
            aria-expanded="false"><i class="fa fa-user"></i> {{ Auth::user()->display_name }} <i
            class="fa fa-caret-down"></i></a>
            <ul class="dropdown-menu" role="menu">
              @if(Auth::user()->hasRole('admin'))
              <li>
                <a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-tachometer"></i> {!! trans("site/site.admin_dashboard") !!}</a>
              </li>
              @endif
              @if(Auth::check())
              <li>
                <a href="{{ URL::to('account/profile') }}"><i class="fa fa-user"></i> {!! trans("site/site.user_profile") !!}</a>
              </li>
              <li>
                <a href="{{ URL::to('account/setting') }}"><i class="fa fa-gear"></i> {!! trans("site/site.user_setting") !!}</a>
              </li>
              <li role="presentation" class="divider"></li>
              <li>
                <a href="{{ URL::to('logout') }}"><i class="fa fa-sign-out"></i> {!! trans("site/site.logout") !!}</a>
              </li>
              @endif
            </ul>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
</body>
@yield('content')
</body>
@section('scripts')
<script src="{{ asset('js/site.js') }}"></script>
@show
</html>
