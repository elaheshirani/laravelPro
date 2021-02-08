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
                <option value="off">off</option>
                <option value="sms">sms</option>
            </select>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input class="form-control" name="phone" id="phone" placeholder="please enter your phone number">
        </div>
        <div class="form-group">
            <button class="btn btn-primary">submit</button>
        </div>
    </form>
@endsection
