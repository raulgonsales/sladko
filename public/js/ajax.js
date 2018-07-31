/**
 * Load reviews.
 *
 * @param limit
 * @param startedDate
 */
function loadReviews(limit, startedDate) {
  var promise = $.ajax({
    type: 'POST',
    url: '/ajax/loadReviews',
    data: {startedDate: startedDate, limit: limit},
    dataType: "json"
  });

  promise.done(function (data) {
    if(data) {
      $(document.getElementById('reviews_items')).append(data['html']);
      localStorage.setItem('lastItemDate', data['lastItemDate']['date']);
    } else {
      localStorage.removeItem('lastItemDate');
      return false;
    }
  });

  promise.fail(function () {
    $(document.getElementById('reviews_items')).append('<p>No reviews...</p>');
  })
}

/**
 * Do changes with quantity in the cart. Adding, deleting and changing
 *
 * @param action Action to do with product row in the cart (add|delete|change|delete-row)
 * @param id Product id
 * @param newQuantity
 * @param fromCart Do action on cart page or not
 */
function changeCartQuantity(action, id, newQuantity, fromCart) {
  var promise = $.ajax({
    type: 'POST',
    url: '/ajax/cart/' + action,
    data: {
      productId: parseInt(id),
      newQuantity: newQuantity
    },
    dataType: 'json'
  });

  promise.done(function (data) {
    console.log(data);
    setCartTemplatePrices(data, id, fromCart, action)
  });
}

/**
 * Does changes with price on cart page after changing quantity
 *
 * @param data
 * @param id
 * @param fromCart
 * @param action
 */
function setCartTemplatePrices(data, id, fromCart, action) {
  var cart = $(document.getElementById('shopping_cart'));

  cart.find('.total-count span').html(data.cartData.totalQuantity);
  cart.find('.total-price span').html(data.cartData.totalPrice);

  if(fromCart) {
    var productRow = (document.getElementById('product_' + id + ''));
    if(action !== 'delete-row') {
      $(productRow).find('.product-total-price span').html(data.cartData.totalProductsGroupPrice);
      $(productRow).find('.product-total-netto-price span').html(data.cartData.totalProductsGroupNettoPrice);
      $(productRow).find('.product-total-quantity').val(data.cartData.totalProductsGroupQuantity);
    } else {
      $(productRow).empty().remove();
    }

    var cartSummary = (document.getElementById('cart_summary'));

    $(cartSummary).find('.total-cart-price span').html(data.cartData.totalPrice);
    $(cartSummary).find('.total-cart-DPH span').html(data.cartData.totalDPH);
    $(cartSummary).find('.total-cart-netto-price span').html(data.cartData.totalNettoPrice);

    if(data.cartData.deliveryPrice) {
      $(cartSummary).find('.delivery-price span').html(data.cartData.deliveryPrice);
    }
  }
}

/**
 * Sets delivery method and changes prices.
 *
 * @param methodId
 */
function setDeliveryMethod(methodId) {
  var promise = $.ajax({
    type: 'POST',
    url: '/ajax/cart/set-delivery',
    data: {methodId: methodId},
    dataType: "json"
  });

  promise.done(function (data) {
    setCartTemplatePrices(data, undefined, true, undefined);
  });
}

/**
 * Loads cart block by blockId
 *
 * @param blockID
 */
function loadCartBlock(blockID) {
  var promise = $.ajax({
    type: 'POST',
    url: '/ajax/cart/loadCartBlock',
    data: {blockId: blockID},
    dataType: "json"
  });

  promise.done(function (data) {
    if(data['success']) {
      $('.cart-block').fadeOut();
      $('.cart .container .cart-blocks').html(data['html']);
      $('.cart-block').fadeIn();
    }
  });
}

/**
 * Validates quantity input data in the cart
 */
function validateQuantityInputData(input) {
  var inputVal = input.val();
  var reg = new RegExp(/^\d+$/);
  return !(!reg.test(inputVal) || parseInt(inputVal) <= 0);
}

$(document).ready(function () {
  loadReviews(2, false);

  //load first cart block with cart product
  loadCartBlock(0);

  $('.show-more-reviews').on('click', '#moreReviews', function () {
    var lastDate;

    if (lastDate = localStorage.getItem('lastItemDate')) {
      loadReviews(1, lastDate);
    }
    document.getElementById('closeReviews').style.display = 'inline-block';
  });

  $('.show-more-reviews').on('click', '#closeReviews', function () {
    document.getElementById('reviews_items').innerHTML = '';
    document.getElementById('closeReviews').style.display = 'none';
    loadReviews(2, false);
  });



  $('.to-basket').on('click', '.to-basket-button', function () {
    changeCartQuantity('add', $(this).data('id'), undefined, false);
  });

  $('.cart-blocks').on('click', '.cart-products .plus-product', function () {
    changeCartQuantity('add', $(this).data('id'), undefined, true);
  });

  $('.cart-blocks').on('click', '.cart-products .minus-product', function () {
    if (parseInt($(this).siblings('.product-total-quantity').val()) === 1) {
      return false;
    }
    changeCartQuantity('delete', $(this).data('id'), undefined, true);
  });

  $('.cart-blocks').on('change', '.cart-products .product-total-quantity', function () {
    if (!validateQuantityInputData($(this))) {
      $(this).val(1);
    }
    changeCartQuantity('change', $(this).data('id'), $(this).val(), true);
  });

  $('.cart-blocks').on('click', '.cart-products .delete-row', function () {
    if (confirm("Are you sure you want to delete product from cart?")) {
      changeCartQuantity('delete-row', $(this).data('id'), undefined, true);
    } else {
      return false;
    }
  });

  $('.cart-blocks').on('focus', '.delivery input[type=radio]', function () {
    setDeliveryMethod($(this).data('id'));
  });

  $('.cart-blocks').on('click', '#submit_cart_products', function () {
    loadCartBlock(1);
  })
});