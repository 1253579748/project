@extends('admin.index.index')

@section('main')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="color:#666;">修改用户权限</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="post" onsubmit="return false">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" id="dd" value="<?php echo $res->id ?>">
            <div class="form-group" style="margin-bottom:30px;margin-top:20px;">
                <label for="lastname" class="col-sm-2 control-label">权限码：</label>
                <div class="col-sm-5">
                    <select class="form-control" id="rr">
                        @foreach($rr as $key=>$e)
                        <option value="{{$e->id}}">{{$e->controller}} @ {{$e->action}} --> {{$e->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-5">
                    <input id="edt" type="submit" value="修改">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
$('#edt').click(function(){
    var id = $("#dd").val();
    var option = $("#rr option:selected");
    var permission_id = option.val();

    var fd = new FormData();
    fd.append('permission_id', permission_id);
    fd.append('id', id);
    fd.append('_token', '{{ csrf_token() }}');

    $.ajax({
        type: 'post',
        url: '/admin/power/ueup',
        processData: false,
        contentType: false,
        data: fd,
        success: function(res){
            if (res.code == 0){
                location.href = '/admin/power/userole';
            }
        },
        error: function(err){
            alert('修改失败,请重试');
        }
    }) 
})
</script>
@endsection