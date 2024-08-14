@extends('auth.layouts')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center mt-5">
            <input type="text" onkeyup="processSearch()" name="searchUser" id="searchUser">

            <div class="mt-5 mb-5" id="userData">
                <h5> Search User ...</h5>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>

<script>
  var originalContent = document.getElementById("userData").innerHTML;
function processSearch() {
   var search= document.getElementById('searchUser').value;
   
   if (search.trim() === '') {
        document.getElementById("userData").innerHTML = originalContent;
        return;
    }

   $.post("{{ url('user-search') }}",
        {
            _token: '{!! csrf_token() !!}',
            search_key: search,
        },
        function(data, status){
           document.getElementById("userData").innerHTML = data;          
        }
        );
}

</script>


<script>
$(document).ready(function(){
   $(document).on('click', '.followBtn', function(e){
    e.preventDefault();
    let id= $(this).data('id');
    let button = $(this); 
    $.ajax({
            url:"{{ route('followUser')}}",
            method:"POST",
            data:{
                id:id
            },
            success:function(res){
                if(res.status=== 'success'){
                    if (button.hasClass('followBtn')) {
                        button.removeClass('followBtn btn border-info').addClass('unfollowBtn btn btn-sm border-danger').text('Unfollow');
                    } else {
                        button.removeClass('unfollowBtn btn-danger').addClass('followBtn btn btn-sm border-info').text('Follow');
                    }

                }
            },
            error:function(xhr){

            }
        });
   })
   
   $(document).on('click', '.unfollowBtn', function(e){
    e.preventDefault();
    let id= $(this).data('id');
    let button= $(this);
    $.ajax({
        url:"{{ route('unfollowUser')}}",
        method:"DELETE",
        data:{
            id:id
        },
        success:function(res){
            if(res.status=== 'success'){
                if (button.hasClass('unfollowBtn')){
                    button.removeClass('unfollowBtn btn border-danger').addClass('followBtn btn border-info').text('follow');
                }else{
                    button.removeClass('followBtn btn border-info').addClass('unfollowBtn btn border-danger').text('unfollow');
                }
            }
        },
        error:function(xhr){

        }
    })
   })
  
})

</script>

@endsection
