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
            <li class="am-active">
              <a href="#tab1">所有订单</a></li>
            <li>
              <a href="#tab2">待付款</a></li>
            <li>
              <a href="#tab3">待发货</a></li>
            <li>
              <a href="#tab4">待收货</a></li>
            <li>
              <a href="#tab5">待评价</a></li>
          </ul>
          <div class="am-tabs-bd">


            <div class="am-tab-panel am-fade am-in am-active" id="tab1">
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
                  <div class="order-status5">
                    <div class="order-title">
                      <div class="dd-num">订单编号：
                        <a href="javascript:;">2222222222222</a></div>
                      
                      <span>成交时间：1111111111111111</span>
                      <!-- <em>店铺：小桔灯</em>--></div>
                    <div class="order-content">
                      <div class="order-left">
                        <ul class="item-list">
                          <li class="td td-item">
                            <div class="item-pic">
                              <a href="" class="J_MakePoint">
                                <img src="__PUBLIC__/home/images/17.jpeg" class="itempic J_ItemImg"></a>
                            </div>
                            <div class="item-info">
                              <div class="item-basic-info">
                                  <p>111111111111</p>
                              </div>
                            </div>
                          </li>
                          <li class="td td-price">
                            <div class="item-price">1111</div></li>
                          <li class="td td-number">
                            <div class="item-number">
                             11111111</div></li>
                          <li class="td td-operation">
                            <div class="item-operation">1111</div>
                          </li>
                        </ul>
                      </div>
                      <div class="order-right">
                        <li class="td td-amount">
                          <div class="item-amount">1111111111
                          </div>
                        </li>
                        <div class="move-right">
                          <li class="td td-status">
                            <div class="item-status">
                          
                                    <div class="anniu">未付款</div>
                              
                            </div>
                          </li>
                          <li class="td td-status">
                            <div class="item-status">
                                   <div class="am-btn am-btn-danger anniu">提醒发货</div>
                            </div>
                            </li>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="am-tab-panel am-fade" id="tab2">
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
                  <!-- 未付款 -->
                  @foreach
                   <div class="order-status5">
                    <div class="order-title">
                      <div class="dd-num">订单编号：
                        <a href="javascript:;">11111111</a>
                    	</div>
                      
                      <span>成交时间：2222</span>
                      <!-- <em>店铺：小桔灯</em>-->
                  	</div>

                    <div class="order-content">
                      <div class="order-left">

                      @foreach()
                        <ul class="item-list">
                          <li class="td td-item">
                            <div class="item-pic">
                              <a href="" class="J_MakePoint">
                                <img src="__PUBLIC__/home/images/17.jpeg" class="itempic J_ItemImg"></a>
                            </div>
                            <div class="item-info">
                              <div class="item-basic-info">
                                <a href="">
                                  <p>111111111111</p>
                              </div>
                            </div>
                          </li>
                          <li class="td td-price">
                            <div class="item-price">1111111111111</div></li>
                          <li class="td td-number">
                            <div class="item-number">
                             11111111</div></li>
                          <li class="td td-operation">
                            <div class="item-operation"></div>
                          </li>
                        </ul>
                      @endforeach

                      </div>

                      <div class="order-right">
                        <li class="td td-amount">
                          <div class="item-amount">1111111111
                          </div>
                        </li>
                        <div class="move-right">
                          <li class="td td-status">
                            <div class="item-status">
                          
                                    <div class="anniu">未付款</div>
                              
                            </div>
                          </li>
                          <li class="td td-status">
                            <div class="item-status">
                                   <div class="am-btn am-btn-danger anniu">提醒发货</div>
                            </div>
                            </li>
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

</div>
@endsection