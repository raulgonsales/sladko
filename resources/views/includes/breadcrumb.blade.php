<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($items as $i => $item)
            @if($i != count($items))
                <li class="breadcrumb-item">
                    <a href="/category/{{ $item['id'] }}" title="{{ $item['description'] }}">{{ $item['name'] }}</a>
                </li>
            @else
                <li class="breadcrumb-item active">
                    {{ $item['name'] }}
                </li>
            @endif
        @endforeach
    </ol>
</nav>