@extends('layouts.app')

@section('title', 'Featured Deals - Deals Website')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="mb-3">
                <i class="fas fa-star text-warning me-2"></i>
                Featured Deals
            </h1>
            <p class="text-muted">Hand-picked deals with the best savings and highest quality</p>
        </div>
    </div>

    @if($featuredDeals->count() > 0)
        <div class="row">
            @foreach($featuredDeals as $deal)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card deal-card h-100 position-relative shadow">
                        <!-- Featured Badge -->
                        <div class="badge bg-warning text-dark position-absolute" style="top: 10px; left: 10px; z-index: 10;">
                            <i class="fas fa-star me-1"></i>Featured
                        </div>
                        
                        @if($deal->discount_percentage > 0)
                            <div class="badge bg-danger discount-badge">
                                {{ (int)$deal->discount_percentage }}% OFF
                            </div>
                        @endif

                        @if($deal->image)
                            <img src="{{ asset('storage/' . $deal->image) }}" class="card-img-top deal-image" alt="{{ $deal->title }}">
                        @else
                            <div class="deal-image bg-light d-flex align-items-center justify-content-center">
                                <i class="fas fa-image text-muted fa-3x"></i>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="badge bg-secondary">{{ ucfirst($deal->category) }}</span>
                                @if($deal->merchant_name)
                                    <span class="badge bg-info">{{ $deal->merchant_name }}</span>
                                @endif
                            </div>

                            <h5 class="card-title">{{ $deal->title }}</h5>
                            
                            @if($deal->short_description)
                                <p class="card-text text-muted">{{ Str::limit($deal->short_description, 100) }}</p>
                            @endif

                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        @if($deal->original_price != $deal->deal_price)
                                            <span class="price-original">${{ number_format($deal->original_price, 2) }}</span>
                                        @endif
                                        <span class="price-deal fs-4">${{ number_format($deal->deal_price, 2) }}</span>
                                    </div>
                                    @if($deal->savings > 0)
                                        <small class="text-success fw-bold">Save ${{ number_format($deal->savings, 2) }}</small>
                                    @endif
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        Expires {{ $deal->end_date->format('M j, Y') }}
                                    </small>
                                    <a href="{{ route('deals.show', $deal) }}" class="btn btn-primary btn-sm">
                                        View Deal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- CTA Section -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <div class="card bg-primary text-white">
                    <div class="card-body py-4">
                        <h3>Want to see more deals?</h3>
                        <p class="mb-3">Browse our complete collection of deals across all categories</p>
                        <a href="{{ route('deals.index') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-tags me-2"></i>View All Deals
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-star fa-3x text-muted mb-3"></i>
                    <h3>No Featured Deals Available</h3>
                    <p class="text-muted mb-4">There are currently no featured deals. Check back soon or browse all deals.</p>
                    <div>
                        <a href="{{ route('deals.index') }}" class="btn btn-primary me-3">
                            <i class="fas fa-tags me-2"></i>View All Deals
                        </a>
                        @auth
                            <a href="{{ route('deals.create') }}" class="btn btn-outline-primary">
                                <i class="fas fa-plus me-2"></i>Add Deal
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection