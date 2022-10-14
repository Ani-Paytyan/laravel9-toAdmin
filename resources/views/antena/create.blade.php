@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Antena</h2>
            </div>
            <div class="pull-right float-end">
                <a class="btn btn-primary" href="{{ route('antena.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <x-alert-component />

    <form action="{{ route('antena.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="mac_address" class="form-control" placeholder="Name">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Type:</strong>
                    <select  class="form-control" name="type_id">
                        <option value="" disabled>Choose type</option>
                        <option value="1">RadioLand</option>
                        <option value="2">Minew</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center m-5">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
