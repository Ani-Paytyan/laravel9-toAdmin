@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ trans('page.antena.show_title') }}</h2>
            </div>
            <div class="pull-right float-end">
                <a class="btn btn-primary" href="{{ route('registrationBox.index') }}">{{ trans('page.dashboard.back_button') }}</a>
            </div>
        </div>
    </div>
    <div class="row">
        <form id="rsiiSLider" method="POST">
            @csrf
            <input type="hidden" value="{{ $registrationBox->id }}" id="registrationBoxId">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="customRange2" class="form-label">{{ trans('page.registration_box.rssi') }}</label>
                <input type="range" class="form-range" value="{{$registrationBox->rssi_throttle}}" step="1" min="0" max="100" id="customRange2" oninput="this.nextElementSibling.value = this.value">
                <output>{{$registrationBox->rssi_throttle}}</output>
            </div>
        </form>
    </div>
@endsection

@push('bodyEnd')
    <script src="{{ mix('build/js/registration-box.js')  }}"></script>
@endpush

