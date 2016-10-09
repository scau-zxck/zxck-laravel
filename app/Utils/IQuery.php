<?php 

/*
 * @version: 0.1 查询工具类范例
 * @author: wuzhihui
 * @date: 2016/9/4
 * @description:
 *
 */

namespace app\Utils;

class IQuery{


	//加入排序
	public function ofOrder(&$query, $request)
	{
		//$query = $query->orderBy('id', 'desc');
		$sort = $request->input('_sort');
		$order =$request->input('_order');
		if($sort != null && $sort != ''){
			if($order != null && $order == 'desc') $query = $query->orderBy($sort, 'desc');
			else $query = $query->orderBy($sort,'asc');
		}else{
			$query = $query->orderBy('id', 'desc');
		}
		return $query;
	}

	//加入删除字段
	public static function ofDelete(&$query, $request)
	{
		//待补充
	}

	
}