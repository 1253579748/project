
@extends('admin.index.index')
@section('main')

<!-- <meta charset="gbk"> -->
<link rel="stylesheet" href="/admin/uploadImg/css/upload-img.css">

<div id="app" style="width:300px;height:300px" v-cloak>
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

<form id="fmsub">
  <div class="form-group">
    <label for="exampleInputEmail1">商品名称</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="商品名">
  </div>

    <select name="contrller"  class="form-control" id="s1">
        <option>---选择商品分类-</option>
        @foreach($type as $v)
        @if(substr_count($v['path'], ',') === 1)
        <option class="s2_" id="{{$v['id']}}">{{ $v['name'] }}</option>
        @endif
        @endforeach
    </select>
    <br>
    <select name="contrller"  class="form-control" id="s2">
        <option>---选择商品分类-</option>
        @foreach($type as $v)
        @if(substr_count($v['path'], ',') === 2)
        <option class="s2_type s1_{{$v['pid']}}" id="{{$v['id']}}">{{ $v['name'] }}</option>
        @endif
        @endforeach
    </select>
    <br>
    <select name="type_id" class="form-control" id="s3">
        <option>---选择商品分类-</option>
        @foreach($type as $v)
        @if(substr_count($v['path'], ',') === 3)
        <option value="{{ $v['id'] }}" class="s3_type s3_{{$v['pid']}}">{{ $v['name'] }}</option>
        @endif
        @endforeach
    </select>
  <hr>
  商品简介
  <textarea name="description" class="form-control" rows="3"></textarea>
    
  <div class="form-group">
    <hr>
    @php

    @endphp
    售价
    <input type="text" name="price" class="form-control" id="exampleInputPassword1" placeholder="￥">
  </div>


    <select name="model_id"  class="form-control" id="model">
        <option>---选择商品模型-</option>
        @foreach($model as $v)
        <option class="" id="{{$v['id']}}">{{ $v['name'] }}</option>
        @endforeach
    </select>

<div class="container-fluid">

  <div style="" class="col-xs-8">
    <div id="#spec">
        <table class="table table-bordered" id="tab">

        </table>
    </div>

    <table class="table table-bordered" id="tabEach">

    </table>
  </div>


  <div style="" id="attr" class="col-xs-4">
        
  </div>
</div>


</form>
<button name="btn" class="btn btn-default">Submit</button>


<script src="https://www.jq22.com/jquery/vue.min.js"></script>
<script src="https://cdn.bootcss.com/axios/0.19.0-beta.1/axios.min.js"></script>
<script>

$('button[name=btn]').on('click', function(){

    if ($('input[name=name]').eq(0).val() == null) return false;
    if (isNaN($('select[name=type_id]').val())) return false;
    if (isNaN($('select[name=model_id]')[0].selectedOptions[0].id)) return false;
    if ( isNaN($('input[name=price]').val()) ) return false;
    console.dir('ddd')
    app.onUploadImg();//上传图片

    return false;
})







$('#model').change(function(){
    var id = this.selectedOptions[0].id;
    $.ajax({
        type: 'get',
        url: '/api/spec/get/' + id,
        success: function(res) {

            eachSpec(res);
        }
    })

    $.ajax({
        type: 'get',
        url: '/api/attr/get/' + id,
        success: function(res) {
            $('#tabEach').html('');
            $('#attr').html('');
            $('#tab').html('');
            attrAction(res);
        }
    })


})

function attrAction(data)
{
    for (let v in data){

        $(`<select id="${data[v].id}" class="${v} form-control attr"><option value="">-${data[v].attr_name}---请选择--</option></select>`).appendTo('#attr');

        for (let k in data[v]['attr_item']){

            $(`<option value="${data[v]['attr_item'][k]}">${data[v]['attr_item'][k]}</option>`).appendTo($('.'+v))
        }
    }
}



var check = [];
var ipts;
var show = {};
function eachSpec(res)
{

    for (let val in res[0]['spec']) {

        $(`<tr class="a_${val}"><th>${res[0]['spec'][val].name}</th><tr>`).appendTo($('#tab'));
        for (let v in res[0]['spec'][val]['spec_item']) {
            // console.dir(res[0]['spec'][val]['spec_item'][v])

            show[res[0]['spec'][val]['spec_item'][v].id] = res[0]['spec'][val]['spec_item'][v].item;

            if (res[0]['spec'][val]['spec_item'][v]['item']) {

                let ipt = `<input name="${res[0]['spec'][val]['spec_item'][v].item}" type_id="${res[0]['spec'][val].id}" class="specInput" type="checkbox" value="${res[0]['spec'][val]['spec_item'][v]['id']}">`;
                $(`<td>${ipt}${res[0]['spec'][val]['spec_item'][v]['item']}</td>`).appendTo($('.a_' + val));
            }
        }

    }

    $('.specInput').on('change', function(){
        check = [];
        $('.specInput').each(function(){
            if (this.checked == true) {
                check.push(this.value);
            }
        })

        ipts = document.getElementsByClassName('specInput');
        var tmp = dataEach(res);
        var a = actionData(tmp);
        var specData = multiCartesian(a); 
        showSpec(specData);

    })
    
}

