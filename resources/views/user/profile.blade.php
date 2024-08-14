@extends('auth.layouts')
@section('content')


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile-card card"   style="width: 40rem;" >
                <div class="card-header">
                    <h4>Profile 
                        @if(auth()->check() && auth()->user()->id == $user->id)
                            <a href="{{ url('profile/create') }}" class="btn border-info btn-sm float end">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z"/></svg></a>
                        @endif
                    </h4>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                @if($user->userProfile && $user->userProfile->image)
                                    <img src="{{ asset($user->userProfile->image) }}" class="img-thumbnail" style="border-radius: 50%; height: 80px; object-fit: cover; width: 74px">
                                @else
                                    <img src="{{ asset('storage/images/default/default_pic.jpg') }}" class="img-thumbnail" style="border-radius: 50%; height: 80px; object-fit: cover; width: 74px">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-capitalize fw-bold fs-3">{{ $user->name }}    
                            <div class="followMsg"></div>
                    @if(auth()->user()->id !== $user->id)
                    @if(auth()->user()->followings()->where('followed_id', $user->id)->exists())
                      <button type="submit" class="btn border-danger btn-sm" id="unfollowBtn" data-id="{{$user->id}}">
           <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M734-331 634-432l32-34 68 70 136-137 32 33-168 169ZM432-485Zm0 331 50 44Q340-240 257-325.5t-124.5-142Q91-524 79.5-563T68-639q0-77 55-133t132-56q47 0 93.5 25t83.5 73q37.3-48.095 81.95-73.048Q558.6-828 605-828q75 0 137.5 54.5T804-635h-43q0-56-41-101.5T605-782q-48 0-86 28t-49 68h-76q-15-42-48.5-69T255-782q-65 0-103 41.5T114-639q0 35.366 12.5 70.183Q139-534 174.5-487.5q35.5 46.5 97 111T432-217q28-25 55-53.5t48-47.5l4.553 4.553q4.552 4.552 11.447 10.947t11.447 10.947L567-287q-21 21-26 28.5T518-233l-86 79Z"/></svg>
                      </button>
                   @else
                      <button type="submit" class="btn border-info btn-sm" id="followBtn" data-id="{{$user->id}}">
          <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M432-509Zm0 331 50 44Q340-264 257-349.5t-124.5-142Q91-548 79.5-587T68-663q0-77 55-133t132-56q47 0 93.5 25t83.5 73q37.3-48.095 81.95-73.048Q558.6-852 605-852q75 0 137.5 54.5T804-659h-43q0-56-41-101.5T605-806q-48 0-86 28t-49 68h-76q-15-42-48.5-69T255-806q-65 0-103 41.353Q114-723.295 114-663q0 35.366 12.5 70.183Q139-558 174.5-511.5q35.5 46.5 97 111T432-241q28-25 55-53.5t48-47.5l4.553 4.553q4.552 4.552 11.447 10.947t11.447 10.947L567-311q-21 21-26 28.5T518-257l-86 79Zm233-147v-108H557v-46h108v-108h46v108h108v46H711v108h-46Z"/></svg>
                      </button>
                    @endif
                    @endif
                @if(session('success'))
                <div class="alert alert-success mt-2" style="font-size:12px; width:100px; height:10px; display: flex; align-items: center;">
                {{ session('success') }}
                </div>
                @endif
                            </p>
                    @if ($user->userProfile)
                        <p class="fw-bold">age: {{ $user->userProfile->age }}</p>
                        <p class="fw-bold">address: {{ $user->userProfile->address }}</p>
                        <p class="fw-bold">phone number: {{ $user->userProfile->phone_number }}</p>
                    @else
                        <p>No user details found.</p>
                    @endif
                        </div>
                        <div class="col-md-2">
                            <p class="ms-4">{{ $user->followers()->count() }}</p>
                            <a href="{{url ('followers/'.$user->id)}}" class="fw-bold" style="text-decoration: none; color: black; ">Followers</a>
                        </div>
                        <div class="col-md-2">
                            <p class="ms-4"> {{ $user->followings()->count() }}</p>
                            <a href="{{url ('followings/'.$user->id)}}" class="fw-bold" style="text-decoration: none; color: black;">Following</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container mt-5">
    <div class="row justify-content-center">
    <div class="col-md-8">
        <h4>Posts</h4>
        @if ($post->isEmpty())
        <div class="card" style="width: 40rem;">
        <div class="card-body">
        <p class="card-text">No posts available.</p>
        </div>
         </div>
        @else
         @endif
    <div class="row justify-content-center">
    <div class="col-md-12 mt-2">
@foreach ($post as $p)
<div class="card mb-5" style="width: 40rem;">
 <img src="{{ asset($p->image) }}" class="card-img-top" alt="">
 <div class="card-body">
