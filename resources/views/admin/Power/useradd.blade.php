@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">添加管理员角色</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputUsername3">用户ID：</label>
                <div class="col-sm-5">
                    <input type="text" name="user_id" class="form-control" placeholder="用户ID">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputUsername3">角色ID：</label>
                <div class="col-sm-5">
                    <input type="text" name="role_id" class="form-control" placeholder="角色ID">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button id="btn" class="btn btn-default">添加</button>
                </div>
            </div>
        </form>
        <div class="alert alert-danger" id="errors" style="display:none;" role="alert">

        </div>
    </div>
  </div>
@endsection

@section('script')
<script>
    $('#btn').click(function(){
        var user_id = $('input[name=user_id]').val();
        var role_id = $('input[name=role_id]').val();

        var fd = new FormData();
        fd.append('user_id', user_id);
        fd.append('role_id', role_id);
        fd.append('_token', '{{ csrf_token() }}');

        $.ajax({
            type: 'post',
            url: '/admin/power/usersub',
            processData: false,
            contentType: false,
            data: fd,
            success: function(res) {
                if (res.code == 0) {
                    location.href = '/admin/power/user';
                }
            },
            error: function(err) {
                $('#errors').css('display', 'block').html();
                let errs = err.responseJSON.errors;

                for (err in errs) {
                    $('<p>'+errs[err][0]+'</p>').appendTo('#errors');
                }
            }
        });
        return false;
    })
</script>
@endsection