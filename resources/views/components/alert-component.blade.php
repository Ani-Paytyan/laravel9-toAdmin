@if(session('message') !== null)
    <x-common.alert type="{{ (session('message'))->getType() }}" class="mb-4">
        {{ (session('message'))->getMessage() }}
    </x-common.alert>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
