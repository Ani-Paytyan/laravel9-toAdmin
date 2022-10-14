@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Produc</h2>
            </div>
            <div class="pull-right float-end">
                <a class="btn btn-primary" href="{{ route('antena.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <x-alert-component />

    <form action="{{ route('antena.update', $antena->id) }}" method="POST">
        @csrf

        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="mac_address" value="{{$antena->mac_address}}" class="form-control" placeholder="Name">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Type:</strong>
                    <select class="form-control" name="type_id">
                        <option value="">Choose type</option>
                        <option value="1"{{($antena->type_id == 1) ? 'selected' : ''}}>RadioLand</option>
                        <option value="2" {{($antena->type_id == 2) ? 'selected' : ''}}>Minew</option>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center p-5">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
