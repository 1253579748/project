@extends('home.index.index')

@section('cates')
@endsection

@section('cate') 
@endsection

@section('css')
<style>



	.dis{
		background:#FBFAFA;
	}
	.over a{
		background:#eee;
		border-radius:50px;
		border: 1px dotted #ccc;
	}
	.over a span{
		color:rgb(215,215,215);
	}
	.over a:hover{
		cursor: not-allowed;
	}
</style>
@endsection

@section('main')

<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="content inner">
		<section class="item-show__div item-show__head clearfix">
			<div class="pull-left">
				<ol class="breadcrumb">
					<li><a href="/index/index">首页</a></li>
					<li><a href="/goods/list/{{$goods['type_id']}}">商品列表</a></li>
					<li class="active">{{$goods['name']}}</li>
				</ol>
				<div class="item-pic__box" id="magnifier">
					<div class="small-box">
						<img class="cover" src="/storage/{{$goods['goods_img'][0]['url']}}" alt="{{$goods['description']}}">
						<span class="hover"></span>
					</div>
					<div class="thumbnail-box">
						<a href="javascript:;" class="btn btn-default btn-prev"></a>
						<div class="thumb-list">
							<ul class="wrapper clearfix">
								@foreach($goods['goods_img'] as $v)
								<li class="item" data-src="/storage/{{$v['url']}}"><img class="cover" src="/storage/{{$v['url']}}" alt="商品预览图"></li>
								@endforeach
							</ul>
						</div>
						<a href="javascript:;" class="btn btn-default btn-next"></a>
					</div>
					<div class="big-box"><img src="/storage/{{$goods['goods_img'][0]['url']}}" alt="{{$goods['description']}}"></div>
				</div>
				<script src="/home/js/jquery.magnifier.js"></script>
				<script>
					$(function () {
						$('#magnifier').magnifier();
					});
				</script>
				<div class="item-info__box">
					<div class="item-title">
						<div class="name ep2">{{$goods['name']}}</div>
						<div class="sale cr">快递：0￥</div>
					</div>
					<div class="item-price bgf5">
						<div class="price-box clearfix">
							<div class="price-panel pull-left">
								售价：<span class="price money">￥{{$goods['price']}} </span> <s class="fz16 c9" id="money">￥{{$goods['price']}}</s>
							</div>
							<div class="vip-price-panel pull-right active">
								{{$goods['status'] == 1 ? '此商品正在热卖中' : '此商品已下架!'}}
							</div>

						</div>
						<div class="c6">普通会员限购 2 件，想要<u class="cr"><a href="">购买更多</a></u>？</div>
					</div>
					<ul class="item-ind-panel clearfix">
						<li class="item-ind-item">
							<span class="ind-label c9">累计销量</span>
							<span class="ind-count cr">{{$goods['buy_count']}}</span>
						</li>
						<li class="item-ind-item">
							<a href=""><span class="ind-label c9">累计评论</span>
							<span class="ind-count cr">{{count($goods['comment'])}}</span></a>
						</li>
						<li class="item-ind-item">
							<a href=""><span class="ind-label c9">浏览量</span>
							<span class="ind-count cg">{{$goods['look_count']}}</span></a>
						</li>
					</ul>
					<div class="item-key">
						<div class="item-sku">
							@foreach($goods['model_type']['spec'] as $v)
							<dl class="item-prop clearfix">
								<dt class="item-metatit">{{$v['name']}}：</dt>
								<dd><ul data-property="{{$v['name']}}" attr="{{$v['id']}}" class="clearfix">
									@foreach($v['spec_item'] as $vv)
									<li class="p_{{$v['id']}} spec_item" num="{{$v['id']}}" id="{{$vv['id']}}"><a href="javascript:;" role="button" data-value="{{$vv['item']}}" aria-disabled="true">
										<span>{{$vv['item']}}</span>
									</a></li>
									@endforeach
								</ul></dd>
							</dl>
							@endforeach
						</div>
<script>

var result = @json($goods['goods_spec']);//以知商品规格组合
var items = $('ul', $('.item-sku'));//所有的规格选项
var selected = [];//表示用户选择的

var checked; //用户以选定的规格

//初始化禁用
items.each(function(attr, curitems) {

	$(curitems.children).each(function(k, v){

		var res = check(selected, v);


		if (res) {

		} else {
			$(v).addClass('over');
			$(v).removeClass('spec_item');
		}
	})

})


$('.spec_item').on('click', action);//绑定点击事件
function action()
{
	_this = this;
	exec();
	selected.push(this);
	changeColor();//改变选中的样式
	changeMoney();

}

