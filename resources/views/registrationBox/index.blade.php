@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ trans('page.registration_box.title') }}</h2>
            </div>
            <div class="pull-right float-end m-2">
                <a class="btn btn-success" href="{{ route('registrationBox.create') }}">{{ trans('page.registration_box.add_registration_box') }}</a>
            </div>
        </div>
    </div>

    <x-alert-component />

    <table class="table table-bordered">
        <tr>
            <th>{{ trans('attributes.registration_box.id') }}</th>
            <th>{{ trans('attributes.registration_box.name') }}</th>
            <th>{{ trans('attributes.registration_box.rssi_throttle') }}</th>
            <th></th>
        </tr>
        @foreach ($boxes as $box)
            <tr>
                <td>{{ $box->id }}</td>
                <td>{{ $box->name }}</td>
                <td>{{ $box->rssi_throttle }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('registrationBox.edit',$box->id) }}">{{ trans('page.dashboard.edit_button') }}</a>
                    <form action="{{ route('registrationBox.destroy',$box->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ trans('page.dashboard.delete_button') }}</button>
                    </form>
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('watcher.antennaData',$box->id) }}">{{ trans('page.registration_box.antenna_data_button') }}</a>
                </td>
            </tr>
        @endforeach
        <a class="btn btn-primary" href="{{ route('registrationBox.listDeleted') }}">{{ trans('page.dashboard.list_delete') }}</a>

    </table>
    <div class="d-flex">
        {!! $boxes->links('pagination::bootstrap-4') !!}
    </div>
@endsection
