@extends('auth.layouts')
@section('content')


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            @if ($following->isEmpty())
                <div class="card" style="width: 25rem;">
                    <div class="card-body">
                        <p class="card-text">No posts available.</p>
                    </div>
                </div>
            @else
                @foreach ($following as $f)
                    @php
                        $followingUser = \App\Models\User::findOrFail($f->followed_id);
                    @endphp
                    @if (!$followingUser->post->isEmpty())
                        @foreach ($followingUser->post as $post)
                            <div class="row justify-content-center">
                                <div class="col-md-7 mt-5">
                                    <div class="card mb-5" style="width: 25rem;">
                                        <img src="{{ asset($post->image) }}" class="card-img-top" alt="">
                                        <div class="card-body">
                                            <p class="card-text fw-medium">{{ $post->content }}</p>
                                            <p class="card-text text-sm font-weight-light">{{ $post->created_at->format('M d, Y') }}</p>
                                            <a href="{{url('profile/'.$post->user->id)}}" class="text-dark" style="text-decoration: none;">
                                                <h5 class="card-title text-capitalize">{{ $post->user->name }}</h5>
                                            </a>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6 text-center">
                                                @if($post->likes()->where('user_id',auth()->user()->id)->exists())
                                            <form action="{{url('unlike/'.$post->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                             <button type="submit" class="btn border-danger btn-sm">
                                                {{ $post->likes()->count() }}
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M718-322.461 614.461-426 661-473.308l57 57.769 141-142L905.539-511 718-322.461ZM440-506Zm0 368.154 6.769 4.307Q317.538-253 238.807-332.731q-78.73-79.73-121.038-135.653-42.308-55.924-56.039-98.347Q48-609.154 48-652q0-87.308 60.846-148.039 60.846-60.73 149.154-60.73 48.769 0 96 24.5t86 71.038q38.769-46.538 86-71.038t96-24.5q81.462 0 142.423 53.192Q825.385-754.385 833.154-673H767q-6.539-51.231-45.615-86.5-39.077-35.269-99.385-35.269-42.692 0-86.385 27-43.692 27-52.538 69.769h-86.154q-10.385-43.538-51.769-70.154-41.385-26.615-87.154-26.615-64.538 0-104.269 40.884Q114-713 114-652q0 36.769 14 73.039 14 36.269 51 83.538t100 111.308Q342-320.077 440-228q27.615-24.615 42.731-41.038 15.115-16.424 36.423-35.731l6.885 6.884Q532.923-291 542.423-282t16.385 15.885l6.885 6.884q-21.539 20.308-37.039 36.347-15.5 16.038-42.346 41.653L440-137.846Z"/></svg>
                                            </form>
                                    
                                                @else
                                                <form action="{{url ('like/'.$post->id)}}"  method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn border-info btn-sm">
                                                        {{ $post->likes()->count() }}
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Zm0-108q96-86 158-147.5t98-107q36-45.5 50-81t14-70.5q0-60-40-100t-100-40q-47 0-87 26.5T518-680h-76q-15-41-55-67.5T300-774q-60 0-100 40t-40 100q0 35 14 70.5t50 81q36 45.5 98 107T480-228Zm0-273Z"/></svg>
                                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <a href="{{ url('comment/'.$post->id) }}"  class="btn border-info">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-400h320v-80H240v80Zm0-120h480v-80H240v80Zm0-120h480v-80H240v80ZM80-80v-720q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H240L80-80Zm126-240h594v-480H160v525l46-45Zm-46 0v-480 480Z"/></svg>
                                                            </a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="card" style="width: 30rem;">
                            <div class="card-body">
                                <p class="card-text">No posts available.</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>




          
@endsection