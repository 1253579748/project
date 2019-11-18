@extends('admin.index.index')
@section('main')


<div>
    <div class="input-group">
      <input type="text" name="find" value="{{$_GET['search']??''}}" class="">
        <button type="button" onclick="find()" class="btn btn-default">搜索</button>
    </div>

    <table class="table table-bordered">
        <tr>
            <td>商品名</td>
            <td>商品分类</td>
            <td>销量</td>
            <td>标准价格</td>
            <td>推荐</td>
            <td>修改时间</td>
            <td>状态</td>
            <td>操作</td>
        </tr>
        @foreach($goods->toArray()['data'] as $v)
        <tr>
            <td>{{$v['name']}}</td>
            <td>{{$v['type_id']}}</td>
            <td>{{$v['buy_count']}}</td>
            <td>{{$v['price']}}</td>
            <td onclick="push({{$v['id']}})" id="{{$v['id']}}">{{($v['is_push']) ? '是':'否'}}</td>
            <td>{{$v['updated_at']}}</td>
            <td>{{$showStatus[ $v['status'] ]}}</td>
            <td id="{{$v['id']}}">
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">操作 <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li><a href="/admin/goods/editImg/{{$v['id']}}">图片管理</a></li>
                      <li><a href="/admin/goods/editGoods/{{$v['id']}}">编辑商品</a></li>
                      <li><a onclick="del({{$v['id']}})" href="javascript:;">删除商品</a></li>
                    </ul>
                  </div><!-- /btn-group -->
                </div><!-- /input-group -->
            </td>
        </tr>
        @endforeach
    </table>
    {{ $goods->links() }}
</div>

<script>
//删除
function del(id)
{
    $.ajax({
        type: 'get',
        url: '/admin/goods/delGoods/'+ id,
        success: function(){
            location.href = '/admin/goods/list';
        }
    })
}

//推荐
function push(id)
{
    $.ajax({
        type: 'get',
        url: '/admin/goods/push/'+ id,
        success: function(res){
            $('#' + id).html( parseInt(res) ? '是':'否' );
        }
    })
}

//查找
function find()
{
    var search = $('input[name=find]').val();
    location.href = '/admin/goods/list?search=' + search;
}
</script>



@endsection