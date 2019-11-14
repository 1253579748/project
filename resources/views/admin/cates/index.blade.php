@extends("admin.index.index")
@section("main")
@include('admin.public.information')
<div class="panel-body widget-shadow ">
	<h4>分类列表</h4>
	<table class="table table-hover">
		<thead>
			<tr>
			  <th>ID号</th>
			  <th>分类名</th>
			  <th>PID</th>
			  <th>操作</th>
			</tr>
		</thead>
		<tbody>

			@foreach($data as $k => $v)
			
			<tr data-id="{{$v->id}}" data-name="{{$v->name}}">
			  <th scope="row">{{$v->id}}</th>
			  <td>{{$v->name}}</td>
			  <td>{{$v->pid}}</td>
			  <td>
				<a class="type-edit" >修改</a>
				<a class="type-del">删除</a>
			  </td>
			</tr>

			@endforeach
		</tbody>
	<!--修改ajax JQ处理-->
	<script type="text/javascript">

		$('.type-edit').click(function(){
			//
				
			//获取他的源生 防止缓存 .get(0).dataset.name等效于data('name')
			var name = $(this).parent().parent().get(0).dataset.name;
			var id  = $(this).parent().parent().data('id');
			//console.dir($(this).parent().parent()[0].dataset.name);
			$(this).parent().prev().prev().replaceWith('<input type="text" data-id="' + id + '" name="name" value="'+ name +'">');
			//自动聚焦
			$('input[name=name]').focus();
			$('input[name=name]').change(function(){
				
				var tname = $(this);
				var tval = tname.val();
				$.ajax({
					url:'/admin/cates/update',
					method:'post',
					data:{
						id:id,
						name:tval,
						_token:'{{ csrf_token() }}'
					},
					success:function(res){
						if(res == 'ok'){
							//更新tr标签的data-name 防止重复点击后没更新数据
							tname.parent().attr('data-name',tval);
							tname.replaceWith('<td>'+tval+'</td>');

						}
					},
					error:function(){

					}
				})
			});

			$('input[name=name]').blur(function(){

				var tname = $(this);
				var tval = tname.val();
				if(tval == name){
					tname.replaceWith('<td>'+name+'</td>');
				}
			})

		});
	</script>
	<!--删除ajax JQ处理-->
	<script type="text/javascript">
		
		$('.type-del').click(function(){
			var tdel = $(this);
			var id  = $(this).parent().parent().data('id');
			$.ajax({
				url:'/admin/cates/delete',
				method:'get',
				data:{
					id:id,
				},
				success:function(res){
					if(res == 'ok'){
						tdel.parent().parent().remove();
					}
				},
				error:function(res){

				}
			})

		})

	</script>
	</table>
</div>
@endsection