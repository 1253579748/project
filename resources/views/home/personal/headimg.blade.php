@extends('home.user.frame')

@section('title', '修改头像')
@section('main')
<div class="pull-right">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="container">
            <div class="mt" style="padding: 10px;">
                <ul>
                    <li>
                        <a href="/home/personal/show" style="padding-bottom:0;color:#e4393c;border-bottom:2px solid #e4393c;font-weight:700;cursor:pointer;text-decoration:none;">基本信息</a>

                        <a href="/home/personal/headimg" style="padding-bottom:0;color:#e4393c;border-bottom:2px solid #e4393c;font-weight:700;cursor:pointer;text-decoration:none;margin-left:20px;">头像照片</a>
                    </li>
                </ul>
            </div>
            <!-- 左侧 -->
            <div class="col-sm-5" style="padding: 20px 5px 0 15px;">
                <form class="form-horizontal" role="form" id="upload">
                    <label for="exampleInputFile">请上传头像:</label>
                    <div class="form-group lccid">
                        <img src="" / class="img" width="200">
                        <input type="file" id="fie" name="headimg" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg" capture="camera" style="padding-top:20px;">
                    </div>
                </form>
                <button id="bt" type="submit" class="btn btn-default" style="margin-top:20px;">保存</button>
                <!-- 错误信息 -->
                <div class="form-group">
                    <div id="errors" style="display:none;text-align:center;color:red;" role="alert">

                    </div>
                </div>
            </div>

            <!-- 右侧 -->
            <div class="col-sm-4">

            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
<script>
$(".lccid").on("change", "input[type=file]", function() {
    $(this).prev().css("opacity","1")
    var filePath = $(this).val();//读取图片路径
    
    var fr = new FileReader();//创建new FileReader()对象
    var imgObj = this.files[0];//获取图片
    
    fr.readAsDataURL(imgObj);//将图片读取为DataURL
    var obj = $(this).prev()[0];//

    if(filePath.indexOf("jpg") != -1 || filePath.indexOf("JPG") != -1 || filePath.indexOf("PNG") != -1 || filePath.indexOf("png") != -1) {
        var arr = filePath.split('\\');
        var fileName = arr[arr.length - 1];
    
        $(this).parent().next().show();
        fr.onload = function() {
            obj.src = this.result;
        };
    } else {
        $(this).parent().next().show();
        $(this).parent().next().children("i").html("您未上传文件，或者您上传文件类型有误！").css("color", "red");
        //$(this).parent().next().html("您未上传文件，或者您上传文件类型有误！").css("color","red");
        return false
    }
});

$('#bt').click(function(){
    var headimg = $('input[name=headimg]').get(0).files[0];
    var fd = new FormData();
    fd.append('headimg', headimg);
    fd.append('_token', '{{ csrf_token() }}');

    $.ajax({
        type: 'post',
        url: '/home/personal/head',
        processData: false,
        contentType: false,
        data: fd,
        success: function(res){
            if(res.code == 0){
                alert(res.msg);
                location='/home/personal/show';
            }
        },
        error: function(err){
            $('#errors').css('display', 'block').html("");
            let errs = err.responseJSON.errors
            for (err in errs) {
                $('<p>'+errs[err][0]+'</p>').appendTo('#errors');
            }
        }
    })
})
</script>
@endsection