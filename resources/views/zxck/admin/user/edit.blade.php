{{--
version: 1.0 用户管理edit页
author: wuzhihui
date: 2016/10/7
description:
--}}

@extends(config('app.theme').'.layouts.admin.content')

@section('content')

<ol class="breadcrumb">
  <li><a href="{{url('admin')}}">后台</a></li>
  <li><a href="{{url('admin/user')}}">用户管理</a></li>
  <li class="active">@lang('common.edit')</li>
</ol>

<div class="panel panel-default">
  <div class="panel-body">

      @include(config('app.theme').'.layouts.admin.error_alert')
      @yield('error_alert')

		<form class="form-horizontal" id="form-user" role="form" action="{{url('admin/user/'.$user->id)}}" method="post">
			{{ csrf_field() }}
			<input name="_method" type="hidden" value="PUT">
			<input type="hidden" id="id" name="id" value="{{$user->id}}">
		  <div class="form-group">
		    <label for="name" class="col-sm-2 control-label">@lang('common.name')</label>
		    <div class="col-sm-10">
		      <input class="form-control" id="name" name="name" type="text" placeholder="@lang('common.name')" value="{{$user->name}}">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="email" class="col-sm-2 control-label">@lang('common.email')</label>
		    <div class="col-sm-10">
		      <input class="form-control" id="email" name="email" type="text" placeholder="@lang('common.email')" value={{$user->email}}>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="password" class="col-sm-2 control-label">@lang('common.password')</label>
		    <div class="col-sm-10">
		      <input class="form-control" id="password" name="password" type="password" placeholder="@lang('common.password')">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="password2" class="col-sm-2 control-label">确认@lang('common.password')</label>
		    <div class="col-sm-10">
		      <input class="form-control" id="password2" name="password2" type="password" placeholder="确认@lang('common.password')">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="type" class="col-sm-2 control-label">@lang('common.type')</label>
		    <div class="col-sm-10">
		    	<select class="form-control" id="type" name="type">
		    		@foreach(App\User::TYPE as $key=>$type)
		    		<option value="{{$key}}">{{$type}}</option>
		    		@endforeach
		    	</select>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default">@lang('common.save')</button>
		    </div>
		  </div>
		</form>
  </div>
</div>

@endsection


@section('script')
@parent
<script src="{{url(config('app.theme').'/js/admin/user.js')}}"></script>
<script>
  $().ready(function(){
    AdminUser.init();
    AdminUser.initEdit("{{$user->type}}");
  });
</script>
@endsection
