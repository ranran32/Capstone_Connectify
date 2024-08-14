<!DOCTYPE html>
<html>

<head>
    <title>ConnectiFy</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
   <div class="container-fluid border-bottom-5 border-info fixed-top">
   <a href="{{url ('/')}}" style="color: black; text-decoration: none;"> <h4 class="text-white p-1"  style="font-family: Brush Script MT; font-size:50px;" ><em >Connecti <span class="text-info">Fy</span></em> <button class="btn border-info float-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"></a>
        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></button>
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
          <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="offcanvasScrollingLabel" style="font-weight: 350;"><small>Menu</small></h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('profile/'. auth()->user()->id) }}">
                        <h4 class="text-capitalize" style="font-weight: 350;">
                            @if(auth()->user()->userProfile && auth()->user()->userProfile->image)
                            <img src="{{ asset(auth()->user()->userProfile->image) }}" alt="" style="height: 38px; width: 40px; object-fit: cover; border-radius: 50%;  border: 2px solid #48CAE4;">
                        @else
                            <img src="{{ asset('storage/images/default/default_pic.jpg') }}" alt="" style="height: 35px; width: 40px; object-fit: cover; border-radius: 50%;  border: 2px solid #48CAE4;">
                        @endif
                            {{ auth()->user()->name }}</h4></a>
                </li>
                <hr>
                <li class="nav-item mb-2">
                    <a class="nav-link " href="{{ url('post/create') }}" style="font-weight: 350;">
<svg xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="M460.667-295.333H502V-458h162.667v-41.333H502v-165.334h-41.333v165.334H295.333V-458h165.334v162.667Zm19.379 184.666q-76.998 0-143.907-29.245-66.909-29.244-116.911-79.187-50.003-49.944-79.282-116.909-29.279-66.966-29.279-144.151 0-76.533 29.304-143.925 29.303-67.393 79.471-117.632 50.168-50.239 116.859-78.928t143.563-28.689q76.568 0 144.161 28.654 67.593 28.655 117.691 78.848 50.099 50.194 78.858 117.727 28.759 67.534 28.759 144.142 0 77.274-28.654 143.735-28.655 66.462-78.835 116.55-50.18 50.088-117.696 79.549-67.515 29.461-144.102 29.461Zm.287-41.333q136.18 0 231.923-95.744Q808-343.487 808-480.333q0-136.18-95.619-231.923Q616.763-808 480-808q-136.513 0-232.256 95.619Q152-616.763 152-480q0 136.513 95.744 232.256Q343.487-152 480.333-152ZM480-480Z"/></svg>
                        Create</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link  light-font" href="{{ url('chatify') }}"  style="font-weight: 350;">
                        <svg xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="M110.667-152v-632q0-30.575 21.379-51.954T184-857.333h592q30.575 0 51.954 21.379T849.333-784v429.334q0 30.574-21.379 51.953-21.379 21.38-51.954 21.38H240L110.667-152Zm112-170.666H776q12 0 22-10t10-22V-784q0-12-10-22t-22-10H184q-12 0-22 10t-10 22v533.667l70.667-72.333Zm-70.667 0V-816v493.334Z"/></svg>
                        Chat</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ url('search') }}" style="font-weight: 350;">
                        <svg xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="m787-146.667-254-254q-30.404 26.385-72.534 39.859-42.131 13.474-80.507 13.474-99.577 0-167.601-67.837t-68.024-167q0-99.162 67.837-167.162t166.515-68q98.677 0 167.495 67.884Q615-681.564 615-582.475q0 41.808-14.167 82.142Q586.666-460 561.333-431l255 254.333-29.333 30Zm-407.667-242q82.723 0 138.528-55.361 55.806-55.361 55.806-138.305 0-82.945-55.747-138.306Q462.173-776 379.392-776q-82.781 0-138.253 55.361-55.472 55.361-55.472 138.306 0 82.944 55.472 138.305 55.472 55.361 138.194 55.361Z"/></svg>
                        Search</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ url('') }}" style="font-weight: 350;">
