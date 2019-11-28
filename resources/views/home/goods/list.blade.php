@extends('home.index.index')

@section('cates')
@endsection

@section('cate') 
@endsection

@section('main')

    <div class="content inner">
        <section class="filter-section clearfix">
            <ol class="breadcrumb">
                <li><a href="/">首页</a></li>
                <li class="active">商品列表</li>
            </ol>

            <div class="filter-box">
                <div class="all-filter">
                    <div class="filter-value">
                        @foreach($twoTypes as $v)
                        <a href="/goods/list/{{$v['id']}}" class="sale-title {{$v['id']==$type->id ? 'active':''}} {{$v['id']==$type->pid ? 'active':''}}">{{ $v['name'] }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr>
            <div class="filter-box">
                <div class="all-filter">
                    <div class="filter-value">
                        @foreach($threeTypes as $v)
                        <a href="/goods/list/{{$v['id']}}" class="sale-title {{$v['id']==$type->id ? 'active':''}}">{{ $v['name'] }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="sort-box bgf5">
                <div class="sort-text">排序：</div>
                <a href="{{$goods->toArray()['path']}}?buy={{!($_GET['buy']??true)}}"><div class="sort-text">销量 <i class="iconfont <?php if(isset($_GET['buy'])&&$_GET['buy']==1){echo 'icon-sortUp';}elseif(isset($_GET['buy'])){echo 'icon-sortDown';} ?> "></i></div></a>
                <a href="{{$goods->toArray()['path']}}?look={{!($_GET['look']??true)}}"><div class="sort-text">浏览 <i class="iconfont  <?php if(isset($_GET['look'])&&$_GET['look']==1){echo 'icon-sortUp';}elseif(isset($_GET['look'])){echo 'icon-sortDown';} ?>"></i></div></a>
                <a href="{{$goods->toArray()['path']}}?money={{!($_GET['money']??true)}}"><div class="sort-text">价格 <i class="iconfont  <?php if(isset($_GET['money'])&&$_GET['money']==1){echo 'icon-sortUp';}elseif(isset($_GET['money'])){echo 'icon-sortDown';} ?>"></i></div></a>
                <div class="sort-total pull-right">共{{$goods->toArray()['total']}}个商品</div>
            </div>
        </section>
        <section class="item-show__div clearfix">
            <div class="pull-left">
            @php

            @endphp
                <div class="item-list__area clearfix">
                    @foreach($goods->toArray()['data'] as $v)
                    <div class="item-card">
                        <a href="/goods/detail/{{$v['id']}}" class="photo">
                            <img src="/storage/{{$v['goods_img_one']['url']}}" alt="{{$v['description']}}" class="cover">
                            <div class="name">{{$v['name']}}</div>
                        <div class="middle">
                            <div class="price"><small>￥</small>{{$v['price']}}</div>
                            <div class="sale no-hide"><a>包邮</a></div>
                        </div>
                        <div class="buttom">
                            <div>销量 <b>{{ $v['buy_count'] }}</b></div>
                            <div>人气 <b>{{ $v['look_count'] }}</b></div>
                            <!-- <div>评论 <b>1688</b></div> -->
                        </a>
                        </div>
                    </div>
                    @endforeach

                </div>
                <!-- 分页 -->
                <div class="page text-right clearfix">
                    <a href="{{$goods->toArray()['first_page_url']}}">首页</a>
                    <a class="" href="{{$goods->toArray()['prev_page_url']}}">上一页</a>
                    <a style="{{$goods->toArray()['current_page']-2 < 1 ? 'display:none;':''}}" href="{{$goods->toArray()['path']}}?page={{$goods->toArray()['current_page']-2}}">{{$goods->toArray()['current_page']-2}}</a>
                    <a style="{{$goods->toArray()['current_page']-1 < 1 ? 'display:none;':''}}" href="{{$goods->toArray()['path']}}?page={{$goods->toArray()['current_page']-1}}">{{$goods->toArray()['current_page']-1}}</a>
                    <a class="select" href="">{{$goods->toArray()['current_page']}}</a>
                    <a style="{{$goods->toArray()['current_page']+1 > $goods->toArray()['last_page'] ? 'display:none;':''}}" href="{{$goods->toArray()['path']}}?page={{$goods->toArray()['current_page']+1}}">{{$goods->toArray()['current_page']+1}}</a>
                    <a style="{{$goods->toArray()['current_page']+2 > $goods->toArray()['last_page'] ? 'display:none;':''}}" href="{{$goods->toArray()['path']}}?page={{$goods->toArray()['current_page']+2}}">{{$goods->toArray()['current_page']+2}}</a>
                    <a class="" href="{{$goods->toArray()['next_page_url']}}">下一页</a>
                    <a class="disabled">共{{$goods->toArray()['last_page']}}页</a>
                    <a href="{{$goods->toArray()['last_page_url']}}">尾页</a>
                    <form action="" class="page-order">
                        到第
                        <input type="text" name="page">
                        页
                        <input class="sub" type="submit" value="确定">
                    </form>
                </div>
            </div>
            <div class="pull-right">
                
                <div style="height:550px" class="desc-segments__content">
                    <div class="lace-title">
                        <span class="c6">爆款推荐</span>
                    </div>
                    <div class="picked-box">
                        @foreach($push as $v)
                        <a href="" class="picked-item"><img src="/storage/{{$v['goods_img_one']['url']}}" alt="" class="cover"><span class="look_price">¥{{$v['price']}}</span></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection