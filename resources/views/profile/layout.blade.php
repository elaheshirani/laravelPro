@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                                <a href="{{ route('profile') }}"
                                   class="nav-link {{ request()->is('profile') ? 'active' : '' }}"
                                >Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('profile.auth-factors') }}"
                                   class="nav-link
                                    {{ request()->is('profile/auth-factors') ? 'active' : '' }}">
                                    Auth Factors</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        @yield('main')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
