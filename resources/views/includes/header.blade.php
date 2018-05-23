<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    @foreach($categories as $category)
                        @if(count($category->children) > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $category->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    @each('includes.recursive-nav', $category->children, 'category')
                                </ul>
                            </li>
                        @else
                            <li class="nav-item active">
                                <a class="nav-link" href="#">{{ $category->name }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
</header>
