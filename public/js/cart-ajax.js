function loadCartBlock(blockID) {
  var promise = $.ajax({
    type: 'POST',
    url: '/ajax/cart/loadCartBlock',
    data: {blockId: blockID},
    dataType: "json"
  });

  promise.done(function (data) {
    if(data['success']) {
      $('.cart .container .cart-blocks').html(data['html']);
      $('.cart-block').fadeIn();
    }
  });
}

$(document).ready(function () {
  loadCartBlock(0);


});