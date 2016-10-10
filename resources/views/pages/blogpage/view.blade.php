<!-- {{$debugpath}} -->

<div class="blog-wrapper">
	
	@foreach($blog as $post)
		<article>
			<h2>{{$post->title}}</h2>
			<p>{{$post->content}}</p>
			<p><small>Posted by <b>{{$post->Author->name}}</b> at <b>{{$post->created_at}}</b></small></p>
		</article>
	@endforeach	

	{{$blog->links()}}
</div>

<!-- [{
	"id":2,
	"title":"Nog een title",
	"content":"dsfasdf",
	"author_id":1,
	"created_at":"2016-10-09 00:00:00",
	"updated_at":null,
	"author":{
		"id":1,
		"name":"Ronald",
		"email":"ronaldzwiers@hotmail.com",
		"created_at":null,
		"updated_at":null,
		"lastname":"",
		"gender":"",
		"tradename":"",
		"streetnumber":"",
		"zip":"",
		"city":"",
		"type":"",
		"birthday":""}
	},
{
	"id":1,
	"title":"Dit is een blog titel",
	"content":"asdfasdf",
	"author_id":1,
	"created_at":"2016-10-10 00:00:00",
	"updated_at":null,
	"author":{
		"id":1,
		"name":"Ronald",
		"email":"ronaldzwiers@hotmail.com",
		"created_at":null,
		"updated_at":null,
		"lastname":"",
		"gender":"",
		"tradename":"",
		"streetnumber":"",
		"zip":"",
		"city":"",
		"type":"",
		"birthday":""
	}
}] -->