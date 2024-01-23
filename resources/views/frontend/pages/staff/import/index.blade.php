@extends('frontend.layouts.app')

@section('title', __('Import student'))

@push('after-styles')
    <style>
        .steps {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 1rem;
            position: relative;
        }

        .step-button {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background-color: var(--prm-gray);
            transition: .4s;
        }

        .step-button[aria-expanded="true"] {
            width: 36px;
            height: 36px;
            background-color: var(--prm-color);
            color: #fff;
        }

        .done {
            background-color: var(--prm-color);
            color: #fff;
        }

        .step-item {
            z-index: 10;
            text-align: center;
        }

        #progress {
            -webkit-appearance: none;
            position: absolute;
            width: 95%;
            z-index: 5;
            height: 10px;
            margin-left: 18px;
            margin-bottom: 18px;
        }

        /* to customize progress bar */
        #progress::-webkit-progress-value {
            background-color: var(--prm-color);
            transition: .5s ease;
        }

        #progress::-webkit-progress-bar {
            background-color: var(--prm-gray);
        }

        .wrapper-input {
            text-align: center;
        }

        .wrapper-input #file-student {
            display: none;
        }

        .wrapper-input label[for='file-student'] * {
            vertical-align: middle;
            cursor: pointer;
        }

        .wrapper-input label[for='file-student'] span {
            margin-left: 10px
        }

    </style>
@endpush

@section('content')
    <div class="mt-4 rounded bg-white shadow-sm">
        <div class="p-3 pl-2 ">
            <h4 class="font-weight-bold">
                @lang('Import student')
            </h4>
        </div>
        <div class="p-3">
            <div class="accordion" id="accordionExample">
                <div class="steps">
                    <div class="border mx-3 flex-grow-1"></div>
                    <div class="step-item d-flex align-items-center">
                        <button class="step-button text-center mr-2" type="button" id="step-btn-1"
                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            1
                        </button>
                        <div class="step-title text-break">
                            @lang('Upload data')
                        </div>
                    </div>
                    <div class="border mx-3 flex-grow-1 px-5"></div>
                    <div class="step-item d-flex align-items-center">
                        <button class="step-button text-center collapsed mr-2" type="button" id="step-btn-2"
                                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            2
                        </button>
                        <div class="step-title">
                            @lang('Check data')
                        </div>
                    </div>
                    <div class="border mx-3 flex-grow-1"></div>
                </div>
                <div>
                    <div id="headingOne">
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                         data-parent="#accordionExample">
                        <div class="card-body">
                            <div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item pl-1">
                                        <h5>
                                            @lang("Provide a list of students by uploading a excel file with the following fields:")
                                        </h5>
                                    </li>
                                    <li class="list-group-item">
                                        - <span class="font-bold">Email</span>: @lang("Student's email")
                                    </li>
                                    <li class="list-group-item">
                                        -
                                        <span class="font-bold">Password</span>: @lang("Student's password (leave blank will automatically get default password: Nix@123456)")
                                    </li>
                                    <li class="list-group-item">
                                        - <span class="font-bold">Name</span>: @lang("Student's name")
                                    </li>
                                    <li class="list-group-item">
                                        -
                                        <span class="font-bold">Gender</span>: @lang("Student's gender (Male, Female, Other)")
                                    </li>
                                    <li class="list-group-item">
                                        -
                                        <span class="font-bold">Birthday</span>: @lang("Student's date of birth (YYYY-MM-DD)")
                                    </li>
                                    <li class="list-group-item">
                                        -
                                        <span class="font-bold">Phone</span>: @lang("Student's phone number")
                                    </li>
                                </ul>

                                <div>
                                    <p class="font-italic">
                                        @lang("Note"): <span class="font-bold">Email</span> @lang('and') <span
                                                class="font-bold">Password</span>
                                        @lang("is used to create an account for students in case students do not have an account.")
                                        <br/>
                                        @lang("If the student already has an account, the system will not create a new account, the student's name and password will remain the same.")
                                        <br/>
                                        @lang("If a student already has an account but hasn't joined this class, the student will be automatically added to the class.")
                                    </p>
                                </div>

                                <a href="#"
                                   class="btn btn-outline-secondary mb-3">
                                    <i class="fa-solid fa-file-arrow-down"></i> @lang('Download template excel')
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div id="headingTwo">
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                         data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="table-responsive-md">
                                <table class="table table-hover border" id="excelTable"></table>
                            </div>
                            <div>
                                <i class="fa-solid fa-triangle-exclamation ml-2"></i>
                                <span>@lang(": Email existed, the record will not affect current user's data")</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-3">
                    <form action="#" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="wrapper-input d-flex align-items-center mb-2">
                                    <div class="mr-2">@lang('Choose file')</div>
                                    <div>
                                        <input type="file" class="file-upload-field" name="file-student"
                                               id="file-student" data-check-student-url="#">
                                        <label class="m-0" for="file-student">
                                            <i class="fa fa-paperclip fa-xl"></i>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary import-data d-none">
                                <i class="fa-solid fa-file-arrow-up"></i> @lang('Import data')
                            </button>
                        </div>
                        <small class="text-danger d-none error-file"></small>
                        @error('file-student')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                    </form>
                </div>
                <div class="py-2">
                    @include('includes.partials.messages', ['autoDismiss' => false])
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        const errorTypeExcel = @json(__('Please upload a valid excel file!'));
        const errorHTML5 = @json(__('Sorry! Your browser does not support HTML5!'));
    </script>
    <script src="{{ asset('js/assets/vendor/xlsx/dist/xlsx.full.min.js') }} "></script>
    <script src="{{ asset('js/pages/staff/import.js') }}"></script>
@endpush
