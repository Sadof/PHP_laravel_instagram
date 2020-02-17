@extends ('layouts.app')


@section('content')

<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-4">
			<form action='/p' method="POST" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label for="title">title</label>
					<input type="text" name="title" class="form-control" value="{{ old('title') }}">
					@error('title')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label for="text">Text</label>
					<input type="text" name="text" class="form-control" value="{{ old('text')}}">
					@error('text')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
				    <label for="image">Image</label>
				    <input type="file" class="form-control-file" id="image" name="image">
				    @error('image')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>


				<button class="btn btn-primary">Edit profile</button>
			</form>
		</div>
	</div>
</div>	
	
@endsection

