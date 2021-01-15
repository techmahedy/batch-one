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
    @php $ex_counter = $doctor->experiences->count(); @endphp
</div>

<div class="card-body">
    <form action="{{ route('doctor.profile',$doctor->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
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

            <div class="col-md-12 mb-2" id="image_hidden">
                <img id="image_preview_container" src="" style="max-height: 100px; border-radius:50%;">
            </div>

            <div class="position-relative form-group">
                <label for="examplePassword" class="">Avatar</label>
                <input type="file" name="avatar" id="avatar" class="form-control">
            </div>
            <div class="col-md-12 mb-2" id="image_hidden">
                <img src="{{ asset('avatars'.'/'.$doctor->avatar) }}" style="max-height: 50px; border-radius:50%;">
            </div>

            <div class="position-relative form-group">
                <label for="examplePassword" class="">Seelct Country</label>
                <select name="country_id" class="form-control">
                    <option value="0">Select name</option>
                    @forelse (\App\Models\Country::select('id','name')->get() as $item)
                    <option value="{{ $item->id }}" {{ $doctor->country_id == $item->id ? 'selected' : ''}}>{{ $item->name }}</option>
                    @empty
                    @endforelse
                </select>
            </div>
            
            <div class="position-relative form-group">
                <label for="examplePassword" class="">Visit Fee</label>
                <input type="number" name="visit_fee" class="form-control" value="{{ $doctor->visit_fee }}">
            </div>

            <div class="position-relative form-group">
                <input type="checkbox" name="is_offday" id="is_offday" value="1" {{ $doctor->is_offday == 1 ? 'checked' : '' }}> Any Offday
            </div>

            <div class="hidden_break_time" style="display: none;">
                <select name="offday" class="form-control">
                    <option value="saturday" {{ $doctor->offday == 'saturday' ? 'selected' : '' }}>Saturday</option>
                    <option value="sunday" {{ $doctor->offday == 'sunday' ? 'selected' : '' }}>Sunday</option>
                    <option value="monday" {{ $doctor->offday == 'monday' ? 'selected' : '' }}>Monday</option>
                    <option value="tuesday" {{ $doctor->offday == 'tuesday' ? 'selected' : '' }}>Tuesday</option>
                    <option value="wednesday" {{ $doctor->offday == 'wednesday' ? 'selected' : '' }}>Wednesday</option>
                    <option value="thursday" {{ $doctor->offday == 'thursday' ? 'selected' : '' }}>Thursday</option>
                    <option value="friday" {{ $doctor->offday == 'friday' ? 'selected' : '' }}>Friday</option>
                </select>
            </div>
            <br>
            <div class="position-relative form-group">
                <label for="examplePassword" class="">Break Time</label>
                <input type="text" name="break_time" class="form-control" value="{{ $doctor->break_time }}" placeholder="ex.. 4.00 pm to 5.00 pm">
            </div>

            <label for="">Your degree</label>
            @php $counter = 0; @endphp
            @foreach ($doctor->education as $education)
            <table class="table table-bordered" id="dynamic_field"> 
                <tr>  
                <td>
                    <input type="text" name="education[{{ $counter }}][key]" value="{{ $education['key'] }}" class="form-control form-control-sm key_list" id="key">
                </td>
                <td>
                    <input type="text" name="education[{{ $counter }}][value]" value="{{ $education['value'] }}" class="form-control form-control-sm value_list" id="value">
                </td>   
                <td>
                    <button type="button" id="degree_add" class="btn btn-success fa fa-plus-circle">
                    </button>
                </td>  
                </tr>  
            </table>
            @php $counter++; @endphp
            @endforeach

            <table class="table table-bordered" id="dynamic_field"> 
                <tr>  
                <td>
                    <input type="text" name="education[{{ $counter }}][key]" placeholder="Degree" class="form-control form-control-sm key_list" id="key">
                </td>
                <td>
                    <input type="text" name="education[{{ $counter }}][value]" placeholder="Institution" class="form-control form-control-sm value_list" id="value">
                </td>   
                <td>
                    <button type="button" id="degree_add" class="btn btn-success fa fa-plus-circle">
                    </button>
                </td>  
                <input type="hidden" id="counter" value="{{ $counter }}">
                </tr>  
            </table>

            <div class="position-relative form-group">
                <label for="examplePassword" class="">Address</label>
                <input type="text" name="address" class="form-control" value="{{ $doctor->address }}">
            </div>

            <div class="position-relative form-group">
                <label for="examplePassword" class="">Your Bio</label>
                <textarea name="bio" class="form-control">{{ $doctor->bio }}</textarea>
            </div>
            
            <div class="position-relative form-group">
                <label for="examplePassword" class="">Reusme</label>
                <input type="file" name="resume" class="form-control">
            </div>
            <table class="table table-striped table-inverse">
                <thead class="thead-inverse">
                    <tr>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>{{ $doctor->resume }}</td>
                        <td><a href="{{ asset('resumes').'/'.$doctor->resume }}" class="btn btn-danger btn-sm py-0">Read</a></td>
                    </tr>
                </tbody>
            </table>
            <div class="position-relative form-group">
                <input type="checkbox" name="is_medelist" value="1" {{ $doctor->is_medelist == 1 ? 'checked' : '' }}> Is Madelist?
            </div>
        </div>
        <div class="col-md-6">
            <blockquote class="custom_block">
                Your Experience!
            </blockquote>

            @if( $ex_counter > 0)
            @foreach ($doctor->experiences as $item)
            <div class="control-group clone_experience">
                <input type="hidden" name="experience_id[]" value="{{ $item->id }}">
                <div class="position-relative form-group">
                    <label for="examplePassword" class="">Start Date</label>
                    <input type="date" name="start_date[]" class="form-control" value="{{ $item->start_date }}">
                </div>
                <div class="position-relative form-group">
                    <label for="examplePassword" class="">End Date</label>
                    <input type="date" name="end_date[]" class="form-control" value="{{ $item->end_date }}">
                </div>
                <div class="position-relative form-group">
                    <label for="examplePassword" class="">Clinic Name</label>
                    <input type="text" name="clinic_name[]" class="form-control" value="{{ $item->clinic_name }}">
                </div>    
            </div>
            @endforeach
            @endif
            
            <div class="position-relative form-group">
                <input type="checkbox" id="experience"> Any Experience?
            </div>
            <img src="{{ asset('loader/loader.gif') }}" id="loader" style="display: none;">
            <div class="doctor_experiece" style="display: none;">
                <div class="control-group clone_experience">
                    <input type="hidden" name="experience_id[]">
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Start Date</label>
                        <input type="date" name="start_date[]" class="form-control">
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">End Date</label>
                        <input type="date" name="end_date[]" class="form-control">
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Clinic Name</label>
                        <input type="text" name="clinic_name[]" class="form-control">
                    </div>    
                </div>
    
                <div class="clone" style="display: none;">
                    <div class="control-group">
                    <h5>Experience</h5>
                    <input type="hidden" name="experience_id[]">
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Start Date</label>
                        <input type="date" name="start_date[]" class="form-control">
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">End Date</label>
                        <input type="date" name="end_date[]" class="form-control">
                    </div>
                    <div class="position-relative form-group">
                        <label for="examplePassword" class="">Clinic Name</label>
                        <input type="text" name="clinic_name[]" class="form-control">
                    </div>
                    <button class="btn btn-danger btn-sm btn-remove" type="button"><i class="fa fa-window-close"></i> Remove</button>
                    </div>
                </div>
                 <button type="button" class="btn btn-success pull-right mb-3" id="addMoreExperience">Add More Experience</button>
            </div>

            <label for="">Upload Certificate<small> (You can choose one or multiple)</small></label>

            <div class="input-group control-group img_div form-group" >
                <input type="file" name="documents[]" class="form-control">
                <button class="btn btn-dark btn-sm btn-add-more" type="button"><i class="fa fa-plus-circle"></i> Add More</button>
            </div>
        
            <div class="documents hide" style="display: none;">
                <div class="control-group input-group form-group">
                  <input type="file" name="documents[]" class="form-control"> 
                  <button class="btn btn-danger btn-sm documents-remove" type="button"><i class="fa fa-window-close"></i> Remove</button>
                </div>
            </div>
                @forelse($doctor->certificates as $certificate)
                <div class="control-group input-group form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="update_certifate[{{ $certificate->id }}]" class="form-control form-control-sm" value="{{ $certificate->id }}"> 
                            {{ $certificate->documents }}
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <a href="/documents/{{ $certificate->documents }}" class="btn btn-success btn-sm py-0"> Read</a> | 
                            <button class="btn btn-sm btn-danger py-0 documents-remove custom_button_design">
                            <i class="fa fa-window-close"></i> 
                            Remove
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>

    <input type="submit" class="btn btn-success" value="Update Profile">

