
@extends('layout.app')

@section('content')

    <div class="row">
        <div class="col-sm-6">
            <h3>Book An Appointment</h3>
            <a href="{{route('appointment_form')}}">Book</a>
        </div>
        <div class="col-sm-6">
            <h3>View All Appointments</h3>
            <a href="{{route('appointments_calender')}}">View</a>
        </div>

    </div>


@endsection
