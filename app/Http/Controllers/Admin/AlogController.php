<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Alog;
use IQuery;

class AlogController extends Controller
{
    //
    public function index(Request $request)
    {
    	//return "admin.alog.index";
    	
    	//$alogs = Alog::paginate(10);
    	//return view(config('app.theme').'.admin.alog.index')->withAlogs($alogs);


        $request->flash();

        $alogs = Alog::whereRaw('1 = 1');

        //文本查询
        $query_text=$request->input('query_text');
        if($query_text != null && $request != ''){
            $texts=  explode(' ', $query_text);
            foreach($texts as $text)
            {
                $alogs = $alogs->where('content', 'like', '%'.$text.'%');
            }

        }

        $module = $request->input('module');
        if($module != null && $module != ''){
        	$alogs = $alogs->where('module', $module);
        }

        $operate = $request->input('operate');
        if($operate != null && $operate != ''){
        	$alogs = $alogs->where('operate', $operate);
        }

        IQuery::ofOrder($alogs, $request);

        $alogs = $alogs->paginate(10);

        if($alogs == null || count($alogs) == 0){
            return view(config('app.theme').'.admin.alog.index')->withAlogs($alogs)->with('status', '查询结果为空');
        }else{
            return view(config('app.theme').'.admin.alog.index')->withAlogs($alogs); 
        }
    }
}
