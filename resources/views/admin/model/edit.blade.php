@extends('admin.index.index')

@section('main')

@php
    dump($model)
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}">
<div>

<div class="row">
  <div class="col-lg-6">
  <span class="label label-primary">模型名</span> <span style="color:red">*</span>
    <div class="input-group">
      <input type="text" name="name" value="{{$model['name']}}" class="form-control" placeholder="输入模型名称">
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
<center><button id="submit" data-toggle="modal" data-target="#sendOutModal" class="btn btn-default">确认提交</button></center>

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
            <label for="recipient-name" class="control-label">规格名称:</label>
            <input type="text" name="odd" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">规格值（多个规格值用英文逗号隔开）:</label>
            <input type="text" name="express" class="form-control" id="recipient-name">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" onclick="" name="submit" class="btn btn-primary">提交</button>
      </div>
    </div>
  </div>
</div>


<script>

!function(){
    var spec = @json($model['spec'])

    for (let k in spec) {
        $(`<tr><td><input class="spec" num="${spec[k].id}" name="spec_name" value="${spec[k].name}" type="text" /> <span class="add_spec_item">+</span></td><td class="val val_${k}"></td></tr>`).appendTo('#spec');
        let spec_item = spec[k].spec_item;
        for (let i in spec_item) {
            $('.val_'+ k).append(`<input class="spec_item" num="${spec_item[i].id}" type="text" value="${spec_item[i].item}" /><span class="del_spec_item">-</span>　`);//克隆
        }

    }

    $('.del_spec_item').on('click', function(){
        var spec_item_id = this.previousElementSibling.attributes.num.value;
        var _this = this;
            $.ajax({
                type: 'post',
                url: '/admin/model/delSpecItem',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    spec_item_id: spec_item_id
                },
                success: function(res){
                    // location.reload();
                    $(_this.previousElementSibling).remove();
                    $(_this).remove();
                }
            });
            
        
    });

    $('.add_spec_item').on('click', function(){
        var specId = this.previousElementSibling.attributes.num.value;
        var val = prompt();
        if (val) {
            $.ajax({
                type: 'post',
                url: '/admin/model/addSpecItem',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    spec_id: specId,
                    val: val 
                },
                success: function(res){
                    location.reload();
                }
            });
            
        }
    });

}()





</script>

@endsection