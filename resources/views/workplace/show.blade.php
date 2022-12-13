@extends('layout.dashboard')

@section('title', trans('page.dashboard.title'))

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left button">
                <h2>{{ trans('page.antena.title') }}</h2>
            </div>
            <div class="pull-right float-end">
                <a class="btn btn-primary" href="{{ route('workplace.index') }}">{{ trans('page.dashboard.back_button') }}</a>
            </div>
            <div class="pull-left">
                <button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#antenaModal">
                    {{ trans('page.antena.add_antena') }}
                </button>
            </div>
        </div>
    </div>
    <x-alert-component />

    <table class="table table-bordered top-20" id="workplaceAntennaDataTable">
        <tr>
            <th>{{ trans('attributes.antena.mac') }}</th>
            <th>{{ trans('attributes.antena.position') }}</th>
            <th>{{ trans('attributes.antena.status') }}</th>
            <th></th>
        </tr>

        @foreach ($antenas as $antena)
            <tr class="workplaceAntennaData">
                <td>{{ $antena->mac_address }}</td>
                    <td>
                        {{ $antena->pivot->type }}
                    </td>
                <td>
                    <span class="logged-in text-{{$antena->is_online ? 'success' : 'danger'}}">●</span>
                </td>
                <td>
                    <a class="btn btn-info" href="{{ route('workplace.antena.edit', [$workplace, $antena]) }}">
                        {{ trans('page.dashboard.edit_button') }}
                    </a>

                    <form action="{{ route('workplace.antena.destroy', [$workplace, $antena]) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ trans('page.dashboard.delete_button') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>

    <!-- Modal -->
    <div class="modal fade" id="antenaModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('page.workplace.modal_title') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addAntena" action="{{ route('workplace.antena.create', $workplace) }}"  method="POST">
                        @csrf
                        @method('HEAD')
                        <x-form.select name="antena_id" :withSearch="true" :options="$filterAntena" label="{{ trans('attributes.antena.mac') }}" @overwrite></x-form.select>
                        <x-form.select name="type" :options="['in' => 'In', 'out' => 'Out']" label="{{ trans('attributes.antena.position') }}" ></x-form.select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="addAntena">{{ trans('page.antena.add_antena') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('bodyEnd')
    <script src="{{ mix('build/js/input.js')  }}"></script>
    <script>
      const translation = {
        'btn_delete': '{{ trans('page.dashboard.delete_button') }}',
        'btn_edit': ' {{trans('page.dashboard.edit_button') }}',
      };
      const tokenStatus = '{{ @csrf_token() }}';
    </script>
    <script src="{{ mix('build/js/antenna-status.js')  }}"></script>
@endpush
