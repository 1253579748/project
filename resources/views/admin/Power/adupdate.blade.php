@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">修改管理员角色</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" action="adupda" method="post" onsubmit="return false">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" id="inp" name="id" value="<?php echo $re->id ?>">
            <div class="form-group" style="margin-bottom:30px;margin-top:20px;">
                <label for="lastname" class="col-sm-2 control-label">角色名称：</label>
                <div class="col-sm-3">
                    <select class="form-control" id="pp">
                        @foreach($rr as $r)
                        <option value="{{$r->id}}">{{$r->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-5">
                    <input type="submit" value="修改" id="edit">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
$('#edit').click(function(){
    var id = $("#inp").val();
    var option = $("#pp option:selected");
    var role_id = option.val();

    var fd = new FormData();
    fd.append('id', id)
    fd.append('role_id', role_id);
    fd.append('_token', '{{ csrf_token() }}');

    $.ajax({
        type: 'post',
        url: '/admin/power/adupda',
        processData: false,
        contentType: false,
        data: fd,
        success: function(res){
            if (res.code == 0){
                location.href = '/admin/power/user';
            }
        },
        error: function(err){
            alert('修改失败');
        }
    }) 
})
</script>
@endsection