@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">修改权限</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="upda" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="id" value="<?php echo $re->id ?>">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">权限名称：</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="name" value="<?php echo $re->name ?>" placeholder="权限名称">
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">简短描述：</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="descr" value="<?php echo $re->descr ?>" placeholder="简短描述">
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">控制器名称：</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="controller" value="<?php echo $re->controller ?>" placeholder="控制器名称">
                </div>
            </div>
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">操作方法名称：</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="action" value="<?php echo $re->action ?>" placeholder="操作方法名称">
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