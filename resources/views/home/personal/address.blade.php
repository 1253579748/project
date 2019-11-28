@extends('home.user.frame')

@section('css')
<link rel="stylesheet" href="/home/css/ljc.css">
<link rel="stylesheet" href="/home/css/add.css">
@endsection
@section('title', '地址管理')
@section('main')
<div class="pull-right">
    <div class="ri-menu fr">
        <div class="menumain p">
            <div class="goodpiece" style="padding: 10px;">
                <b style="border-bottom:2px solid #e4393c;float:left;">地址管理</b>
                <button class="btn btn-primary btn-lg address" data-toggle="modal" data-target="#myModal">增加新地址</button>
            </div>
            <div class="grou_num_list address_list_jl ma-to-20">
                <ul class="grou_tite">
                    <li class="sx2"><span>收货人</span></li>
                    <li class="sx1"><span>收货地址</span></li>
                    <li class="sx3"><span>联系电话</span></li>
                    <li class="sx5"><span>操作</span></li>
                </ul>
                @foreach($address as $ress)
                <ul class="add_conta">
                    @if (($ress->is_default) == 1)
                        <ins class="deftip" style="color:blue">默认地址</ins>
                    @else
                        <ins></ins>
                    @endif
                    <li class="sx2"><span>{{ $ress->username }}</span></li>
                    <li class="sx1"><span>{{ $ress->address }}</span><span>{{ $ress->addrinfo }}</span></li>
                    <li class="sx3"><span>{{ $ress->phone }}</span></li>
                    <li class="sx5" style="width:200px">
                        <span style="font-size:14px;padding:2px;font-weight:400;"><a href="/home/personal/defa/{{$ress->id}}">设为默认</a></span>
                        <button onclick="data(this)" class="btn btn-primary btn-lg" da-id="{{ $ress->id}}" da-username="{{$ress->username}}" da-address="{{ $ress->address }}" da-phone="{{ $ress->phone }}" da-addrinfo="{{ $ress->addrinfo }}"  data-toggle="modal" data-target="#update">修改</button>
                        <button type="submit" class="btn btn-primary btn-lg del" data-id="{{ $ress->id }}">删除</button>
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
    </div>
    <!-- 添加模态框 -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="bi">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        新增收货地址
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" style="margin-top: 20px;">
                        <label for="firstname" class="col-sm-2 control-label" style="margin-top:5px;width:120px;"><i style="color:red;">*</i>收货人：</label>
                        <input type="text" class="form-control" name="username" placeholder="收货人" style="width:60%;">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <label for="firstname" class="col-sm-2 control-label" style="margin-top:5px;width:120px;"><i style="color:red;">*</i>手机号码：</label>
                        <input type="number" class="form-control" name="phone" placeholder="请输入大陆手机号码" style="width:60%;">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <label for="firstname" class="col-sm-2 control-label" style="margin-top:5px;width:120px;"><i style="color:red;">*</i>收货地址：</label>
                        <input type="text" class="form-control" name="address" placeholder="请输入收货地址" style="width:60%;">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <label for="firstname" class="col-sm-2 control-label" style="margin-top:5px;width:120px;"><i style="color:red;">*</i>详细地址：</label>
                        <input type="text" class="form-control" name="addrinfo" placeholder="详细地址" style="width:60%;">
                    </div>
                    <!-- 错误信息 -->
                    <div class="form-group">
                        <div id="errors" style="display:none;text-align:center;color:red;" role="alert">

                        </div>
                    </div>
                    <span style="padding-left:130px;color:#999;font-size:11px">注：红色星号标记的为必填项哦~</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="guan">关闭
                    </button>
                    <button type="button" class="btn btn-primary" id="bton">
                        提交更改
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 修改模态框 -->
    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="bb">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        修改收货地址
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" style="margin-top: 20px;">
                        <label for="firstname" class="col-sm-2 control-label" style="margin-top:5px;width:120px;"><i style="color:red;">*</i>收货人：</label>
                        <input type="text" class="form-control" name="name" required placeholder="收货人" style="width:60%;">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <label for="firstname" class="col-sm-2 control-label" style="margin-top:5px;width:120px;"><i style="color:red;">*</i>手机号码：</label>
                        <input type="number" class="form-control" name="phon" required placeholder="请输入大陆手机号码" style="width:60%;">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <label for="firstname" class="col-sm-2 control-label" style="margin-top:5px;width:120px;"><i style="color:red;">*</i>收货地址：</label>
                        <input type="text" class="form-control" name="addres" required placeholder="请输入收货地址" style="width:60%;">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <label for="firstname" class="col-sm-2 control-label" style="margin-top:5px;width:120px;"><i style="color:red;">*</i>详细地址：</label>
                        <input type="text" class="form-control" name="addrinf" required placeholder="详细地址" style="width:60%;">
                    </div>
                    <!-- 错误信息 -->
                    <div class="form-group">
                        <div id="error" style="display:none;text-align:center;color:red;" role="alert">

                        </div>
                    </div>
                    <span style="padding-left:130px;color:#999;font-size:11px">注：红色星号标记的为必填项哦~</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="gg">关闭
                    </button>
                    <button type="submit" class="btn btn-primary" id="bbt">
                        提交更改
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#bton').click(function(){
        var username = $('input[name=username]').val();
        var phone = $('input[name=phone]').val();
        var address = $('input[name=address]').val();
        var addrinfo = $('input[name=addrinfo]').val();

        var add = new FormData();
        add.append('username', username);
        add.append('phone', phone);
        add.append('address', address);
        add.append('addrinfo', addrinfo);
        add.append('_token', '{{ csrf_token() }}');

        $.ajax({
            type: 'post',
            url: '/home/personal/addres',
            processData: false,
            contentType: false,
            data: add,
            success: function(res) {
                if (res.code == 0) {
                    location.href = '/home/personal/address';
                }
            },
            error: function(err) {
                if (err.responseJSON.code == 2) {
                    alert(err.responseJSON.msg);
                }
                if (err.responseJSON.errors != undefined) {
                    $('#errors').css('display', 'block').html("");
                    let errs = err.responseJSON.errors
                    for (err in errs) {
                        $('<p>'+errs[err][0]+'</p>').appendTo('#errors');
                    }
                }
            }
        });
    });
    $('#bi').click(function(){
        $('#errors').html("");
    });
    $('#guan').click(function(){
        $('#errors').html("");
    });

    function data(obj)
    {
        // console.dir(obj)
        $('input[name=name]').val($(obj).attr('da-username'));
        $('input[name=phon]').val($(obj).attr('da-phone'));
        $('input[name=addres]').val($(obj).attr('da-address'));
        $('input[name=addrinf]').val($(obj).attr('da-addrinfo'));

        $('#bbt').click(function(){
            var name = $('input[name=name]').val();
            var phon = $('input[name=phon]').val();
            var addres = $('input[name=addres]').val();
            var addrinf = $('input[name=addrinf]').val();
            var id = $(obj).attr('da-id');

            var ad = new FormData();
            ad.append('id', id);
            ad.append('name', name);
            ad.append('phon', phon);
            ad.append('addres', addres);
            ad.append('addrinf', addrinf);
            ad.append('_token', '{{ csrf_token() }}');

            $.ajax({
                type: 'post',
                url: '/home/personal/upres',
                processData: false,
                contentType: false,
                data: ad,
                success: function(res) {
                    if (res.code == 0) {
                        location.href = '/home/personal/address';
                    }
                },
                error: function(err) {
                    if (err.responseJSON.code == 2) {
                        alert(err.responseJSON.msg);
                    }
                    if (err.responseJSON.errors != undefined) {
                        $('#error').css('display', 'block').html("");
                        let errs = err.responseJSON.errors
                        for (err in errs) {
                            $('<p>'+errs[err][0]+'</p>').appendTo('#error');
                        }
                    }
                }
            });
        });
    }
    $('#bb').click(function(){
        $('#error').html("");
    });
    $('#gg').click(function(){
        $('#error').html("");
    });

    //删除
    $('.del').click(function(){
        let _t = this;
        $.ajax({
            type: 'post',
            url: '/home/personal/delres/' + $(this).data('id'),
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                if (res.code == 0) {
                    $(_t).parent().parent().remove();
                }
            },
            error: function(err) {
                alert(err.responseJSON.msg);
            }
        });
    });
</script>
@endsection