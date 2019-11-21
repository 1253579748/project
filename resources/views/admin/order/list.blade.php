@extends('admin.index.index')
@section('main')


<div>
    <div class="input-group">
      <input type="text" name="find" value="{{$_GET['search']??''}}" class="">
        <button type="button" onclick="find()" class="btn btn-default">搜索</button>
    </div>

    <table class="table table-bordered">
        <tr>
            <td>订单编号</td>
            <td>会员名称</td>
            <td>收货信息</td>
            <td>总金额</td>
            <td>订单状态</td>
            <td>下单时间</td>
            <td>操作时间</td>
            <td>操作</td>
        </tr>
        @foreach($order->toArray() as $v)
        <tr>
            <td>{{$v['id']}}</td>
            <td>{{$v['user_id']}}</td>
            <td>{{$v['getman']}}:{{$v['phone']}}</td>
            <td>{{$v['total']}}</td>
            <td onclick="push({{$v['id']}})" id="{{$v['id']}}">{{$v['id']}}</td>
            <td>{{$v['updated_at']}}</td>
            <td>{{$v['status']}}</td>
            <td id="{{$v['id']}}">
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">操作 <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li><a href="/admin/order/editImg/{{$v['id']}}">商品图片</a></li>
                      <li><a href="/admin/order/editorder/{{$v['id']}}">编辑商品</a></li>
                      <li><a onclick="del({{$v['id']}})" href="javascript:;">删除商品</a></li>
                      <li><a href="/admin/order/editDetail/{{$v['id']}}">详情管理</a></li>
                    </ul>
                  </div><!-- /btn-group -->
                </div><!-- /input-group -->
            </td>
        </tr>
        @endforeach
    </table>

</div>

<script>
//删除
function del(id)
{
    $.ajax({
        type: 'get',
        url: '/admin/order/delorder/'+ id,
        success: function(){
            location.href = '/admin/order/list';
        }
    })
}

//推荐
function push(id)
{
    $.ajax({
        type: 'get',
        url: '/admin/order/push/'+ id,
        success: function(res){
            $('#' + id).html( parseInt(res) ? '是':'否' );
        }
    })
}

//查找
function find()
{
    var search = $('input[name=find]').val();
    location.href = '/admin/order/list?search=' + search;
}
</script>



@endsection