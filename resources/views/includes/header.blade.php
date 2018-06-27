<header>
    <div class="container">
        <div class="header-info">
            <div class="company-info-left">
                <ul>
                    <li><a href="#">Akce</a></li>
                    <li><a href="#">Kontakt</a></li>
                    <li><a href="#">Pro nas</a></li>
                </ul>
            </div>
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('images/1-1.png') }}" width="300px" height="300px" alt="">
                </a>
            </div>
            <div class="company-info-right">
                <div id="shopping_cart">
                    <a href="#" title="Shopping cart">
                        <span>0 Kc</span>
                        <i style="font-size: 35px" class="fas fa-shopping-cart"></i>
                    </a>
                </div>
                <div>
                    <a href="#">
                        <span>32523523523</span>
                        <i style="font-size: 35px" class="fas fa-phone-square"></i>
                    </a>
                </div>
                <div>
                    <a href="#">
                        <span>/sladkobrno</span>
                        <i style="font-size: 35px" class="fab fa-facebook"></i>
                    </a>
                </div>
                <div>
                    <a href="#">
                        <span>/sladkobrno</span>
                        <i style="font-size: 35px" class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    @foreach($categories as $category)
                        @if(count($category->children) > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="/category/{{ $category->id }}" aria-haspopup="true" aria-expanded="false">
                                    {{ $category->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    @each('includes.recursive-nav', $category->children, 'category')
                                </ul>
                            </li>
                        @else
                            <li class="nav-item active">
                                <a class="nav-link" href="/category/{{ $category->id }}">{{ $category->name }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
</header>
