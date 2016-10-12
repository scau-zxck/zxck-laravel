{{--
version: 1.0 后台模板
author: wuzhihui
date: 2016/9/30
description:
--}}

@extends('layouts.app')

@section('css')
@parent
<link href="//cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//cdn.bootcss.com/layer/2.4/skin/layer.min.css" rel="stylesheet">
@endsection

@section('app')
    <nav class="navbar navbar-default navbar-static-top admin-navar-top">
        <div class="container-fluid">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="{{url('/')}}">@lang('common.index')</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a id="a-admin-name" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a id="a-admin-settings" href="javascript:void(0)">@lang('common.settings')</a>
                            </li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    @lang('common.logout')
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


	<div class="col-lg-2 admin-navar-left">
        <div class="list-group">
            <li class="list-group-item">后台管理</li>
            <a href="/admin" class="list-group-item" id="left-nav-index-index">@lang('common.index')</a>
        </div>
        @if(Auth::user()->type == App\User::TYPE_ADMIN)
        <div class="list-group">
            <li class="list-group-item">系统管理</li>
            <a href="{{url('/admin/info')}}" class="list-group-item" id="left-nav-info-manager">
                <i class="fa fa-database" aria-hidden="true"></i>&nbsp;&nbsp;配置管理
            </a>
            <a href="{{url('/admin/category')}}" class="list-group-item" id="left-nav-category-manager">
                <i class="fa fa-sitemap" aria-hidden="true"></i>&nbsp;&nbsp;分类管理
            </a>
            <a href="{{url('/admin/user')}}" class="list-group-item" id="left-nav-user-manager">
                <i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;用户管理
            </a>
            <a href="{{url('/admin/alog')}}" class="list-group-item" id="left-nav-alog">
                <i class="fa fa-calendar" aria-hidden="true"></i></i>&nbsp;&nbsp;操作日志
            </a>
        </div>
        @endif
    </div>
    <div class="col-lg-10 admin-content">
    	@yield('content')
    </div>
    <div class="col-lg-12 admin-footer">
        <span> <i class="fa fa-copyright"></i>&nbsp;2016-2016 {{config('app.copyright')}}  All rights reserved.</span>
    </div>

    <div id="admin-settings" style="display: none; padding: 20px 20px;">
        <form class="form-horizontal" id="form-suser" role="form" action="{{url('admin/user/'.Auth::user()->id).'/settings'}}" method="post">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" id="id" name="id" value="{{Auth::user()->id}}">
          <div class="form-group">
            <label for="sname" class="col-sm-2 control-label">@lang('common.name')</label>
            <div class="col-sm-10">
              <input class="form-control" id="sname" name="sname" type="text" placeholder="@lang('common.name')" value="{{Auth::user()->name}}">
            </div>
          </div>
          <div class="form-group">
            <label for="spassword" class="col-sm-2 control-label">@lang('common.password')</label>
            <div class="col-sm-10">
              <input class="form-control" id="spassword" name="spassword" type="password" placeholder="@lang('common.password')">
            </div>
          </div>
          <div class="form-group">
            <label for="spassword2" class="col-sm-2 control-label">确认@lang('common.password')</label>
            <div class="col-sm-10">
              <input class="form-control" id="spassword2" name="spassword2" type="password" placeholder="确认@lang('common.password')">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button id="btn-suser-save" type="submit" class="btn btn-default">@lang('common.save')</button>
            </div>
          </div>
        </form>
    </div>

@endsection



@section('script')
    @parent
    <script src="{{url(config('app.theme').'/js/common.js')}}"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="//cdn.bootcss.com/layer/2.4/layer.min.js"></script>
    @include('layouts.jquery_validate')
    @yield('jquery_validate')
    <script src="//cdn.bootcss.com/jquery.form/3.51/jquery.form.min.js"></script>
    @if (session('status'))
    <script>
        layer.msg("{{session('status')}}");
    </script>
    @elseif(isset($status))
    <script>
        layer.msg("{{$status}}");
    </script>
    @endif
    <script src="{{url(config('app.theme').'/js/admin/content.js')}}"></script>
    <script>
        $().ready(function() {
            AdminContent.init();
        });
    </script>
@endsection