@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Edit Section') }}</div>

        <div class="card-body">
          {{-- @include('layouts._messages')

          @include('sections._form', [
          'route' => 'sections.update',
          'params' => ['section' => $section->id],
          'method' => 'PUT'
          ]) --}}

          <sections-edit :section-id="{{ $section->id }}"></sections-edit>


        </div>
      </div>
    </div>
  </div>
</div>
@endsection