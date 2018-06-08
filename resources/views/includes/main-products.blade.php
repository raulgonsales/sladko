<div class="products-wrapper">
    @foreach($newProducts as $product)
        <div class="product-wrapper col-xl-3 col-lg-4 col-md-6 col-sm-6 col-6">
            <div class="product">
                <a href="/product/{{ $product->id }}">
                    <div class="product-image">
                        <img src="images/shvarcvaldskii-vishnevyi-tort_1396253792_1_max.jpg" alt="">
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
</div>