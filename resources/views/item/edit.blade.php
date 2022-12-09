@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ trans('page.unique_items.title') }}</h2>
            </div>
            <div class="pull-right float-end">
                <a class="btn btn-primary" href="{{ route('item.index') }}">{{ trans('page.dashboard.back_button') }}</a>
            </div>
        </div>
    </div>

    <div class="d-none display_value">
            <x-success-component />
    </div>
    <div class="d-none display_value_error">
        <x-error-component />
    </div>
    <form action="{{ route('item.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="_token" value="{{ @csrf_token() }}">
        <table class="table table-bordered top-20">
            <tr>
                <th>{{ trans('attributes.item.name') }}</th>
                <th>{{ trans('attributes.unique_item.article') }}</th>
                <th>{{ trans('attributes.unique_item.mac') }}</th>
                <th>{{ trans('attributes.unique_item.action') }}</th>
                <th>{{ trans('attributes.unique_item.is_online') }}</th>
                <th>{{ trans('attributes.unique_item.is_inside') }}</th>
            </tr>
            @foreach ($uniqueItems as $uniqueItem)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $uniqueItem->article }}</td>

                    <td class="mac">
                        <div class="mb-5">
                            <x-form.input
                                name="mac[{{$uniqueItem->id}}]" class="mac {{ ($uniqueItem->mac) ? 'form-control-muted': ''}}"
                                type="text"
                                id="password"
                                value="{{ $uniqueItem->mac }}"
                            />
                        </div>
                    </td>
                    <td>
                        @if($uniqueItem->mac)
                            <button class="btn btn-primary itemEdit" type="button" data-mac="{{ $uniqueItem->mac }}" data-id="{{ $uniqueItem->id }}">{{ trans('page.dashboard.edit_button') }}</button>
                        @endif
                            <button class="btn btn-info itemConnect {{($uniqueItem->mac) ? '': 'disabled'}}" type="button"  data-id="{{ $uniqueItem->id }}">{{ trans('page.dashboard.connect_button') }}</button>
                            <button class="btn btn-danger itemDetach {{($uniqueItem->mac) ? '': 'disabled'}}" type="button" data-id="{{ $uniqueItem->id }}">{{ trans('page.dashboard.detach _button') }}</button>
                    </td>
                    <td>
                        @if($uniqueItem->is_online)
                            <div style="background-color:green; color:white; text-align: center">Online</div>
                        @else
                            <div style="background-color:red; color:white; text-align: center">Offline</div>
                        @endif
                    </td>
                    <td>
                        @if($uniqueItem->is_inside)
                            <div style="background-color:green; color:white; text-align: center">Inside</div>
                        @else
                            <div style="background-color:red; color:white; text-align: center">Outside</div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center p-5">
            <button type="submit" class="btn btn-primary">{{ trans('page.dashboard.submit_button') }}</button>
        </div>
    </form>
@endsection
@push('bodyEnd')
    <script src="{{ mix('build/js/item-data.js') }}"></script>
@endpush