function showSpec(specData)
{
    $('#tabEach').html('');

    for (let k in specData){
        tmp = '';
        for (let i in specData[k]) {
            tmp = tmp + '_' + show[specData[k][i]]; //处理keyname
        }
        tmp = tmp.trim('_', 'left');
        $(`<tr id="${k}" key="${specData[k]}" keyname="${tmp}" class="k_${k} spec"></tr>`).appendTo('#tabEach');
        debugger;
        for (let key in specData[k]) {
            $(`<td>${show[specData[k][key]]}</td>`).appendTo('.k_'+k);

        }

        $(`<td>价格<input type="text" name="spec_price"/></td>`).appendTo('.k_'+k);
        $(`<td>库存<input type="text" name="spec_store"/></td>`).appendTo('.k_'+k);
    }


}


function multiCartesian(specs) {
    // 判断是否传递了参数，是否是空数组
    if (!specs || specs.length == 0) {
        return [];
    } else {
        return joinSpec([[]], specs, 0, specs.length - 1);
    }

    // prevProducts 和 specs 两个数组做笛卡尔积
    // i 是索引，表示原始数组遍历的位数
    // max 是原始数组最大的长度
    function joinSpec(prevProducts, specs, i, max) {
        var currentProducts = [], currentProduct, currentSpecs = specs[i];
        if (i > max) {
            return prevProducts;
        }
        // 前面的数组 和 紧跟着后面的数组 做笛卡尔积
        prevProducts.forEach(function (prevProduct) {
            currentSpecs.forEach(function (spec) {
                currentProduct = prevProduct.slice(0);
                currentProduct.push(spec);
                currentProducts.push(currentProduct);
            });
        });
        // 递归处理，前面笛卡尔积之后的结果作为前面的数组，然后循环往前推进1位
        return joinSpec(currentProducts, specs, ++i, max);
    }
}


function actionData(res)
{
    let tmp = [];
    for (let k in res) {
        tmp.push(res[k]);
    }

    return tmp;
}


function dataEach(res)
{
    var obj = {};
    for (let val in ipts) {
        if (isNaN(val)) continue;
        obj[$(ipts[val]).attr('type_id')] = [];

    }

    for (let val in ipts) {
        if (isNaN(val)) continue;
        if (ipts[val].checked == true) {

            obj[$(ipts[val]).attr('type_id')].push(ipts[val].value)


        }
    }

    return obj;
    
}




$(".s2_type").hide();
$(".s3_type").hide();

$("#s1").change(function(){
    $(".s2_type").hide();
    $(".s3_type").hide();
    var id = this.selectedOptions[0].id;
    $(".s1_"+id).show();

});

$("#s2").change(function(){
    // console.dir(this.selectedOptions[0].id);
    $(".s3_type").hide();
    var id = this.selectedOptions[0].id;
    $(".s3_"+id).show();
});







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
                if (currentImgTempArray.length >= 1) {
                    alert("请填加商品后管理图片");
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

                    // that.isUploading = true; //正在上传 显示遮罩层 防止连续点击

                    var countNum = 0; //计算数量用的 判断上传到第几张图片了

                    //map循环遍历上传图片
                    imgTempList.map(function (imgItem, imgIndex) {
                        var files = that.dataURLtoFile(imgItem, 'pj' + Date.now() + '.jpg'); //DataURL转File

                        //创FormData对象
                        var formdata = new FormData();
                        //append(key,value)在数据末尾追加数据。 这儿的key值需要和后台定义保持一致
                        formdata.append('img', files);


                        var name = $('input[name=name]').eq(0).val();
                        var type_id = $('select[name=type_id]').val();
                        var model_id = $('select[name=model_id]')[0].selectedOptions[0].id;
                        var price = $('input[name=price]').val();
                        var description = $('textarea[name=description]').val();

                        var attr = [];//处理属性数据
                        $('.attr').each(function(k,v){
                            if (this.id != '' && this.selectedOptions[0].value != '') {

                                attr.push([this.id, this.selectedOptions[0].value]);   
                            }
                        })

                        for (let k in attr) {
                            if (isNaN(k)) break;
                            formdata.append('attr[]', attr[k]);
                        }



                        formdata.append('name', name);
                        formdata.append('type_id', type_id);
                        formdata.append('model_id', model_id);
                        formdata.append('price', price);
                        formdata.append('description', description);
                        var attr_tmp = $('.spec');
                        for (let k in attr_tmp) {
                            if (isNaN(k)) break;
                            
                            var key = attr_tmp[k].attributes.key.value
                            var keyname = $(attr_tmp[k]).attr('keyname');
                            var a = attr_tmp[k].lastElementChild.previousElementSibling.firstElementChild.value//价格
                            var b = attr_tmp[k].lastElementChild.firstElementChild.value//库存
                                

                            if (a === '' || b === '') continue;
                            formdata.append('spec[]', [key, a, b, keyname]);
                        }
                        console.dir(formdata);
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
                            location.href = '/admin/goods/list'
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
@endsection





