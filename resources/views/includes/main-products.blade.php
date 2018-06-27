<div class="products-wrapper">
    @if(isset($products) && !empty($products))
        @foreach($products as $product)
            <div class="product-wrapper col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                <div class="product">
                    <a href="/product/{{ $product->id }}">
                        <div class="product-image">
                            @if(count($product->images)
                                && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->images[0]->url))
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($product->images[0]->url) }}"
                                     alt="{{ $product->images[0]->description }}">
                            @else
                                <img src="{{ \Illuminate\Support\Facades\Storage::url("/images/not-photo.png") }}">
                            @endif
                        </div>
                        <div class="product-description">
                            <p class="product-name">{{ $product->name }}</p>
                            <p class="product-price">Cena: {{ $product->price }} Kc</p>
                        </div>
                    </a>
                    <div class="to-basket">
                        <button class="to-basket-button">To basket</button>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        No products
    @endif
</div>