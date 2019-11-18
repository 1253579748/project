@extends("admin.index.index")
@section("main")
	@include('admin.public.information')

      	<div class="form-body">
			<form action="/admin/cates/store" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
					
					<div class="form-group">
						 <label for="exampleInputEmail1">分类名称</label> 
						 <input type="text" class="form-control" id="exampleInputEmail1" value="" name="name"> 
					</div> 

					<div class="form-group"> 
						 <label for="exampleInputPassword1">所属分类</label> 
						 <select name="pid" id="pid" class="form-control">
						 <option value="0">--请选择--</option>
						 @foreach($data as $k => $v)
							
						 	<option value="{{$v->id}}">{{$v->name}}</option>

						 @endforeach
						 </select>
					</div> 


					<button type="submit" class="btn btn-default">提交</button> 
			</form>
		</div>
@endsection