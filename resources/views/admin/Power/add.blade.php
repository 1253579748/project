@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">添加管理员</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" id="upload">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputUsername3">权限名称：</label>
                <div class="col-sm-5">
                    <input type="text" name="name" class="form-control" id="name" placeholder="权限名称">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputPassword3">简短描述：</label>
                <div class="col-sm-5">
                    <input type="text" name="descr" class="form-control" id="descr" placeholder="简短描述">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputPhone3">控制器名称：</label>
                <div class="col-sm-5">
                    <input type="text" name="controller" class="form-control" placeholder="控制器名称">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputPhone3">操作名称：</label>
                <div class="col-sm-5">
                    <input type="text" name="action" class="form-control" placeholder="操作名称">
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
        var name = $('input[name=name]').val();
        var descr = $('input[name=descr]').val();
        var controller = $('input[name=controller]').val();
        var action = $('input[name=action]').val();

        var fd = new FormData();
        fd.append('name', name);
        fd.append('controller', controller);
        fd.append('action', action);
        fd.append('descr', descr);
        fd.append('_token', '{{ csrf_token() }}');

        $.ajax({
            type: 'post',
            url: '/admin/power/sub',
            processData: false,
            contentType: false,
            data: fd,
            success: function(res) {
                if (res.code == 0) {
                    location.href = '/admin/power/index';
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