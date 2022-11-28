@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ trans('page.registration_box.title_deleted') }}</h2>
            </div>
            <div class="pull-right float-end">
                <a class="btn btn-primary" href="{{ route('registrationBox.index') }}">{{ trans('page.dashboard.back_button') }}</a>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>{{ trans('attributes.registration_box.id') }}</th>
            <th>{{ trans('attributes.registration_box.name') }}</th>
            <th>{{ trans('attributes.registration_box.rssi_throttle') }}</th>
        </tr>
        @foreach ($boxes as $box)
            <tr>
                <td>{{ $box->id }}</td>
                <td>{{ $box->name }}</td>
                <td>{{ $box->rssi_throttle }}</td>
                <td>
                    <form action="{{ route('registrationBox.restore',$box->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-success">{{ trans('page.dashboard.restore_button') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex">
        {!! $boxes->links('pagination::bootstrap-4') !!}
    </div>
@endsection
