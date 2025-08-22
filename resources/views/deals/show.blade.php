@extends('layouts.app')

@section('title', $deal->title . ' - Deal Details')

@section('content')
<div class="container">
    <div class="row">
        <!-- Deal Details -->
        <div class="col-lg-8">
            <div class="card">
                <div class="position-relative">
                    @if($deal->featured)
                        <div class="badge bg-warning text-dark position-absolute" style="top: 15px; left: 15px; z-index: 10;">
                            <i class="fas fa-star me-1"></i>Featured Deal
                        </div>
                    @endif
                    
                    @if($deal->discount_percentage > 0)
                        <div class="badge bg-danger position-absolute" style="top: 15px; right: 15px; z-index: 10; font-size: 1.2em;">
                            {{ (int)$deal->discount_percentage }}% OFF
                        </div>
                    @endif

                    @if($deal->image)
                        <img src="{{ asset('storage/' . $deal->image) }}" class="card-img-top" style="height: 400px; object-fit: cover;" alt="{{ $deal->title }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 400px;">
                            <i class="fas fa-image text-muted" style="font-size: 5rem;"></i>
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h1 class="card-title">{{ $deal->title }}</h1>
                            
                            <div class="mb-3">
                                <span class="badge bg-secondary me-2">{{ ucfirst($deal->category) }}</span>
                                @if($deal->merchant_name)
                                    <span class="badge bg-info me-2">{{ $deal->merchant_name }}</span>
                                @endif
                                <span class="badge bg-success">{{ ucfirst($deal->status) }}</span>
                            </div>

                            @if($deal->short_description)
                                <p class="lead">{{ $deal->short_description }}</p>
                            @endif

                            <div class="mb-4">
                                <h5>Description</h5>
                                <p>{{ $deal->description }}</p>
                            </div>

                            @if($deal->terms_conditions)
                                <div class="mb-4">
                                    <h5>Terms & Conditions</h5>
                                    <p class="text-muted small">{{ $deal->terms_conditions }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Deal Price</h5>
                                    
                                    @if($deal->original_price != $deal->deal_price)
                                        <p class="text-muted mb-1">
                                            <span style="text-decoration: line-through; font-size: 1.2em;">
                                                ${{ number_format($deal->original_price, 2) }}
                                            </span>
                                        </p>
                                    @endif
                                    
                                    <p class="text-danger mb-3" style="font-size: 2.5rem; font-weight: bold;">
                                        ${{ number_format($deal->deal_price, 2) }}
                                    </p>
                                    
                                    @if($deal->savings > 0)
                                        <p class="text-success mb-3">
                                            <strong>You Save: ${{ number_format($deal->savings, 2) }}</strong>
                                        </p>
                                    @endif

                                    @if($deal->merchant_website)
                                        <a href="{{ $deal->merchant_website }}" target="_blank" class="btn btn-primary btn-lg w-100 mb-3">
                                            <i class="fas fa-external-link-alt me-2"></i>Get This Deal
                                        </a>
                                    @else
                                        <button class="btn btn-primary btn-lg w-100 mb-3" disabled>
                                            <i class="fas fa-tag me-2"></i>Deal Available
                                        </button>
                                    @endif

                                    <div class="text-muted small">
                                        <div class="mb-2">
                                            <i class="fas fa-calendar me-1"></i>
                                            <strong>Valid Until:</strong><br>
                                            {{ $deal->end_date->format('F j, Y g:i A') }}
                                        </div>
                                        
                                        <div class="mb-2">
                                            <i class="fas fa-eye me-1"></i>
                                            <strong>Views:</strong> {{ $deal->view_count }}
                                        </div>

                                        @if($deal->isExpired())
                                            <div class="alert alert-danger mt-3">
                                                <i class="fas fa-exclamation-triangle me-1"></i>
                                                This deal has expired
                                            </div>
                                        @elseif($deal->end_date->diffInDays(now()) <= 3)
                                            <div class="alert alert-warning mt-3">
                                                <i class="fas fa-clock me-1"></i>
                                                Expires in {{ $deal->end_date->diffForHumans() }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Actions -->
            @auth
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Admin Actions</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('deals.edit', $deal) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit me-1"></i>Edit Deal
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-1"></i>Delete Deal
                        </button>
                    </div>
                </div>
            @endauth
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Related Deals -->
            @if($relatedDeals->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Related Deals</h5>
                    </div>
                    <div class="card-body">
                        @foreach($relatedDeals as $relatedDeal)
                            <div class="d-flex mb-3 pb-3 border-bottom">
                                <div class="flex-shrink-0 me-3">
                                    @if($relatedDeal->image)
                                        <img src="{{ asset('storage/' . $relatedDeal->image) }}" 
                                             class="rounded" style="width: 60px; height: 60px; object-fit: cover;" 
                                             alt="{{ $relatedDeal->title }}">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 60px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">
                                        <a href="{{ route('deals.show', $relatedDeal) }}" class="text-decoration-none">
                                            {{ Str::limit($relatedDeal->title, 50) }}
                                        </a>
                                    </h6>
                                    <p class="text-danger mb-0 fw-bold">${{ number_format($relatedDeal->deal_price, 2) }}</p>
                                    @if($relatedDeal->discount_percentage > 0)
                                        <small class="text-success">{{ (int)$relatedDeal->discount_percentage }}% OFF</small>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <a href="{{ route('deals.index', ['category' => $deal->category]) }}" class="btn btn-outline-primary btn-sm">
                            View All {{ ucfirst($deal->category) }} Deals
                        </a>
                    </div>
                </div>
            @endif

            <!-- Deal Statistics -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Deal Information</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h4 class="text-primary">{{ $deal->view_count }}</h4>
                            <small class="text-muted">Views</small>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success">${{ number_format($deal->savings, 2) }}</h4>
                            <small class="text-muted">Savings</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
@auth
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Deal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this deal? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="{{ route('deals.destroy', $deal) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Deal</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endauth
@endsection