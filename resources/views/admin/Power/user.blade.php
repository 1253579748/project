@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">管理员角色详情</div>
    <div class="panel-body">
        <a href="/admin/power/useradd" style="color:red;"> ==> 添加管理员角色</a>
    </div>
        <table class="table">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>用户ID</th>
                    <th>角色ID</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rol as $ro)
                <tr>
                    <td>{{ $ro->id }}</td>
                    <td>{{ $ro->user_id }}</td>
                    <td>{{ $ro->role_id }}</td>
                    <td>
                        <button type="submit" class="btn btn-primary delete" data-id="{{ $ro->id }}">删除</button>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    <div style="text-align:center">
    {{ $rol->links() }}
    </div>
</div>
@endsection

@section('script')
<script>
    //删除
    $('.delete').click(function(){
        let _t = this;
        $.ajax({
            type: 'post',
            url: '/admin/power/updel/' + $(this).data('id'),
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