<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-component/>
</head>
<body>
<x-header-component/>
<div class="container mt-3">
    <h1 class="text-center">My Favourite Runner</h1>
    @if($favOrderCount <= 0)
        <h3 class="text-center mt-3">No favourite runner yet</h3>
    @else
        <div class="list-group mt-3">
            @foreach($runnerArray as $item)
                <a href="{{url('/student/showFavouriteRunnerDetail/'.$item->runner_id)}}" class="list-group-item list-group-item-action" aria-current="true">
                    {{$i++}}. {{$item->student_name}}
                </a>
            @endforeach
        </div>
    @endif
</div>
<script>
    var element = document.getElementsByClassName("nav-link favouriterunner");
    element[0].classList.add("active");
</script>
</body>
</html>
