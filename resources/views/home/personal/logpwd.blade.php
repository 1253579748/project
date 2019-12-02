@extends('home.user.frame')

@section('title', '修改登录密码')
@section('main')
<div class="pull-right">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="mt" style="padding: 10px;">
            <ul><li><a href="" style="padding-bottom:0;color:#e4393c;border-bottom:2px solid #e4393c;font-weight:700;cursor: pointer;text-decoration: none;">修改登录密码</a></li>
            </ul>
        </div>
        <form class="form-horizontal" role="form" action="logpass" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="id" value="<?php echo $log->id ?>">
            <div class="form-group" style="margin-bottom: 30px;">
                <label for="firstname" class="col-sm-2 control-label">旧密码：</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" name="pwd" placeholder="请输入旧密码" maxlength="12">
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 30px;">
                <label for="firstname" class="col-sm-2 control-label">新密码：</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" name="password" placeholder="请输入由字母或数字组成的6~12位密码" maxlength="12">
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 30px;">
                <label for="firstname" class="col-sm-2 control-label">确认密码：</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" name="pass" placeholder="确认密码" maxlength="12">
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 30px;">
                <label for="firstname" class="col-sm-2 control-label">验证码：</label>
                <div class="col-sm-5">
                    <input name="captcha" lay-verify="required" placeholder="验证码"  type="text" class="form-control">
                    <img src="{{captcha_src()}}" style="cursor:pointer;margin-top:10px;" onclick="this.src='{{captcha_src()}}'+Math.random()" title="点击图片重新获取验证码">
                    <span style="margin-left:20px;font-size:12px;color:#999"> 看不清？点击图片换一张</span>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 20px; text-align:center;">
                <div class="col-sm-offset-2 col-sm-5">
                    <input type="submit" value="修改" style="width:100px;height:30px;">
                </div>
            </div>
        </form>
        <!-- 错误信息 -->
        <div style="color:red;text-align:center;">
          @if(count($errors) > 0)
          <ul>
            @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
          </ul>
          @endif
        </div>
    </div>
</div>
@endsection