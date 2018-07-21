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
 * Add product to cart.
 * @param id Id of product
 */
function addToCart(id) {
  var promise = $.ajax({
    type: 'POST',
    url: '/ajax/cart/add',
    data: {productId: parseInt(id)},
    dataType: 'json'
  });

  promise.done(function (data) {
    var cart = $(document.getElementById('shopping_cart'));

    cart.find('.total-count span').html(data.totalQuantity);
    cart.find('.total-price span').html(data.totalPrice);
  });
}

$(document).ready(function () {
  loadReviews(2, false);

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
    addToCart($(this).data('id'));
  });
});