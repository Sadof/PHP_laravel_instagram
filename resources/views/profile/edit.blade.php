@extends ('layouts.app')



@section('content')
<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-4">
			<form action='/profile/{{ $user->id }}' method="POST" enctype="multipart/form-data">
				@csrf
				@method("PATCH")
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" class="form-control" value="{{ old('name') ?? $user->profile->name }}">
					@error('name')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label for="surname">Surname</label>
					<input type="text" name="surname" class="form-control" value="{{ old('surname') ?? $user->profile->surname }}">
					@error('surname')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
					<label for="bio">Bio</label>
					<input type="text" name="bio" class="form-control" value="{{ old('bio') ?? $user->profile->bio }}">
					@error('bio')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>
				<div class="form-group">
				    <label for="image">Image</label>
				    <input type="file" class="form-control-file" id="image" name="image">
				    @error('file')
					    <div class="alert alert-danger">{{ $message }}</div>
					@enderror
				</div>


				<button class="btn btn-primary">Edit profile</button>
			</form>
		</div>
	</div>
</div>	
@endsection