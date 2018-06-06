@foreach($reviews as $review)
    <div class="review">
        <div class="review-info">
            Datum: <span class="review-date">{{ $review['created_at'] }}</span><br>
            Autor: <span class="review-author">{{ $review['name'] }}</span>
        </div>
        <div class="review-comment">
            <p>{{ $review['text'] }}</p>
        </div>
        <hr>
    </div>
@endforeach