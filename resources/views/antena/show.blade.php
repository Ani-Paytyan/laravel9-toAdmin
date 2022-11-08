@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ trans('page.antena.show_title') }}</h2>
            </div>
            <div class="pull-right float-end">
                <a class="btn btn-primary" href="{{ route('antena.index') }}">{{ trans('page.dashboard.back_button') }}</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ trans('attributes.antena.mac_address') }}</strong>
                {{ $antena->mac_address }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ trans('attributes.antena.manufacture_type') }}</strong>
                {{ $antena->manufactureType->name }}
            </div>
        </div>
    </div>
@endsection
