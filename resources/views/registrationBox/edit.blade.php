@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ trans('page.registration_box.edit_title') }}</h2>
            </div>
            <div class="pull-right float-end">
                <a class="btn btn-primary" href="{{ route('registrationBox.index') }}">{{ trans('page.dashboard.back_button') }}</a>
            </div>
        </div>
    </div>

    <form action="{{ route('registrationBox.update',$registrationBox->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-5">
            <x-form.input
                name="name"
                type="text"
                id="mac_address"
                label="{{ trans('attributes.registration_box.name') }}"
                class="form-control-muted"
                value="{{ $registrationBox->name }}"
            />
        </div>
        <div class="mb-5">
            <x-form.select
                name="rssi_throttle"
                :options="$rssiRange"
                label="{{ trans('attributes.registration_box.rssi_throttle') }}"
                value="{{$registrationBox->rssi_throttle}}">
            </x-form.select>
        </div>
        <div class="mb-5">
            <x-form.select
                name="antena_id"
                value="{{ $registrationBox->antena_id }}"
                :options="$antenas"
                label="{{ trans('attributes.registration_box.antenas') }}" >
            </x-form.select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center m-5">
            <button type="submit" class="btn btn-primary">{{ trans('page.dashboard.submit_button') }}</button>
        </div>
    </form>
@endsection
