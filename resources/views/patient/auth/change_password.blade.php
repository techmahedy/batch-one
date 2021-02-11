@extends('doctor.layout.master')

@push('style')
<style>
    .is-valid{
        border: 1px solid green;
    }
</style>
@endpush

@section('content')
<div class="card-header">
    Update Password
</div>

<div class="card-body">
        @includeIf('admin.success.message')
        <form action="{{ route('doctor.change.password') }}" method="POST" id="doctor_update_password">
            @csrf
            @method('PATCH')
            <div class="position-relative form-group">
                <label for="examplePassword" class="">Password</label>
                <input name="oldpassword" id="examplePassword" placeholder="Old password" type="password" class="form-control">
            </div>

            <div class="position-relative form-group">
                <label for="" class="">New Password</label>
                <input name="password" id="password" placeholder="New password" type="password" class="form-control">
            </div>

            <div class="position-relative form-group">
                <label for="" class="">Confirm Password</label>
                <input name="password_confirmation" placeholder="Confirm password" type="password" class="form-control">
            </div>
           
            <button type="submit" class="mt-1 btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script type="text/javascript">

    $(document).ready(function () {
        //Validate form data
        $('#doctor_update_password').validate({ 
        rules: {
            oldpassword: {
                required: true
            },
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                equalTo: '#password'
            },
        },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
          }
        });
    });
</script>
@endpush