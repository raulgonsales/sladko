@if(isset($noProducts))
    <div class="alert alert-info">
        No products in cart!
    </div>
@else
    <div class="cart-products cart-block hidden">
        <table>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total price</th>
                    <th scope="col">Price without DPH</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach($cartProducts as $key=>$product)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>
                        <a href="{{ route('product', ['id' => $product['product']->id]) }}">
                            {{ $product['product']->name }}</a>
                    </td>
                    <td>{{ $product['product']->price }} Kc</td>
                    <td class="product-quantity">
                        <div>
                            <input type="text" name="product_quantity" value="{{ $product['quantity'] }}">
                            <button class="plus-product">+</button>
                            <button class="minus-product">-</button>
                        </div>
                    </td>
                    <td>{{ $product['totalProductsPrice'] }} Kc</td>
                    <td>{{ $product['product']->nettoPrice * $product['quantity'] }} Kc</td>
                </tr>
                <?php $i++?>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="cart-summary col-xl-4 col-lg-3 col-md-12 col-sm-12 col-12">
        <table>
            <tbody>
                <tr>
                    <th>Total price</th>
                    <td>{{ $totalPrice }} Kc</td>
                </tr>
                <tr>
                    <th>DPH</th>
                    <td>{{ $totalDPH }} Kc</td>
                </tr>
                <tr>
                    <th>Total price without DPH</th>
                    <td>{{ $totalPriceWithoutDPH }} Kc</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="control">
        <button>OK</button>
    </div>
@endif