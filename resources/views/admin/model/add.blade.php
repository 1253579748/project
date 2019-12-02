@extends('admin.index.index')

@section('main')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div>

<div class="row">
  <div class="col-lg-6">
  <span class="label label-primary">模型名</span> <span style="color:red">*</span>
    <div class="input-group">
      <input type="text" name="name" class="form-control" placeholder="输入模型名称">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
</div>

<hr>
<button id="spec_btn" class="btn btn-default">添加规格</button>
<table class="table" id="spec">
    <tr>
        <td>规格名称</td>
        <td>规格值</td>
    </tr>
</table>

<hr>
<hr>
<button id="attr_btn" class="btn btn-default">添加属性</button>
<table class="table" id="attr">
    <tr>
        <td>属性名称</td>
        <td>属性值</td>
    </tr>
</table>
<hr>
<hr>
<hr>
<hr>
<center><button id="submit" class="btn btn-default">确认提交</button></center>
<script>

$('#spec_btn').on('click', function(){
    $(`<tr><td><input name="spec_name" type="text" /></td><td class="val"><input class="spec_value" placeholder="双击添加多个规格值" type="text" /></td></tr>`).appendTo('#spec');
    $(`.val`).unbind('dblclick').dblclick(function(){
        $(this).children().eq(0).clone().appendTo($(this));//克隆
    })
});

$('#attr_btn').click(function(){
    $(`<tr><td><input name="attr_name" type="text" /></td><td class="atr"><input class="attr_value" placeholder="双击添加多个属性值" type="text" /></td></tr>`).appendTo('#attr');
    $(`.atr`).unbind('dblclick').dblclick(function(){
        $(this).children().eq(0).clone().appendTo($(this));//克隆
    })
});

$('#submit').on('click', function(){
    arr = [];
    $('input[name=spec_name]').each(function(k){
        // console.dir($(this).parent().parent())
        var v = $(this).parent().parent().find('.spec_value')

        if (!(v.context.value == '')) {

            arr[k] = [];

            arr[k].push(v.context.value);
            console.dir(v)
            v.each(function(){
                if (!($(this).val() == '')) {

                    arr[k].push($(this).val());
                    
                }
            })

        };//规格名输入为空则跳过
    });

    attr = [];
    $('input[name=attr_name]').each(function(k){
        // console.dir($(this).parent().parent())
        var v = $(this).parent().parent().find('.attr_value')

        if (!(v.context.value == '')) {

            attr[k] = [];

            attr[k].push(v.context.value);

            v.each(function(){
                if (!($(this).val() == '')) {

                    attr[k].push($(this).val());
                    
                }
            })

        };//规格名输入为空则跳过
    });

    name = $('input[name=name]').eq(0).val();

    fd = new FormData();

    for (k in arr) {
        if (arr[k]) fd.append('spec[]', arr[k])
    }

    for (k in attr) {
        if (arr[k]) fd.append('attr[]', attr[k])
    }

    fd.append('name', name)

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        contentType: false,
        processData: false,
        url: '/admin/model/store',
        data: fd,
        success:function(){
            location.href = '/admin/model/list';
        }

    })



});
</script>

@endsection