@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ trans('page.antena.edit_title') }}</h2>
            </div>
            <div class="pull-right float-end">
                <a class="btn btn-primary" href="{{ route('antena.index') }}">{{ trans('page.dashboard.back_button') }}</a>
            </div>
        </div>
    </div>

    <form action="{{ route('antena.update', $antena->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <x-form.input
                    name="mac_address"
                    type="text"
                    id="password"
                    label="{{ trans('attributes.antena.mac_address') }}"
                    class="form-control-muted"
                    value="{{$antena->mac_address}}"
            />
        </div>

        <div class="mb-5">
            <x-form.select name="type_id" :options="['1' => 'RadioLand' , '2' => 'Minew' ]"
                           value="{{ $antena->type_id }}" label="{{ trans('attributes.antena.manufacture_type') }}">
            </x-form.select>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center p-5">
            <button type="submit" class="btn btn-primary">{{ trans('page.dashboard.submit_button') }}</button>
        </div>
    </form>
@endsection
