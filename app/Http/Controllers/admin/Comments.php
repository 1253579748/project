<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use DB;
class Comments extends Controller
{
    public function index(){
    	$data = DB::table('comments')->where('pid','=','0')->get();
    	foreach ($data as $k => $v) {
    		//查询uid的用户名
    		$uid = $v->uid;
    		$uname = DB::table('users')->where('id','=',$uid)->value('username');
    		$data[$k]->uid = $uname;

    		//查询gid的商品名
    		$gid = $v->gid;
    		$gname = DB::table('goods')->where('id','=',$gid)->value('name');
    		$data[$k]->gid = $gname;
    	}
    	
    	return view('admin.comments.index',['data'=>$data]);

    }

    //更新留言信息
    public function update(Request $request){

    	$id = $request->input('id');
    	$data = DB::select("select * from comments where pid = $id order by created_at desc");
    	foreach ($data as $k => $v) {
    		$data[$k]->created_at = date('Y-m-d H:i:s', $v->created_at);
    	}
    	return $data;
    }

    public function store(Request $request){
    	$id = $request->input('id');
    	$text = $request->input('text');

    	//补全数据
    	$data['text'] = $text;
    	$data['pid'] = $id;
    	$data['uid'] = session()->get('userInfo.id');
    	$data['role'] = '1';
    	$data['created_at'] = date('Y-m-d H:i:s', time());
    	$res = DB::table('comments')->insert($data);
    	if($res){
    		//回复成功改变留言状态
    		$com = DB::table('comments')->where('id','=',$id)->update(['status'=>1]);

    		return redirect('/admin/comments/index')->with('success','回复成功');
    	}else{
    		return back()->with('error','回复失败');
    	}

    }

    public function add(Request $request)
    {
        dump($request->all());
        $this->validate($request, [
            'goods_ids' => 'required',
            'text' => 'required'
        ]);

        $data = explode('_', $request->goods_ids);

        foreach ($data as $k=>$v) {
            if (!is_numeric($v)) continue;
            $model = new Comment;
            $model->uid = session()->get('userInfo.id');
            $model->gid = $v;
            $model->text = $request->text;

            $model->save();
            
        }

      
    }

    public function delete(Request $request){
    	$id = $request->input('id');
    	$res = DB::table('comments')->where('pid','=',$id)->orwhere('id','=',$id)->delete();
    	if($res){
    		return 'ok';
    	}else{
    		return 'no';
    	}
    	
    }
}
