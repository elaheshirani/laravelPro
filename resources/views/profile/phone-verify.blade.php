@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Active phone number
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.auth-factors.phone') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="token" class="col-form-label">token</label>
                                <input type="text" value="" placeholder="enter your token"
                                       class="form-control @error('token') is-invalid @enderror">
                                @error('token')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">validate token</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
