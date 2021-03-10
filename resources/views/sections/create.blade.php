@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Add Section') }}</div>

        <div class="card-body">
          {{-- @include('layouts._messages') --}}

          {{-- @include('sections._form', [
            'route' => 'sections.store',
            'params' => [],
            'method' => null
            ]) --}}

          
          <sections-create></sections-create>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection