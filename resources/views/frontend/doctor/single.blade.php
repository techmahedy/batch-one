@extends('layouts.app')

@push('css')
<link href="{{ asset('css/doctor.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-img">
                <img src="{{ asset( 'avatars/' . $doctor->avatar) }}"/>
            </div>
            @if (session()->has('message'))
                <li>{{ session()->get('message') }}</li>
            @endif
            <form action="{{ route('feedback',$doctor->id) }}" method="post">
                @csrf 
                <select name="rating_value" id="" class="form-control" style="margin-top: 10px;">
                    <option value="">Select Rating</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <textarea name="feedback" id="" class="form-control" style="margin-top: 10px;"></textarea>
                <input type="submit" value="Give feedback" class="btn btn-success" style="margin-top:10px;">
            </form>
        </div>
        <div class="col-md-8">
            <div class="profile-head">
            <h5>
                {{ $doctor->name }}
            </h5>
            <h6>
                {{ $doctor->designation->name ?? 'No designation' }}
            </h6>
            <p class="proile-rating">Feedback : <span>{{ $doctor->feedbacks()->count() }}</span></p>
            <p class="rating_value">
                <span>Rating: {{ (int)$doctor->rating() }}</span>
            </p>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Bio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="education-tab" data-toggle="tab" href="#education" role="tab" aria-controls="education" aria-selected="false">Education</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <form action="{{ route('appointment',$doctor->id) }}" method="post">
                @csrf
                <input type="submit" class="btn btn-danger btn-sm py-0" value="Appoint Me">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-8">
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-md-6">
                        <label>Country</label>
                    </div>
                    <div class="col-md-6">
                        <p>{{ $doctor->country->name ?? '' }}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Assistant Number</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $doctor->assistant_phone }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Experience</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $doctor->experience }} Years</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Visit Fee</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $doctor->visit_fee }} Taka</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Offday</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $doctor->offday }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Break Time</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $doctor->break_time }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Address</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $doctor->address }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Medelist</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $doctor->is_medelist == 1 ? 'Medelist' : 'Not A Medelist'}}</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="col">
                            {{ $doctor->bio }}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
                    <div class="row">
                        <div class="col">
                            <table>
                                <tr>
                                    <th width="50%">Deegre</th>
                                    <th width="50%">Institution</th>
                                </tr>
                                @if(!empty($doctor->education))
                                    @forelse ($doctor->education as $education)
                                    <tr>
                                        <td width="50%">{{ $education['key'] }}</td>
                                        <td width="50%">{{ $education['value'] }}</td>
                                    </tr>
                                    @empty
                                    @endforelse
                                @endif

                            </table>
                        </div>
                        <div class="tab-pane fade show " id="experience" role="tabpanel" aria-labelledby="experience-tab">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>SL</th>
                                            <td>Clinic Name</td>
                                            <td>Start Name</td>
                                            <td>End Name</td>
                                        </tr>
                                        @forelse($doctor->experiences as $key =>$experience)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$experience->clinic_name}}</td>
                                                <td>{{$experience->start_date}}</td>
                                                <td>{{$experience->end_date}}</td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
