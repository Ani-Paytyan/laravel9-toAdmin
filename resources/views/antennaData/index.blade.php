@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left button">
                <h2>{{ trans('page.antenna_data.title') }}</h2>
            </div>
        </div>
    </div>

    <x-alert-component />

    <table class="table table-bordered top-20">
        <tr>
            <th>{{ trans('attributes.antenna_data.mac_address') }}</th>
            <th>{{ trans('attributes.antenna_data.article_name') }}</th>
            <th>{{ trans('attributes.antenna_data.item_name') }}</th>
            <th></th>
        </tr>
        @foreach ($antennaData as $data)
            <tr>
                <td>{{ $data['mac'] }}</td>
                <td>{{ $data['unique_item'] ? $data['unique_item']['article']: 'Not connected' }}</td>
                <td>{{ $data['unique_item'] ? $data['unique_item']['item']['name']: 'Not connected'}}</td>

                @if($data['unique_item'])
                    <form action="{{ route('watcher.unique_item_disable', [$data['unique_item']['id'], $mac]) }}" method="POST">
                        @csrf
                        <td>
                            <button type="submit" class="btn btn-danger">{{ trans('page.antenna_data.disable') }}</button>
                        </td>
                    </form>
                @else
                    <td>
                        <div class="pull-left">
                            <button type="button" class="btn btn-primary macUniqueItem" data-mac={{ $data['mac'] }} data-bs-toggle="modal" data-bs-target="#antennaDataModal">
                                {{ trans('page.antenna_data.to_plug') }}
                            </button>
                        </div>
                    </td>
                @endif
            </tr>
        @endforeach
    </table>

    <!-- Modal -->
    <div class="modal fade" id="antennaDataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('page.antenna_data.add_unique_item') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ @csrf_token() }}">
                    <x-form.select name="item_id" :options="$items" class="items"  label="{{ trans('attributes.antenna_data.item_name') }}" ></x-form.select>
                    <x-form.select name="unique_id" :options="$uniqueItems ?? []" id="uniqueItems" label="{{ trans('attributes.antenna_data.unique_item') }}" ></x-form.select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="addAntennaData" form="addAntennaData">{{ trans('page.dashboard.submit_button') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('bodyEnd')
    <script src="{{ mix('build/js/antenna-data.js')  }}"></script>
@endpush
