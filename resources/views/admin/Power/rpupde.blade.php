@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">修改管理员角色</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="rpup" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="permission_id" value="<?php echo $res->permission_id ?>">
            <div class="form-group" style="margin-bottom:30px;margin-top:20px;">
                <label for="lastname" class="col-sm-2 control-label">权限名称：</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="name" placeholder="权限名称" value="<?php echo $re->name ?>">
                </div>
            </div>
            <div class="form-group" style="margin-bottom:30px;margin-top:20px;">
                <label for="lastname" class="col-sm-2 control-label">权限码：</label>
                <div class="col-sm-5">
                    <input type="text" value="<?php echo $re->controller ?>" name="controller" placeholder="控制器名称" style="padding:6px 12px;font-size:14px;"> @ <input type="text" value="<?php echo $re->action ?>" name="action" placeholder="方法名称" style="padding:6px 12px;font-size:14px;">
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