@extends('layouts.app')
@section('title')
    Online shopping | Reviews Seller
@endsection

@section('content')
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Reviews Seller</h3>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <div class="section">
        <!-- container -->
        <div class="container">
            <div class="row">
                <div id="tab3" class="tab-pane fade in">
                    <div class="row">
                        <!-- Reviews -->
                        <div class="col-md-8" style="margin-left:5%">
                        
                            @foreach ($reviews as $review)
                            <div id="reviews">
                                    <ul class="reviews">
                                        <li>
                                            <div class="review-heading">
                                                <h5 class="name">{{ $review->nickname }}</h5>
                                                <p class="date">{{ $review->created_at }}</p>
                                                <div class="review-rating">Rating:
                                                    {{ $review->review }}/10
                                                </div>
                                            </div>
                                            <div class="review-body">
                                                <p> {{ $review->comment }}</p>
                                            </div>

                                        </li>
                                    </ul>   
                            </div>
                            @endforeach
                            {!! $reviews->links('pagination::bootstrap-4') !!}
                          
                        </div>
                        @if (Auth::check())
                        @if (($sellerId != Auth::user()->id) && $countReviews == 0)
                        
                        <div class="col-md-3" style="margin-top:-35px;margin-left:-10%;">
                            <div id="review-form">
                                <form method="POST" action="{{ route('reviewsSeller', $sellerId) }}">
                                    @csrf
                                    <textarea id="comment" name="comment" class="input" placeholder="Your Review"></textarea>
                                    <div class="input-rating" style="margin-left: 15px">
                                        <span>Your Rating: </span>
                                        <div class="stars" style="margin-top: -7px">
                                            <input id="review" name="review" min="0" max="10"
                                                type="number">
                                            /10
                                            <button class="buttonRegister" style="margin-left:10px;">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
