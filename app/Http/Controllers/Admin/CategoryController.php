<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category, App\Alog;
use Redirect;
use IQuery;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return "admin.category.index";
        //$categories = Category::paginate(10);
        //return view(config('app.theme').'.admin.category.index')->withCategories($categories);

        $request->flash();

        $categories = Category::whereRaw('1 = 1');


        //文本查询
        $query_text=$request->input('query_text');
        if($query_text != null && $request != ''){
            $texts=  explode(' ', $query_text);
            foreach($texts as $text)
            {
                $categories = $categories->where('name', 'like', '%'.$text.'%');
            }

        }

        $pid = $request->input('pid');

        if($pid != null && $pid != ""){
            $categories = $categories->where('pid', '=', $pid); 
        }


        IQuery::ofOrder($categories, $request);

        $categories = $categories->paginate(10);

        if($categories == null || count($categories) == 0){
            return view(config('app.theme').'.admin.category.index')->withCategories($categories)->with('status', '查询结果为空');
        }else{
            return view(config('app.theme').'.admin.category.index')->withCategories($categories); 
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config('app.theme').'.admin.category.create');
    }


    public function storeOrUpdate(Request $request, $id = 0)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'serial' => 'required|string|max:255|unique:categories,serial,'.$id,
            'pid' => 'exists:categories,id',
        ]);


        $name = $request->input('name');
        $value = $request->input('value');
        $serial = $request->input('serial');
        $pid = $request->input('pid');

        if($id == 0){
            $category = new Category;
        }else{
            $category = Category::find($id);
        }

        $category->name = $name;
        $category->value = $value;
        $category->serial = $serial;
        if($pid != null && $pid != "") $category->pid = $pid;
        else $category->pid = null;

        if($category->save()){
            if($id == 0) $operate = Alog::OPERATE_CREATE;
            else $operate = Alog::OPERATE_UPDATE;
            Alog::log('Category', $operate, $category->name, $request->getClientIp());
            return Redirect::to('admin/category')->with('status', '保存成功');
        }else{
            return Redirect::back()->withErrors('保存失败');
        }


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return $this->storeOrUpdate($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view(config('app.theme').'.admin.category.edit')->withCategory($category);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->storeOrUpdate($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $category = Category::find($id);

        if($category->delete()){

            Alog::log('Category', Alog::OPERATE_DELETE, $category->name, $request->getClientIp());
            return Redirect::back()->with('status', '删除成功');
        }else{
            return Redirect::back()->withErrors();
        }
    }
}
