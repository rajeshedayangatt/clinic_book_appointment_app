
@extends('layout.app')

@section('content')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>



    <div class="row">
        <div class="col-md-12">
            <h3>Appointment Calender</h3>

            <p>Click Patient Name For Additional Details</p>

            <div id="calendar"></div>


        </div>

    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Appointment Details</h4>
                </div>
                <div class="modal-body" id="content_modal">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script>


        $(document).ready(function() {

            var getappointments = "{{route('appointment_all')}}";

            var calendar = $('#calendar').fullCalendar({
                editable:true,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                events: getappointments,
                selectable:true,
                selectHelper:true,
                select: function(start, end, allDay)
                {

                },
                editable:true,
                eventResize:function(event)
                {

                },

                eventDrop:function(event)
                {

                },

                eventClick:function(event)
                {

                    $("#myModal").modal("show");
                    var getappointmentDetails = "{{route('appointment_detail')}}";

                        var id = event.id;
                        $.ajax({
                            url: getappointmentDetails,
                            type:"GET",
                            data:{id:id},
                            success:function(data)
                            {

                                var content = `<p><b>Doctor Appointed</b> : ${data[0].doctor_name}</p>`;
                                content += `<p><b>Doctor Specilized</b>  : ${data[0].specelization}</p>`;
                                content += `<p><b>Patient Name</b>  : ${data[0].patient_name}</p>`;
                                content += `<p><b>Information</b>: ${data[0].information}</p>`;
                                content += `<p><b>Appointment Date </b>: ${data[0].appointment_date}</p>`;
                                content += `<p><b>Appointment Start Time </b>: ${data[0].start_time}</p>`;
                                content += `<p><b>Appointment End Time </b>: ${data[0].end_time}</p>`;

                                $("#content_modal").html(content);
                                calendar.fullCalendar('refetchEvents');
                                $("#myModal").modal("show");
                            }
                        })

                },

            });
        });

    </script>
@endsection
