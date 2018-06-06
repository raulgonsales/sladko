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
});