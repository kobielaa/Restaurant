<div class="menu">
    <h4>@lang('cusines.cusines')</h4>
    <ul class=menu>
        @if(count($globalData['cusines']))
        @foreach ($globalData['cusines'] as $row)
        <li class="nav-item">
            <span><a href="
                @if (strlen(Request::segment(2)) == 0)
                {{route('home').'/all/cusines/'.$row->slug}}"
                @else
                {{route('home').'/'.Request::segment(2).'/cusines/'.$row->slug}}"
                @endif
                 class="nav-link">{{$row->name}}</a></span>
            <span class="float-right">({{$row->advertsCount(Request::segment(2), Request::segment(3), Request::segment(4), Request::segment(5))}})</span>
        </li>
        @endforeach
        @endif
    </ul>
    <h4>Extras</h4>
    <ul class=menu>
        <li class="nav-item">
            <span><a href="#" class="nav-link">Development &amp; Services</a></span>
        </li>
        <li class="nav-item">
            <span><a href="#" class="nav-link">AllRestaurants Magazine</a></span>
        </li>
        <li class="nav-item">
            <span><a href="#" class="nav-link">AllRestaurants Agents</a></span>
        </li>
    </ul>
    <h4>Newsletter</h4>
    <h4>Login</h4>
    
</div>