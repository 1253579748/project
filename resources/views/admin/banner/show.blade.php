@extends('admin.index.index')
@section('cssjs')
    <link rel="stylesheet" href="/login/css/font.css">
    <link rel="stylesheet" href="/login/css/xadmin.css">
    <script type="text/javascript" src="/login/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/login/js/xadmin.js"></script>

    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
@stop
@section('main')
    <div class="layui-card-body ">
        <table class="layui-table layui-form">
            <thead>

            <tr>
                <th width="70">ID</th>
                <th width="100">描述</th>
                <th width="200">网址</th>
                <th width="250">图片</th>
                <th>操作</th>
            </thead>
            <tbody class="x-cate">
            {{--            判断是否搜索到数据 --}}
                @foreach($arr as $k=>$v)
                    <tr cate-id='1' fid='0' >
                        <td>{{$v->id}}</td>
                        <td>
                            <i class="layui-icon x-show" >{{$v->img_describe}}</i>
                        </td>
                        <td>
                            <i class="layui-icon x-show">{{$v->img_url}}</i>
                        </td>
                        <td>
                            <img  class="layui-icon x-show" src="/storage/admin/banner_img/{{$v->img_add}}" alt="1">
{{--                            <i class="layui-icon x-show">{{$v->img_add}}</i>--}}
                        </td>
                        <td class="td-manage" style="width: 100px">
                            <button class="layui-btn layui-btn layui-btn-xs" onclick="edit({{$v->id}})"><i class="layui-icon">&#xe642;</i>编辑</button>
                            <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="del({{$v->id}})"><i class="layui-icon">&#xe640;</i>删除</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{--        输出分页--}}
        {{ $arr->links() }}
    </div>
@stop
@section('js')
    <script>
        function del(id) {
            var url = "/admin/banner/del?id="+id;
            console.dir(url);
            location.href=url;

        }
        function edit(id) {
            var url = "/admin/banner/edit?id="+id;
            console.dir(url);
            location.href=url;
        }
    </script>
@stop