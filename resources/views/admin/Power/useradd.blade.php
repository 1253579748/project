@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">添加管理员角色</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" onsubmit="return false" role="form" action="usersub" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputUsername3">用户名：</label>
                <div class="col-sm-3">
                    <select class="form-control" id="test">
                        @foreach($res as $re)
                        <option value="{{$re->name}}">{{$re->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputUsername3">角色名称：</label>
                <div class="col-sm-3">
                    <select class="form-control" id="rr">
                        @foreach($role as $rol)
                        <option value="{{$rol->id}}">{{$rol->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button id="btn" class="btn btn-default">添加</button>
                </div>
            </div>
        </form>
    </div>
  </div>
@endsection

@section('script')
<script>
$('#btn').click(function(){
    var options = $("#test option:selected");//获取当前选择项.
    var valu = options.val();//获取当前选择项的值.
    var option = $("#rr option:selected");
    var role_id = option.val();

    var fd = new FormData();
    fd.append('valu', valu);
    fd.append('role_id', role_id);
    fd.append('_token', '{{ csrf_token() }}');

    $.ajax({
        type: 'post',
        url: '/admin/power/usersub',
        processData: false,
        contentType: false,
        data: fd,
        success: function(res){
            if (res.code == 0){
                location.href = '/admin/power/user';
            }
        },
        error: function(err){
            alert('添加失败,请检查');
        }
    }) 
})
</script>
@endsection