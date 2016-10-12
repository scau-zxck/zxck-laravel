{{--
version: 1.0 配置管理create页
author: wuzhihui
date: 2016/9/30
description:
--}}

@extends(config('app.theme').'.layouts.admin.content')

@section('content')

<ol class="breadcrumb">
  <li><a href="{{url('admin')}}">后台</a></li>
  <li><a href="{{url('admin/info')}}">分类管理</a></li>
  <li class="active">@lang('common.add')</li>
</ol>

<div class="panel panel-default">
  <div class="panel-body">

      @include(config('app.theme').'.layouts.admin.error_alert')
      @yield('error_alert')

		<form class="form-horizontal" id="form-category" role="form" action="{{url('admin/category')}}" method="post">
			{{ csrf_field() }}
		  <div class="form-group">
		  	<label for="pid" class="col-sm-2 control-label">父分类</label>
		  	<div class="col-sm-10">
		  		<select class="form-control" id="pid" name="pid">
		  			<option value="">@lang('common.null')</option>
		  			@foreach(App\Category::all() as $s_category)
		  			<option value="{{$s_category->id}}">{{$s_category->name}}</option>
		  			@endforeach
		  		</select>
		  	</div>
		  </div>
		  <div class="form-group">
		  	<label for="name" class="col-sm-2 control-label">@lang('common.name')</label>
		  	<div class="col-sm-10">
		  		<input class="form-control" id="name" name="name" type="text" placeholder="@lang('common.name')">
		  	</div>
		  </div>
		  <div class="form-group">
		  	<label for="value" class="col-sm-2 control-label">@lang('common.value')</label>
		  	<div class="col-sm-10">
		  		<input class="form-control" id="value" name="value" type="text" placeholder="@lang('common.value')">
		  	</div>
		  </div>
		  <div class="form-group">
		  	<label for="serial" class="col-sm-2 control-label">@lang('common.serial')</label>
		  	<div class="col-sm-10">
		  		<input class="form-control" id="serial" name="serial" type="text" placeholder="@lang('common.serial')">
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
<script src="{{url(config('app.theme').'/js/admin/category.js')}}"></script>
<script>
	AdminCategory.init();
	AdminCategory.initCreate();
</script>
@endsection