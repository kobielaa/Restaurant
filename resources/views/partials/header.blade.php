<nav class="navbar sticky-top navbar-expand-lg">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="app-navbar-collapse">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>
                @if(count($globalData['advert_types']))
                @foreach ($globalData['advert_types'] as $row)
                <li class="nav-item">
                    <a href="{{route('adverts.'.$row->slug)}}"class="nav-link">{{$row->name}}</a>
                </li>
                @endforeach
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container d-flex align-items-center">
    <div class="mission">
        <h1>Find perfect restaurant or company</h1>
        <p>Lorem Ipsum is simply dummy text of the printing typestting industry.</p>
        <form>
            <div class="form-group">
                <div class="input-group @if ($errors->has('birth_date')) is-invalid @endif">
                    <input class="form-control" type=text placeholder="Just search perfect restaurant or company...">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                </div>
            </div>                
        </form>
    </div>
</div>