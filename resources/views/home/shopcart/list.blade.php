@extends('home.index.index')

@section('cates')
@endsection

@section('cate')
@endsection

@php
    dump($arr)
@endphp

@section('main')
    <div class="content clearfix bgf5">
        <section class="user-center inner clearfix">
            <div class="user-content__box clearfix bgf">
                <div class="title">购物车-确认支付 </div>
                <div class="shop-title">收货地址</div>
                <form  class="shopcart-form__box" action="data" method="post">
                    {{ csrf_field() }}

                    <div class="addr-radio">
                        @foreach($data as $k=>$v)
                            <div class="radio-line radio-box active">
                            <label class="radio-label ep" title="福建省 福州市 鼓楼区 温泉街道 五四路159号世界金龙大厦20层B北 福州rpg.blue网络 （喵喵喵 收） 153****9999">
                                <input type="radio" <?php echo $v->is_default == 1? 'checked': ''; ?> name="addid"  value="{{$v->id}}" autocomplete="off" ><i class="iconfont icon-radio"></i>
                                {{$v->addrinfo}}
                                （{{$v->username}} 收） {{$v->phone}}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <div class="add_addr"><a href="/home/personal/address">添加新地址</a></div>
                    <!-- 错误信息 -->
                    <div style="color:red;text-align:center">
                        @if(count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="shop-title">确认订单</div>
                    <div class="shop-order__detail">
                        <table class="table">
                            <thead>
                                <tr>
                                <th width="120"></th>
                                <th width="300">商品信息</th>
                                <th width="150">单价</th>
                                <th width="200">数量</th>
                                <th width="200">运费</th>
                                <th width="80">总价</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($arr as $k=>$v)
                                <input type="hidden" name="cartid[]" value="{{$v->id}}">
                                <tr>
                                    <th scope="row"><a href="/goods/detail/{{$v->gid}}"><div  class="img"><img style="width: 100px; height: 100px" src="/storage/{{$v->img}}"  alt="" class="cover"></div></a></th>
                                <td>
                                    <div class="name ep3">{{$v->name}}</div>
                                    <div class="type c9">型号：{{$v->bar_code}}</div>
                                </td>
                                <td>¥{{$v->price}}</td>
                                <td>{{$v->num}}</td>
                                <td>¥0.0</td>
                                <td>¥<?=$v->num * $v->price ?></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="shop-cart__info clearfix">
                        <div class="pull-left text-left">

                        </div>
                        <div class="pull-right text-right">
                            <div class="form-group">
                            </div>
                            <script>
                                $('#coupon').bind('change',function() {
                                    console.log($(this).val());
                                })
                            </script>
                            <div class="info-line"><span class="c6"></span></div>
                            <div class="info-line"><span class="c6"></span></div>
                            <div class="info-line"><span class="favour-value"></span>合计：<b class="fz18 cr">¥{{$aa}}.0</b></div>

                        </div>
                    </div>
                    <div class="user-form-group shopcart-submit">
                        <button type="submit" class="btn">继续支付</button>
                    </div>
                    <script>
                        $(document).ready(function(){
                            $(this).on('change','input',function() {
                                $(this).parents('.radio-box').addClass('active').siblings().removeClass('active');
                            })
                        });
                    </script>
                </form>
            </div>
        </section>
    </div>

@stop