@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <span>{{ __('Users') }}</span>

          <a href="{{ route('users.create') }}" class="btn btn-primary ml-auto">Add</a>
        </div>

        <div class="card-body">

          {{-- @include('layouts._messages') --}}

          <users-list :user-id="{{ auth()->id() }}"></users-list>

          
          {{-- <div class="m-4">{!! $users->appends(request()->except('page'))->render() !!}</div> --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection