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
            <th>{{ trans('attributes.item.id') }}</th>
            <th>{{ trans('attributes.item.name') }}</th>
            <th>{{ trans('attributes.item.number_of_unique_items') }}</th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name}}</td>
                <td>125</td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex">
        {!! $items->links('pagination::bootstrap-4') !!}
    </div>
@endsection
