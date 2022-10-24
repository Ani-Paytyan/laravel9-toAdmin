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
                <td>
                    <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="{{ route('item.edit',$item->id) }}">{{ $item->name}}}</a>
                </td>
                <td>{{ $item->unique_item_count }}<td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex">
        {!! $items->links('pagination::bootstrap-4') !!}
    </div>
@endsection
