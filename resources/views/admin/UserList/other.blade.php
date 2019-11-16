@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">用户信息</h3>
    </div>
    <div class="panel-body">
        <form class="form-inline" method="get" action="other">
        <div class="row">
          <div class="form-group col-sm-1"></div>
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
            <th>用户ID</th>
            <th>收件人姓名</th>
            <th>收件人手机号码</th>
            <th>收货地址</th>
            <th>详细地址</th>
          </tr>
        </thead>
        <tbody>
          @foreach($arr as $user)
          <tr class="jiedian">
            <td>{{ $user->id }}</td>
            <td>{{ $user->uid }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->addrinfo }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  <div style="text-align:center">
    {{ $arr->appends(['name' => $search])->links() }}
  </div>
  <div class="panel">
    <a href="/admin/userList/index"> <<<< 返回 </a>
  </div>
</div>
@endsection