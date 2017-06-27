<ul class="menu">

    @if($menu)
        @foreach($menu as $item)
            <li><a href="{{route('/')}}">{{$item->name}}</a></li>
        @endforeach
    @endif
    <li class="soceity"><a href="javascrip: void(0)"><i class="fa fa-twitter"></i></a></li>
    <li class="soceity"><a href="javascrip: void(0)"><i class="fa fa-youtube"></i></a></li>
    <li class="soceity no-mr"><a href="javascrip: void(0)"><i class="fa fa-facebook"></i></a></li>
</ul>