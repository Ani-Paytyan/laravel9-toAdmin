<div class="card mb-8">
    <form action="{{ route('registrationBox.index') }}" method="get">
        <div class="row p-4">
            <div class="col-sm-3">
                <x-form.input
                    name="name"
                    type="text"
                    id="filter_name"
                    placeholder="{{ __('attributes.registration_box.name') }}"
                    class="form-control-muted"
                    value="{{ $_GET['name'] ?? old('name') }}"
                />
            </div>
            <div class="col-sm-3">
                <x-form.input
                        name="rssi_throttle"
                        type="text"
                        id="filter_rssi_throttle"
                        placeholder="{{ __('attributes.registration_box.rssi_throttle') }}"
                        class="form-control-muted"
                        value="{{ $_GET['rssi_throttle'] ?? old('rssi_throttle') }}"
                />
            </div>
        </div>
        <div class="row pt-2 pb-4">
            <div class="col-sm-12 text-center">
                <button class="btn btn-primary filter-form">
                    <i class="bi bi-funnel"></i>
                    {{ __('attributes.filter.title') }}
                </button>
                <button type="button" class="btn btn-warning filter-clean-form">
                    <i class="bi bi-x-circle"></i>
                    {{ __('attributes.filter.clean') }}
                </button>
            </div>
        </div>
    </form>
</div>
