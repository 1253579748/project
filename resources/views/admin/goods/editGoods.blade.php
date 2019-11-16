@extends('admin.index.index')
@section('main')
<meta name="csrf-token" content="{{ csrf_token() }}">
<form id="fmsub">
  <div class="form-group">
    <label for="exampleInputEmail1">商品名称</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{$goods['name']}}" placeholder="商品名">
  </div>

  <hr>
  商品简介
  <textarea name="description" class="form-control" rows="3">{{$goods['description']}}</textarea>

  <div class="form-group">
    <hr>
    @php
        dump($goods);
    @endphp
    售价
    <input type="text" value="{{$goods['price']}}" name="price" class="form-control" id="exampleInputPassword1" placeholder="￥">
  </div>



<div class="container-fluid">

  <div style="" class="col-xs-8">
    <div id="#spec">
        <ul class="list-group">
            @foreach($goods['goods_spec'] as $v)
                <li item-id="{{$v['id']}}" class="list-group-item"><br>规格：{{$v['key_name']}} <br> 价格：<input type="text" value="{{$v['price']}}"> 库存：<input  value="{{$v['store_count']}}" type="text"></li>
            @endforeach
        </ul>
    </div>

    <table class="table table-bordered" id="tabEach">
        
    </table>
  </div>


  <div style="" id="attr" class="col-xs-4">
        @foreach($goods['attr_item'] as $v)
            <select class="form-control attr" id="{{$v['attribute_id']}}">
                <option value="">无</option>
                @php
                    $arr_attr = explode('_', $v['attri_bute']['attr_value']);
                @endphp
                @foreach($arr_attr as $vv)
                    <option {{$v['value'] == $vv ? 'selected' : ''}} value="{{$vv}}">{{$vv}}</option>
                @endforeach
            </select>

        @endforeach
  </div>
</div>


</form>
<button class="sub">Submit</button>


<script src="https://www.jq22.com/jquery/vue.min.js"></script>
<script src="https://cdn.bootcss.com/axios/0.19.0-beta.1/axios.min.js"></script>
<script>

$('.sub').on('click', function(){

    var name = $('input[name=name]').eq(0).val();
    var price = $('input[name=price]').val();
    var description = $('textarea[name=description]').val();

    var spec = [];//接收规格信息
    $('.list-group-item').each(function(k, v){
        if (!isNaN(k)) {
            spec[k] = [];
            spec[k].push($(this).attr('item-id'));
            spec[k].push( $('input', this).first().val() );
            spec[k].push( $('input', this).last().val() );
        }   
    });

    var attr = [];//属性处理
    $('.attr').each(function(k, v){
        re = this
        attr[k] = [];
        attr[k].push(this.id);
        attr[k].push(this.selectedOptions[0].value);
    });

    var id = {{$goods['id']}};//商品id
    data = {
        name: name,
        id: id,
        price: price,
        description: description,
        spec: spec,
        attr: attr
    };



    $.ajax({
        type: 'post',
        url: '/admin/goods/edit',
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(res) {
            console.dir(res);

        }
    })


    return false;
})








 








</script>

@endsection