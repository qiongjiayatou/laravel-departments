<form method="POST" action="{{ route($route, $params) }}">

  @csrf
  @method($method)


  <div class="form-group">
    <label for="name">{{ __('Name') }}</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
      value="{{ old('name', isset($user->name) ? $user->name : '') }}" required autocomplete="name" autofocus>
    @error('name')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="email">{{ __('Email address') }}</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
      value="{{ old('email', isset($user->email) ? $user->email : '') }}" required autocomplete="email">
    @error('email')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="password">{{ __('Password') }}</label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
      required autocomplete="new-password">
    @error('password')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
</form>