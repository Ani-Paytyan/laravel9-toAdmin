@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ trans('page.registration_box.title') }}</h2>
            </div>
            <div class="pull-right m-2">
                <a class="btn  btn-primary float-end" href="{{ route('registrationBox.listDeleted') }}">{{ trans('page.dashboard.list_delete') }}</a>
                <a class="btn btn-success btn-primary" href="{{ route('registrationBox.create') }}">{{ trans('page.registration_box.add_registration_box') }}</a>
            </div>
        </div>
    </div>
    @include('registrationBox.components.filter')
    <table class="table table-bordered">
        <tr>
            <th>{{ trans('attributes.registration_box.name') }}</th>
            <th>{{ trans('attributes.registration_box.rssi_throttle') }}</th>
            <th>{{ trans('attributes.antena.status') }}</th>
            <th></th>
        </tr>
        @foreach ($boxes as $box)
            <tr>
                <td>{{ $box->name }}</td>
                <td>{{ $box->rssi_throttle }}</td>
                <td>
                    <span class="logged-in text-{{$box->antenna->is_online ? 'success' : 'danger'}}">●</span>
                </td>
                <td>
                    <a class="btn btn-info" href="{{ route('registrationBox.show',$box->id) }}">{{ trans('page.dashboard.show_button') }}</a>
                    <a class="btn btn-primary" href="{{ route('registrationBox.edit',$box->id) }}">{{ trans('page.dashboard.edit_button') }}</a>
                    <form action="{{ route('registrationBox.destroy',$box->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ trans('page.dashboard.list_delete') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex">
        {!! $boxes->links('pagination::bootstrap-4') !!}
    </div>
@endsection
