@extends('auth.layouts')
@section('content')


<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h4>Edit Profile <a href="{{ url('profile/'. auth()->user()->id) }}"class="btn btn-primary float end">Back</a></h4></div>
            <div class="card-body">
                <form action="{{ url('profile')}}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <h4> Profile details</h4>

                    <div class="mb-3">
                        <label for="">age</label>
                        <input type="number" name="age" class="form-control" value="{{ optional($user->userprofile)->age }}">
                        @error('age')
                            <span class="text-danger"> {{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">address</label>
                        <input type="text" name="address" class="form-control" value="{{ optional($user->userprofile)->address }}">
                        @error('address')
                            <span class="text-danger"> {{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">phone number</label>
                        <input type="text" name="phone_number" class="form-control" value="{{ optional($user->userprofile)->phone_number }}">
                    </div>
                    <div class="mb-3">
                        <label for="">profile photo</label>
                        <input type="file" name="image">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection