@extends('auth.layouts')
@section('content')



<div class="container">
        <div class="row justify-content-center mt-2">
        <div class="col-md-8">
        @if ($post->isEmpty())
        <div class="card" style="width: 30rem;">
        <div class="card-body">
        <p class="card-text">No posts available.</p>
        </div>
         </div>
        @else
         @endif
    <div class="row justify-content-center mt-2">
    <div class="col-md-7 ">
    @foreach ($post as $p)
    <div class="options">
        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
            <path d="M240-400q-33 0-56.5-23.5T160-480q0-33 23.5-56.5T240-560q33 0 56.5 23.5T320-480q0 33-23.5 56.5T240-400Zm240 0q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm240 0q-33 0-56.5-23.5T640-480q0-33 23.5-56.5T720-560q33 0 56.5 23.5T800-480q0 33-23.5 56.5T720-400Z"/>
        </svg>
        <div class="opt_content">
            <p class="opt"><a href="{{ url('comment/'.$p->id) }}">View post</a></p>
            @if(Auth::check() && Auth::user()->id === $p->user->id)
            <p class="opt"><a href="{{url('post/update/'. $p->id )}}">Edit</a></p>
            <form method="post" action="{{url('post/delete/'.$p->id)}}">
                @csrf
                <button type="submit" class="delete-button">Delete</button>
            </form>
        @endif
        </div>
    </div>
    <div class="card mb-5" style="width: 25rem;" >
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
    </div>
    @endforeach
    </div>
</div>


<style>

    p{
        font-family: 'Courier New', Courier, monospace;
    }

    .options {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .opt_content {
        text-align: center;
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        width: 80px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .options:hover .opt_content {
        display: block;
    }

    a{
        color: black;
        text-decoration: none;
    }
    .opt{
        font-size: 12px;
        padding-left: 3px
    }
    .opt:hover{
        border-bottom: 2px solid #48CAE4;
    }


    .delete-button {
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    padding: 0;
    width: 80px;
}

.delete-button:hover {
    border-bottom: 2px solid red;
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
    })
})

})

</script>



@endsection