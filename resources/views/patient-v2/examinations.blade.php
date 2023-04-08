<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Examination Records</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>
    <div class="row" style="padding : 20px;">
        @foreach ($patient->examinations as $examination)
            <a href="{{ route('patient-v2.examination-record-view', $examination->id) }}">
                <div class="card" style="background:#3700B3;  font-family: sans-serif; border-radius : 8px;">
                    <div class="card-content white-text" style="padding : 5px;">
                        <div class="row valign-wrapper">
                            <div class="col s4">
                                <img src="{{ asset('medical-appointment.png') }}" class="responsive-img valign-wrapper">
                            </div>
                            <div class="col s10">
                                <p>&nbsp;</p>
                                <b>
                                    <p>{{ $examination->created_at->format('l jS \\of F h:i A Y') }}</p>
                                </b>
                                <p>{{ $examination->teeths->implode('tooth_description', ', ') }}</p>
                                <p>{{ $examination->payments->service_rendered }} -
                                    {{ number_format($examination->payments->fee, 2, '.', ',') }}
                                </p>
                                <span>{{ $examination->doctor->title }} {{ $examination->doctor->firstname }}
                                    {{ $examination->doctor->lastname }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach


    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
</body>

</html>
