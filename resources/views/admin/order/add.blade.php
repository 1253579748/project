@extends('admin.index.index')

@section('main')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div>
    <div class="row">
      <div class="col-lg-6">
      <span class="label label-primary">订单编号</span>
        <div class="input-group">
          <input type="text" name="id" class="form-control" disabled placeholder="默认自动生成">
        </div><!-- /input-group -->
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->

    <div class="row">
      <div class="col-lg-6">
      <span class="label label-primary">用户名</span> <span style="color:red">*</span>
        <div class="input-group">
          <input type="text" id="username" user-id="1" name="username" class="form-control" placeholder="输入订单用户名">
        </div><!-- /input-group -->
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->

    <div class="row">
      <div class="col-lg-6">
      <span class="label label-primary">收货人</span> <span style="color:red">*</span>
        <div class="input-group">
          <input type="text" name="getman" class="form-control" placeholder="输入订单收货人">
        </div><!-- /input-group -->
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->

    <div class="row">
      <div class="col-lg-6">
      <span class="label label-primary">收货人手机号</span> <span style="color:red">*</span>
        <div class="input-group">
          <input type="text" name="phone" class="form-control" placeholder="输入订单收货人手机号">
        </div><!-- /input-group -->
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->

    <div class="row">
      <div class="col-lg-6">
      <span class="label label-primary">地址</span><span style="color:red">*</span>
        <div class="input-group">
          <input type="text" name="address" class="form-control" placeholder="输入收货人地址">
        </div><!-- /input-group -->
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->

    <div class="row">
      <div class="col-lg-6">
      <span class="label label-primary">管理员备注</span>
        <div class="input-group">
          <input type="text" name="message" class="form-control" placeholder="添加备注">
        </div><!-- /input-group -->
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->

</div>

<hr>
<button id="addgoods" class="btn btn-default">添加商品</button>
<table class="table" id="goods">
    <tr>
        <td>商品编号</td>
        <td>数量</td>
    </tr>
</table>

<hr>
<hr>
<hr>
<hr>
<center><button id="submit" class="btn btn-default">确认提交</button></center>
<script>

$('#addgoods').on('click', function(){
    $(`<tr class="goods_tr"><td><input name="spec_name" type="text" /></td><td class=""><input class="" type="text" /></td></tr>`).appendTo('#goods');

});


//检测用户输入是否存在
$('input[name=username]').on('blur', function(){
    var name = this.value;
    $.ajax({
        type: 'get',
        url: '/api/user/getId/' + name,
        success:function(){
            // location.href = '/admin/model/list';
        }

    })
 
})


$('#submit').on('click', function(){

    fd = new FormData();
    
    $('.goods_tr').each(function(k){
        var goods_id = $(this).children()[0].firstElementChild.value;
        var num = $(this).children()[1].firstElementChild.value;
        fd.append('detail[]', [goods_id, num]);
    });

    var user_id = $('input[name=username]').attr('user-id');

    var getman = $('input[name=getman]').val();

    var phone = $('input[name=phone]').val();

    var address = $('input[name=address]').val();

    var message = $('input[name=message]').val();

    fd.append('user_id', user_id);
    fd.append('getman', getman);
    fd.append('phone', phone);
    fd.append('address', address);
    fd.append('message', message);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        contentType: false,
        processData: false,
        url: '/admin/model/store',
        data: fd,
        success:function(res){
            console.dir(res)
        }

    })



});
</script>

@endsection