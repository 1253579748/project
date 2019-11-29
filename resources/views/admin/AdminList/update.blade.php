@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">编辑管理员信息</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="upda" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="id" value="<?php echo $re->id ?>">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">用户名：</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="name" value="<?php echo $re->name ?>" placeholder="用户名">
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">密码：</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="pwd" placeholder="密码">
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">手机号：</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" name="phone" value="<?php echo $re->phone ?>" placeholder="手机号">
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">状态： </label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="status" value="1" checked="checked">启用</label> | 
                    <label>
                        <input type="checkbox" name="status" value="0">禁用</label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-5">
                    <input type="submit" value="修改">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection