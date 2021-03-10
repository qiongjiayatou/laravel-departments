@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex align-items-center">
          <span class="">{{ __('Sections') }}</span>

          <a href="{{ route('sections.create') }}" class="btn btn-primary ml-auto">Add</a>
        </div>

        <div class="card-body">

          <sections-list></sections-list>
          

          {{-- <div class="m-4">{!! $sections->appends(request()->except('page'))->render() !!}</div> --}} 

        </div>
      </div>
    </div>
  </div>
</div>

@endsection