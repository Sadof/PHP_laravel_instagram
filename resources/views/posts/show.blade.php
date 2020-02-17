@extends ('layouts.app')


@section('content')
	<!-- Button trigger modal -->


<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			Delete this post?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" onclick="document.getElementById('delete-form').submit();">Delete</button>
	      </div>
	    </div>
	  </div>
	</div>
	<form id="delete-form" action="/p/{{ $post->id }}" method="POST" style="display: none;">
        @csrf
        @method('delete')
    </form>
	<div class="container">
		
		<div class="row">
			<div>
				<img src="/storage/{{ $post->image }}" style="width: 600px; height: 600px;">
			</div>
			<div>
				<div class="ml-5">
					<h3>{{ $post->title }}</h3>
					@can('update', $post->user->profile)
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
							Delete
						</button>
					@endcan
					<p>{{ $post->text }}</p>
				</div>
			</div>
		</div>
	</div>

@endsection