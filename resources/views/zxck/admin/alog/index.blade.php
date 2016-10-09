{{--
version: 1.0 用户管理index页
author: wuzhihui
date: 2016/10/7
description:
--}}

@extends(config('app.theme').'.layouts.admin.content')

@section('content')
<ol class="breadcrumb">
  <li><a href="{{url('admin')}}">后台</a></li>
  <li class="active">操作日志</li>
</ol>

<div class="panel panel-default">
  <div class="panel-body">
      <form class="form-admin-search"action="{{url('admin/alog')}}" method="GET">
        <div class="col-lg-2 col-md-2 col-sm-12 col-sm-12">
          <select class="form-control" id="module" name="module">
            <option value="">@lang('common.module')</option>
            <option value="User">User</option>
            <option value="Info">Info</option>
          </select>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-sm-12">
          <select class="form-control" id="operate" name="operate">
            <option value="">@lang('common.operate')</option>
            @foreach(App\Alog::OPERATE as $key=>$operate)
            <option value="{{$key}}">{{$operate}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-10 col-xs-10">
  		    <div class="input-group">
  		      <input name="query_text" type="text" class="form-control" value="{{old('query_text')}}" placeholder="请输入内容进行查询">
            <input id="_sort" name="_sort" type="hidden">
            <input id="_order" name="_order" type="hidden">
  		      <span class="input-group-btn">
  		        <button class="btn btn-default" type="button submit">@lang('common.search')</button>
  		      </span>
  		    </div>
    	</div>
    </form>
    <div class="pull-right col-lg-1 col-md-1 col-sm-2 col-xs-2">
    	{{--<a class="form-control btn btn-success" href="{{url('/admin/alog/create')}}">@lang('common.add')</a>--}}
    </div>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-body">
  	<table class="table table-striped">
  		<thead>
  			<tr>
  				<th>#</th>
          <th><a class="admin-order-group" data-sort="log_time" data-order="asc" href="javascript:void(0)">@lang('common.time')</a></th>
          <th>@lang('common.username')</th>
          <th>@lang('common.module')</th>
          <th>@lang('common.operate')</th>
          <th>@lang('common.content')</th>
          <th>@lang('common.ip')</th>
          {{--<th>@lang('common.operate')</th>--}}
  			</tr>
  		</thead>
  		<tbody>
        @foreach($alogs as $alog)
        <tr>
          <td><input class="checkbox-batch" name="checkbox[]" type="checkbox" data-group="alogs" data-id="{{$alog->id}}"></td>
          <td>{{$alog->log_time}}</td>
          <td>{{$alog->user->name}}</td>
          <td>{{$alog->module}}</td>
          <td>{{App\Alog::OPERATE[$alog->operate]}}</td>
          <td>{{$alog->content}}</td>
          <td>{{$alog->ip}}</td>
          {{--
          <td>
            <a class="btn btn-primary btn-xs" href="{{url('admin/alog/'.$alog->id.'/edit')}}">
              <i class="fa fa-pencil"></i>
            </a>
            <form class="form-operate-delete" action="{{url('admin/alog/'.$alog->id)}}" method="POST">
              {{ csrf_field() }}
              <input name="_method" type="hidden" value="DELETE">
              <button class="btn btn-danger btn-xs" id="delete" name="delete" type="submit">
                  <i class="fa fa-trash-o"></i>
              </button>
            </form>
          </td>
          --}}
        </tr>
        @endforeach
  		</tbody>
  	</table>
  </div>
</div>

@if($alogs->links()  != '')
<div class="panel panel-default admin-toolbar">
  <div class="panel-body">
      {{--
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
      <input class="checkbox-all" type="checkbox" data-group-name="users">
      </div>
      <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
        <button class="form-control btn btn-danger" id="batch_delete" type="button">@lang('common.delete')</button>
      </div>
      --}}
      <div class="pull-right">
      {!! $alogs->appends(['query_text' => old('query_text'),'module' => old('module'), 'operate' => old('operate'), '_sort' => old('_sort'), '_order' => old('_order')])->links() !!}
      </div>
  </div>
</div>
@endif

@endsection


@section('script')
@parent
<script src="{{url(config('app.theme').'/js/admin/alog.js')}}"></script>
<script src="{{url(config('app.theme').'/js/util.js')}}"></script>
<script>
  $().ready(function(){
    AdminAlog.init();
    AdminAlog.initIndex("{{old('module')}}", "{{old('operate')}}");
    Util.initOrder("{{old('_sort')}}", "{{old('_order')}}");
  });
</script>
@endsection