function exec()
{
	items.each(function(attr, curitems) {
		var attrSelected = selected;

		var cur = curitems.attributes.attr.value;//当前属性组的id

		$(curitems.children).each(function(k, v){
			for (let i in selected) {

				if ($(selected[i]).attr('num') == $(_this).attr('num')) {

					selected.splice(i,1);//删除数组元素

				} else {
					console.dir('no')
				}
			}
		})

	})

}

function changeMoney()
{
	var res = check(selected, null);
	console.dir(res);
	if (res) {
		if (selected.length == res[2]) {

			$('.money').eq(0).html('￥' +result[ res[1] ].price ); //改变显示价格
			$('#money').html('￥' +result[ res[1] ].price ); //下划线价格

			checked = result[ res[1] ]; //当前选择的规格

			$('#Stock').eq(0).html( result[ res[1] ].store_count )
			$('.amount-input').val(1);

			storeNum();
		}
	}
}

function changeColor()
{
	$('.item-sku a').removeClass('on');
	for (let k in selected) {
		selected[k].children[0].className = 'on'
	}

	items.each(function(attr, curitems) {
		rr = curitems
		$(curitems.children).each(function(k, v){

			var seled = [];
			for (let i in selected) {

				if ($(selected[i]).attr('num') == $(v).attr('num')) {

					//当前检测属性与选中属性在同一分类
				} else {
					seled.push(selected[i]);

				}
			}

			var res = check(seled, v); 
			// debugger;
			if (res) {
				$(v).removeClass('over');
				$(v).addClass('spec_item');
				$(v).unbind('click').click(action);//重新绑定点击事件
			} else {
				console.dir('huzhipan');
				$(v).unbind('click');//禁用后取消点击事件
				$(v).addClass('over');
				$(v).removeClass('spec_item');
			}
		})

	})
}


/*
	seled 已选中的属性
	item 要判断是否能选的属性
 */
function check(seled, item)
{
	arr = [];//每一次组成的suk
	for (let k in seled) {
		arr.push(seled[k].id)
	}
	if (item) arr.push(item.id);

	checkResult = [];//存规格key数组
	for (let k in result) {
		var res = result[k].key.split('_');
		checkResult.push(res);
	}

	for (let k in checkResult) {

		var res = checkArr(checkResult[k], arr);
		if (res) {
			return [true, k, res[1]];//成功返回匹配规格的对应价格,与是否完全匹配
		} 
	}

	return false;//未匹配则不包含
}



//判断arr1数组是否包含arr2数组的所有元素
function checkArr(arr1,arr2) {
	var arr3 = [];
    for(var i = 0; i < arr2.length; i++){
        if(arr1.indexOf(arr2[i])>-1){
            arr3.push(arr2[i])
        }
    }
    if(arr3.length == arr2.length){
        return [true, arr1.length];
    }else {
        return false;
    }
}

</script>


						<div class="item-amount clearfix bgf5">
							<div class="item-metatit">数量：</div>
							<div class="amount-box">
								<div class="amount-widget">
									<input id="stoo" class="amount-input" value="1" maxlength="8" title="请输入购买量" type="text">
									<div class="amount-btn">
										<a class="amount-but add"></a>
										<a class="amount-but sub"></a>
									</div>
								</div>
								@php
									$store = 0;
									foreach($goods['goods_spec'] as $v) {
										$store += $v['store_count'];
									}
								@endphp
								<div class="item-stock"><span style="margin-left: 10px;">库存 <b id="Stock">{{$store}}</b> 件</span></div>


								<script>
									storeNum();
									function storeNum () {
										$('.amount-input').onlyReg({reg: /[^0-9]/g});
										var stock = parseInt($('#Stock').html());

											$('.amount-input').unbind('input').on('input', function(){
												if (parseInt(this.value) >= stock) {
													$('.amount-input').val(stock);
												}
												if (parseInt(this.value) < 1) {
													$('.amount-input').val(1);
												}
												if (isNaN(parseInt(this.value))) {
													$('.amount-input').val(1);
												}

											});
										$('.amount-widget').unbind('click').on('click','.amount-but',function() {
											console.dir(stock);
											var num = parseInt($('.amount-input').val());
											if (!num) num = 0;

											if ($(this).hasClass('add')) {
												if (num >= stock){
												$('.amount-input').val(num);

												} else {
													$('.amount-input').val(num + 1);

												}
											} else if ($(this).hasClass('sub')) {
												$('.amount-input').val(num - 1);
												if (num <= 1){
													$('.amount-input')[0].value = 1;
												}
											}


										});
									};

								</script>
							</div>
						</div>
						<div class="item-action clearfix bgf5">
							<a href="javascript:;" rel="nofollow" data-addfastbuy="true" title="点击此按钮，到下一步确认购买信息。" role="button" class="item-action__buy">立即购买</a>
							<a href="javascript:;" rel="nofollow" data-addfastbuy="true" role="button" class="item-action__basket">
								<i class="iconfont icon-shopcart"></i> 加入购物车
							</a>
						</div>
					</div>
				</div>
			</div>
