@extends('home.user.frame')

@section('title', '个人资料')
@section('main')
<div class="pull-right">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="container">
            <div class="mt" style="padding: 10px;">
                <ul><li><a href="" style="padding-bottom: 0;color: #e4393c;border-bottom: 2px solid #e4393c;font-weight: 700;cursor: pointer;text-decoration: none;">基本信息</a></li>
                </ul>
            </div>
            <!-- 左侧 -->
            <div class="col-sm-5" style="padding: 20px 5px 0 15px;">
                <div class="panel-heading" style="margin-bottom: 20px;">
                    <span>用户名：</span><strong>{{ $res->username }}</strong>
                </div>
                <div class="panel-heading" style="margin-bottom: 20px;">
                    <span>真实姓名：</span>
                    @if (($user->name) == null)
                    <strong style="color:red;">未填写</strong>
                    @else
                    <strong>{{ $user->name }}</strong>
                    @endif
                </div>
                <div class="panel-heading" style="margin-bottom: 20px;">
                    <span>性别：</span>
                    @if (($user->sex) == null)
                    <strong style="color:red;">未填写</strong>
                    @elseif(($user->sex) == 1)
                    <strong>男</strong>
                    @elseif(($user->sex) == 2)
                    <strong>女</strong>
                    @elseif(($user->sex) == 3)
                    <strong>保密</strong>
                    @endif
                </div>
                <div class="panel-heading" style="margin-bottom: 20px;">
                    <span>手机号码：</span><strong>{{ $res->phone }}</strong><span style="padding-left:25px;color:#999;font-size:10px">可用于登录,请牢记哦~</span>
                </div>
                <div class="panel-heading" style="margin-bottom: 20px;">
                    <span>邮箱：</span>
                    @if (($res->email) == null)
                    <strong style="color:red;">未绑定</strong>
                    @else
                    <strong>{{ $res->email }}</strong>
                    @endif
                </div>
                <div class="panel-heading" style="margin-bottom: 20px;">
                    <span>账号状态：</span>
                    @if (($res->status) == 1)
                    <strong style="color:skyblue;">正常</strong>
                    @else
                    <strong style="color:red;">禁用</strong>
                    @endif
                </div>
                <div class="panel-heading" style="margin-bottom: 20px;">
                    <span>注册时间：</span><strong>{{ $res->created_at }}</strong>
                </div>
                <div class="panel-heading" style="margin-bottom: 20px;">
                    <a href="/home/personal/update?id=<?php echo $res->id ?>&uid=<?php echo $user->uid ?>" style="margin:0px 0px 5px 5px;padding:6px 8px;font-size:12px;text-decoration:none;text-align:center;line-height:30px;cursor: pointer;color:white;background-color:rgba(255,0,0,.8)">修改信息</a>
                </div>
            </div>

            <!-- 右侧 -->
            <div class="col-sm-4" style="padding:20px;margin-bottom:20px;height:150px;background:#f9f9f9;border:1px solid #ccc;color:#666;line-height: 20px;">
                <div style="margin-right:6px;width:104px;height:104px;float:left;"><img src="/home/images/tou.jpeg" style="width:100%;"></div>
                <div style="float:left;">
                    <div><b>用户名：{{ $res->username }}</b></div>
                    <div style="margin-bottom:10px;">
                        <span>
                            <img src="/home/images/xxg-icon.png">
                            <a href="" style="color:#F03435;text-decoration:none;">星享值8888</a>
                        </span>
                    </div>
                    <div>小星信用：<a href="" style="text-decoration:none;color:#005ea7">666</a></div>
                    <div>会员类型：个人用户</div>
                </div>
            </div>
            <div style="width:70%;text-align: center;">
                <span style="color:#999;font-size:12px">
                    注：修改密码请到 
                    <a href="/home/personal/paypwd?uid=<?php echo $user->uid ?>" style="color:#005ea7;text-decoration:none;">修改支付密码</a>
                    <a href="/home/personal/logpwd?id=<?php echo $res->id ?>" style="color:#005ea7;text-decoration:none;">修改登录密码</a>
                </span>
            </div>
        </div>
    </div>
</div>
</div>
@endsection