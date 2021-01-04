@extends('admin.layout.master')

@push('style')
@endpush

@section('content')
<div class="card-header">Active Users

    {{ Auth::guard('doctor')->user()->name }}

</div>

<div class="card-body">



</div>
@endsection

@push('stack')
@endpush