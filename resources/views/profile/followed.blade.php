@extends ('layouts.app')

@section('content')
	<div class="container">
		<div class="h2"><a href="/profile/{{ $user->id }}">{{ $user->username }}</a> followed by: </div>

		<!-- <div class="card-deck">
		@foreach($follow ?? $following as $p)
		  <div class="card">
		    <img src="{{ $p->profile->getImage() }}" class="card-img-top" alt="..." style="width: 36px; height: 36px;">
		    <div class="card-body">
		      <h5 class="card-title"><a href="/profile/{{ $p->id }}/">{{$p->username}}</a></h5>
		      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
		    </div>
		    <div class="card-footer">
		      <small class="text-muted">Last updated 3 mins ago</small>
		    </div>
		  </div>
		@endforeach  
		</div> -->
		<div class="mt-5">
		@foreach($follow ?? $following as $p)
			<div class="media mb-2">
			  <img src="{{ $p->profile->getImage() }}" class="mr-3" alt="..." style="width: 150px;">
			  <div class="media-body">
			    <h5 class="mt-0"><a href="/profile/{{ $p->id }}/">{{$p->username}}</a></h5>
			   		<div class="row justify-content-md-left">
						<div class="col col-lg-2">
							<p><span class="font-weight-bold">{{ $p->posts()->count()}}</span> posts</p>
						</div>
							<div class="col col-lg-2">
							<p><a href="/profile/{{ $p->id }}/followed"><span class="font-weight-bold">{{ $p->profile->followers()->count() }}</span> followers </a></p>
						</div>
						<div class="col col-lg-2">
								<p><a href="/profile/{{ $p->id }}/follow"><span class="font-weight-bold">{{ $p->following()->count() }}</span> following</a></p>
							</div>
					</div>
					<div>
						<p class="font-weight-bolder" >{{ $p->profile->name}} {{ $p->profile->surname}}</p>
						<p>{{ $p->profile->bio }}</p>
					</div>
			  </div>
			</div>
			<hr>
		@endforeach  
		</div>
	</div>
	
@endsection

<!-- foreach($follow ?? $following as $p) -->