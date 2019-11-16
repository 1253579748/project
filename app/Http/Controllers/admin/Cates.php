<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Cates extends Controller
{
    public static function getTypes()
    {
        $data = DB::select('select *,concat(path,id,",") as paths from types order by paths asc' );
        foreach ($data as $k => $v) {
                $path = $v->path;
                $str1 = str_replace(',',"",$path);
                $num = strlen($path)-strlen($str1);
                if($num == 2){
                   $data[$k]->name = "|------".$v->name;
                }else if($num == 3){
                   $data[$k]->name = "|------"."|------".$v->name;
                }
            
        }
        return $data;

    }


    public function Index()
    {
    	$data = DB::table('types')->get();
    	
    	return view('admin.cates.index',['data'=>self::getTypes()]);
    }


    public function create()
    {
    	return view('admin.cates.create',['data'=>self::getTypes()]);
    	
    }
    public function store(Request $request){
       
        $pid = $request->input('pid');
        //判断是否是顶级分类 如果不是就查他的父级
        if($pid == '0'){
            $path= $pid.',';
        }else{
        //父类查询
        $type_date = DB::table('types')->where('id',$pid)->first();
        //拼接path路径 
        $path = $type_date->path.$type_date->id.',';

        }
        
        $data['pid'] = $pid;
        $data['path'] = $path;
        $data['name'] = $request->input('name');
        $res = DB::table('types')->insert($data);
        if($res){
            return redirect('/admin/cates/index')->with('success', '添加成功!');
        }else{
            return back()->with('error','添加失败');
        }

    }

    public function update(Request $request){
        $id = $request->input('id');
        $name = str_replace('|------',"",$request->input('name'));
        $res = DB::table('types')->where('id',$id)->update(['name'=>$name]);
        if($res){
            return 'ok';
        }else{
            return 'no';
        }
    }

    public function delete(Request $request){
        $id = $request->input('id');
        $res = DB::table('types')->where('id','=',$id)->delete();
        if($res){
            return 'ok';
        }else{
            return 'no';
        }
    }
}