<svg xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="m297.333-297.333 237.334-128 128-237.334-237.334 128-128 237.334ZM480-440q-17 0-28.5-11.5T440-480q0-17 11.5-28.5T480-520q17 0 28.5 11.5T520-480q0 17-11.5 28.5T480-440Zm-.132 329.333q-76.508 0-143.573-29.245-67.065-29.244-117.067-79.187-50.003-49.944-79.282-117.016-29.279-67.072-29.279-143.711 0-76.654 29.304-144.152 29.303-67.499 79.471-117.738 50.168-50.239 116.965-78.928t143.124-28.689q76.689 0 144.388 28.654 67.699 28.655 117.797 78.848 50.099 50.194 78.858 117.727 28.759 67.534 28.759 144.319 0 76.785-28.654 143.402-28.655 66.618-78.835 116.829-50.18 50.211-117.696 79.549-67.515 29.338-144.28 29.338ZM480-152q136.513 0 232.256-95.744Q808-343.487 808-480t-95.744-232.256Q616.513-808 480-808t-232.256 95.744Q152-616.513 152-480t95.744 232.256Q343.487-152 480-152Zm0-328Z"/></svg>
                        Explore</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ url('myFollowing/' . auth()->user()->id) }}" style="font-weight: 350;">
            
<svg xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="M718-340.334 632.334-426 661-456.333l57 58 141-142L888.333-511 718-340.334ZM440-504Zm0 338 19 15.333Q334-266.334 257.167-343.5 180.334-420.667 139-475.167q-41.333-54.5-54.833-94T70.667-649q0-77.041 53.97-131.687 53.969-54.646 132.03-54.646 50.333 0 97.666 27.667 47.334 27.667 85.667 81.667 39-54 85.667-81.667 46.666-27.667 97.666-27.667 72.667 0 128 50.833Q806.666-733.666 811-657.666h-39Q768.667-713 728.333-753.5 688-794 623.333-794q-44.666 0-88.833 28t-62.167 80.667h-64.666q-20-53-62.291-80.834Q303.085-794 256.667-794 193-794 152.5-752.459T112-649.283q0 37.95 14.24 74.206t51.333 83.666Q214.667-444 278.333-379.5 342-315 440-222.667q30.333-28.666 47.833-45.833 17.501-17.167 41.501-40.5l4.5 4.5q4.5 4.5 10.166 10.333 5.667 5.833 10.167 10l4.5 4.167q-24 22.333-41.334 39.666Q500-223 469.333-194L440-166Z"/></svg>
                    Following</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link" href="{{ route('signout') }}" style="font-weight: 350;">
                        
<svg xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="M224-150.667q-30.575 0-51.954-21.379T150.667-224v-512q0-30.575 21.379-51.954T224-809.333h257V-768H224q-12 0-22 10t-10 22v512q0 12 10 22t22 10h257v41.333H224Zm440-184-31.666-30L727.667-460H366v-41.333h361.667l-95.333-95.333 31-29.333 145.999 146.332-145.333 145Z"/></svg>
                        Logout</a>
                </li>
                @endguest
          </div>
        </div></h4>
   </div>

    <div class="container mt-5">
        @yield('content')
    </div>


    
    <footer class=" py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#">Home</a></li>
                        <li class="list-inline-item"><a href="#">Features</a></li>
                        <li class="list-inline-item"><a href="#">FAQs</a></li>
                        <li class="list-inline-item"><a href="#">About</a></li>
                    </ul>
                    <hr class="my-3">
                    <p>&copy; 2024 Company, Inc</p>
                </div>
            </div>
        </div>
    </footer>
    





    <style>
        body {
            background-color: #f0f0f0;
        }
        ul li{
            font-family: 'Courier New', Courier, monospace;
            font-size: 20px;
        }

        ul li:hover{    
            transform: translateY(-3px);
            transition: 0.3s;
        }
   

           



    </style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

</body>

</html>