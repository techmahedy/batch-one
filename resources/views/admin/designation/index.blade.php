@extends('admin.layout.master')

@push('style')
@endpush

@section('content')
<div class="card-header">
    Designation List
    <a href="" class="d-inline ml-5" data-toggle="modal" data-target="#modelId">Add Designation</a>
</div>

<div class="card-body">

<table class="table table-striped">
    <thead class="thead-inverse">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @forelse($designations as $item)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <a href="" class="btn btn-success btn-sm py-0">Edit</a>
                    |
                    <a href="" class="btn btn-danger btn-sm py-0">Delete</a>
                </td>
            </tr>
            @empty
                <span>No data found!</span>
            @endforelse
        </tbody>
</table>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>



</div>
@endsection

@push('stack')
@endpush