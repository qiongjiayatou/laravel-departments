
<form action="{{ route($route, $params) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method($method)

  <div class="form-group">
    <label for="name">{{ __('Name') }}</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', isset($section->name) ? $section->name : '') }}" required autocomplete="name" autofocus>
    @error('name')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="description">{{ __('Description') }}</label>
    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="5" required autocomplete="description">{{ old('description', isset($section->description) ? $section->description : '') }}</textarea>
    @error('description')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <label class="form-label">{{ __('Logo') }}</label>
  <div class="custom-file form-group">
    <input type="file" class="custom-file-input" id="logo" name="logo">
    <label class="custom-file-label" for="logo"></label>
  </div>

  <h2 class="mt-3">Users</h2>
  <div class="form-group mt-3">
    @foreach($users as $user)
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="user-{{ $user->id }}" name="users[]" value="{{ $user->id }}" 
        @if(in_array($user->id, old('users', [])) 
            || (isset($section) && in_array($user->id, $section->users->pluck('id')->toArray())))  
            checked
        @endif>
      <label class="custom-control-label" for="user-{{ $user->id }}">{{ $user->name }}</label>
    </div>
    @endforeach
  </div>

  <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
</form>