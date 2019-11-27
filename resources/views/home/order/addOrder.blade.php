@extends('home.index.index')
@section('css')
<link rel="stylesheet" href="/home/css/cart.css">
@endsection
@section('cates')
@endsection

@section('cate')
@endsection

@section('main')
<style>
.wrapper{
	box-sizing: border-box;
    width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.ui-btn-theme {
    color: #fff;
    border: 1px solid #f34e4e;
    background-color: #f34e4e;
}
</style>
	<div class="wrapper">
        <div class="pay-wrap">
            <div class="order-result">
                <div class="section clearfix">
                    <img src="/home/images/order-success.jpg" class="ico">
                    <div class="titbox">
                        <div class="tit">订单提交成功，应付金额 {{$total}} 元</div>
                        <div class="stit">订单号：{{$id}}    请您在 1 日 内完成支付，否则订单会被自动取消</div>
                    </div>
                    <div class="mt20">
                    	@foreach($res as $k => $v)
                        <div class="meta">
                            <div class="hd">商品</div>
                            <div class="bd">{{$v->name}}{{$v->bar_code}}*{{$v->num}}</div>
                        </div>
                        @endforeach
                        <div class="meta">
                            <div class="hd">收货地址</div>
                            <div class="bd">{{$uadd->address}}{{$uadd->addrinfo}} </div>
                            <div class="hd">收货人</div>
                            <div class="bd">{{$uadd->username}} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--         <div class="pay-wrap-tit">
            在线支付
        </div>
        <div class="pay-wrap">
            <div class="pay-way">
                <div class="row">
                    <div class="col col-3">
                        <label class=""><div class="sty1-radio" style="position: relative;"><input class="check" type="radio" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><img src="/home/images/zfb.jpg"></label>
                    </div>
                    <div class="col col-3">
                        <label class=""><div class="sty1-radio" style="position: relative;"><input class="check" type="radio" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><img src="/home/images/weixin.jpg"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-3">
                        <label><div class="sty1-radio" style="position: relative;"><input class="check" type="radio" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><img class="bd" src="/home/images/zgyh.jpg"></label>
                    </div>
                    <div class="col col-3">
                        <label><div class="sty1-radio" style="position: relative;"><input class="check" type="radio" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><img class="bd" src="/home/images/jsyh.jpg"></label>
                    </div>
                    <div class="col col-3">
                        <label class=""><div class="sty1-radio" style="position: relative;"><input class="check" type="radio" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><img class="bd" src="/home/images/nyyh.jpg"></label>
                    </div>
                    <div class="col col-3">
                        <label><div class="sty1-radio" style="position: relative;"><input class="check" type="radio" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><img class="bd" src="/home/images/gsyh.jpg"></label>
                    </div>
                    <div class="col col-3">
                        <label><div class="sty1-radio" style="position: relative;"><input class="check" type="radio" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><img class="bd" src="/home/images/jtyh.jpg"></label>
                    </div>
                    <div class="col col-3">
                        <label><div class="sty1-radio" style="position: relative;"><input class="check" type="radio" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><img class="bd" src="/home/images/zsyh.jpg"></label>
                    </div>
                    <div class="col col-3">
                        <label class=""><div class="sty1-radio" style="position: relative;"><input class="check" type="radio" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><img class="bd" src="/home/images/yzcxyh.jpg"></label>
                    </div>
                    <div class="col col-3">
                        <label><div class="sty1-radio" style="position: relative;"><input class="check" type="radio" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><img class="bd" src="/home/images/xyyy.jpg"></label>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="bottom-panel">
            <a href="" class="go-next ui-btn-theme">支付</a>
        </div>
    </div>

@endsection