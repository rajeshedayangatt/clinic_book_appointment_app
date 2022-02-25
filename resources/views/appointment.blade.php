
@extends('layout.app')

@section('content')

    <!-- Include Moment.js CDN -->
    <script type="text/javascript" src=
    "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js">
    </script>

    <!-- Include Bootstrap DateTimePicker CDN -->
    <link
        href=
        "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet">

    <script src=
            "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>



    <div class="row">
        <div class="col-sm-6">
            <h3>Book An Appointment</h3>

            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Doctor Name</th>
                        <th>Specialization</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($doctors as $index => $doctor)


                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$doctor->name}}</td>
                            <td>{{$doctor->specializedIn->title}}</td>
                            <td>
                                <button class="appointment btn btn-default" data-doc="{{$doctor->id}}" >Take An Appointment</button>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>




        </div>
        <div class="col-sm-6">
            <form id="appointment_form" style="margin-top: 67px" method="POST">
                @csrf
                <input type="hidden" name="doctor" id="doctor">
                <div class="form-group">
                    <label for="specilization">Select Time</label>
                    <input type="text" name="appointment_date" class="form-control datepicker" required>
                </div>
                <div class="form-group">
                    <label for="specilization">Patient Name</label>
                    <input type="text" name="patient_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="specilization">Reason</label>
                    <textarea name="reason" class="form-control" required></textarea>
                </div>

                <button type="button" class="btn btn-primary" onClick="return submitAppointment()" >Submit</button>
            </form>
        </div>

    </div>


    <script>

        $(document).on('ready' , () => {
            $("#appointment_form").hide();
        });
        $('.datepicker').datetimepicker({
            minDate:new Date()
        });

        $(".appointment").on("click",function()  {

            $("#appointment_form").hide();

            $(".btn").each(function() {
                $(this).removeClass('btn-primary');
                $(this).addClass('btn-default');
            })

            $(this).removeClass("btn-default");
            $(this).addClass("btn-primary");
            let doc_id = $(this).data('doc');
            $("#doctor").val(doc_id);


            setInterval(function() {


                $("#appointment_form").show();


            },200);



        });

        function submitAppointment() {


            var form = $("#appointment_form");
            var url = "{{route('appointment_form_submit')}}";

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(data) {

                    // Ajax call completed successfully
                    alert(data.status);

                    if(data.status == "Successfully Booked") {

                        var url = "{{route('appointment_form')}}";

                        location.href = "/";
                    }
                },
                error: function(data) {

                    // Some error in ajax call
                    alert(data.status);
                }
            });

            return false;

        }



    </script>

@endsection
