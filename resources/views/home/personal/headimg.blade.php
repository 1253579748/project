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
                <form class="form-horizontal" role="form" action="head" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputFile">请上传头像:</label>
                        <input type="file" id="exampleInputFile" name="headimg" accept="image/gif,image/jpeg,image/jpg,image/png,image/svg">
                    </div>
                    <button type="submit" class="btn btn-default">保存</button>
                </form>
            </div>

            <!-- 右侧 -->
            <div class="col-sm-4">

            </div>
        </div>
    </div>
</div>
</div>
@endsection