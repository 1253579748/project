@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">修改管理员角色</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="adupda" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="id" value="<?php echo $re->id ?>">
            <div class="form-group" style="margin-bottom:30px;margin-top:20px;">
                <label for="lastname" class="col-sm-2 control-label">角色名称：</label>
                <div id="checkboxDiv" >&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="role_id" value="1" />超级管理员&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="role_id" value="2" />一般管理员&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="role_id" value="3" checked/>普通管理员
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