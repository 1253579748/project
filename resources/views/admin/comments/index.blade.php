@extends("admin.index.index")
@section("main")
@include('admin.public.information')
<div class="panel-body widget-shadow ">
	<h4>留言列表</h4>
	<table class="table table-striped" >
		<thead >
			<tr >
			  <th>ID号</th>
			  <th>用户</th>
			  <th>商品标题</th>
			  <th>留言内容</th>
			  <th>留言时间</th>
			  <th>状态</th>
			  <th>操作</th>
			</tr>
		</thead>
		<tbody>

			@foreach($data as $k => $v)
			
			<tr data-text="{{$v->text}}" data-uid="{{$v->uid}}" data-id="{{$v->id}}"data-time="{{@date('Y-m-d H:i:s',$v->created_at)}}" >
			  <th scope="row">{{$v->id}}</th>
			  <td>{{$v->uid}}</td>
			  <td>{{$v->gid}}</td>
			  <td>{{$v->text}}</td>
			  <td>{{@date('Y-m-d H:i:s',$v->created_at)}}</td>
			  <td>
				@if($v->status==0)
				待回复
				@elseif($v->status==1)
					已回复
			    @elseif($v->status==2)
					追加评论
				@endif		
			  </td>
			  
			  <td>
								<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary comment-update" data-toggle="modal" data-target="#myModal{{$v->id}}">
				  回复
				</button>
				<!-- Modal -->
				<div class="modal fade" id="myModal{{$v->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span  class="close-span" aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">留言</h4>
				      </div>
				      <div class="row">
				      	
							<div class="well first">
							  <div class="media-left">
							   <span class="glyphicon glyphicon-user"></span>
							  </div>
							  <div class="media-body comments-first">
							    <h4 class="media-heading"></h4>
						    	<div class="c-text">
						    	</div>
						    	<div class="c-time">
						    	</div>
							  </div>
							</div>
				      </div>
				      <form action="/admin/comments/store" method="post">
				      	{{ csrf_field() }}
							<div>
								<input type="text" name="text">
								<input type="hidden" name="id" value="{{$v->id}}">
							</div>
							<div class="modal-footer">
				        
						        <button type="submit" class="btn btn-primary comment-store">发送</button>
						        
						        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
						    </div>
				      </form>
			      	
	
				     
				    </div>
				  </div>
				</div>
				<button class="comment-del btn btn-danger">删除</button>
			  </td>
			</tr>

			@endforeach



		</tbody>
	</table>

		<!--打开留言回复功能-->
	<script>
		
			$('.comment-update').click(function(){
				//获取用户留言信息并显示到回复留言中
				var uid = $(this).parent().parent().data('uid');
				var text = $(this).parent().parent().data('text');
				var time = $(this).parent().parent().data('time');
				var id = $(this).parent().parent().data('id');
				$('.comments-first h4').html(uid);
				$('.c-text').html(text);
				$('.c-time').html(time);
				//
				$.ajax({
					url:'/admin/comments/update',
					method:'get',
					data:{
						id:id,
					},
					success:function(res){
						for (var i = 0; i < res.length; i++) {
							if(res[i].gid == 0){
								res[i].gid = '商家';
							}
							if(res[i].role == '1'){
								$('.first').after('<div class="well asd"><div class="media-body text-right"><h4 class="media-heading">'+res[i].gid+'</h4><div>'+res[i].text+'</div><div>'+res[i].created_at+'</div> </div><div class="media-right"><span class="glyphicon glyphicon-user"></span></div></div>');
							}else{
								$('.first').after('<div class="well asd"><div class="media-left"><span class="glyphicon glyphicon-user"></span></div><div class="media-body comments-first"><h4 class="media-heading">'+uid+'</h4><div>'+res[i].text+'</div><div>'+res[i].created_at+'</div></div></div>');
							}
							
						}

					},
				})
			})
			//模态框关闭清空数据
			$('.modal').on('hidden.bs.modal',function(){
				$('.asd').remove();
				$('input[name=text]').val("");
			})					
	</script>
		
	<script>
			$('.comment-del').click(function(){
				var id = $(this).parent().parent().data('id');
				$.ajax({
					url:'/admin/comments/delete',
					method:'get',
					data:{
						id:id,
					},
					success:function(res){
						console.dir(res);
					}
				})
			});
	</script>
</div>
@endsection

