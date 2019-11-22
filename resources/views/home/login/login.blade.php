<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="/home/images/favicon.jpg">
    <link rel="stylesheet" href="/home/css/iconfont.css">
    <link rel="stylesheet" href="/home/css/global.css">
    <link rel="stylesheet" href="/home/css/bootstrap.min.css">
    <link rel="stylesheet" href="/home/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/home/css/login.css">
    <script src="/home/js/jquery.1.12.4.min.js" charset="UTF-8"></script>
    <script src="/home/js/bootstrap.min.js" charset="UTF-8"></script>
    <script src="/home/js/jquery.form.js" charset="UTF-8"></script>
    <script src="/home/js/global.js" charset="UTF-8"></script>
    <script src="/home/js/login.js" charset="UTF-8"></script>
    <title>星心光商城 -  登录 / 注册</title>
</head>
<body>
    <div class="public-head-layout container">
        <a class="logo" href="/home/index"><img src="images/favicon.jpg" alt="星心光商城" class="cover" style="width:100px;"></a>
    </div>
    <div style="background:url(images/login_bg.jpg) no-repeat center center; ">
        <div class="login-layout container">
            <div class="form-box login">
                <div class="tabs-nav">
                    <h2>欢迎登录星心光官网平台</h2>
                </div>
                <div class="tabs_container">
                    <form class="tabs_form" id="login_form" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                                </div>
                                <input class="form-control phone" id="telphone" name="telphone" required placeholder="手机号" maxlength="11" autocomplete="off" type="text" value="{{ old('telphone') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input class="form-control" name="checkcode" placeholder="输入验证码" type="text">
                                <span class="input-group-btn">
                                    <input class="btn btn-primary" id="getCodeBtn" type="button" value="免费获取手机验证码">
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                                </div>
                                <input class="form-control password" name="password" id="login_pwd" placeholder="请输入密码" autocomplete="off" type="password">
                            </div>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input checked="" id="login_checkbox" type="checkbox"><i></i> 30天内免登录
                            </label>
                            <a href="javascript:;" class="pull-right" id="resetpwd">忘记密码？</a>
                        </div>
                        <!-- 错误信息 -->
                        <div class="form-group">
                            <div style="color:red;text-align:center">
                              @if(count($errors) > 0)
                              <ul>
                                @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                                @endforeach
                              </ul>
                              @endif
                            </div>
                        </div>
                        <input class="btn btn-large btn-primary btn-lg btn-block submit" value="登录" type="submit"><br>
                        <p class="text-center">没有账号？<a href="javascript:;" id="register">免费注册</a></p>
                    </form>
                </div>
            </div>
            <div class="form-box register">
                <div class="tabs-nav">
                    <h2>欢迎注册<a href="javascript:;" class="pull-right fz16" id="reglogin">返回登录</a></h2>
                </div>
                <div class="tabs_container">
                    <form class="tabs_form" method="post" id="register_form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                                </div>
                                <input class="form-control phone" name="phone" id="phone" required placeholder="手机号" maxlength="11" autocomplete="off" type="text" value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input class="form-control" name="smscode" id="register_sms" placeholder="输入验证码" type="text">
                                <span class="input-group-btn">
                                    <input class="btn btn-primary" type="button" id="geCodeBtn" value="免费获取手机验证码">
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                                </div>
                                <input class="form-control password" name="pwd" id="register_pwd" placeholder="输入由字母或数字组成的6~12位密码" autocomplete="off" type="password">
                            </div>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input checked="" id="register_checkbox" type="checkbox"><i></i> 同意<a href="temp_article/udai_article3.html">U袋网用户协议</a>
                            </label>
                        </div>
                        <!-- 错误信息 -->
                        <div class="form-group">
                            <div class="alert alert-danger" id="errors" style="display:none;" role="alert">

                            </div>
                        </div>
                        <input class="btn btn-large btn-primary btn-lg btn-block submit" value="注册" type="button" id="regi">
                    </form>
                </div>
            </div>
            <div class="form-box resetpwd">
                <div class="tabs-nav clearfix">
                    <h2>找回密码<a href="javascript:;" class="pull-right fz16" id="pwdlogin">返回登录</a></h2>
                </div>
                <div class="tabs_container">
                    <form class="tabs_form" method="post" id="resetpwd_form">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                                </div>
                                <input class="form-control phone" name="phon" id="phon" required placeholder="手机号" maxlength="11" autocomplete="off" type="text" value="{{ old('phon') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input class="form-control" name="sms" id="sms" placeholder="输入验证码" type="text">
                                <span class="input-group-btn">
                                    <input class="btn btn-primary" type="button" id="gCodeBtn" value="免费获取手机验证码">
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                                </div>
                                <input class="form-control password" name="pass" id="pass" placeholder="设置字母或数字组成的6~12位新密码" autocomplete="off" type="password">
                            </div>
                        </div>
                        <!-- 错误信息 -->
                        <div class="form-group">
                            <div class="alert alert-danger" id="error" style="display:none;" role="alert">

                            </div>
                        </div>
                        <button class="btn btn-large btn-primary btn-lg btn-block submit" id="rese" type="button">重置密码</button>
                    </form>
                </div>
            </div>
            <script>
                var itime = 59; //定义一个变量，倒计时初始化，从59秒开始
                function getTime() {
                    if (itime >= 0) {
                        if (itime == 0) {
                            //倒计时变成0时，要清除计时器
                            clearTimeout(act);
                            //设置按钮为初始状态
                            $("#getCodeBtn").val('免费获取手机验证码').attr('disabled', false);
                            itime = 59;
                        } else {
                            //延迟一秒中执行该函数。
                            var act = setTimeout('getTime()', 1000);
                            //把倒计时的秒显示到按钮中
                            $("#getCodeBtn").val('还剩' + itime + '秒');
                            itime = itime - 1;
                        }
                    }
                }
                $(function() {
                    //登录
                    $("#getCodeBtn").click(function() {
                        //获取输入的手机号码
                        var telphone = $("#telphone").val();
                        //ajax请求文件，调用短信发送的接口
                        $.ajax({
                            type: 'post',
                            url: '/home/yan?telphone=' + telphone,
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(res) {
                                //调用接口已经成功
                                // alert('短信验证码已经发送成功');
                                $("#getCodeBtn").attr('disabled', true); //要禁用该按钮
                                //调用一个函数，完成倒计时效果。
                                getTime();
                            }
                        });
                    });

                    //注册
                    $('#regi').click(function() {
                        var pwd = $('input[name=pwd]').val();
                        var phone = $('input[name=phone]').val();
                        var smscode = $('input[name=smscode]').val();

                        var fd = new FormData();
                        fd.append('pwd', pwd);
                        fd.append('phone', phone);
                        fd.append('smscode', smscode);
                        fd.append('_token', '{{ csrf_token() }}');

                        $.ajax({
                            type: 'post',
                            url: '/home/login/register',
                            processData: false,
                            contentType: false,
                            data: fd,
                            success: function(res) {
                                if (res.code == 0) {
                                    alert(res.msg);
                                    location.href = '/home/login';
                                }
                            },
                            error: function(err) {
                                if (err.responseJSON.code == 2) {
                                    alert(err.responseJSON.msg);
                                }
                                if (err.responseJSON.errors != undefined) {
                                    $('#errors').css('display', 'block').html();
                                    let errs = err.responseJSON.errors
                                    for (err in errs) {
                                        $('<p>'+errs[err][0]+'</p>').appendTo('#errors');
                                    }
                                }
                            }
                        });
                    });

                    // 修改密码
                    $('#rese').click(function() {
                        var pass = $('input[name=pass]').val();
                        var phon = $('input[name=phon]').val();
                        var sms = $('input[name=sms]').val();

                        var fdd = new FormData();
                        fdd.append('pass', pass);
                        fdd.append('phon', phon);
                        fdd.append('sms', sms);
                        fdd.append('_token', '{{ csrf_token() }}');

                        $.ajax({
                            type: 'post',
                            url: '/home/login/resetpwd',
                            processData: false,
                            contentType: false,
                            data: fdd,
                            success: function(res) {
                                if (res.code == 0) {
                                    alert(res.msg);
                                    location.href = '/home/login';
                                }
                            },
                            error: function(err) {
                                if (err.responseJSON.code == 2) {
                                    alert(err.responseJSON.msg);
                                }
                                if (err.responseJSON.errors != undefined) {
                                    $('#error').css('display', 'block').html();
                                    let errs = err.responseJSON.errors
                                    for (err in errs) {
                                        $('<p>'+errs[err][0]+'</p>').appendTo('#error');
                                    }
                                }
                            }
                        });
                    });
                });

                //注册验证码
                var itme = 59; //定义一个变量，倒计时初始化，从59秒开始
                function geTime() {
                    if (itme >= 0) {
                        if (itme == 0) {
                            //倒计时变成0时，要清除计时器
                            clearTimeout(act);
                            //设置按钮为初始状态
                            $("#geCodeBtn").val('免费获取手机验证码').attr('disabled', false);
                            itme = 59;
                        } else {
                            //延迟一秒中执行该函数。
                            var act = setTimeout('geTime()', 1000);
                            //把倒计时的秒显示到按钮中
                            $("#geCodeBtn").val('还剩' + itme + '秒');
                            itme = itme - 1;
                        }
                    }
                }
                $(function() {
                    //定义一个函数,用于完成倒计时效果
                    $("#geCodeBtn").click(function() {
                        //获取输入的手机号码
                        var phone = $("#phone").val();
                        //ajax请求文件，调用短信发送的接口
                        $.ajax({
                            type: 'post',
                            url: '/home/yanre?phone=' + phone,
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(res) {
                                //调用接口已经成功
                                // alert('短信验证码已经发送成功');
                                $("#geCodeBtn").attr('disabled', true); //要禁用该按钮
                                //调用一个函数，完成倒计时效果。
                                geTime();
                            }
                        });
                    });
                });

                //修改密码验证码
                var tme = 59; //定义一个变量，倒计时初始化，从59秒开始
                function gTime() {
                    if (tme >= 0) {
                        if (tme == 0) {
                            //倒计时变成0时，要清除计时器
                            clearTimeout(act);
                            //设置按钮为初始状态
                            $("#gCodeBtn").val('免费获取手机验证码').attr('disabled', false);
                            tme = 59;
                        } else {
                            //延迟一秒中执行该函数。
                            var act = setTimeout('gTime()', 1000);
                            //把倒计时的秒显示到按钮中
                            $("#gCodeBtn").val('还剩' + tme + '秒');
                            tme = tme - 1;
                        }
                    }
                }
                $(function() {
                    //定义一个函数,用于完成倒计时效果
                    $("#gCodeBtn").click(function() {
                        //获取输入的手机号码
                        var phon = $("#phon").val();
                        //ajax请求文件，调用短信发送的接口
                        $.ajax({
                            type: 'post',
                            url: '/home/yanup?phone=' + phon,
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(res) {
                                //调用接口已经成功
                                // alert('短信验证码已经发送成功');
                                $("#gCodeBtn").attr('disabled', true); //要禁用该按钮
                                //调用一个函数，完成倒计时效果。
                                gTime();
                            }
                        });
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    // 判断直接进入哪个页面 例如 login.php?p=register
                    switch($.getUrlParam('p')) {
                        case 'register': $('.register').show(); break;
                        case 'resetpwd': $('.resetpwd').show(); break;
                        default: $('.login').show();
                    };
                });
            </script>
        </div>
    </div>
    <div class="footer-login container clearfix">
        <ul class="links">
            <a href=""><li>网店代销</li></a>
            <a href=""><li>U袋学堂</li></a>
            <a href=""><li>联系我们</li></a>
            <a href=""><li>企业简介</li></a>
            <a href=""><li>新手上路</li></a>
        </ul>
        <!-- 版权 -->
        <p class="copyright">
            © 2005-2017 U袋网 版权所有，并保留所有权利<br>
            ICP备案证书号：闽ICP备16015525号-2&nbsp;&nbsp;&nbsp;&nbsp;福建省宁德市福鼎市南下村小区（锦昌阁）1栋1梯602室&nbsp;&nbsp;&nbsp;&nbsp;Tel: 18650406668&nbsp;&nbsp;&nbsp;&nbsp;E-mail: 18650406668@qq.com
        </p>
    </div>
</body>
</html>