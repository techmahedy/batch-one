@extends('admin.layout.master')

@push('style')
@endpush

@section('content')
<div class="card-header">
   We are learing vue js
</div>

<example-component :test="{{ \App\Models\Doctor::first() }}"></example-component>

@endsection

@push('stack')
@endpush