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
  <form action="{{ route('doctor.list') }}" method="GET">
    <div class="row">
        <div class="col-md-4">
        <h3>Country</h3>
        <select name="country" id="" class="form-control">
          <option value="0">Select country</option>
          @foreach (\App\Models\Country::select('id','name')->get() as $item)
            <option value="{{ $item->id }}" {{ $select_doctor == $item->id ? 'selected' : '' }} >{{ $item->name }}</option>
          @endforeach
        </select>
        </div>
        <div class="col-md-4">
          <h3>Designation</h3>
        <select name="designation" id="" class="form-control">
          <option value="0">Select designation</option>
          @foreach (\App\Models\Designation::select('id','name')->get() as $item)
            <option value="{{ $item->id }}" {{ $selected_designation == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
          @endforeach
        </select>
        </div>
        <div class="col-md-4">
          <input type="submit" class="btn btn-success" value="Filter">
        </div>
    </div>
  </form>
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
              <p><a href="{{ route('doctor.single',$doctor->slug) }}"><button>Details</button></a></p>
          </div>
        @empty
        @endforelse
    </div>
</div>
@endsection
