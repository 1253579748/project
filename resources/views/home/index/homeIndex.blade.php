@extends('home.index.index')


 
@section('main')
    <!-- 顶部轮播 -->
    <div class="swiper-container banner-box">
        <div class="swiper-wrapper">
        @php
            $banner = \DB::table('banner_item')->get();
            $pushGoods = App\Goods::where('is_push', '1')
                            ->with(['GoodsImgOne'])
                            ->limit(8)
                            ->get()
                            ->toArray();
        @endphp
            @foreach($banner as $k=>$v)
                <div class="swiper-slide"><a href="{{$v->img_url}}"><img src="/storage/admin/banner_img/{{$v->img_add}}" title= "{{$v->img_describe}}"  class="cover"></a>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <!-- 楼层内容 -->
    <div class="content inner" style="margin-bottom: 40px;">
        <section class="scroll-floor floor-1 clearfix">
            <div class="pull-left">
                <div class="floor-title">
                    <i class="iconfont icon-tuijian fz16"></i> 爆款推荐
                    <a href="" class="more"><i class="iconfont icon-more"></i></a>
                </div>
                <div class="con-box">

                    <!-- <div class="right-box hot-box"> -->
                        @foreach($pushGoods as $v)
                        <a href="/goods/detail/{{$v['id']}}" class="floor-item">
                            <div class="item-img hot-img">
                                <img src="/storage/{{$v['goods_img_one']['url']}}" alt="{{$v['name']}}" class="cover">
                            </div>
                            <div class="price clearfix">
                                <span class="pull-left cr fz16">￥{{$v['price']}}</span>
                                <span class="pull-right c6">进货价</span>
                            </div>
                            <div class="name ep" title="{{$v['name']}}">{{$v['name']}}</div>
                        </a>
                        @endforeach

                    <!-- </div> -->
                </div>
            </div>
            <div class="pull-right">
                <div class="floor-title">
                    <i class="iconfont icon-horn fz16"></i> 平台公告
                    <a href="udai_notice.html" class="more"><i class="iconfont icon-more"></i></a>
                </div>
                <div class="con-box">
                    <div class="notice-box bgf5">
                        <div class="swiper-container">
                            <div class="swiper-wrapper" id="joke">
                                <!-- 笑话位 -->

                
                            </div>
                        </div>
                    </div>
                    <div class="buts-box bgf5">
                        <div class="but-div">
                            <a href="">
                                <i class="but-icon"></i>
                                <p>物流查询</p>
                            </a>
                        </div>
                        <div class="but-div">
                            <a href="item_sale_page.html">
                                <i class="but-icon"></i>
                                <p>热卖专区</p>
                            </a>
                        </div>
                        <div class="but-div">
                            <a href="item_sale_page.html">
                                <i class="but-icon"></i>
                                <p>满减专区</p>
                            </a>
                        </div>
                        <div class="but-div">
                            <a href="item_sale_page.html">
                                <i class="but-icon"></i>
                                <p>折扣专区</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            $.ajax({
                type: 'get',
                url: '/api/getJoke',
                dataType: 'json',
                success: function(res){
                    // console.dir(res);
                    var data = res.result.data;
                    for (let k in data) {
                        $('#joke').append(`<a href="">${data[k].content}</a>`);
                    }
                    if (!data) {
                        $('#joke').append('<a href="">今日请求次数已达上限！</a>');
                    } 
                }
            }) 
            // $('#joke').append('<a href="">今日请求次数已达上限！</a>');
        </script>
        
        @foreach($typeGoods as $k=>$type) 
        <section class="scroll-floor floor-2">
            <div class="floor-title">
                <a href="/goods/list/{{$k}}"><i class="iconfont icon-skirt fz16"></i> {{$type['topName']}}</a>
                <div class="case-list fz0 pull-right">
                    @foreach($type as $k=>$v)
                        @php
                            if (!is_numeric($k)) break;
                        @endphp
                    <a href="/goods/list/{{$v['id']}}">{{$v['name']}}</a>
                    @endforeach

                </div>
            </div>
            <div class="con-box">
<!--                <a class="left-img hot-img" href="">
                    <img src="images/floor_2.jpg" alt="" class="cover">
                </a> -->
                <div class="">
                    @foreach($type['goods'] as $k=>$v)
                    <a href="/goods/detail/{{$v['id']}}" class="floor-item">
                        <div class="item-img hot-img">
                            <img src="/storage/{{$v['goods_img_one']['url']}}" alt="{{$v['name']}}" class="cover">
                        </div>
                        <div class="price clearfix">
                            <span class="pull-left cr fz16">￥{{$v['price']}}</span>
                            <span class="pull-right c6">进货价</span>
                        </div>
                        <div class="name ep" title="{{$v['name']}}">{{$v['name']}}</div>
                    </a>
                    @endforeach 

                </div>
            </div>
        </section>
        @endforeach

    </div>


@endsection
