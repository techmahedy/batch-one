@extends('layouts.app')

@push('css')
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  margin-bottom:10px;
}
.title {
  color: grey;
  font-size: 18px;
}
button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}
a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}
button:hover, a:hover {
  opacity: 0.7;
}
</style>
@endpush

@section('content')
<div class="container">
    <div class="row">
        @forelse($doctors as $doctor)
          <div class="card col-md-4">
              <img src="avatars/{{ $doctor->avatar }}" style="width:100%; height: 100px;">
              <h1>{{ $doctor->name }}</h1>
              <p class="title">{{ $doctor->designation->name ?? 'No designation' }}</p>
              <p>
              @if(!empty($doctor->education))
                @forelse ($doctor->education as $education)
                {{ $education['value'] }}
                @empty
                @endforelse
              @endif
              </p>
              <span style="margin-bottom:10px;">Feedbacks: ({{ $doctor->feedbacks()->count() }})</span>
              <p><button>Details</button></p>
          </div>
        @empty
        @endforelse
    </div>
</div>
@endsection
