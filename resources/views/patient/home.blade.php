@extends('patient.layout.master')

@push('style')
@endpush

@section('content')
<div class="card-header">
    Hi
</div>

<div class="card-body">

<table class="table table-stripped table-bordered">
    <tr>
        <th>No</th>
        <th>Doctor Name</th>
        <th>Date</th>
        <th>Status</th>
    </tr>
    @forelse (\App\Models\Appointment::where('patient_id',Auth::guard('patient')->id())->get() as $item)
    <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $item->doctor->name ?? '' }}</td>
        <td>{{ $item->schedule_date ?? '' }}</td>
        <td>
            @if($item->status == 0)
                <button class="btn btn-primary btn-sm py-0">Pending</button>
            @elseif($item->status == 1)
            <button class="btn btn-success btn-sm py-0">Accepted</button>
            @elseif($item->status == 2)
            <button class="btn btn-warning btn-sm py-0">Seen</button>
            @elseif($item->status == 3)
            <button class="btn btn-danger btn-sm py-0">Reject</button>
            @endif
        </td>
    </tr>
    @empty
        <p>No appontment found!</p>
    @endforelse
</table>

</div>
@endsection

@push('stack')
@endpush