</form>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
    
    $(document).ready(function(){
        
        if($("#is_offday").prop("checked") == true)
        {
            $('.hidden_break_time').fadeIn();
        }

        //hiding or showing is_offday div
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
        
        //hiding or showing experience div
        $("#experience").click(function() {
            if($("#experience").prop("checked")) {
                $('#loader').fadeIn();
                setTimeout(()=>{
                  	$('.doctor_experiece').fadeIn();
                },1000)
                $('#loader').fadeOut();
            }
            else{
                setTimeout(()=>{
                  $('.doctor_experiece').fadeOut();
                },1000)
            }
        });
        
        //clone experiences
        $('body').on('click','#addMoreExperience',function(){
        	var html = $(".clone").html();
            $(".clone_experience").after(html);
        })

        //remove clone
        $("body").on("click",".btn-remove",function(){ 
        	Swal.fire({
				  title: 'Do you want to remove this experience?',
				  showDenyButton: true,
				  confirmButtonText: `Yes`,
				  denyButtonText: `No`,
				}).then((result) => {
				  if (result.isConfirmed) {
				    $(this).parents(".control-group").remove();
				} 
			})
		});
        
        //Documents addmore code goes here
        $(".btn-add-more").click(function(){ 
            var html = $(".documents").html();
            $(".img_div").after(html);
        });
        $("body").on("click",".documents-remove",function(){ 
            $(this).parents(".control-group").remove();
        });

        //add more degree attributes options
        var i = 0;  
        let counter = $('#counter').val();    
        $('body').on('click','#degree_add',function(){ 
            
        var key = $("#key").val();
        var value = $("#value").val();
        counter++;  

        $('#dynamic_field').append('<tr id="row'+counter+'" class="dynamic-added"><td><input type="text" name="education['+counter+'][key]" placeholder="Degree" class="form-control form-control-sm key_list" value="'+key+'" /></td><td><input type="text" name="education['+counter+'][value]" placeholder="Institution" class="form-control form-control-sm value_list" value="'+value+'" /></td><td><button type="button" name="remove" id="'+counter+'" class="btn btn-danger fa fa-window-close btn_remove"></button></td></tr>');  
        });  

        $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();  
        });

        //instant avatar preview display
        $('#image_hidden').hide();
        
        $(document).on('change','#avatar',function(){
            $('#image_hidden').fadeIn();
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#image_preview_container').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
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