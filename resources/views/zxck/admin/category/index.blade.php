{{--
version: 1.0 分类管理index页
author: wuzhihui
date: 2016/9/30
description:
--}}

@extends(config('app.theme').'.layouts.admin.content')

@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('admin')}}">后台</a></li>
  <li class="active">分类管理</li>
</ol>

<div class="panel panel-default">
  <div class="panel-body">
    <form class="form-admin-search"action="{{url('admin/category')}}" method="GET">
      <div class="col-lg-2 col-md-2 col-sm-10 col-xs-10">
          <select class="form-control" id="pid" name="pid">
            <option value="">父分类</option>
            @foreach(App\Category::all() as $s_category)
            <option value="{{$s_category->id}}">{{$s_category->name}}</option>
            @endforeach
          </select>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-10 col-xs-10">
		    <div class="input-group">
		      <input name="query_text" type="text" class="form-control">
          <input id="_sort" name="_sort" type="hidden">
          <input id="_order" name="_order" type="hidden">
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="button submit">@lang('common.search')</button>
		      </span>
		    </div>
      </div>
    </form>
    <div class="pull-right col-lg-1 col-md-1 col-sm-2 col-xs-2">
    	<a class="form-control btn btn-success" href="{{url('/admin/category/create')}}">@lang('common.add')</a>
    </div>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-body">
  	<table class="table table-striped">
  		<thead>
  			<tr>
  				<th>#</th>
          <th>父分类</th>
          <th><a class="admin-order-group" data-sort="name" data-order='asc' href="javascript:void(0)">@lang('common.name')</a></th>
          <th><a class="admin-order-group" data-sort="value" data-order='asc' href="javascript:void(0)">@lang('common.value')</a></th>
          <th><a class="admin-order-group" data-sort="serial" data-order='asc' href="javascript:void(0)">@lang('common.serial')</a></th>
          <th>@lang('common.operate')</th>
  			</tr>
  		</thead>
  		<tbody>
  			@foreach($categories as $category)
        <tr>
          <td><input class="checkbox-batch" name="checkbox[]" type="checkbox" data-group="categories" data-id="{{$category->id}}"></td>
          <td>@if(isset($category->pid)) {{$category->parent_category->name}} @else @lang('common.null') @endif</td>
          <td>{{$category->name}}</td>
          <td>{{$category->value}}</td>
          <td>{{$category->serial}}</td>
          <td>
            <a class="btn btn-primary btn-xs" href="{{url('admin/category/'.$category->id.'/edit')}}">
              <i class="fa fa-pencil"></i>
            </a>
            <form class="form-operate-delete" action="{{url('admin/category/'.$category->id)}}" method="POST">
              {{ csrf_field() }}
              <input name="_method" type="hidden" value="DELETE">
              <button class="btn btn-danger btn-xs" id="delete" name="delete" type="submit">
                  <i class="fa fa-trash-o"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
  		</tbody>
  	</table>
  </div>
</div>

<div class="panel panel-default admin-toolbar">
  <div class="panel-body">
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
      <input class="checkbox-all" type="checkbox" data-group-name="categories">
      </div>
      <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
        <button class="form-control btn btn-danger" id="batch_delete" type="button">@lang('common.delete')</button>
      </div>

      <div class="pull-right">
      {!! $categories->appends(['query_text' => old('query_text'),'pid' => old('pid'), '_sort' => old('_sort'), '_order' => old('_order')])->links() !!}
      </div>
  </div>
</div>

@endsection


@section('script')
@parent
<script src="{{url(config('app.theme').'/js/admin/category.js')}}"></script>
<script src="{{url(config('app.theme').'/js/util.js')}}"></script>
<script>
  $().ready(function(){
    AdminCategory.init();
    AdminCategory.initIndex("{{old('pid')}}");
    Util.initOrder("{{old('_sort')}}", "{{old('_order')}}");
  });
</script>
@endsection
