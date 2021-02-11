@extends('profile.layout')

@section('main')
    <h2>two factor Auth</h2>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    <hr>
    <form action="#" method="post">
        @csrf
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control">
                @foreach(config('twofactor.types') as $key => $value)
                    <option value="{{$key}}" {{old('type') == $key || auth()->user()->two_factor_type == $key ? 'selected' : ''}}>{{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input class="form-control" name="phone" id="phone" value="{{ old('phone') ?? auth()->user()->phone_number }}" placeholder="please enter your phone number">
        </div>
        <div class="form-group">
            <button class="btn btn-primary">submit</button>
        </div>
    </form>
@endsection
