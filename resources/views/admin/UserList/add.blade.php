@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">添加用户</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" id="upload">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputUsername3">用户名：</label>
                <div class="col-sm-5">
                    <input type="text" name="username" class="form-control" id="username" placeholder="用户名">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputPassword3">密码：</label>
                <div class="col-sm-5">
                    <input type="password" name="password" class="form-control" id="password" placeholder="密码">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputPhone3">手机号：</label>
                <div class="col-sm-5">
                    <input type="phone" name="phone" class="form-control" placeholder="手机号">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputEmail3">邮箱：</label>
                <div class="col-sm-5">
                    <input type="email" name="email" class="form-control" placeholder="邮箱">
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
        var username = $('input[name=username]').val();
        var password = $('input[name=password]').val();
        var phone = $('input[name=phone]').val();
        var email = $('input[name=email]').val();

        var fd = new FormData();
        fd.append('username', username);
        fd.append('password', password);
        fd.append('phone', phone);
        fd.append('email', email);
        fd.append('_token', '{{ csrf_token() }}');

        $.ajax({
            type: 'post',
            url: '/admin/userList/sub',
            processData: false,
            contentType: false,
            data: fd,
            success: function(res) {
                if (res.code == 0) {
                    location.href = '/admin/userList/index';
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