<p class="card-text fw-medium"> {{$p->content}} </p>
<p class="card-text text-sm font-weight-light"> {{ $p->created_at->format('M d, Y') }}</p>
<a href="{{url('profile/'.$p->user->id)}}" class="text-dark" style="text-decoration: none;"> <h5 class="card-title text-capitalize">{{$p->user->name}}</h5></a>
</div>
<div class="row mb-4" id="likesCon_{{$p->id}}">
    <div class="col-md-6 text-center">
        @if($p->likes()->where('user_id',auth()->user()->id)->exists())
     <button class="processUnlike btn border-danger btn-sm" data-id="{{$p->id}}">
        {{ $p->likes()->count() }}
<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M718-322.461 614.461-426 661-473.308l57 57.769 141-142L905.539-511 718-322.461ZM440-506Zm0 368.154 6.769 4.307Q317.538-253 238.807-332.731q-78.73-79.73-121.038-135.653-42.308-55.924-56.039-98.347Q48-609.154 48-652q0-87.308 60.846-148.039 60.846-60.73 149.154-60.73 48.769 0 96 24.5t86 71.038q38.769-46.538 86-71.038t96-24.5q81.462 0 142.423 53.192Q825.385-754.385 833.154-673H767q-6.539-51.231-45.615-86.5-39.077-35.269-99.385-35.269-42.692 0-86.385 27-43.692 27-52.538 69.769h-86.154q-10.385-43.538-51.769-70.154-41.385-26.615-87.154-26.615-64.538 0-104.269 40.884Q114-713 114-652q0 36.769 14 73.039 14 36.269 51 83.538t100 111.308Q342-320.077 440-228q27.615-24.615 42.731-41.038 15.115-16.424 36.423-35.731l6.885 6.884Q532.923-291 542.423-282t16.385 15.885l6.885 6.884q-21.539 20.308-37.039 36.347-15.5 16.038-42.346 41.653L440-137.846Z"/></svg>
        @else
            <button id="#like-button-" class="processLike btn border-info btn-sm" data-id="{{$p->id}}">
                {{ $p->likes()->count() }}
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Zm0-108q96-86 158-147.5t98-107q36-45.5 50-81t14-70.5q0-60-40-100t-100-40q-47 0-87 26.5T518-680h-76q-15-41-55-67.5T300-774q-60 0-100 40t-40 100q0 35 14 70.5t50 81q36 45.5 98 107T480-228Zm0-273Z"/></svg>
                            </button>
        @endif
    </div>
    <div class="col-md-6 text-center">
        <a href="{{ url('comment/'.$p->id) }}"  class="btn border-info">
            {{ $p->comments()->count() }}
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-400h320v-80H240v80Zm0-120h480v-80H240v80Zm0-120h480v-80H240v80ZM80-80v-720q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H240L80-80Zm126-240h594v-480H160v525l46-45Zm-46 0v-480 480Z"/></svg>
                    </a>
    </div>
   </div>
@endforeach
</div>
</div>


<style>

p {
        font-family: 'Courier New', Courier, monospace;
    }

</style>


<script>
    $(document).ready(function(){
        $(document).on('click', '.processLike', function(e) {
            e.preventDefault();
            let id= $(this).data('id');
            $.ajax({
                url:"{{ route('likePost')}}",
                method:"POST",
                data:{
                    id:id
                },
                success:function(res){
                    if(res.status === 'success'){
                        $('#likesCon_'+id).load(location.href+' #likesCon_'+id);
                    }
                },  
                error:function(xhr){
    
                }
            });
        });
    $(document).on('click', '.processUnlike', function(e){
        e.preventDefault();
        let id= $(this).data('id');
    
        $.ajax({
            url:"{{ route('unlikePost')}}",
            method:"DELETE",
            data:{
                id:id
            },
            success:function(res){
               if(res.status=== 'success'){
                $('#likesCon_'+id).load(location.href+' #likesCon_'+id);
               }
            },
            error:function(xhr){
    
            }
        });
    });
    $(document).on('click', '#followBtn', function(e){
        e.preventDefault();
        let id= $(this).data('id');
        
        $.ajax({
            url:"{{ route('followUser')}}",
            method:"POST",
            data:{
                id:id
            },
            success:function(res){
                if(res.status=== 'success'){
                    $('.profile-card').load(location.href+' .profile-card'); 
                }
            },
            error:function(xhr){

            }
        });
    });
    $(document).on('click', '#unfollowBtn', function(e){
        e.preventDefault();
        let id= $(this).data('id');
        
        $.ajax({
            url:"{{ route('unfollowUser')}}",
            method:"DELETE",
            data:{
                id:id
            },
            success:function(res){
                if(res.status === 'success'){
                    $('.profile-card').load(location.href+' .profile-card');
                }
            },
            error:function(err){

            }
        });
    });

    
    })
    
    </script>
    

@endsection