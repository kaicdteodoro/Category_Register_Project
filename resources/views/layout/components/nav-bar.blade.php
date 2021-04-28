    @php
    function setActive($route){
        return request()->routeIs($route)?'active':'';
    }
    @endphp
<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{setActive('home')}}">
                <a class="nav-link" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item {{setActive('products.*')}}">
                <a class="nav-link" href="{{route('products.home')}}">Produtos</a>
            </li>
            <li class="nav-item {{setActive('categories.*')}}">
                <a class="nav-link" href="{{route('categories.home')}}">Categorias</a>
            </li>
        </ul>

    </div>
</nav>
