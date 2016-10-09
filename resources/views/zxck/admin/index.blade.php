{{--
version: 1.0 后台首页
author: wuzhihui
date: 2016/9/30
description:
--}}

@extends(config('app.theme').'.layouts.admin.content')

@section('content')
admin.index
@endsection


@section('script')
@parent
<script src="{{url(config('app.theme').'/js/admin/index.js')}}"></script>
<script>
	$().ready(function(){
		AdminIndex.init();
	});	
</script>
@endsection