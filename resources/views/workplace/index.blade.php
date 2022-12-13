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
            <th>{{ trans('attributes.workplace.name') }}</th>
            <th>{{ trans('attributes.workplace.company') }}</th>
            <th>{{ trans('attributes.workplace.address') }}</th>
            <th>{{ trans('attributes.workplace.number_attached_antena') }}</th>
            <th></th>
        </tr>
        @foreach ($workplaces as $workplace)
            <tr>
                <td>{{ $workplace->name }}</td>
                <td>{{ $workplace->company?->name}}</td>
                <td>{{ $workplace->address}}</td>
                <td>
                    @if( $workplace->antenas_count)
                        @foreach($workplace->antenas as $antena)
                            <span class="logged-in text-{{$antena->is_online ? 'success' : 'danger'}}" title="{{$antena->mac_address}} {{$workplace->name}}">●</span>
                        @endforeach
                    @else
                        <span>-</span>
                    @endif
                </td>
                <td>
                    <a class="btn btn-info" class="antennasStatusData" href="{{ route('workplace.show',$workplace->id.'/') }}">{{ trans('page.dashboard.show_button') }}</a>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex">
        {!! $workplaces->links('pagination::bootstrap-4') !!}
    </div>
@endsection
