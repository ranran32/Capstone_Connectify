@extends('auth.layouts')
@section('content')


<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><h4>Add post <a href="http://127.0.0.1:8000/" class="btn btn-primary float end">Back</a></h4></div>
            <div class="card-body">
                <form action="{{ url('post/store')}}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="">Share your thoughts...</label>
                        <input type="text" name="content" class="form-control">
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