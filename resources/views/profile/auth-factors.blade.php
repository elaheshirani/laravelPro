@extends('profile.layout')

@section('main')
    <h4>your auth Factors</h4><hr>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('profile.auth-factors') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control">
                @foreach(config('authfactor.types') as $key => $value)
                    <option value="{{ $key }}"
                        {{ old('type') == $key || auth()->user()->auth_factor == $key ? 'selected' : ''}}
                    >{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input name="phone" id="phone" class="form-control"
                   placeholder="please add your phone number"
                   value="{{ old('phone') ?? auth()->user()->phone }}"
            >
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Send</button>
        </div>
    </form>
@endsection
