@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left button">
                <h2>{{ trans('page.workplace.title') }}</h2>
            </div>
        </div>
    </div>
    <table class="table table-bordered top-20">
        <tr>
            <th>{{ trans('attributes.antena.mac') }}</th>
            <th>{{ trans('attributes.antena.position') }}</th>
            <th>{{ trans('attributes.workplace.address') }}</th>
            <th>{{ trans('attributes.workplace.number_attached_antena') }}</th>
            <th></th>
        </tr>
        @foreach ($workplaces as $workplace)
            <tr>
                <td>{{ $workplace->name }}</td>
                <td>{{ $workplace->company?->name}}</td>
                <td>{{ $workplace->address}}</td>
                <td>{{ $workplace->antenas_count}}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('workplace.show',$workplace->id.'/') }}">{{ trans('page.dashboard.show_button') }}</a>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex">
        {!! $workplaces->links('pagination::bootstrap-4') !!}
    </div>
@endsection
