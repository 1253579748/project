@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">角色权限详情</div>
    <div class="panel-body">
        <a href="/admin/power/ropo" style="padding-left:50px;color:red"> => 添加权限</a>
    </div>
        <table class="table">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>角色名称</th>
                    <th>权限名称</th>
                    <th>权限码</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($arr as $key=>$ar)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $ar['name'] }}</td>
                    @if(empty($ar['rolename']))
                    <td style="color:#900001">暂无权限</td>
                    @else
                    <td>
                        @foreach(($ar['rolename']) as $key=>$rol)
                            <li>{{$rol}}</li>
                        @endforeach
                    </td>
                    <td>
                        @foreach(($ar['controller']) as $key=>$kk)
                            <li>{{$kk}}</li>
                        @endforeach
                    </td>
                    @endif
                    @if(empty($ar['id']))
                    <td>
                        <a href="/admin/power/ropo">添加权限</a>
                    </td>
                    @else
                    <td>
                      @foreach(($ar['id']) as $key=>$rp)
                        <li>
                            <a style="cursor:pointer;" class="delete" data-id="{{$rp}}">删除</a> | 
                            <a href="/admin/power/rpupde?id={{$rp}}">修改</a>
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
            url: '/admin/power/rpdel/' + $(this).data('id'),
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                if (res.code == 0) {
                    location='/admin/power/rolpow';
                }
            },
            error: function(err) {
                alert(err.responseJSON.msg);
            }
        })
    });
</script>
@endsection