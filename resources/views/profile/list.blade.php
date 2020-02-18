@extends ('layouts.app')

@section('content')
	<div class="container">
		<div class="h2">All users sorted by followers.</div>

		<div class="mt-5">
		@foreach($profiles as $p)
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