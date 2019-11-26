@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">添加角色权限</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="roposub" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputUsername3">角色名称：</label>
                <div id="checkboxDiv" >&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="role_id" value="1" />超级管理员&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="role_id" value="2" />一般管理员&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="role_id" value="3" checked/>普通管理员
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputUsername3">权限名称：</label>
                <div class="col-sm-5">
                    <input type="text" name="name" class="form-control" placeholder="权限名称">
                </div>
            </div>
            <div class="form-group" style="margin-bottom:30px;margin-top:20px;">
                <label for="lastname" class="col-sm-2 control-label">权限码：</label>
                <div class="col-sm-5">
                    <input type="text" name="controller" placeholder="控制器名称" style="padding:6px 12px;font-size:14px;"> @ <input type="text" name="action" placeholder="方法名称" style="padding:6px 12px;font-size:14px;">
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
    $(document).ready(function(){
        $(function(){
            $("#checkboxDiv").find(":checkbox").each(function(){
                $(this).click(function(){
                    if($(this).is(':checked')){
                        $(this).attr('checked',true).siblings().attr('checked',false);
                    }else{
                        $(this).attr('checked',false).siblings().attr('checked',false);
                    }
                });
            });
        });
    });
</script>
@endsection