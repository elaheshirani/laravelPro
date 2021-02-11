@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Active Phone Number
                    </div>
                    <div class="card-body">
                       <form method="post" action="{{route('profile.twoFactor.phone')}}">
                           @csrf
                           <div class="form-group">
                               <label for="">token</label>
                               <input type="text" name="token" id="token" class="form-control @error('token') is-invalid @enderror" >
                               @error('token')
                               <span class="invalid-feedback">
                                   <strong>{{$message}}</strong>
                               </span>
                               @enderror
                           </div>
                           <div class="form-group">
                               <button class="btn btn-primary">Validate token</button>
                           </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
