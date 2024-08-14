@extends('auth.layouts')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 ">
            <div class="card-title fw-bold fs-4 mt-5"> Following</div>
            <br>
            @if($following->isEmpty())
            <div class="card">
                <div class="card-body">
                    <p class="text-center">No following</p>
                </div>
            </div>
            @else
            @foreach ($following as $f)
                @php
                    $followingUser = \App\Models\User::findOrFail($f->followed_id);
                @endphp
                <div class="card" style="width: 15rem; height: 4rem;">
                    <div class="card-body">
                       <h5 class="text-capitalize text-sm">
                        @if($followingUser->userProfile && $followingUser->userProfile->image)
                        <img src="{{ asset($followingUser->userProfile->image) }}" class="img-thumbnail" style="border-radius: 50%; height: 35px; object-fit: cover; width: 35px">
                    @else
                        <img src="{{ asset('storage/images/default/default_pic.jpg') }}" class="img-thumbnail" style="border-radius: 50%; height: 50px; object-fit: cover; width: 50px">
                    @endif
                   <a href="" style="text-decoration: none; color: black;"> {{ $followingUser->name }}</a>
                       </h5>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
    </div>
</div>

          
@endsection