@extends("home.user.frame")
@section("main")
<link href="/order/css/sustyle.css" rel="stylesheet" type="text/css" />
<link href="/order/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
<link href="/order/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
<link href="/order/css/personal.css" rel="stylesheet" type="text/css">
<link href="/order/css/orstyle.css" rel="stylesheet" type="text/css">
<script src="/order/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
<script src="/order/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
<style>
.slideall{display:none;}
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="center">
  <div class="col-main">
    <div class="main-wrap">
      <div class="user-order">
        <!--标题 -->
        <div class="am-cf am-padding">
          <div class="am-fl am-cf">
            <strong class="am-text-danger am-text-lg">订单列表</strong>/
            <small>Order</small></div>
        </div>
        <hr/>
        <div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>
          <ul class="am-avg-sm-5 am-tabs-nav am-nav am-nav-tabs">
<!--             <li class="am-active">
              <a href="#tab1">所有订单</a></li> -->
            <li>
              <a href="#tab1">待付款</a></li>
            <li>
              <a href="#tab2">待发货</a></li>
            <li>
              <a href="#tab3">待收货</a></li>
            <li>
              <a href="#tab4">已完成</a></li>
            <li>
              <a href="#tab0">已取消</a></li>
          </ul>
          <div class="am-tabs-bd">


@foreach($orders as $k=>$v)
<div class="am-tab-panel am-fade am-in am-active" id="tab{{$k}}">
    <div class="order-top">
        <div class="th th-item">
            <td class="td-inner">商品</td></div>
        <div class="th th-price">
            <td class="td-inner">单价</td></div>
        <div class="th th-number">
            <td class="td-inner">数量</td></div>
        <div class="th th-operation">
            <td class="td-inner">商品操作</td></div>
        <div class="th th-amount">
            <td class="td-inner">合计</td></div>
        <div class="th th-status">
            <td class="td-inner">交易状态</td></div>
        <div class="th th-change">
            <td class="td-inner">交易操作</td></div>
    </div>
    <div class="order-main">
        <div class="order-list">
            <!--交易成功-->
            @foreach($v as $k=>$vv)
            <div class="order-status5">
                <div class="order-title">
                    <div class="dd-num">订单编号：
                        <a href="javascript:;">{{$vv['id']}}</a></div>
                    <span>成交时间：{{$vv['created_at']}}</span>
                    <!-- <em>店铺：小桔灯</em>--></div>
                <div class="order-content">
                    <div class="order-left">
                        @php
                            $goods_ids = ''
                        @endphp

                        @foreach($vv['order_detail'] as $vvv)

                            @php
                                $goods_ids .= '_'.$vvv['goods_id']
                            @endphp
                        <ul class="item-list">
                            <li class="td td-item">
                                <div class="item-pic">
                                    <a href="" class="J_MakePoint">
                                        <img src="/storage/{{$vvv['goods_img']}}" class="itempic J_ItemImg"></a>
                                </div>
                                <div class="item-info">
                                    <div class="item-basic-info">
                                        <p>{{$vvv['goods_name']}}</p>
                                        <p>{{$vvv['key_name']}}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="td td-price">
                                <div class="item-price">{{$vvv['price']}}</div></li>
                            <li class="td td-number">
                                <div class="item-number">{{$vvv['num']}}</div></li>
                            <li class="td td-operation">
                                <div class="item-operation">购买</div></li>
                        </ul>
                        @endforeach
                    </div>
                    <div class="order-right">
                        <li class="td td-amount">
                            <div class="item-amount">{{$vv['total']}}</div></li>
                        <div class="move-right">
                            <li class="td td-status">
                                <div class="item-status">
                                <div class="anniu">{{$showStatus[$vv['status']]}}</div></div> 
                            </li>
                            <li class="td td-status">
                                <div class="item-status">
                                @switch($vv['status'])
                                    @case(1)
                                        <a href="/admin/pay/orderPay?order={{$vv['id']}}"><div class="am-btn am-btn-danger anniu">去付款</div></a>
                                        @break
                                    @case(2)
                                        <div class="am-btn am-btn-danger anniu">提醒发货</div>
                                        @break
                                    @case(3)
                                        <a href="javascript:changeOrderStatus({{$vv['id']}}, 4);"><div class="am-btn am-btn-danger anniu">确认收货</div></a>
                                        <a href="/admin/"><div class="am-btn am-btn-danger anniu">查看物流</div></a>
                                        @break
                                    @case(4)
                                        <a goodsIds="{{$goods_ids}}" odd="{{$vv['id']}}" class="comment" data-toggle="modal" data-target="#comment" href="javascript:"><div class="am-btn am-btn-danger anniu">评价</div></a>
                                        @break
                                    @case(5)
                                        <div class="am-btn am-btn-danger anniu">已评价</div>
                                        @break
                                    @case(0)
                                        <div class="am-btn am-btn-danger anniu">已取消</div>
                                @endswitch
                                </div>

                            </li>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endforeach



                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

   </div>

</div>

        <div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span  class="close-span" aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">留言</h4>
              </div>

              <!-- <form action="/admin/comments/store" method="post"> -->
                {{ csrf_field() }}
              <div>
                <textarea name="text" id="" cols="80" rows="10"></textarea>
                <input type="hidden" name="goods_ids" value="">
              </div>
              <div class="modal-footer">
                
                    <button type="submit" class="btn btn-primary comment-store">发送</button>
                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
              <!-- </form> -->
              
  
             
            </div>
          </div>
        </div>



@endsection

@section('script')
<script>

$('.comment').click( function(){

    var goods_ids = $(this).attr('goodsIds');
    var odd = $(this).attr('odd')
    $('input[name=goods_ids]').val( goods_ids);


    $('.comment-store').unbind('click').click(function(){
        comment( odd );
    });

});

function comment(odd)
{
    $.ajax({
        type: 'post',
        url: '/home/personal/comment',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            text: $('textarea[name=text]').val(),
            goods_ids: $('input[name=goods_ids]').val()
        },
        success: function(res) {

            changeOrderStatus(odd, 5)
        }
    })
}

function changeOrderStatus(order_id, status)
{
    $.ajax({
        type: 'post',
        url: '/admin/order/status',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            status: status,
            order_id: order_id
        },
        success: function(res) {
            location.reload();
        }
    })
}


</script>

@endsection