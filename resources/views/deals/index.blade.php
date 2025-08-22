@extends('layouts.app')

@section('title', 'All Deals - Deals Website')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="mb-3">
                <i class="fas fa-fire text-danger me-2"></i>
                Hot Deals
            </h1>
            <p class="text-muted">Discover amazing deals and save money on your favorite products</p>
        </div>
        <div class="col-md-4 text-md-end">
            @auth
                <a href="{{ route('deals.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New Deal
                </a>
            @endauth
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('deals.index') }}" class="row g-3">
                        <div class="col-md-6">
                            <label for="search" class="form-label">Search Deals</label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   value="{{ request('search') }}" placeholder="Search by title, description, or merchant...">
                        </div>
                        <div class="col-md-4">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                        {{ ucfirst($cat) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-search me-1"></i>Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Deals Grid -->
    @if($deals->count() > 0)
        <div class="row">
            @foreach($deals as $deal)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card deal-card h-100 position-relative">
                        @if($deal->featured)
                            <div class="badge bg-warning text-dark position-absolute" style="top: 10px; left: 10px; z-index: 10;">
                                <i class="fas fa-star me-1"></i>Featured
                            </div>
                        @endif
                        
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
                                        <small class="text-success">Save ${{ number_format($deal->savings, 2) }}</small>
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

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $deals->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <h3>No deals found</h3>
            <p class="text-muted">Try adjusting your search criteria or check back later for new deals.</p>
            @auth
                <a href="{{ route('deals.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add First Deal
                </a>
            @endauth
        </div>
    @endif
</div>
@endsection