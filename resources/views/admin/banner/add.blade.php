@extends('admin.index.index')

@section('main')
    <div class="inline-form widget-shadow">
        <div class="form-title">
            <h4>添加轮播图:</h4>
        </div>
        <div class="form-body">
            <form data-toggle="validator" method="post" action="add"  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <label for="exampleInputPassword1">图片描述</label>
                    <input type="text" name="img_describe"  class="form-control" id="inputEmail"  data-error="Bruh, that email address is invalid" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">跳转地址</label>
                    <input type="text" name="img_url" data-toggle="validator" data-minlength="6" class="form-control" id="inputPassword"  required>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input name="img_add" type="file" id="exampleInputFile">
                </div>
                <div class="bottom">
                    <div class="form-group">
                        <button type="submit" onclick="submit()">添加</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        // function submit() {
        //     if(document.getElementById("exampleInputFile").value==""){
        //         alert("你没有选择文件");
        //         return false;
        //     }
        //     return true;
        // }
        
        // function ajax() {
        //     $.ajax({
        //         url: '/admin/ads/add',
        //         method: 'post',
        //         data: {name: 'w'},
        //         // 定义一个接受结果的函数
        //         success: function(res){
        //             alert(res);
        //         }
        //     })
        // }
    </script>
@stop