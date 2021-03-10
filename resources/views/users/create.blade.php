@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Add User') }}</div>

        <div class="card-body">
          {{-- @include('layouts._messages')

          @include('users._form', [
            'route' => 'users.store',
            'params' => [],
            'method' => null
          ]) --}}
          
          <users-create></users-create>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection