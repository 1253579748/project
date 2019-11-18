@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">权限详情</div>
    <form class="form-inline" method="get" action="index">
        <div class="panel-body">
            <!-- <div class="col-sm-1"></div> -->
          <div class="form-group col-sm-3">
            <label>权限名称:</label>
            <input type="text" class="form-control" name="name" placeholder="权限名称">
          </div>
          <div class="col-sm-1">
            <button type="submit" class="btn btn-primary">搜索</button>
          </div>
          <div class="col-sm-1"></div>
          <div class="col-sm-3">
            <a href="/admin/power/add" style="color:red;"> ==> 添加权限</a>
          </div>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>权限名称</th>
                <th>简短描述</th>
                <th>控制器名字</th>
                <th>操作名字</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($arr as $re)
            <tr>
                <td>{{ $re->id }}</td>
                <td>{{ $re->name }}</td>
                <td>{{ $re->descr }}</td>
                <td>{{ $re->controller }}</td>
                <td>{{ $re->action }}</td>
                <td>
                    <button type="submit" class="btn btn-primary delete" data-id="{{ $re->id }}">删除</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="text-align:center">
    {{ $arr->appends(['name' => $search])->links() }}
    </div>
</div>
@endsection

@section('script')
<script>
    //删除
    $('.delete').click(function(){
        let _t = this;
        $.ajax({
            type: 'post',
            url: '/admin/power/del/' + $(this).data('id'),
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                if (res.code == 0) {
                    $(_t).parent().parent().remove();
                }
            },
            error: function(err) {
                alert(err.responseJSON.msg);
            }
        })
    });
</script>
@endsection