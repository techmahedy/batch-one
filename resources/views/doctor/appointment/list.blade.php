@extends('doctor.layout.master')

@push('style')
@endpush

@section('content')
<div class="card-header">
    Appointment List
</div>

<div class="card-body">

    <table class="table table-stripped table-bordered">
        <tr>
            <th>No</th>
            <th>Patient Name</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @forelse ($appointments as $item)
        <tr> 
            <td>{{ $loop->index + 1 }}</td>
            <td>
                {{ $item->patient->name }}
            </td>
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
            <td>
                <a href="{{ route('doctor.appointment.accept',$item->id) }}" class="btn btn-warning btn-sm py-0">Accept</a>
                |
                <a href="{{ route('doctor.appointment.reject',$item->id) }}" class="btn btn-warning btn-sm py-0">Reject</a>
                |
                <a href="{{ route('doctor.appointment.seen',$item->id) }}" class="btn btn-warning btn-sm py-0">Seen</a>
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