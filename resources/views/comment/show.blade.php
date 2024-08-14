@extends('auth.layouts')
@section('content')


            <div class="container mb-1">
            <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Post Details</h4>
                    </div>
                    <div class="card-body">
                    @if ($post->image)
                    <img src="{{ asset($post->image) }}" alt="Post Image" style="max-width: 100%;">
                    @endif
                    <p class="fw-bold fs-4 text-capitalize"> {{ $post->user->name }}</p>
                    <p>{{ $post->content }}</p>
                    <p>{{ $post->created_at->format('M d, Y') }}</p>
                    <div class="col-md-6">
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
                </div>
             </div>
             </div>
            </div>
            </div>

            <div class="container mb-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form action="{{ url('comment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input id="commentInput" class="form-control form-control-lg" type="text" name="content" placeholder="Write a comment..." aria-label=".form-control-lg example" onkeyup="toggleButton()">
                            <button id="submitButton" class="btn btn-primary" style="display: none;">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container mb-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h4>Comments</h4>
                        @foreach ($comments as $comment)
                        <div class="card mb-3">
                        <a href="{{ url('profile/'. $comment->user->id)}}" style="text-decoration: none; color: black;">
                         <div class="card-title fw-bold text-capitalize ps-2">{{$comment->user->name}}</div>
                        </a>
                        <div class="card-body">
                        <p class="card-text fw-medium fs-5">{{$comment->content}}</p>
                        <p class="card-text text-sm font-weight-light"> {{ $comment->created_at->format('M d, Y') }}</p>
                        </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>

            <script>
                function toggleButton() {
                    var input = document.getElementById('commentInput');
                    var button = document.getElementById('submitButton');
            
                    if (input.value.trim() !== '') {
                        button.style.display = 'block';
                    } else {
                        button.style.display = 'none';
                    }
                }
            </script>
@endsection