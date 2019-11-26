@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">管理员角色详情</div>
    <div class="panel-body">
        <a href="/admin/power/useradd" style="padding-left:50px;color:red"> => 添加角色</a>
    </div>
        <table class="table">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>用户名</th>
                    <th>角色名称</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($arr as $key=>$ar)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $ar['name'] }}</td>
                    @if(empty($ar['role']))
                    <td style="color:#900001">暂无角色</td>
                    @else
                    <td>
                        @foreach(($ar['role']) as $key=>$rol)
                            <li>{{$rol}}</li>
                        @endforeach
                    </td>
                    @endif
                    @if(empty($ar['id']))
                    <td>
                        <a href="/admin/power/useradd">添加角色</a>
                    </td>
                    @else
                    <td>
                      @foreach(($ar['id']) as $key=>$ad)
                        <li>
                            <a style="cursor:pointer;" class="delete" data-id="{{$ad}}">删除</a> | 
                            <a href="/admin/power/adupdate?id={{$ad}}">修改</a>
                        </li>
                      @endforeach
                    </td>
                    @endif

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
            url: '/admin/power/updel/' + $(this).data('id'),
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                if (res.code == 0) {
                    location='/admin/power/user';
                    // $(_t).parent().remove();
                    // $(_t).parent().parent().prev().children().remove();
                }
            },
            error: function(err) {
                alert(err.responseJSON.msg);
            }
        })
    });
</script>
@endsection