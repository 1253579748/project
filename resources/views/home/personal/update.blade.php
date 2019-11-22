@extends('home.user.frame')

@section('title', '修改资料')
@section('main')
<div class="pull-right">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="mt" style="padding: 10px;">
            <ul><li><a href="" style="padding-bottom:0;color:#e4393c;border-bottom:2px solid #e4393c;font-weight:700;cursor: pointer;text-decoration: none;">修改基本信息</a></li>
            </ul>
        </div>
        <form class="form-horizontal" role="form" action="upda" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="id" value="<?php echo $users->id ?>">
            <div class="form-group" style="margin-bottom: 30px;">
                <label for="firstname" class="col-sm-2 control-label">用户名：</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="username" value="<?php echo $users->username ?>" placeholder="用户名">
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 30px;">
                <label for="lastname" class="col-sm-2 control-label">手机号码：</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="phone" value="<?php echo $users->phone ?>" placeholder="输入大陆手机号码">
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 30px;">
                <label for="lastname" class="col-sm-2 control-label">邮箱：</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="email" value="<?php echo $users->email ?>" placeholder="绑定邮箱">
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 20px; text-align:center;">
                <div class="col-sm-offset-2 col-sm-5">
                    <input type="submit" value="修改" style="width:100px;height:30px;">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="mt" style="padding: 10px;">
            <ul><li><a href="" style="padding-bottom:0;color:#e4393c;border-bottom:2px solid #e4393c;font-weight:700;cursor: pointer;text-decoration: none;">修改详情</a></li>
            </ul>
        </div>
        <form class="form-horizontal" role="form" action="upd" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="uid" value="<?php echo $userinfo->uid ?>">
            <div class="form-group" style="margin-bottom: 30px;">
                <label for="firstname" class="col-sm-2 control-label">真实姓名：</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="name" value="<?php echo $userinfo->name ?>" placeholder="请输入姓名">
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 30px;">
                <label for="lastname" class="col-sm-2 control-label">性别：</label>
                <div id="checkboxDiv" >&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="checkboxName" value="1" />男&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="checkboxName" value="2" />女&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="checkboxName" value="3" checked/>保密
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 20px; text-align:center;">
                <div class="col-sm-offset-2 col-sm-5">
                    <input type="submit" value="修改" style="width:100px;height:30px;">
                </div>
            </div>
        </form>
    </div>
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