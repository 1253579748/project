@extends('admin.index.index')

@section('main')
    <div class="inline-form widget-shadow">
        <div class="form-title">
            <h4>修改友情链接:</h4>
        </div>
        <div class="form-body">
            <form data-toggle="validator" method="post" action="edit">
                {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$zz['id']}}">
                <div class="form-group has-feedback">
                    <input type="text" name="title" value="{{$zz['title']}}" class="form-control" id="inputEmail" placeholder="友情链接标题" data-error="Bruh, that email address is invalid" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group">
                    <input type="text" name="href" value="{{$zz['href']}}" data-toggle="validator" data-minlength="6" class="form-control" id="inputPassword" placeholder="友情链接网址" required>
                </div>
                <div class="bottom">
                    <div class="form-group">
                        <button type="submit">修改</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
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