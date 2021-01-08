@extends('doctor.layout.master')

@push('style')
<style>
    .is-valid{
        border: 1px solid green;
    }
    blockquote.custom_block {
        border-left: 5px solid green;
        padding: 10px;
    }
</style>
@endpush

@section('content')
<div class="card-header">
    Update Profile
</div>

<div class="card-body">
    <div class="row">
        <div class="col-md-6">
                <div class="position-relative form-group">
                    <label for="examplePassword" class="">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $doctor->name }}">
                </div>
        
                <div class="position-relative form-group">
                    <label for="examplePassword" class="">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ $doctor->email }}">
                </div>

                <div class="position-relative form-group">
                    <label for="examplePassword" class="">Assistant Phone</label>
                    <input type="text" name="assistant_phone" class="form-control" value="{{ $doctor->assistant_phone }}">
                </div>

                <div class="position-relative form-group">
                    <label for="examplePassword" class="">Avatar</label>
                    <input type="file" name="avatar" class="form-control">
                </div>

                <select name="" id="" class="form-control">
                    <option value="">Bangladesh</option>
                    <option value="">India</option>
                </select>
                
                <div class="position-relative form-group">
                    <label for="examplePassword" class="">Visit Fee</label>
                    <input type="number" name="visit_fee" class="form-control" value="{{ $doctor->visit_fee }}">
                </div>

                <div class="position-relative form-group">
                    <input type="checkbox" name="is_offday" id="is_offday" value="1" {{ $doctor->is_offday == 1 ? 'checked' : '' }}> Any Offday
                </div>

                <div class="hidden_break_time" style="display: none;">
                    <select name="" id="" class="form-control">
                        <option value="">Saturday</option>
                        <option value="">Sunday</option>
                    </select>
                </div>
                
                <div class="position-relative form-group">
                    <label for="examplePassword" class="">Break Time</label>
                    <input type="text" name="break_time" class="form-control" value="{{ $doctor->break_time }}">
                </div>

                <label for="">Your degree</label>
                <table class="table table-bordered" id="dynamic_field"> 
                    <tr>  
                    <td>
                        <input type="text" name="education[0][key]" placeholder="Degree" class="form-control form-control-sm key_list" id="key" required>
                    </td>
                    <td>
                        <input type="text" name="education[0][value]" placeholder="Institution" class="form-control form-control-sm value_list" id="value" required>
                    </td>   
                    <td>
                        <button type="button" id="degree_add" class="btn btn-success fa fa-plus-circle">
                        </button>
                    </td>  
                    </tr>  
                </table>

                <div class="position-relative form-group">
                    <label for="examplePassword" class="">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ $doctor->address }}">
                </div>

                <div class="position-relative form-group">
                    <label for="examplePassword" class="">Your Bio</label>
                    <textarea name="bio" id="" class="form-control">{{ $doctor->bio }}</textarea>
                </div>
                
                <div class="position-relative form-group">
                    <label for="examplePassword" class="">Reusme</label>
                    <input type="file" name="address" class="form-control">
                </div>

                <div class="position-relative form-group">
                    <input type="checkbox" name="is_offday" value="1" {{ $doctor->is_medelist == 1 ? 'checked' : '' }}> Is Madelist?
                </div>
        </div>
        <div class="col-md-6">
            <blockquote class="custom_block">
                Your Experience!
            </blockquote>
            <div class="position-relative form-group">
                <input type="checkbox"> Any Experience?
            </div>
            <div class="doctor_experiece" style="display: none;">
                <div class="position-relative form-group">
                    <label for="examplePassword" class="">Start Date</label>
                    <input type="date" name="start_date" class="form-control">
                </div>
                <div class="position-relative form-group">
                    <label for="examplePassword" class="">End Date</label>
                    <input type="date" name="end_date" class="form-control">
                </div>
                <div class="position-relative form-group">
                    <label for="examplePassword" class="">Clinic Name</label>
                    <input type="text" name="clinic_name" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script type="text/javascript">
    
    $(document).ready(function(){

        $("#is_offday").click(function() {
            if($("#is_offday").prop("checked")) {
                setTimeout(()=>{
                  	$('.hidden_break_time').fadeIn();
                },1000)
            }
            else{
                setTimeout(()=>{
                  $('.hidden_break_time').fadeOut();
                },1000)
            }
        });

        //add more degree attributes options
        var i = 0;  
                
        $('body').on('click','#degree_add',function(){ 
            
        var key = $("#key").val();
        var value = $("#value").val();
        i++;  

        $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="education['+i+'][key]" placeholder="Degree" class="form-control form-control-sm key_list" value="'+key+'" /></td><td><input type="text" name="education['+i+'][value]" placeholder="Institution" class="form-control form-control-sm value_list" value="'+value+'" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger fa fa-window-close btn_remove"></button></td></tr>');  
        });  

        $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();  
        });
    })

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