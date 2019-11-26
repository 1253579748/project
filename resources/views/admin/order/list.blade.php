@extends('admin.index.index')

@section('css')


@endsection

@section('main')


<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="/date_plug_in/css/dateTime.css">

<div class="mycontainer">
    <input type="text" placeholder="{{isset($_GET['odd']) ? $_GET['odd'] : '查找订单编号'}}" id="searchOdd">    
    <input type="text" placeholder="{{isset($_GET['start_at']) ? $_GET['start_at'] : '选择开始日期'}}" id="startDate">
    <input type="text" placeholder="{{isset($_GET['stop_at']) ? $_GET['stop_at'] : '选择结束日期'}}" id="stopDate">
    <select name="order_status" style="height:35px" id="">
        <option value="">-筛选订单状态---</option>
        <option {{isset($_GET['status']) && $_GET['status'] == 1 ? 'selected' : ''}} value="1">-未付款---</option>
        <option {{isset($_GET['status']) && $_GET['status'] == 2 ? 'selected' : ''}} value="2">-待发货---</option>
        <option {{isset($_GET['status']) && $_GET['status'] == 3 ? 'selected' : ''}} value="3">-已发货---</option>
        <option {{isset($_GET['status']) && $_GET['status'] == 4 ? 'selected' : ''}} value="4">-已完成---</option>
        <option {{isset($_GET['status']) && $_GET['status'] == 5 ? 'selected' : ''}} value="5">-历史订单---</option>
        <option {{isset($_GET['status']) && $_GET['status'] == 0 ? 'selected' : ''}} value="0">-已作废---</option>
    </select>　　
    <input type="submit" name="search" value="筛选">
</div>

<!-- <script type="text/javascript" src="/date_plug_in/js/jquery.min.js"></script> -->
<script type="text/javascript" src="/date_plug_in/js/dateTime.min.js"></script>
<script type="text/javascript">

var startTime,//开始时间
    stopTime;//结束时间

var time = new Date();

let year = time.getFullYear();//获取年月日

let month = time.getMonth() + 1;//获取年月日

let day = time.getDate();//获取年月日


$("#startDate").datetime({
    type:"date",
    value:[year, month, day],
    success:function(res){
        startTime = res[0] + '-' + res[1] + '-' + res[2];
    }
})


$("#stopDate").datetime({
    type:"date",
    value:[year, month, day],
    success: function(res){
        stopTime = res[0] + '-' + res[1] + '-' + res[2];
    }
})

$('input[name=search]').click(function(){
    path = '/admin/order/list?&';
    if ( $('#searchOdd').val() != '' && !isNaN($('#searchOdd').val()) ) {
        path = path + 'odd=' + $('#searchOdd').val() + '&';
    }

    if (startTime) {
        path = path + 'start_at=' + startTime + '&';
    }

    if (stopTime) {
        path = path + 'stop_at=' + stopTime + '&';
    }

    if ( (sta = $('select[name=order_status]').val()) != '') {
        path = path + 'status=' + sta;
    }

    location.href = path;

});
</script>


<div>
    <div class="input-group">
      <!-- <input type="text" name="find" value="{{$_GET['search']??''}}" class=""> -->
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
        @foreach($order as $v)
        @php

        @endphp
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->user_id}}</td>
            <td>{{$v->getman}}:{{$v->phone}}</td>
            <td>{{$v->total}}</td>
            <td onclick="push({{$v->id}})" id="{{$v->id}}">{{$showStatus[$v->status]}}</td>
            <td>{{$v->created_at}}</td>
            <td>{{$v->updated_at}}</td>
            <td id="{{$v->id}}">
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">操作 <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li onclick="getOrderDetail({{$v->id}})"><a href="javascript:;">订单详情</a></li>

                      @switch($v->status)
                         @case(1) <!--//用户未付款-->
                        <li><a onclick="changeOrderStatus({{$v->id}}, 0)" href="javascript:;">作废订单</a></li>
                        <li ><a href="/admin/order/editDetail/{{$v->id}}">提醒付款</a></li>
                        @break

                        @case(2) <!--//用户已付款-->
                        <li me-id="{{$v->id}}" me-getman="{{$v->getman}}:{{$v->phone}}-{{$v->address}}" data-toggle="modal" data-target="#sendOutModal" onclick="sendOut(this)"><a href="javascript:;">发货</a></li>
                        @break

                        @case(3) <!--//已发货-->
                        <li onclick="lookExpress({{$v->id}})"><a href="javascript:;">查看物流</a></li>
                        @break

                        @case(4) <!--//已签收-->
                        <li><a onclick="changeOrderStatus({{$v->id}}, 5)" href="javascript:;">加入历史订单</a></li>
                        @break
                      @endswitch                      
                    </ul>
                  </div><!-- /btn-group -->
                </div><!-- /input-group -->
            </td>
        </tr>
        @endforeach
    </table>

