@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Antena </h2>
            </div>
            <div class="pull-right float-end m-2">
                <a class="btn btn-success" href="{{ route('antena.create') }}"> Add New </a>
            </div>
        </div>
    </div>

    <x-alert-component />

    <table class="table table-bordered">
        <tr>
            <th>MAC address</th>
            <th>Manufacture Types<th>
        </tr>
        @foreach ($antenas as $antena)
            <tr>
                <td>{{ $antena->mac_address }}</td>
                <td>{{ $antena->type_id}}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('antena.show',$antena->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('antena.edit',$antena->id) }}">Edit</a>
                    <form action="{{ route('antena.destroy', $antena->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
