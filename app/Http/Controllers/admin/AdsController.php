<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdsController extends Controller
{
    public function show(Request $request)
    {
        $test =  null ;
        $msg = 0;
        // 将DB类 保存为变量
        $class = DB::table('ads');
        // 接收搜索数据 保存为一个变量
        $search = $request->input('lookup');
        // 判断是否搜索数据是否为空 不为空 将类添加where条件
        if ($search) {
            $class->where('title','like','%'.$search.'%');
            $test = $class->where('title','like','%'.$search.'%')->first();
            $msg = 1;
        }
//        dump($test);
        // 执行分页 每页显示5条
        $arr = $class->paginate(5);
        return view('admin.Ads.show',['arr'=>$arr,'search'=>$search,'test'=>$test,'msg'=>$msg]);
    }

    public function add (){
        return view('admin.Ads.add');
    }
    public function addData (Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'href' =>'url',
        ], [
            'required' => ':attribute必须填写',
        ], [
            'href' => '地址',
            'title' => '描述',
        ]);

        $href = $request->href;
        $title = $request->title;
        $add= DB::table('ads')->insert([
            'href'=>$href,'title'=>$title
        ]);
        if($add){
            return redirect('/admin/ads/show');
        }else{
            return back()->withInput();
        }
    }
    public function del (Request $request)
    {
        $id =$request->id;
        $del =DB::table('ads')->where('id', '=', $id)->delete();
        if ($del){
            echo '删除成功';
        }else{
            echo '删除失败';
        }
    }


    public function edit(Request $request)
    {
        $id =$request->id;
            $check=DB::table('ads')->where('id','=',$id)->get();
            $arr =$check[0];
            foreach ($arr as $k=>$v){
                $zz[$k]=$v;
        }
        return view('admin.Ads.edit',compact('zz'));
    }
    public function editData(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'href' =>'url',
        ], [
            'required' => ':attribute必须填写',
        ], [
            'href' => '地址',
            'title' => '描述',
        ]);
        $id = $request->id;
        $href = $request->href;
        $title = $request->title;
        $edit=DB::table('ads')
            ->where('id','=',$id)
            ->update([
                'href'=>$href,'title'=>$title
            ]);
        if ($edit){
            return redirect('/admin/ads/show');
        }else{
            return redirect('/admin/ads/show');
        }
    }

    public function stats(Request $request)
    {
        $id = $request->id;
        $arr =DB::table('ads')
            ->where('id', '=', $id)
            ->first();

        if ($arr->state == 1){
            DB::table('ads')
                ->where('id','=',$id)
                ->update([
                    'state'=> 0
                ]);
            return redirect('/admin/ads/show');
        }else{
            DB::table('ads')
                ->where('id','=',$id)
                ->update([
                    'state'=> 1
                ]);
            return redirect('/admin/ads/show');
        }
    }
}
