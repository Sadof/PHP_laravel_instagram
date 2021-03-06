@extends ('layouts.app')

@section('content')
	<div class="container">
		<div class="h2"><a href="/profile/{{ $user->id }}">{{ $user->username }}</a> follow: </div>

		<!-- <div class="card-deck">
		@foreach($follow ?? $following as $p)
	
		  <div class="card">
		    <img src="{{ $p->getImage() }}" class="card-img-top" alt="..." style="width: 300px; height: 300px;">
		    <div class="card-body">
		      <h5 class="card-title"><a href="/profile/{{ $p->user->id }}/">{{$p->user->username}}</a></h5>
		      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
		      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
		    </div>
		  </div>
		@endforeach  
		</div> -->
		<div class="mt-5">
		@foreach($follow ?? $following as $p)
			<div class="media mb-2">
			  <img src="{{ $p->getImage() }}" class="mr-3" alt="..." style="width: 150px;">
			  <div class="media-body">
			    <h5 class="mt-0"><a href="/profile/{{ $p->id }}/">{{$p->user->username}}</a></h5>
			   		<div class="row justify-content-md-left">
						<div class="col col-lg-2">
							<p><span class="font-weight-bold">{{ $p->user->posts()->count()}}</span> posts</p>
						</div>
							<div class="col col-lg-2">
							<p><a href="/profile/{{ $p->user->id }}/followed"><span class="font-weight-bold">{{ $p->followers()->count() }}</span> followers </a></p>
						</div>
						<div class="col col-lg-2">
								<p><a href="/profile/{{ $p->user->id }}/follow"><span class="font-weight-bold">{{ $p->user->following()->count() }}</span> following</a></p>
							</div>
					</div>
					<div>
						<p class="font-weight-bolder" >{{ $p->name}} {{ $p->surname}}</p>
						<p>{{ $p->bio }}</p>
					</div>
			  </div>
			</div>
			<hr>
		@endforeach  
		</div>
	</div>
	
@endsection

<!-- foreach($follow ?? $following as $p) -->