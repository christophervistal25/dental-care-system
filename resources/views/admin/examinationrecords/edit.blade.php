@extends('admin.layouts.app')
@section('page-title', 'Edit examination record chart for ' . $record->patient->firstname . ' ' .
    $record->patient->middlename . ' ' . $record->patient->lastname)
@section('content')
    @prepend('meta')
        <meta name="id" content="{{ $record->id }}">
        <meta name="teeth_numbers" content="{{ $record->teeths }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.css" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.buttons.css"
            crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.nonblock.css"
            crossorigin="anonymous" />
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

        <style>
            .modal-body {
                max-height: calc(100vh - 212px);
                overflow-y: auto;
            }
        </style>
    @endprepend
    <div class="row" id="toothChartInformation">

        <div class="col-lg-4 mb-3">
            <div class="alert alert-danger" id="message">
                If a tooth is already selected and you select it again, it will automatically be
                deselected.
            </div>
            <div class="card">
                <div class="card-header">
                    <span class="fw-bold">TOOTH CHART</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            @include('templates.adult-tooth-chart')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <span class="fw-bold">TOOTH PARTS</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <ul class="list-group">
                                <li data-key="1" class="text-dark fw-medium list-group-item"> 1 - 3rd Molar (wisdom tooth)
                                </li>
                                <li data-key="2" class="text-dark fw-medium list-group-item"> 2 - 2nd Molar (12-yr molar)
                                </li>
                                <li data-key="3" class="text-dark fw-medium list-group-item"> 3 - 1st Molar (6-yr molar)
                                </li>
                                <li data-key="4" class="text-dark fw-medium list-group-item"> 4 - 2nd Bicuspid (2nd
                                    premolar)</li>
                                <li data-key="5" class="text-dark fw-medium list-group-item"> 5 - 1st Bicuspid (1st
                                    premolar)</li>
                                <li data-key="6" class="text-dark fw-medium list-group-item"> 6 - Cuspid (canine/eye
                                    tooth)</li>
                                <li data-key="7" class="text-dark fw-medium list-group-item"> 7 - Lateral incisor</li>
                                <li data-key="8" class="text-dark fw-medium list-group-item"> 8 - Central incisor</li>
                                <li data-key="9" class="text-dark fw-medium list-group-item"> 9 - Central incisor</li>
                                <li data-key="10" class="text-dark fw-medium list-group-item">10 - Lateral incisor</li>
                                <li data-key="11" class="text-dark fw-medium list-group-item">11 - Cuspid (canine/eye
                                    tooth)</li>
                                <li data-key="12" class="text-dark fw-medium list-group-item">12 - 1st Bicuspid (1st
                                    premolar)</li>
                                <li data-key="13" class="text-dark fw-medium list-group-item">13 - 2nd Bicuspid (2nd
                                    premolar)</li>
                                <li data-key="14" class="text-dark fw-medium list-group-item">14 - 1st Molar (6-yr molar)
                                </li>
                                <li data-key="15" class="text-dark fw-medium list-group-item">15 - 2nd Molar (12-yr molar)
                                </li>
                                <li data-key="16" class="text-dark fw-medium list-group-item">16 - 3rd Molar (wisdom tooth)
                                </li>
                                <li data-key="17" class="text-dark fw-medium list-group-item">17 - 3rd Molar (wisdom tooth)
                                </li>
                                <li data-key="18" class="text-dark fw-medium list-group-item">18 - 2nd Molar (12-yr molar)
                                </li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="list-group">
                                <li data-key="19" class="text-dark fw-medium list-group-item">19 - 1st Molar (6-yr molar)
                                </li>
                                <li data-key="20" class="text-dark fw-medium list-group-item">20 - 2nd Bicuspid (2nd
                                    premolar)</li>
                                <li data-key="21" class="text-dark fw-medium list-group-item">21 - 1st Bicuspid (1st
                                    premolar)</li>
                                <li data-key="23" class="text-dark fw-medium list-group-item">23 - Lateral incisor</li>
                                <li data-key="22" class="text-dark fw-medium list-group-item">22 - Cuspid (canine/eye
                                    tooth)</li>
                                <li data-key="24" class="text-dark fw-medium list-group-item">24 - Central incisor</li>
                                <li data-key="25" class="text-dark fw-medium list-group-item">25 - Central incisor</li>
                                <li data-key="26" class="text-dark fw-medium list-group-item">26 - Lateral incisor</li>
                                <li data-key="27" class="text-dark fw-medium list-group-item">27 - Cuspid (canineleye
                                    tooth)</li>
                                <li data-key="28" class="text-dark fw-medium list-group-item">28 - 1st Bicuspid (1st
                                    premolar)</li>
                                <li data-key="29" class="text-dark fw-medium list-group-item">29 - 2nd Bicuspid (2nd
                                    premolar)</li>
                                <li data-key="30" class="text-dark fw-medium list-group-item">30 - 1st Molar (6-yr molar)
                                </li>
                                <li data-key="31" class="text-dark fw-medium list-group-item">31 - 2nd Molar (12-yr molar)
                                </li>
                                <li data-key="32" class="text-dark fw-medium list-group-item">32 - 3rd Molar (wisdom tooth)
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2">
                <input type="submit" class="btn btn-success text-white mt-3" value="Modify Details"
                    id="btnProceedInAddingDetails">
            </div>
        </div>
    </div>

    <div id="addDetailsForm">
        <a id="btnBack" class="mb-2 fw-bold text-primary text-decoration-underline cursor-pointer">Back</a>
        <div class="card">
            <div class="card-header">
                <span class="fw-bold">Modify Details</span>
            </div>
            <div class="card-body">
                <form method="POST" id="examinationInfoForm">
                    <input type="hidden" name="patient_id" value="{{ $record->patient->id }}">

                    <div class="form-group">
                        <label for="occlusion">Occulusion</label>
                        <textarea name="occlusion" id="occlusion" cols="30" rows="2" class="form-control">{{ $record->occlusion }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="periodontal_condition">Periodontal Condtion</label>
                        <input type="text" name="periodontal_condition" id="periodontal_condition"
                            class="form-control" value="{{ $record->periodontal_condition }}">
                    </div>

                    <div class="form-group">
                        <label for="oral_hygiene">Oral Hygiene</label>
                        <input type="text" name="oral_hygiene" id="oral_hygiene" class="form-control"
                            value="{{ $record->oral_hygiene }}">
                    </div>

                    <div class="form-group">
                        <label for="service_rendered">Service Rendered</label>
                        <select name="service_rendered" id="service_rendered" class="form-control" required>
                            <option value="" disabled selected hidden>Choose service</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ $service->id == $record?->service_id ? 'selected' : '' }}>{{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="doctor">Doctor</label>
                        <select name="doctor" id="doctor" class="form-control" required>
                            <option value="" disabled selected hidden>Choose service</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}"
                                    {{ $doctor->id == $record->doctor_id ? 'selected' : '' }}>{{ $doctor->title }}
                                    {{ $doctor->fullname }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" {{ $record->denture_upper_since ? 'checked' : '' }} name="denture_upper"
                            id="denture_upper">
                        <label for="denture_upper">Denture Upper</label>
                        <input {{ $record->denture_upper_since ?: 'disabled' }} type="number" name="denture_upper_since"
                            id="denture_upper_since" class="form-control" placeholder="Enter denture upper since"
                            value="{{ $record->denture_upper_since }}">
                    </div>

                    <div class="form-group">
                        <input type="checkbox" {{ $record->denture_lower_since ? 'checked' : '' }} name="denture_lower"
                            id="denture_lower">
                        <label for="denture_lower">Denture Lower</label>
                        <input {{ $record->denture_lower_since ?: 'disabled' }} type="number" name="denture_lower_since"
                            id="denture_lower_since" class="form-control" placeholder="Enter denture lower since"
                            value="{{ $record->denture_lower_since }}">
                    </div>


                    <div class="form-group">
                        <label for="abnormalities">Abnormalities</label>
                        <input type="text" name="abnormalities" id="abnormalities" class="form-control"
                            value="{{ $record->abnormalities }}">
                    </div>

                    <div class="form-group">
                        <label for="general_condition">General Condition</label>
                        <input type="text" name="general_condition" id="general_condition" class="form-control"
                            value="{{ $record->general_condition }}">
                    </div>

                    <div class="form-group">
                        <label for="physician">Physician</label>
                        <input type="text" name="physician" id="physician" class="form-control"
                            value="{{ $record->physician }}">
                    </div>

                    <div class="form-group">
                        <label for="nature_of_treatment">Nature of Treatment</label>
                        <input type="text" name="nature_of_treatment" id="nature_of_treatment" class="form-control"
                            value="{{ $record->nature_of_treatment }}">
                    </div>

                    <div class="form-group">
                        <label for="allergies">Allergies</label>
                        <input type="text" name="allergies" id="allergies" class="form-control"
                            value="{{ $record->allergies }}">
                    </div>

                    <div class="form-group">
                        <label for="previous_bleeding_history">Previous History of Bleeding</label>
                        <input type="text" name="previous_bleeding_history" id="previous_bleeding_history"
                            class="form-control" value="{{ $record->history_bleeding }}">
                    </div>

                    <div class="form-group">
                        <label for="chronic_ailment">Chronic Ailment</label>
                        <input type="text" name="chronic_ailment" id="chronic_ailment" class="form-control"
                            value="{{ $record->chronic_ailment }}">
                    </div>

                    <div class="form-group">
                        <label for="blood_pressure">Blood Pressure</label>
                        <input type="text" name="blood_pressure" id="blood_pressure" class="form-control"
                            value="{{ $record->blood_pressure }}">
                    </div>

                    <div class="form-group">
                        <label for="drugs_taken">Drugs Being Taken</label>
                        <input type="text" name="drugs_taken" id="drugs_taken" class="form-control"
                            value="{{ $record->drugs_taken }}">
                    </div>

                    <div class="float-end">
                        <button type="button" class="btn btn-warning" id="addTeethDetails"><i class="fas fa-edit"></i>
                            Edit details for selected tooth</button>
                        <button type="submit" class="btn btn-success text-white"><i class="fas fa-edit"></i> Update
                            Examination Record</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Add Tooth Details -->
    <div class="modal fade bs-add-teeth-details-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="#teethDetails">Teeth Details</h4>
                </div>
                <form id="selectedToothForm">
                    <div class="modal-body" id="teeth-details-container">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-white" id="btnCloseModal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Tooth Details -->

    @push('page-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.buttons.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.nonblock.js" crossorigin="anonymous"></script>
        <script>
            $('#addDetailsForm').hide();

            let toothChart = [
                "3rd Molar (wisdom tooth)",
                "2nd Molar (12-yr molar)",
                "1st Molar (6-yr molar)",
                "2nd Bicuspid (2nd premolar)",
                "1st Bicuspid (1st premolar)",
                "Cuspid (canine/eye tooth)",
                "Lateral incisor",
                "Central incisor",
                "Central incisor",
                "Lateral incisor",
                "Cuspid (canine/eye tooth)",
                "1st Bicuspid (1st premolar)",
                "2nd Bicuspid (2nd premolar)",
                "1st Molar (6-yr molar)",
                "2nd Molar (12-yr molar)",
                "3rd Molar (wisdom tooth)",
                "3rd Molar (wisdom tooth)",
                "2nd Molar (12-yr molar)",
                "1st Molar (6-yr molar)",
                "2nd Bicuspid (2nd premolar)",
                "1st Bicuspid (1st premolar) ",
                "Cuspid (canine/eye tooth) ",
                "Lateral incisor ",
                "Central incisor ",
                "Central incisor ",
                "Lateral incisor ",
                "Cuspid (canineleye tooth) ",
                "1st Bicuspid (1st premolar) ",
                "2nd Bicuspid (2nd premolar) ",
                "1st Molar (6-yr molar) ",
                "2nd Molar (12-yr molar) ",
                "3rd Molar (wisdom tooth)",
            ];

            let selectedTeeths = [];
            let selectedToothKey = [];
            let teethHover = "";
            let session = sessionStorage;


            (function() {
                // If the page is reload.
                if (performance.navigation.type == 1) {
                    session.clear();
                }
            })();

            $(document).ready(function() {
                let teeths = $('meta[name="teeth_numbers"]').attr('content');
                teeths = JSON.parse(teeths);
                teeths.forEach(tooth => {
                    $(`#Tooth${tooth.tooth_number}`).trigger('highlightEvent');
                    selectedToothKey.push(tooth.tooth_number);
                    selectedTeeths.push({
                        tooth_number: tooth.tooth_number,
                        tooth_description: tooth.tooth_description,
                        surface: tooth.surface,
                        treatment: tooth.treatment,
                        status: tooth.status
                    });
                });
                generateFieldBaseOnSelectedTeeths();
            });

            $('polygon, path').on('highlightEvent', function(e) {
                let tooth_number = parseInt($(e.target).attr('data-key'));
                let tooth_description = toothChart[tooth_number - 1];
                let toothElement = $(e.target);
                let elementDescription = $('body').find(`li[data-key=${tooth_number}]`);

                if (!selectedToothKey.includes(tooth_number)) {
                    toothElement.attr('data-clicked', true);
                    elementDescription.css('background', 'yellow');
                    elementDescription.css('color', 'black');
                    elementDescription.css('font-weight', 'bold');
                    toothElement.css('fill', 'yellow');
                } else {
                    toothElement.removeAttr('data-clicked');
                    elementDescription.css('background', 'white');
                    elementDescription.css('color', 'black');
                    elementDescription.css('font-weight', 'normal');
                    toothElement.css('fill', 'white');
                    selectedToothKey = selectedToothKey.filter((tooth) => tooth != tooth_number);
                    selectedTeeths = selectedTeeths.filter((tooth) => tooth.tooth_number != tooth_number);

                    // If tooth has already a value in the modal then user decide to remove the teeth.
                    session.removeItem(`treatment-${tooth_number}`);
                    session.removeItem(`status-${tooth_number}`);
                    session.removeItem(`surface-${tooth_number}`);
                }
            });

            // $('.bs-add-teeth-details-modal').modal({
            //     backdrop: 'static',
            //     keyboard: false,
            //     show: false,
            // });


            $('polygon, path').on('mouseover', function(e) {
                let toothElement = $(e.target);
                toothElement.css('cursor', 'pointer');
                let key = parseInt($(e.target).attr('data-key'));
                let elementDescription = $('body').find(`li[data-key=${key}]`);
                if (!toothElement.attr('data-clicked')) {
                    toothElement.css('fill', 'gray');
                    elementDescription.css('background', 'gray');
                    elementDescription.css('color', 'white');
                    elementDescription.css('font-weight', 'bold');
                    teethHover = elementDescription;
                }
            });

            $('polygon, path').on('mouseleave', function(e) {
                let toothElement = $(e.target);
                if (!toothElement.attr('data-clicked')) {
                    toothElement.css('fill', '#FFFFFF');
                    teethHover.css('background', 'white');
                    teethHover.css('color', 'black');
                    teethHover.css('font-weight', 'normal');
                }
            });

            $('polygon, path').on('click', function(e) {
                let tooth_number = parseInt($(e.target).attr('data-key'));
                let tooth_description = toothChart[tooth_number - 1];
                let toothElement = $(e.target);
                let elementDescription = $('body').find(`li[data-key=${tooth_number}]`);

                if (!selectedToothKey.includes(tooth_number)) {
                    toothElement.attr('data-clicked', true);
                    elementDescription.css('background', 'yellow');
                    elementDescription.css('color', 'black');
                    elementDescription.css('font-weight', 'bold');
                    toothElement.css('fill', 'yellow');
                    selectedToothKey.push(tooth_number);
                    selectedTeeths.push({
                        tooth_number,
                        tooth_description,
                        surface: '',
                        treatment: '',
                        status: ''
                    });
                } else {
                    toothElement.removeAttr('data-clicked');
                    elementDescription.css('background', 'white');
                    elementDescription.css('color', 'black');
                    elementDescription.css('font-weight', 'normal');
                    toothElement.css('fill', 'white');
                    selectedToothKey = selectedToothKey.filter((tooth) => tooth != tooth_number);
                    selectedTeeths = selectedTeeths.filter((tooth) => tooth.tooth_number != tooth_number);
                    $(`#tooth-${tooth_number}-row`).remove();
                    // If tooth has already a value in the modal then user decide to remove the teeth.
                    session.removeItem(`treatment-${tooth_number}`);
                    session.removeItem(`status-${tooth_number}`);
                    session.removeItem(`surface-${tooth_number}`);
                }
            });

            function teethFieldHasValue(toothNumber) {
                return session.getItem(`treatment-${toothNumber}`) &&
                    session.getItem(`status-${toothNumber}`) &&
                    session.getItem(`surface-${toothNumber}`);
            }

            function generateFieldBaseOnSelectedTeeths() {
                // Rebase the container first before generation.
                $('#teeth-details-container').html('');
                selectedTeeths.map((tooth, index) => {
                    // Checking if there's an old input values.
                    if (teethFieldHasValue(tooth.tooth_number)) {
                        tooth.treatment = session.getItem(`treatment-${tooth.tooth_number}`);
                        tooth.status = session.getItem(`status-${tooth.tooth_number}`);
                        tooth.surface = session.getItem(`surface-${tooth.tooth_number}`);
                    }

                    $('#teeth-details-container').append(`
              <div id="tooth-${tooth.tooth_number}-row">
                  <div class="row">
                        <div class="col-lg-12">
                            <label for="#treatment">Teeth : ${tooth.tooth_number} - ${tooth.tooth_description}</label>
                        </div>
                  </div>
                  
                  <div class="row">
                        <input type="hidden" name="teeths[numbers][${index}]"  value="${tooth.tooth_number}"/>
                        <input type="hidden" name="teeths[descriptions][${index}]"  value="${tooth.tooth_description}"/>
                      
                        <div class="col-lg-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                                <input type="text" name="teeths[treatments][${index}]" data-key="treatment-${tooth.tooth_number}"  class="form-control" placeholder="Enter treatment" value="${tooth.treatment}"/>
                          </div>
                        </div>

                        <div class="col-lg-4 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <input type="text" name="teeths[surfaces][${index}]" data-key="surface-${tooth.tooth_number}"  class="form-control" placeholder="Enter surface" value="${tooth.surface}"/>
                                </div>
                        </div>

                        <div class="col-lg-4 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <input type="text" name="teeths[statuses][${index}]" data-key="status-${tooth.tooth_number}" class="form-control" placeholder="Enter status" value="${tooth.status}" />
                          </div>
                        </div>
                  </div>
                </div>
          `);
                });
            }

            $('#addTeethDetails').click(function(e) {
                generateFieldBaseOnSelectedTeeths();
                $('.bs-add-teeth-details-modal').modal('toggle');
            });

            $('.bs-add-teeth-details-modal').on('hide.bs.modal', function(e) {

                $('form#selectedToothForm :input').each(function(index) {
                    let input = $(this);
                    let inputKey = input.attr('data-key');
                    session.setItem(inputKey, input.val());
                });

            });

            // Why that we seperated cause there are some cases that we need to change the name attribute of two fields
            // that might gives as a bug if we don't seperate the events for two checkbox.
            $('#denture_lower').click(function(e) {
                if ($(this).prop('checked')) {
                    $('#denture_lower_since').removeAttr('disabled');
                    $('#denture_lower_since').val(session.getItem('denture_lower_since'));
                } else {
                    $('#denture_lower_since').attr('disabled', true);
                    session.setItem('denture_lower_since', $('#denture_lower_since').val());
                    $('#denture_lower_since').val('');
                }
            });

            $('#denture_upper').click(function(e) {
                if ($(this).prop('checked')) {
                    $('#denture_upper_since').removeAttr('disabled');
                    $('#denture_upper_since').val(session.getItem('denture_upper_since'));
                } else {
                    $('#denture_upper_since').attr('disabled', true);
                    session.setItem('denture_upper_since', $('#denture_upper_since').val())
                    $('#denture_upper_since').val('');
                }
            });


            $('#examinationInfoForm').submit(function(e) {
                e.preventDefault();
                // Give the user a message the selecting a tooth is required.
                if (selectedTeeths.length === 0) {
                    new PNotify({
                        title: 'Tooth Chart!',
                        text: 'Plese select a tooth and don\'t forget to add some details.',
                        type: 'error',
                        hide: false,
                        styling: 'bootstrap3',
                        color: 'white',
                    });
                    return;
                }

                // The user forget to add details for each tooth.
                if (selectedTeeths.length !== $('#teeth-details-container').children().length) {
                    generateFieldBaseOnSelectedTeeths();
                }

                let id = $('meta[name="id"]').attr('content');
                let data = $('#selectedToothForm, #examinationInfoForm').serialize();
                $.ajax({
                    url: `/admin/patient/examination/edit/${id}`,
                    type: 'PUT',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            session.removeItem('denture_upper_since');
                            session.removeItem('denture_lower_since');

                            let messageElement = document.createElement('p');
                            messageElement.innerHTML =
                                `<br><br>Succesfully update examination record are you want to generate an receipt?`;
                            messageElement.classList.add('text-center');
                            messageElement.classList.add('text-dark');

                            swal({
                                title: 'Well Done!',
                                content: messageElement,
                                icon: 'success',
                                buttons: ["No", "Yes"]
                            }).then((isGenerate) => {
                                if (isGenerate) {
                                    window.location.href =
                                        `/admin/examination/${response.examination_id}/${response.no_of_tooths}/${response.service_rendered}/payment`;
                                } else {
                                    swal({
                                        title: 'Well Done!',
                                        icon: 'success',
                                        text: 'Examination record successfully updated',
                                        buttons: false,
                                        timer: 5000,
                                    });
                                }
                            });
                        }
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            let messages = [];
                            Object.values(errors).forEach((error) => {
                                [message] = error;
                                messages.push(`<li>${message}</li>`);
                            });

                            // Remove the duplicate messages.
                            messages = [...new Set(messages)];
                            $('#message').html('')
                            $('#message').html(`<ul>${messages.join(' ')}</ul>`);
                        } else if (response.status === 404) {
                            new PNotify({
                                title: 'Whoops! ',
                                text: 'Something went wrong please try to refresh this page!.',
                                type: 'danger',
                                hide: false,
                                styling: 'bootstrap3',
                                color: 'white',
                            });
                        }
                    }
                });
            });

            $('#btnProceedInAddingDetails').click(function() {
                $('#addDetailsForm').fadeIn(300);
                $('#toothChartInformation').fadeOut(300);
            });

            $('#btnBack').click(function() {
                $('#addDetailsForm').fadeOut(300);
                $('#toothChartInformation').fadeIn(300);
            });

            $('#btnCloseModal').click(function() {
                $('.bs-add-teeth-details-modal').modal('toggle');
            });
        </script>
    @endpush
@endsection
