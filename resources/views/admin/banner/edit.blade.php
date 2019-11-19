@extends('admin.index.index')

@section('main')
    <div class="inline-form widget-shadow">
        <div class="form-title">
            <h4>修改轮播图:</h4>
        </div>
        <div class="form-body">
            <form data-toggle="validator" method="post" action="edit" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$arr['id']}}">
                <div class="form-group has-feedback">
                    <input type="text" name="img_describe" value="{{$arr['img_describe']}}" class="form-control" id="inputEmail" placeholder="友情链接标题" data-error="Bruh, that email address is invalid" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group">
                    <input type="text" name="img_url" value="{{$arr['img_url']}}" data-toggle="validator" data-minlength="6" class="form-control" id="inputPassword" placeholder="友情链接网址" required>
                </div>
                <div class="form-group">
                    <img style="height: 200px;width: 300px" src="/storage/admin/banner_img/{{$arr['img_add']}}" alt="">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input name="img_add" type="file" id="exampleInputFile">
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

    </script>
@stop