@extends ('layouts/app')


@section('content')

	<div class="container">
		<div class="row">
			<div class="col-3 ml-3">
				<img src="{{ $user->profile->getImage() }}" style="width: 100%; height: 100%;">
			</div>
			<div class="col-8">
				<div class='d-flex align-items-center mb-3'>
					<div class="h4">{{ $user->username }}</div>
					@if ($follows)	
						<follow-button user-id={{ $user->id }} follows={{ $follows }}></follow-button>
					@endif
					@can('update', $user->profile)
						<div class="ml-3">
							<a href="/profile/{{ $user->id }}/edit">Edit profile</a>   <a href="/p/create" class="ml-3">Add post</a>
						</div>
					@endcan
				</div>
				
				<div class="row justify-content-md-left">
					<div class="col col-lg-2">
						<p><span class="font-weight-bold">{{ $user->posts()->count()}}</span> posts</p>
					</div>
					<div class="col col-lg-2">
						<p><span class="font-weight-bold">{{ $user->profile->followers()->count() }}</span> followers </p>
					</div>
					<div class="col col-lg-2">
						<p><span class="font-weight-bold">{{ $user->following()->count() }}</span> following</p>
					</div>
				</div>
				<div>
					<p class="font-weight-bolder" >{{ $user->profile->name}} {{ $user->profile->surname}}</p>
					<p>{{ $user->profile->bio }}</p>
				</div>
			</div>
		</div>
		
		<div class="album py-3 mt-3 bg-light">
		    <div class="container">
			    <div class="row">
			    	@foreach ($user->posts as $post)
				        <div class="col-md-4">
				          <div class="card mb-4 shadow-sm">
				            <a href="/p/{{ $post->id }}"><img src="/storage/{{ $post->image }}" style="height: 340px; width: 340px;"></a>
				          </div>
				        </div>
					@endforeach
			    </div>	    
		  </div>
	</div>
@endsection