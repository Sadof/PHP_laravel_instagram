@extends ('layouts.app')

@section('content')
	<div class="container">
		@if (!empty($follow))
			<div class="h2"><a href="/profile/{{ $user->id }}">{{ $user->username }}</a> follow: </div>
		@else
			<div class="h2"><a href="/profile/{{ $user->id }}">{{ $user->username }}</a> followed by: </div>
		@endif
		<div class="card-group">
		@foreach($follow ?? $following as $p)
		{{$p}}	
		  <div class="card">
		    <img src="/storage/{{ $p->image }}" class="card-img-top" alt="...">
		    <div class="card-body">
		      <h5 class="card-title">Card title</h5>
		      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
		    </div>
		    <div class="card-footer">
		      <small class="text-muted">Last updated 3 mins ago</small>
		    </div>
		  </div>
		@endforeach  
		</div>
	</div>
	
@endsection