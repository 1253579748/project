@extends('admin.index.index')

@section('main')

<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="input-group">
  <div class="input-group-btn">
    <!-- Button and dropdown menu -->
  </div>
  <input type="text" name="find" class="">
    <button type="button" onclick="find()" class="btn btn-default">搜索</button>
</div>
<button onclick="location.href='/admin/model/add'" class="btn btn-default">添加模型</button><hr>
<div>
    <table class="table table-bordered">
        <tr>
            <td>ID</td>
            <td>模型名称</td>
            <td>操作</td>
        </tr>
        @foreach($model as $v)
        <tr id="{{$v['id']}}">
            <td>{{$v['id']}}</td>
            <td>{{$v['name']}}</td>
            <td>
                <button class="btn btn-default">编辑</button>
                <button onclick="del({{$v['id']}})" class="btn btn-default">删除</button>
            </td>
        </tr>
        @endforeach
    </table>
</div>

<script>
function del(id)
{
    $.ajax({
        type: 'post',
        url: '/admin/model/del',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id
        },
        success: function(res){
            $('#' + id).remove();
        }
    })
}

function find()
{
    var search = $('input[name=find]').val();
    console.dir(search)
    location.href = '/admin/model/list?search=' + search;
}

</script>

@endsection