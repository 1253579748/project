@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">角色管理</div>
        <div class="panel-body">
            <a href="/admin/power/roleadd" style="color:red;"> ==> 添加角色</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>角色ID</th>
                    <th>角色名</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rol as $ro)
                <tr>
                    <td>{{ $ro->id }}</td>
                    <td>{{ $ro->name }}</td>
                    <td>
                        <button type="submit" class="btn btn-primary delete" data-id="{{ $ro->id }}">删除</button>
                        <a href="/admin/power/roleupdate?id=<?php echo $ro->id ?>">修改</a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
</div>
@endsection

@section('script')
<script>
    //删除
    $('.delete').click(function(){
        let _t = this;
        $.ajax({
            type: 'post',
            url: '/admin/power/roledel/' + $(this).data('id'),
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                if (res.code == 0) {
                    $(_t).parent().parent().remove();
                }
            },
            error: function(err) {
                alert(err.responseJSON.msg);
            }
        })
    });
</script>
@endsection