<script>

//立即购买
$('.item-action__buy').click(function(){

});

//加入购物车
$('.item-action__basket').click(function(){

	if ( isNaN(parseInt($('.amount-input').val())) ){
		return alert('您输入的数量有误~');
	}

	if (checked) {//判断通过提交数据
		checked['buy_count'] = parseInt($('.amount-input').val());

		$.ajax({
			type: 'post',
			url: '/goods/addShopCar',
			dataType: 'json',
			data : checked,
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    success: function(res) {
		    	alert(res['msg']);
		    	console.dir(res);
		    }

		})

	} else {
		return alert('请先选择规格~');
	}

});

</script>

			<div class="pull-right picked-div">
				<div class="lace-title">
					<span class="c6">爆款推荐</span>
				</div>
				<div class="swiper-container picked-swiper">
					<div class="swiper-wrapper">

						@for($i = 0; $i+3 < count($push); $i+=3)
						<div class="swiper-slide">
							@for($k = 0; $k < 3; $k++)
							<a class="picked-item" href="/goods/detail/{{$push[$i+$k]['id']}}">
								<img src="/storage/{{$push[$i+$k]['goods_img_one']['url']}}" alt="" class="cover">
								<div class="look_price">¥{{$push[$i+$k]['price']}}</div>
							</a>
							@endfor
						</div>
						@endfor

					</div>
				</div>
				<div class="picked-button-prev"></div>
				<div class="picked-button-next"></div>
				<script>
					$(document).ready(function(){ 
						// 顶部banner轮播
						var picked_swiper = new Swiper('.picked-swiper', {
							loop : true,
							direction: 'vertical',
							prevButton:'.picked-button-prev',
							nextButton:'.picked-button-next',
						});
					});
				</script>
			</div>
		</section>
		<section class="item-show__div item-show__body posr clearfix">
			<div class="item-nav-tabs">
				<ul class="nav-tabs nav-pills clearfix" role="tablist" id="item-tabs">
					<li role="presentation" class="active"><a href="#detail" role="tab" data-toggle="tab" aria-controls="detail" aria-expanded="true">商品详情</a></li>
					<li role="presentation"><a href="#evaluate" role="tab" data-toggle="tab" aria-controls="evaluate">累计评价 <span class="badge">1314</span></a></li>
					<li role="presentation"><a href="#service" role="tab" data-toggle="tab" aria-controls="service">售后服务</a></li>
				</ul>
			</div>
			<div class="pull-left">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="detail" aria-labelledby="detail-tab">
						<div class="item-detail__info clearfix">
							@foreach($goods['attr_item'] as $v)
							<div class="record">{{$v['attri_bute']['attr_name']}}：{{$v['value']}}</div>
							@endforeach
						</div>
						<div class="rich-text">
							<p style="text-align: center;">
								@foreach($goods['goods_detail'] as $k=>$v)
								<i id="desc-module-{{$v['position']}}-{{$k}}" style="font-size: 0"></i>
								<img src="/storage/{{$v['img']}}" alt=""><br>
								@endforeach
							</p>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="evaluate" aria-labelledby="evaluate-tab">
						<div class="evaluate-tabs bgf5">
							<ul class="nav-tabs nav-pills clearfix" role="tablist">
								<li role="presentation" class="active"><a href="#all" role="tab" data-toggle="tab" aria-controls="all" aria-expanded="true">全部评价 <span class="badge">1314</span></a></li>
								<li role="presentation"><a href="#good" role="tab" data-toggle="tab" aria-controls="good">好评 <span class="badge">1000</span></a></li>
								<li role="presentation"><a href="#normal" role="tab" data-toggle="tab" aria-controls="normal">中评 <span class="badge">314</span></a></li>
								<li role="presentation"><a href="#bad" role="tab" data-toggle="tab" aria-controls="bad">差评 <span class="badge">0</span></a></li>
							</ul>
						</div>
						<div class="evaluate-content">
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="all" aria-labelledby="all-tab">

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>



									<!-- 分页 -->
									<div class="page text-center clearfix">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a href="">4</a>
										<a href="">5</a>
										<a href="">6</a>
										<a href="">7</a>
										<a href="">8</a>
										<a class="" href="">下一页</a>
										<a class="disabled">1/60页</a>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="good" aria-labelledby="good-tab">
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>
									
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<!-- 分页 -->
									<div class="page text-center clearfix">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a href="">4</a>
										<a href="">5</a>
										<a href="">6</a>
										<a href="">7</a>
										<a href="">8</a>
										<a class="" href="">下一页</a>
										<a class="disabled">1/20页</a>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="normal" aria-labelledby="normal-tab">
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>
									
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>


									<!-- 分页 -->
									<div class="page text-center clearfix">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a href="">4</a>
										<a href="">5</a>
										<a class="" href="">下一页</a>
										<a class="disabled">1/5页</a>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="bad" aria-labelledby="bad-tab">

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>
									
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="images/temp/S-001-1_s.jpg" data-src="images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-2_s.jpg" data-src="images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-3_s.jpg" data-src="images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-4_s.jpg" data-src="images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="images/temp/S-001-5_s.jpg" data-src="images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>
									<!-- 分页 -->
									<div class="page text-center clearfix">
									</div>
								</div>
							</div>
							<script src="/home/js/jquery.zoom.js"></script>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="service" aria-labelledby="service-tab">
						<!-- 富文本 -->
						<div class="service-content rich-text">
							<img title="" alt="" src="http://img.aocmonitor.com.cn/image/2014-06/86575417.gif" width="240" height="160" border="0" align="left"><p>承蒙惠购 AOC 产品，谨致谢意！为了让您更好地使用本产品，武汉艾德蒙科技股份有限公司通过该产品随机附带的保修证向您做出下述维修服务承诺，并按照该服务的承诺向您提供维修服务。</p><p>这些服务承诺仅适用于2016年6月1日（含）之后销售的AOC品牌显示器标准品。</p><p>如果您选择购买了 AOC 显示器扩展功能模块或其它厂家电脑主机，其保修承诺请参见相应产品的保修卡。</p><p>所有承诺内容以产品附件的保修卡为准。</p><p><br></p><h3>一、全国联保</h3><p style="text-indent:2em">AOC 显示器实施全国范围联保，国家标准三包服务。无论您是在中国大陆 ( 不含香港、澳门、台湾地区) 何处购买并在大陆地区使用的显示器，出现三包范围内的故障时，可凭显示器的保修证正本和购机发票到 AOC 显示器维修网点或授权网点进行维修同时，也欢迎您关注官方微信服务号“AOC用户俱乐部”(微信号：aocdisplay)进行查询。</p><div style="text-align:center"><img src="http://img.aocmonitor.com.cn/image/2017-05/89154415.jpg" alt=""></div><p><br></p><p>三包服务如下：</p><ol><li>商品自售出之日起 7 日内，出现《微型计算机商品性能故障表》中所列故障时，消费者可选择退货、换货或修理。</li><li>商品自售出之日起 15 日内，出现《微型计算机商品性能故障表》中所列故障时，消费者可选择换货或修理。</li><li>商品自售出之日起 1 年内，出现《微型计算机商品性能故障表》中所列故障时，消费者可选择修理。</li></ol><p>以下情况不在三包范围内：</p><ol><li>超过三包有效期。</li><li>无有效的三包凭证及发票。</li><li>发票上内容与商品实物标识不符或者涂改的。</li><li>未按产品使用说明书要求使用、维护、保养而造成损坏的（人为损坏）。</li><li>非 AOC 授权的修理者拆动造成损坏的（私自拆修）。</li><li>非 AOC 在中国大陆（不含香港、澳门、台湾地区）销售的商品。</li></ol><h3>二、显示器专享服务</h3><p><strong>1、LUVIA视界头等舱，VIP专享服务</strong></p><p style="text-indent:2em">AOC针对各省市地区采取指定商品销售，消费者购买指定销往该区域的LUVIA卢瓦尔显示器标准品，从发票开具之日起1年内，注册成为官方微信服务号“AOC用户俱乐部”(微信号：aocdisplay)产品会员，即可在当地享“LUVIA视界头等舱，VIP专享服务”。</p><div style="text-align:center"><img src="http://img.aocmonitor.com.cn/image/2017-05/25352146.jpg" alt=""></div><p><br></p><p style="text-indent:2em">* 如客户未在发票开具之日起1年内注册AOC微信会员，则只享受国家三包服务。</p><p style="text-indent:2em">注册会员方式：1、关注“AOC用户俱乐部”微信公众号。2、点击“会员”→“注册会员”。3、填写个人真实信息并注册产品信息，即可成为AOC产品会员。</p><p style="text-indent:2em"><strong>3年免费上门更换</strong>：从发票开具之日起3年内，产品若发生《微型计算机商品性能故障表》所列性能故障，可免费更换不低于同型号同规格产品。（服务网点无法覆盖区域，全国区域免费邮寄，双向运费由AOC负担）</p><p style="text-indent:2em"><strong>一键快捷掌上服务：</strong>从注册成为“AOC用户俱乐部”会员之日起，可享在线贴身技术顾问有问必答、售后服务在线预约、服务网点在线查询等一键快捷掌上服务。（人工客服咨询在线时间：8:00-22:00）</p><p style="text-indent:2em"><strong>增值豪礼尊享服务：</strong>可参加“AOC用户俱乐部”有奖互动赢取豪礼。</p><p>注：<br>(1)如不能及时提供购机发票或发票记载不清、涂改、商品实物标示和发票内容不符，将以您上传“AOC用户俱乐部”的发票信息为准计算保修时间；如果发票信息并未上传，将以该显示器制造日期(制造日期见显示器后壳条形码标签)加一个月为准计算保修时间。<br>(2)非“AOC用户俱乐部”产品会员，不享受“LUVIA视界头等舱，VIP专享服务”。</p>
						</div>
					</div>
			    </div>
				<div class="recommends">
					<div class="lace-title type-2">
						<span class="cr">爆款推荐</span>
					</div>
					<div class="swiper-container recommends-swiper">
						<div class="swiper-wrapper">
						@for($i = 0; $i+3 < count($push); $i+=3)
						<div class="swiper-slide">
							@for($k = 0; $k < 3; $k++)
							<a class="picked-item" href="/goods/detail/{{$push[$i+$k]['id']}}">
								<img src="/storage/{{$push[$i+$k]['goods_img_one']['url']}}" alt="" class="cover">
								<div class="look_price">¥{{$push[$i+$k]['price']}}</div>
							</a>
							@endfor
						</div>
						@endfor

						</div>
					</div>
					<script>
						$(document).ready(function(){
							var recommends = new Swiper('.recommends-swiper', {
								spaceBetween : 40,
								autoplay : 5000,
							});
						});
					</script>
				</div>
			</div>
			<div class="pull-right">
				<div class="tab-content" id="descCate">
					<div role="tabpanel" class="tab-pane fade in active" id="detail-tab" aria-labelledby="detail-tab">
						<div class="descCate-content bgf5">
							@foreach($goods['goods_detail'] as $k=>$v)
							<dd class="dc-idsItem selected">
								<a href="#desc-module-{{$v['position']}}-{{$k}}"><i class="iconfont icon-dot">{{$v['description']}}</i></a>
							</dd>
							@endforeach

						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="evaluate-tab" aria-labelledby="evaluate-tab">
						<div class="descCate-content posr bgf5">
							<div class="lace-title">
								<span class="c6">相关推荐</span>
							</div>
							<div class="picked-box">
								<a class="picked-item" href="">
									<img src="images/temp/S-001-1_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="images/temp/S-001-2_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="images/temp/S-001-3_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="images/temp/S-001-4_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="images/temp/S-001-5_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="service-tab" aria-labelledby="service-tab">
						<div class="descCate-content posr bgf5">
							<div class="lace-title">
								<span class="c6">最近浏览</span>
							</div>
							<div class="picked-box">
								<a class="picked-item" href="">
									<img src="images/temp/S-001-1_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="images/temp/S-001-2_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="images/temp/S-001-3_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="images/temp/S-001-4_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="images/temp/S-001-5_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script>
				$(document).ready(function(){
					$('#descCate').smartFloat(0);
					$('.dc-idsItem').click(function() {
						$(this).addClass('selected').siblings().removeClass('selected');
					});
					$('#item-tabs a[data-toggle="tab"]').on('show.bs.tab', function (e) {
						$('#descCate #' + $(e.target).attr('aria-controls') + '-tab')
						.addClass('in').addClass('active').siblings()
						.removeClass('in').removeClass('active');
					});
				});
			</script>
		</section>
	</div>

@endsection

@section('script')

@endsection