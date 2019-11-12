<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面-X-admin2.2</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="   0  =device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="stylesheet" href="/admin/uploadImg/css/upload-img.css">
        <link rel="stylesheet" href="/admin/css/font.css">
        <link rel="stylesheet" href="/admin/css/xadmin.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="/admin/js/xadmin.js"></script>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
            <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
            <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form">
                  <div class="layui-form-item">
                      <label for="username" class="layui-form-label">
                          <span class="x-red">*</span>商品名称
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="username" name="name" required="" lay-verify="required"
                          autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>将会展示的商品名
                      </div>
                  </div>

                  <div class="layui-form-item" style>
                      <div class="layui-input-inline layui-show-xs-block">
                          <select name="contrller" id="s1">
                              <option>---选择商品分类-</option>
                            @foreach($type as $v)
                              @if($v['pid'] === 0)
                                <option style="display:none"  class="s1_type">{{ $v['name'] }}</option>
                              @endif
                            @endforeach
                          </select>
                      </ >
                      <div class="layui-input-inline layui-show-xs-block">
                          <select name="contrller" id="s2">
                              <option>---选择商品分类-</option>
                            @foreach($type as $v)
                              @if(substr_count($v['path'], ',') === 2)
                                <option class="s2_">{{ $v['name'] }}</option>
                              @endif
                            @endforeach
                          </select>
                      </div>
                      <div class="layui-input-inline layui-show-xs-block">
                          <select name="contrller"  id="s3">
                              <option>---选择商品分类-</option>
                            @foreach($type as $v)
                              @if(substr_count($v['path'], ',') === 3)
                                <option class="s3_type">{{ $v['name'] }}</option>
                              @endif
                            @endforeach
                          </select>
                      </div>
                      <span class="x-red">*</span>
                  </div>



                  <div class="layui-form-item">
                      <label for="phone" class="layui-form-label">
                          <span class="x-red"></span>商品简介
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="phone" name="phone" required="" lay-verify="phone"
                          autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red"></span>展示商品的描述信息
                      </div>
                  </div>

                  <div class="layui-form-item">
                      <label for="phone" class="layui-form-label">
                          <span class="x-red">*</span> 售价
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="ph" name="phone" required="" lay-verify="phone"
                          autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>
                      </div>
                  </div>


<div id="app" style="width:500px;height:400px" v-cloak>
    <div class="uploading-data" v-if="isUploading"></div>

    <div class="upload-img-column">
        <div class="words">上传图片 (@{{imgTempList.length}}/5)</div>
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



    <!--  压缩图片用的  -->
    <canvas id="compressCanvas" style="position: fixed; z-index: -1; opacity: 0; top: -100%; left: -100%"></canvas>
</div>



                  <div class="layui-form-item">
                      <label for="L_repass" class="layui-form-label">
                      </label>
                      <button onclick="app.onUploadImg()" class="layui-btn" lay-filter="add" lay-submit="">
                          增加
                      </button>
                  </div>
              </form>
            </div>
        </div>
        <script>layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;

                //自定义验证规则
                form.verify({
                    nikename: function(value) {
                        if (value.length < 5) {
                            return '昵称至少得5个字符啊';
                        }
                    },
                    pass: [/(.+){6,12}$/, '密码必须6到12位'],
                    repass: function(value) {
                        if ($('#L_pass').val() != $('#L_repass').val()) {
                            return '两次密码不一致';
                        }
                    }
                });

                //监听提交
                form.on('submit(add)',
                function(data) {
                    console.log(data);
                    //发异步，把数据提交给php
                    layer.alert("增加成功", {
                        icon: 6
                    },
                    function() {
                        //关闭当前frame
                        xadmin.close();

                        // 可以对父窗口进行刷新 
                        xadmin.father_reload();
                    });
                    return false;
                });

            });


          </script>
<script type="text/javascript" src="/admin/js/jquery.min.js" charset="utf-8"></script> 
<script>




$("#s1").change(function(){

    $(".s2_type").hide();
    $(".s3_type").hide();
    var id = $(this).val();
    $(".s1_"+id).show();
    console.log(".s1_"+id)
    console.log(555)
});

$("#s2").change(function(){
    $(".s3_type").hide();
    var id = $(this).val();
    $(".s2_"+id).show();
});

</script>

        <script>
            var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();



        </script>

<script src="https://www.jq22.com/jquery/vue.min.js"></script>
<script src="https://cdn.bootcss.com/axios/0.19.0-beta.1/axios.min.js"></script>
<script>
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
                if (currentImgTempArray.length >= 5) {
                    alert("最多上传5张图片");
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

                        //用axios上传，
                        axios({
                            method: "POST",
                            //url: "http://www.clluo.com:8060/uploadImg",
                            // url: "http://图片上传路径",
                            url: '/admin/goods/store',
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
    </body>

</html>
