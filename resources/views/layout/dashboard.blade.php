@extends('layout.base')

@section('page')
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <!-- Vertical Navbar -->
        <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-light border-bottom border-bottom-lg-0 border-end-lg"
             id="navbarVertical">
            <div class="container-fluid">
                <!-- Toggler -->
                <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Brand -->
                <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="#">
                    <img src="https://preview.webpixels.io/web/img/logos/clever-primary.svg" alt="...">
                </a>
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidebarCollapse">
                    <!-- Navigation -->
                    <ul class="navbar-nav">
                        <li class="nav-item li-ac">
                            <a class="nav-link {{ request()->is('antena*') ? 'active' : '' }}" href="{{ route('antena.index') }}">
                                <i class="bi bi-reception-3"></i> {{trans('page.antena.title')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('workplace*') ? 'active' : '' }}" href="{{ route('workplace.index') }}">
                                <i class="bi bi-building"></i> {{trans('page.workplace.title')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('item*') ? 'active' : '' }}" href="{{ route('item.index') }}">
                                <i class="bi bi-layout-wtf"></i> {{trans('page.item.title')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('registrationBox*') ? 'active' : '' }}" href="{{ route('registrationBox.index') }}">
                                <i class="bi bi-box"></i> {{trans('page.registration_box.title')}}
                            </a>
                        </li>
                    </ul>
                </div>
                <p class="px-lg-3 version">{{ AppVersionHelper::getAppVersion() }}</p>
            </div>
        </nav>

        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <!-- Header -->
            <header class="bg-surface-primary border-bottom py-2">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="dropdown">
                                <button class="btn btn-link dropdown-toggle" type="button" id="userNavDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ \Illuminate\Support\Facades\Auth::user()->getFirstName() }}
                                    {{ \Illuminate\Support\Facades\Auth::user()->getLastName() }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="userNavDropdown">
                                    <li><a class="dropdown-item" href="{{ route('auth.logout') }}">{{ trans('common.logout') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <div class="message">
                        <x-alert-component />
                    </div>
                    @yield('content')
                </div>
            </main>
        </div>

    </div>
@endsection
@push('bodyEnd')
    <script src="{{ mix('build/js/message-time.js') }}"></script>
@endpush
