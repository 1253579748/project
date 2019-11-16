@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">用户信息</h3>
    </div>
    <div class="panel-body">
        <form class="form-inline" method="get" action="index">
        <div class="panel-body">
          <div class="form-group col-sm-3">
            <label>用户名:</label>
            <input type="text" class="form-control" name="name" placeholder="用户名">
          </div>
          <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">搜索</button>
          </div>
        </div>
        </form>
      <table class="table table-hover" style="margin-top:2px;">
        <thead>
          <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>手机号</th>
            <th>邮箱</th>
            <th>创建时间</th>
            <th>修改时间</th>
            <th>状态</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          @foreach($arr as $user)
          <tr class="jiedian">
            <td>{{ $user->id }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>
            <td>
              @if (($user->status) == 1)
                <p style="color:skyblue;">启用</p>
              @else
                <p style="color:red;">禁用</p>
              @endif
            </td>
            <td>
                <button type="submit" class="btn btn-primary delete" data-id="{{ $user->id }}">删除</button>
                <a href="/admin/userList/update?id=<?php echo $user->id ?>">修改</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  <div style="text-align:center">
    {{ $arr->appends(['name' => $search])->links() }}
  </div>
  <div class="panel">
    <a href="/admin/userList/other"> >>>> 查看更多信息 </a>
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
            url: '/admin/userList/del/' + $(this).data('id'),
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