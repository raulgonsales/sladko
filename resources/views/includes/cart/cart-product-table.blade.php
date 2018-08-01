@if(!isset($cartProducts) || !count($cartProducts))
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
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach($cartProducts as $product)
                <tr id="product_{{ $product['product']->id }}">
                    <th scope="row">{{ $i }}</th>
                    <td>
                        <a href="{{ route('product', ['id' => $product['product']->id]) }}">
                            {{ $product['product']->name }}</a>
                    </td>
                    <td>{{ $product['product']->price }} Kc</td>
                    <td class="product-quantity">
                        <div>
                            <input class="product-total-quantity"
                                   data-id="{{ $product['product']->id }}"
                                   type="text"
                                   name="product_quantity"
                                   maxlength="3"
                                   value="{{ $product['quantity'] }}">
                            <button class="plus-product" data-id="{{ $product['product']->id }}">+</button>
                            <button class="minus-product" data-id="{{ $product['product']->id }}">-</button>
                        </div>
                    </td>
                    <td class="product-total-price"><span>{{ $product['totalProductsPrice'] }}</span> Kc</td>
                    <td class="product-total-netto-price">
                        <span>{{ $product['totalProductsGroupNettoPrice'] }}</span> Kc
                    </td>
                    <td class="delete-product-row">
                        <button class="delete-row"
                                data-id="{{ $product['product']->id }}"
                                title="Delete product from cart">X</button>
                    </td>
                </tr>
                <?php $i++?>
            @endforeach
            </tbody>
        </table>
        <div class="cart-additional">
            <div class="delivery col-xl-4 col-lg-3 col-md-12 col-sm-12 col-12">
                <h4>Choose your delivery method</h4>
                @foreach($deliveryMethods as $method)
                    <p>
                        <input id="delivery_method_{{ $method->id }}"
                               data-id="{{ $method->id }}"
                               type="radio"
                               name="delivery"
                               @if(isset($chosenDeliveryMethod) && $chosenDeliveryMethod == $method->id) checked @endif>
                        <label for="delivery_method_{{ $method->id }}" data-id="{{ $method->id }}">
                            {{ $method->name }} ({{ $method->price }} Kc)
                        </label>
                    </p>
                @endforeach
            </div>
            <div class="cart-summary col-xl-4 col-lg-3 col-md-12 col-sm-12 col-12" id="cart_summary">
                <table>
                    <tbody>
                    <tr>
                        <th>Delivery</th>
                        <td class="delivery-price"><span>{{ $deliveryPrice }}</span> Kc</td>
                    </tr>
                    <tr>
                        <th>Total price without DPH</th>
                        <td class="total-cart-netto-price"><span>{{ $totalNettoPrice  }}</span> Kc</td>
                    </tr>
                    <tr>
                        <th>DPH</th>
                        <td class="total-cart-DPH"><span>{{ $totalDPH }}</span> Kc</td>
                    </tr>
                    <tr>
                        <th>Total price</th>
                        <td class="total-cart-price"><span>{{ $totalPrice }}</span> Kc</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="control">
            <button id="submit_cart_products">OK</button>
        </div>
    </div>
@endif