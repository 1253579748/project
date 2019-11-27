@extends('home.index.index')

@section('cates')
@endsection

@section('cate')
@endsection

@section('main')
    <div class="content clearfix bgf5">
        <section class="user-center inner clearfix">
            <div class="user-content__box clearfix bgf">
                <div class="title">购物车</div>
                <form action="/home/shopcart/sub" class="shopcart-form__box" method="get">
                    {{ csrf_field() }}
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="150">
                            </th>
                            <th width="300">商品信息</th>
                            <th width="150">单价</th>
                            <th width="200">数量</th>
                            <th width="200">合计</th>
                            <th width="80">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($arr as $k=>$v)
                            <tr>
                            <th scope="row">
                                <label class="checked-label">
                                    <input class="fxk" type="checkbox" name="id[]" qwe = {{$v->checkbox}} value="{{$v->id}}" ><i></i>
                                    <div class="img"><img style="height: 100px" src="/storage/{{$v->img}}" alt="" class="cover"></div>
                                </label>
                            </th>
                            <td>
                                <div class="name ep3"  style="width: 300px">{{$v->name}}</div>
                                <div class="type c9">型号：{{$v->bar_code}}</div>
                            </td>
                            <td>
                                ￥{{$v->price}}
                            </td>
                            <td>
                                <div class="cart-num__box">
                                    <a href="/home/shopcart/jian?id={{$v->id}}&num={{$v->num}}">-</a>
                                    <input disabled type="text" class="val" value="{{$v->num}}" maxlength="2">
                                    <a href="/home/shopcart/jia?id={{$v->id}}&num={{$v->num}}">+</a>
                                </div>
                            </td>
                            <td ><p>￥<?=$v->num * $v->price ?></p></td>
                            <td><a href="/home/shopcart/del?id={{$v->id}}">删除</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="user-form-group tags-box shopcart-submit pull-right">
                        <button type="submit" class="btn">提交订单</button>
                    </div>
                    <div class="checkbox shopcart-total">
                        <label><input type="checkbox" class="check-all"><i></i> 全选</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="del">删除</a>
                        <div class="pull-right">
                            已选商品 <span>{{$num}}</span> 件
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;合计（不含运费）
                            <b class="cr">¥{{$aa}}<span class="fz24"></span></b>
                        </div>
                    </div>
                    <script>
                        console.dir($("#price").attr('price'));
                        console.dir($(".val").val());
                        var zz = $("#price").attr('price') * $(".val").val();
                        // $('.zzz').html(zz);
                        $(document).ready(function(){
                            var $item_checkboxs = $('.shopcart-form__box tbody input[type="checkbox"]'),
                                $check_all = $('.check-all');
                            // 全选
                            $check_all.on('change', function() {
                                $check_all.prop('checked', $(this).prop('checked'));
                                $item_checkboxs.prop('checked', $(this).prop('checked'));
                            });
                            // 点击选择
                            $item_checkboxs.on('change', function() {
                                var flag = true;
                                $item_checkboxs.each(function() {
                                    if (!$(this).prop('checked')) { flag = false }
                                });
                                $check_all.prop('checked', flag);
                            });
                        });
                        $(".fxk").click(function () {
                            var id = $(this).val();
                            var url = "/home/shopcart/checkbox?id="+id;
                            location.href=url;
                        });
                        $.each($('input:checkbox'),function(){
                            console.dir($(this).attr('qwe'));
                            if ($(this).attr('qwe') == 1){
                                $(this).prop('checked', true);
                            }
                        });

                        $(".del").click(function () {
                            var id = [];

                            $('input').each(function(){
                                var status = $(this).prop('checked') // 当前是否选中
                                if (status){
                                    id.push($(this).val())
                                }

                            });

                            $.ajax({
                                    url: '/home/shopcart/dels',
                                    method: 'post',
                                    data: {
                                        _token: '{{ csrf_token() }}' ,
                                        id: id,
                                    },
                                    // 定义一个接受结果的函数
                                    success: function(res){

                                    }
                                })
                            window.location.reload();
                        });
                    </script>
                </form>
            </div>
        </section>
    </div>
@stop