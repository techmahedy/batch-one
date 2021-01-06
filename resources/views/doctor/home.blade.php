@extends('doctor.layout.master')

@push('style')
@endpush

@section('content')
<div class="card-header">
    Your last login was {{ \Carbon\Carbon::parse(Auth::guard('doctor')->user()->last_login)->toFormattedDateString() }}
</div>

<div class="card-body">

<h1>Welcome {{ Auth::guard('doctor')->user()->name }}.</h1>

</div>
@endsection

@push('stack')
@endpush