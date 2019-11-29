@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">添加角色权限</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="roposub" method="post" onsubmit="return false">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputUsername3">角色名称：</label>
                <div class="col-sm-3">
                    <select class="form-control" id="tt">
                        @foreach($res as $t)
                        <option value="{{$t->id}}">{{$t->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group" style="margin-bottom:30px;margin-top:20px;">
                <label for="lastname" class="col-sm-2 control-label">权限码：</label>
                <div class="col-sm-5">
                    <select class="form-control" id="rr">
                        @foreach($re as $key=>$e)
                        <option value="{{$e->id}}">{{$e->controller}} @ {{$e->action}} --> {{$e->name}}</option>
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
    var option = $("#rr option:selected");
    var permission_id = option.val();
    var options = $("#tt option:selected");
    var user_id = options.val();

    var fd = new FormData();
    fd.append('permission_id', permission_id);
    fd.append('user_id', user_id);
    fd.append('_token', '{{ csrf_token() }}');

    $.ajax({
        type: 'post',
        url: '/admin/power/usesub',
        processData: false,
        contentType: false,
        data: fd,
        success: function(res){
            if (res.code == 0){
                location.href = '/admin/power/userole';
            }
        },
        error: function(err){
            alert('添加失败,请重试');
        }
    }) 
})
</script>
@endsection