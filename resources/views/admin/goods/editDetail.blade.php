@extends('admin.index.index')
@section('main')


<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">
    @foreach($goods->toArray()['goods_detail'] as $img)
        <div class="col-xs-3 pic" url="{{$img['img']}}" id="{{$img['id']}}">详情位置：<input name="position" type="number" value="{{$img['position']}}"><br>详情描述：<input name="description" type="text" value="{{$img['description']}}"><img src="/storage/{{$img['img']}}" alt="..." class="img-thumbnail"><center><span onclick="del(this ,{{$img['id']}})" class="glyphicon glyphicon-trash"></span></center><br></div>
        
    @endforeach
</div>

<link rel="stylesheet" href="/admin/uploadImg/css/upload-img.css">
<div id="app" style="width:500px;height:500px" v-cloak>
    <div class="uploading-data" v-if="isUploading"></div>

    <div class="upload-img-column">
        <div class="words">按顺序上传详情图片 (@{{imgTempList.length}}/10)</div>
        <div class="upload-wrap">
            <div class="box">
                <label class="p dotted">
                    <input type="file" accept="image/jpg,image/jpeg,image/png" name="file"
                           @change="onChooseImage($event)"/>
                    <img src="/admin/uploadImg/img/jiahao.png" alt="">
                </label>
            </div>
            <template v-for="(imgItem, imgIndex) in imgTempList">
                <div class="box">
                    <div class="p">
                        <img :src="imgItem">
                        <div class="delete" @click.stop="deleteImg(imgIndex)">
                            <img src="/admin/uploadImg/img/guanbi.png" alt="">
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <button type="button" onclick="app.onUploadImg()" class="btn btn-info">上传图片</button>
    <!--  压缩图片用的  -->
    <canvas id="compressCanvas" style="position: fixed; z-index: -1; opacity: 0; top: -100%; left: -100%"></canvas>
</div>

<script src="https://www.jq22.com/jquery/vue.min.js"></script>
<script src="https://cdn.bootcss.com/axios/0.19.0-beta.1/axios.min.js"></script>

<script>

$('.pic input').on('blur', function(){
    console.dir(this);
    var id = $(this).parent()[0].id;//要编辑的详情图id
    var val = this.value;
    var who = this.name;

    if (id == '' || val == '' || who == '') return;

        $.ajax({
            type: 'post',
            url: '/admin/goods/updateDetail',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id, 
                val: val,
                who: who
            },
            success: function(res) {
                console.dir(res);
            }
        })
  
});

function del(_this, id)
{
    var url = $(_this).parent().parent().attr('url');

    $.ajax({
        type: 'post',
        url: '/admin/goods/delDetail',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
            url: url
        },
        success: function(res) {
            $(_this).parent().parent().remove();
        }
    })
}




    var app = new Vue({
        el: '#app',
        data: {
            imgTempList: [], //图片临时路径列表
            isUploading: false, //是否正在上传
            successPath: [], //上传成功后的路径(没必要)
        },
        mounted: function () {
            var that = this;
        },
        watch: {},
        methods: {
            //选择图片
            onChooseImage: function (event) {
                var that = this;

                //判断图片数量是否已上限
                var currentImgTempArray = that.imgTempList;
                if (currentImgTempArray.length >= 10) {
                    alert("最多上传10张图片");
                    return false;
                }

                //使用FileReader对文件对象进行操作
                var reader = new FileReader();
                reader.readAsDataURL(event.target.files[0]); //将读取到的文件编码成Data URL
                reader.onload = function () { //读取完成时
                    var replaceSrc = reader.result; //文件输出的内容

                    //压缩图片处理
                    var image = new Image();
                    image.src = replaceSrc;
                    image.onload = function () {
                        //获取图片初始宽高
                        var width = image.width;
                        var height = image.height;
                        //判断图片宽度，再按比例设置宽度和高度的值
                        if (width > 1024) {
                            width = 1024;
                            height = Math.ceil(1024 * (image.height / image.width));
                        }

                        //将图片重新画入canvas中
                        var canvas = document.getElementById("compressCanvas");
                        var context = canvas.getContext("2d");
                        canvas.width = width;
                        canvas.height = height;
                        context.beginPath();
                        context.fillStyle = "#ffffff";
                        context.fillRect(0, 0, width, height);
                        context.fill();
                        context.closePath();
                        context.drawImage(image, 0, 0, width, height);
                        replaceSrc = canvas.toDataURL("image/jpeg"); //canvas转DataURL(base64格式)

                        //将压缩后的路径 追加到临时路径数组中
                        var totalList = [];
                        if (currentImgTempArray.length > 0) {
                            totalList = currentImgTempArray.concat(replaceSrc);
                        } else {
                            totalList[0] = replaceSrc;
                        }
                        that.imgTempList = totalList;
                    };
                };

            },

            //删除某张图片
            deleteImg: function (idx) {
                var that = this;
                that.imgTempList.splice(idx, 1);
            },

            //提交上传图片
            onUploadImg: function () {
                var that = this;
                var imgTempList = that.imgTempList;
                if (imgTempList.length > 0) {

                    that.isUploading = true; //正在上传 显示遮罩层 防止连续点击

                    var countNum = 0; //计算数量用的 判断上传到第几张图片了

                    //map循环遍历上传图片
                    imgTempList.map(function (imgItem, imgIndex) {
                        var files = that.dataURLtoFile(imgItem, 'pj' + Date.now() + '.jpg'); //DataURL转File

                        //创FormData对象
                        var formdata = new FormData();
                        //append(key,value)在数据末尾追加数据。 这儿的key值需要和后台定义保持一致
                        formdata.append('img', files);
                        formdata.append('goods_id', {{$goods->id}});
                        formdata.append('position', countNum+1);


                        //用axios上传，
                        axios({
                            method: "POST",
                            //url: "http://www.clluo.com:8060/uploadImg",
                            // url: "http://图片上传路径",
                            url: '/admin/goods/storeDetail',
                            data: formdata,
                            headers: {
                                "Content-Type": "multipart/form-data"
                            }
                        }).then(function (res) {
                            console.log(res);
                            countNum++;
                            console.log("第 " + countNum + " 张图片上传完成");
                            //图片全部上传完后去掉遮罩层
                            if (countNum >= imgTempList.length) {
                                location.reload();
                                that.isUploading = false;
                            }

                        }).catch(function (error) {
                            console.error(error);
                        });
                    });
                }
            },

            /**
             * 将base64转换为文件
             * @dataUrl base64路径地址
             * @fileName 自定义文件名字
             * */
            dataURLtoFile: function (dataUrl, fileName) {
                var arr = dataUrl.split(','), mime = arr[0].match(/:(.*?);/)[1],
                    bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
                while (n--) {
                    u8arr[n] = bstr.charCodeAt(n);
                }
                return new File([u8arr], fileName, {type: mime});
            },
        }
    });

</script>
@endsection