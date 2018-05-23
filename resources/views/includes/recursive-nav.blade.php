@if(count($category->children) > 0)
    <li class="dropdown-submenu nav-item">
        <a class="dropdown-item dropdown-toggle" href="#">{{ $category->name }}</a>
        <ul class="dropdown-menu">
            @each('includes.recursive-nav', $category->children, 'category')
        </ul>
    </li>
@else
    <li class="nav-item">
        <a class="dropdown-item" href="#">{{ $category->name }}</a>
    </li>
@endif