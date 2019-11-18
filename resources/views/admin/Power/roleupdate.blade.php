@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">修改角色</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="roleupda" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="id" value="<?php echo $re->id ?>">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">角色名称：</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="name" value="<?php echo $re->name ?>" placeholder="角色名称">
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