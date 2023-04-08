@extends('admin.layouts.app')
@section('page-title', 'View Examination Record')
@prepend('meta')
    <meta name="teeth_numbers" content="{{ $record->teeths->pluck('tooth_number')->implode('|') }}">
@endprepend
@prepend('page-css')
    <style>
        .tooth-chart {
            width: 450px;
        }

        /* On screens that are 1900px or less, set the background color to olive */
        @media screen and (max-width: 1900px) {
            .tooth-chart {
                width: auto;
            }
        }
    </style>
@endprepend
@section('content')
    <div class="card">
        <div class="card-header">
            <span class="fw-bold text-uppercase">{{ $record->created_at->format('l jS \\of F h:i A Y') }}</span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <center>
                        @include('templates.adult-tooth-chart')
                    </center>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <table class="table border">
                        <thead>
                            <tr>
                                <th class="border text-dark text-center">Tooth</th>
                                <th class="border text-dark text-center">Description</th>
                                <th class="border text-dark text-center">Surface</th>
                                <th class="border text-dark text-center">Treatment</th>
                                <th class="border text-dark text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($record->teeths as $tooth)
                                <tr id="teeth-row-{{ $tooth->tooth_number }}">
                                    <td>{{ $tooth->tooth_number }}</td>
                                    <td>{{ $tooth->tooth_description }}</td>
                                    <td>{{ $tooth->surface }}</td>
                                    <td>{{ $tooth->treatment }}</td>
                                    <td>{{ $tooth->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label for="occlusion">Occulusion</label>
                        <textarea readonly name="occlusion" id="occlusion" cols="30" rows="2" class="form-control">{{ $record->occlusion }}</textarea>
                    </div>


                    <div class="">
                        <div class="form-group">
                            <label for="periodontal_condition">Periodontal Condtion</label>
                            <input readonly type="text" name="periodontal_condition" id="periodontal_condition"
                                class="form-control" value=" {{ $record->periodontal_condition }}">
                        </div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <label for="oral_hygiene">Oral Hygiene</label>
                            <input readonly type="text" name="oral_hygiene" id="oral_hygiene" class="form-control"
                                value="{{ $record->oral_hygiene }}">
                        </div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <input onclick="return {{ $record->denture_upper === 1 ? 'false;' : '' }}" type="checkbox"
                                {{ $record->denture_upper === 1 ? 'checked' : 'disabled' }} name="denture_upper"
                                id="denture_upper">
                            <label for="denture_upper">Denture Upper</label>
                            <input {{ $record->denture_upper === 1 ? 'readonly' : 'disabled' }} type="number"
                                name="denture_upper_since" id="denture_upper_since" class="form-control"
                                value="{{ $record->denture_upper_since }}">
                        </div>
                    </div>

                    <div class="">
                        <input onclick="return {{ $record->denture_lower === 1 ? 'false;' : '' }}" type="checkbox"
                            {{ $record->denture_lower === 1 ? 'checked' : 'disabled' }} name="denture_lower"
                            id="denture_lower">
                        <label for="denture_lower">Denture Lower</label>
                        <input {{ $record->denture_lower === 1 ? 'readonly' : 'disabled' }} type="number"
                            name="denture_lower_since" id="denture_lower_since" class="form-control"
                            value="{{ $record->denture_lower_since }}">
                    </div>


                    <div class="">
                        <div class="form-group">
                            <label for="abnormalities">Abnormalities</label>
                            <input readonly type="text" name="abnormalities" id="abnormalities" class="form-control"
                                value="{{ $record->abnormalities }}">
                        </div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <label for="general_condition">General Condition</label>
                            <input readonly type="text" name="general_condition" id="general_condition"
                                class="form-control" value="{{ $record->general_condition }}">
                        </div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <label for="physician">Physician</label>
                            <input readonly type="text" name="physician" id="physician" class="form-control"
                                value="{{ $record->physician }}">
                        </div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <label for="nature_of_treatment">Nature of Treatment</label>
                            <input readonly type="text" name="nature_of_treatment" id="nature_of_treatment"
                                class="form-control" value="{{ $record->nature_of_treatment }}">
                        </div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <label for="allergies">Allergies</label>
                            <input readonly type="text" name="allergies" id="allergies" class="form-control"
                                value="{{ $record->allergies }}">
                        </div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <label for="previous_bleeding_history">Previous History of Bleeding</label>
                            <input readonly type="text" name="previous_bleeding_history"
                                id="previous_bleeding_history" class="form-control"
                                value="{{ $record->history_bleeding }}">
                        </div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <label for="chronic_ailment">Chronic Ailment</label>
                            <input readonly type="text" name="chronic_ailment" id="chronic_ailment"
                                class="form-control" value="{{ $record->chronic_ailment }}">
                        </div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <label for="blood_pressure">Blood Pressure</label>
                            <input readonly type="text" name="blood_pressure" id="blood_pressure"
                                class="form-control" value="{{ $record->blood_pressure }}">
                        </div>
                    </div>

                    <div class="">
                        <div class="form-group">
                            <label for="drugs_taken">Drugs Being Taken</label>
                            <input readonly type="text" name="drugs_taken" id="drugs_taken" class="form-control"
                                value="{{ $record->drugs_taken }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script>
        let hoveredTeeth = "";
        $(document).ready(function() {
            let teeths = $('meta[name="teeth_numbers"]').attr('content').split("|");

            teeths.forEach(tooth => $(`#Tooth${tooth}`).css('fill', 'yellow'));

            // Make an ID to all teeths
            $('#Tooth' + teeths.join(', #Tooth')).on('mouseover', function(e) {
                // Get the selected teeth number 
                let teethNumber = $(this).attr('data-key');

                $(this).css('cursor', 'pointer');
                $(`#teeth-row-${teethNumber}`).css('background', 'gray');
                $(`#teeth-row-${teethNumber}`).css('color', 'white');
                hoveredTeeth = $(this);
            });

            $('#Tooth' + teeths.join(', #Tooth')).on('mouseleave', function(e) {
                let teethNumber = hoveredTeeth.attr('data-key');
                $(`#teeth-row-${teethNumber}`).css('background', '');
                $(`#teeth-row-${teethNumber}`).css('color', '');
            });
        });
    </script>
@endsection
