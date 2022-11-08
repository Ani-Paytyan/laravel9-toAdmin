@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ trans('page.antena.title') }}</h2>
            </div>
            <div class="pull-right float-end m-2">
                <a class="btn btn-success" href="{{ route('antena.create') }}">{{ trans('page.antena.add_antena') }}</a>
            </div>
        </div>
    </div>

    <x-alert-component />

    <table class="table table-bordered">
        <tr>
            <th>{{ trans('attributes.antena.mac_address') }}</th>
            <th>{{ trans('attributes.antena.choose_type') }}</th>
        </tr>
        @foreach ($antenas as $antena)
            <tr>
                <td>{{ $antena->mac_address }}</td>
                <td>{{ $antena->manufactureType->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('antena.show',$antena->id) }}">{{ trans('page.dashboard.show_button') }}</a>
                    <a class="btn btn-primary" href="{{ route('antena.edit',$antena->id) }}">{{ trans('page.dashboard.edit_button') }}</a>
                    <form action="{{ route('antena.destroy', $antena->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ trans('page.dashboard.delete_button') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex">
        {!! $antenas->links('pagination::bootstrap-4') !!}
    </div>
@endsection
