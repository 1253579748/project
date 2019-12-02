@extends('admin.index.index')
@section('main')



<h2>正在编辑商品：{{$goods['name']}}</h2><hr>
    <h4>商品规格会以此次提交编辑为准</h4><hr>
    <div class="container-fluid">

      <div style="" class="col-xs-8">
        <div id="#spec">
            <table class="table table-bordered" id="tab">

            </table>
        </div>

        <table class="table table-bordered" id="tabEach">

        </table>
      </div>


    </div>

</form>
<button name="btn" class="btn btn-default">Submit</button>


<script src="https://www.jq22.com/jquery/vue.min.js"></script>
<script src="https://cdn.bootcss.com/axios/0.19.0-beta.1/axios.min.js"></script>
<script>

var goods_id = {{$goods['id']}}

$('button[name=btn]').on('click', function(){

    var formdata = new FormData();

    formdata.append('goods_id', goods_id);

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

    //用axios上传，
    axios({
        method: "POST",
        url: '/admin/goods/skuEdit',
        data: formdata,
        headers: {
            "Content-Type": "multipart/form-data"
        }
    }).then(function (res) {
        location.reload();
    }).catch(function (error) {
        console.error(error);
    });

})


console.dir(@json($goods['goods_spec']))

var goods_spec = @json($goods['goods_spec']);

var specArr = [];
for (let k in goods_spec) {

    specArr = specArr.concat(goods_spec[k].key.split('_'));

}

    // $('#tabEach').html('');
    // $('#tab').html('');

 
(function(){
    var id = {{$goods['model_id']}};

    $.ajax({
        type: 'get',
        url: '/api/spec/get/' + id,
        success: function(res) {

            eachSpec(res);

        }
    })


})();




var check = [];
var ipts;
var show = {};
function eachSpec(res)
{
    $('#tab').html('');
    for (let val in res[0]['spec']) {

        $(`<tr class="a_${val}"><th>${res[0]['spec'][val].name}</th><tr>`).appendTo($('#tab'));
        for (let v in res[0]['spec'][val]['spec_item']) {
            // console.dir(res[0]['spec'][val]['spec_item'][v])

            show[res[0]['spec'][val]['spec_item'][v].id] = res[0]['spec'][val]['spec_item'][v].item;

            if (item_name = res[0]['spec'][val]['spec_item'][v]['item']) {
                item_val = res[0]['spec'][val]['spec_item'][v]['id'];
                let seled = checkSelected(item_val) ? 'checked' : '';
                let ipt = `<input name="${item_name}" ${seled} type_id="${res[0]['spec'][val].id}" class="specInput" type="checkbox" value="${item_val}">`;
                $(`<td>${ipt}${res[0]['spec'][val]['spec_item'][v]['item']}</td>`).appendTo($('.a_' + val));
            }
        }

    }

    $('.specInput').on('change', specInputChange)


specInputChange();
function specInputChange(){
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
}

    
}

function checkSelected(specInput) 
{
    for (let k in specArr) {

        if (specArr[k] == specInput) return true;
    }

    return false;
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
        

        for (let key in specData[k]) {
            $(`<td>${show[specData[k][key]]}</td>`).appendTo('.k_'+k);
        }

        spec_tmp = specData[k].join("_");
        if (tmp = specExist(spec_tmp)) {
            var skuInfo = tmp;
        } else {
            skuInfo = {
                sku_price: '',
                sku_store_count: ''                
            };
        }

        $(`<td>价格<input type="text" value="${skuInfo.sku_price}" name="spec_price"/></td>`).appendTo('.k_'+k);
        $(`<td>库存<input type="text" value="${skuInfo.sku_store_count}" name="spec_store"/></td>`).appendTo('.k_'+k);
    }



}

function specExist(goods_sku) 
{
    for (let k in goods_spec) {
        if (goods_spec[k].key == goods_sku) {
            return {
                sku_price: goods_spec[k].price,
                sku_store_count: goods_spec[k].store_count
            }
        }
    }

    return false;
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







</script>
@endsection





