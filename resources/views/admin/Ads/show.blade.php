@extends('admin.index.index')
@yield("js")
<link rel="stylesheet" href="/login/css/font.css">
<link rel="stylesheet" href="/login/css/xadmin.css">
<script type="text/javascript" src="/login/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/login/js/xadmin.js"></script>

<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
<script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>

@section('main')
    <button type="submit" class="btn btn-primary" style="margin-left:15px;" onclick="list()">返回列表</button>
    <form class="form-inline" style="margin-left:15px;margin-top:10px;" action="show" method="get">
        <div class="form-group">
            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
            <div class="input-group">
                <input type="text" name="lookup" value="{{$search}}" class="form-control" id="exampleInputAmount" placeholder="名称">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">搜索</button>
    </form>
    <div class="layui-card-body ">
        <table class="layui-table layui-form">
            <thead>
            <tr>
                <th width="70">ID</th>
                <th width="100">名称</th>
                <th width="200">网址</th>
                <th width="250">操作</th>
            </thead>
            <tbody class="x-cate">
{{--            判断是否搜索到数据 --}}
            @if ($test != null || $msg = 1)
                @foreach($arr as $k=>$v)
                    <tr cate-id='1' fid='0' >
                        <td>{{$v->id}}</td>
                        <td>
                            <i class="layui-icon x-show" >{{$v->title}}</i>
                        </td>
                        <td>
                            <i class="layui-icon x-show">{{$v->href}}</i>
                        </td>
                        <td class="td-manage">
                            <button class="layui-btn layui-btn layui-btn-xs" onclick="edit({{$v->id}})"><i class="layui-icon">&#xe642;</i>编辑</button>
                            <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="del({{$v->id}})"><i class="layui-icon">&#xe640;</i>删除</button>
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td>暂无友情链接</td>
                        </tr>
                    @endif
            </tbody>
        </table>
{{--        输出分页--}}
        {{ $arr->appends(['lookup' => $search])->links() }}
    </div>
@stop
@section('js')
        <script>
        function del(id) {
            $.ajax({
                url:'/admin/ads/del',
                method:'get',
            data:{
                "id":id
            },
                headers: {

                },
            success: function(res){
                alert(res);
                location.href="/admin/ads/show";
                }
            })
        }
        function edit(id) {
            var url = "/admin/ads/edit?id="+id;
            console.dir(url);
            location.href=url;
        }
        function list() {
            location.href="/admin/ads/show";
        }
    </script>
@stop