<div class="modal fade" id="sendOutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" name="title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">快递单号:</label>
            <input type="text" name="odd" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">物流公司:</label>
            <input type="text" name="express" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">留言:</label>
            <textarea class="form-control" name="message" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" onclick="sendOut(this)" name="submit" class="btn btn-primary">提交</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="expressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" name="title" id="exampleModalLabel">快递状态</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">快递单号:</label>
            <input type="text" name="showOdd" disabled class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">物流公司:</label>
            <input type="text" disabled name="showExpress" class="form-control" id="recipient-name">
          </div>

        </form>
      </div>

        <div id="status">

        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>

    </div>
  </div>
</div>

<!-- 商品详情 -->
<div class="modal fade" id="goodsDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" name="title" id="exampleModalLabel">订单详情</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label class="control-label">订单状态:</label>
            <input type="text" name="order_status" disabled class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label">下单时间:</label>
            <input type="text" name="order_created_at" disabled class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label">订单总金额:</label>
            <input type="text" name="order_total" disabled class="form-control">
          </div>
          <div class="form-group">
            <label class="control-label">订单留言:</label>
            <textarea disabled class="form-control" name="order_message"></textarea>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="control-label">收货地址:</label>
            <input type="text" name="order_getman" disabled class="form-control" id="recipient-name">
          </div>
        </form>

      </div>
        <div class="alert alert-warning" role="alert">购买商品信息</div>
        <div id="orderDetail">

        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>

    </div>
  </div>
</div>


</div>

<script>


var showStatus = @json($showStatus);

//发货
function sendOut(send)
{
    if (send.name == 'submit') {
        if ( isNaN($('input[name=odd]').val()) || $('input[name=odd]').val() == '' || $('input[name=express]').val() == '') return alert('请填写好物流信息~');

    $.ajax({
        type: 'post',
        url: '/admin/order/sendOut',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            order_id: send.id, 
            odd: $('input[name=odd]').val(),
            express: $('input[name=express]').val(),
            message: $('textarea[name=message]').val() || ''
        },
        success: function(res) {
            changeOrderStatus(send.id, 3);//将订单状态改成已发货
        }
    })

    } else {
        
        $('h4[name=title]').html( '收货地址:<hr>'+ $(send).attr('me-getman'));
        $('button[name=submit]')[0].id = $(send).attr('me-id');
    }

}

//查看物流
function lookExpress(order_id)
{
    $.ajax({
        type: 'get',
        dataType: 'json',
        url: '/admin/order/getExpress/'+ order_id,
        success: function(res){
            console.dir(res);
            $('input[name=showOdd]').val(res.result.number);//快递单号
            $('input[name=showExpress]').val(res.result.expName);//快递公司
            let list = res.result.list; //状态列表
            for (let k in list) {
                $(`<ul class="list-group">
                    <li class="list-group-item list-group-item-success">${list[k]['time']}</li>
                    <li class="list-group-item list-group-item-info">${list[k]['status']}</li>
                </ul>`).appendTo('#status');
            }

            $("#expressModal").modal();
        }
    })
}


//查看订单详情
function getOrderDetail(order_id)
{
    $('#orderDetail').html('');
    $('input[name=order_status]').val('');//订单状态
    $('input[name=order_created_at]').val('');//下单时间
    $('input[name=order_total]').val('');//订单总价
    $('textarea[name=order_message]').val('');//订单留言
    $('input[name=order_getman]').val('');//收货信息

    $.ajax({
        type: 'get',
        dataType: 'json',
        url: '/admin/order/getOrderDetail/'+ order_id,
        success: function(result){
            console.dir(result);
            let list = result.order_detail;
            $('input[name=order_status]').val(showStatus[result.status]);//订单状态
            $('input[name=order_created_at]').val(result['created_at']);//下单时间
            $('input[name=order_total]').val(result['total']);//订单总价
            $('textarea[name=order_message]').val(result['message']);//订单留言
            $('input[name=order_getman]').val( result.getman + ': ' + result.phone + ' , ' + result.address );//收货信息

            for (let k in list) {
                $(`<ul class="list-group">
                    <li class="list-group-item list-group-item-success">商品编号: ${list[k]['goods_id']}</li>
                    <li class="list-group-item list-group-item-info">商品名称: ${list[k]['goods_name']}</li>
                    <li class="list-group-item list-group-item-info">商品规格: ${list[k]['key_name']}</li>
                    <li class="list-group-item list-group-item-info">商品价格: ${list[k]['price']}</li>
                    <li class="list-group-item list-group-item-info">购买数量: ${list[k]['num']}</li>
                </ul>`).appendTo('#orderDetail');
            }

            $("#goodsDetailModal").modal();
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