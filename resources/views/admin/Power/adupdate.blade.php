@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">修改角色</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="adupda" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="id" value="<?php echo $re->id ?>">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">用户ID：</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="user_id" value="<?php echo $re->user_id ?>" placeholder="用户ID">
                </div>
            </div>
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">角色ID：</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="role_id" value="<?php echo $re->role_id ?>" placeholder="角色ID">
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