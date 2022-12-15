@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ trans('page.antena.show_title') }}</h2>
            </div>
            <div class="pull-right float-end">
                <a class="btn btn-primary"
                   href="{{ route('registrationBox.index') }}">{{ trans('page.dashboard.back_button') }}</a>
            </div>
        </div>
    </div>
    <div class="row">
        <form id="rsiiSLider" method="POST">
            @csrf
            <input type="hidden" value="{{ $registrationBox->id }}" id="registrationBoxId">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="customRange2" class="form-label">{{ trans('page.registration_box.rssi') }}</label>
                <input type="range" class="form-range" value="{{$registrationBox->rssi_throttle }}" step="1" min="0"
                       max="100" id="customRange2" oninput="this.nextElementSibling.value = this.value">
                <output>{{$registrationBox->rssi_throttle }}</output>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left button">
                <h2>{{ trans('page.antenna_data.title') }}</h2>
            </div>
        </div>
    </div>
    <table class="table table-bordered top-20 antennaDataTable">
        <tr>
            <th>{{ trans('attributes.antenna_data.mac_address') }}</th>
            <th>{{ trans('attributes.antenna_data.rssi') }}</th>
            <th>{{ trans('attributes.antenna_data.item_name') }}</th>
            <th>{{ trans('attributes.antenna_data.article_name') }}</th>
            <th></th>
        </tr>
        @foreach ($antennaData as $data)
            <tr class="antennaData">
                <td>{{ $data->getMac() ? $data->getMac() : '' }}</td>
                <td>{{ $data->getRssi() ? abs($data->getRssi()) :'' }}</td>
                <td>{{ $data->getUniqueItem() ? $data->getUniqueItem()['item']['name']: 'Not connected'}}</td>
                <td>{{ $data->getUniqueItem() ?$data->getUniqueItem()['article']: 'Not connected' }}</td>

                @if($data->getUniqueItem())
                    <form action="{{ route('watcher.unique_item_disable', $data->getUniqueItem()['id']) }}" method="POST">
                        @csrf
                        <td>
                            <button type="submit"
                                    class="btn btn-danger">{{ trans('page.antenna_data.disable') }}</button>
                        </td>
                    </form>
                @else
                    <td>
                        <div class="pull-left">
                            <button type="button" class="btn btn-primary macUniqueItem"
                                    data-mac={{ $data->getMac() }} data-bs-toggle="modal"
                                    data-bs-target="#antennaDataModal">
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
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('page.antenna_data.add_unique_item') }}
                        <span class="macHeader"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ @csrf_token() }}">
                    <div class="mb-4">
                        <x-form.select
                            name="item_id"
                            :withSearch="true"
                            :options="$items ?? []" id="items"
                            label="{{ trans('attributes.antenna_data.item_name') }}"
                            placeholder="{{ trans('common.choose') }}"
                        />
                    </div>
                    <x-form.select
                        name="unique_id"
                        :withSearch="true"
                        :options="$uniqueItems ?? []"
                        id="uniqueItems"
                        label="{{ trans('attributes.antenna_data.article_name') }}"
                        placeholder="{{ trans('common.choose') }}"
                    />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary addAntennaData"
                            form="addAntennaData">{{ trans('page.dashboard.submit_button_popup') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('bodyEnd')
    <script src="{{ mix('build/js/registration-box.js')  }}"></script>
    <script>
        const translations = {
            'btn_disable': '{{ trans('page.antenna_data.disable') }}',
            'btn_to_plug': '{{ trans('page.antenna_data.to_plug') }}',
        };
        const token = '{{ @csrf_token() }}';
    </script>
    <script src="{{ mix('build/js/antenna-data.js')  }}"></script>
    <script src="{{ mix('build/js/input.js')  }}"></script>
@endpush

