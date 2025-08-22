@extends('layouts.app')

@section('title', 'Edit Deal - ' . $deal->title)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Deal: {{ $deal->title }}
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('deals.update', $deal) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Basic Information -->
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="title" class="form-label">Deal Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $deal->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select @error('category') is-invalid @enderror" 
                                        id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="electronics" {{ old('category', $deal->category) == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                    <option value="clothing" {{ old('category', $deal->category) == 'clothing' ? 'selected' : '' }}>Clothing</option>
                                    <option value="home" {{ old('category', $deal->category) == 'home' ? 'selected' : '' }}>Home & Garden</option>
                                    <option value="books" {{ old('category', $deal->category) == 'books' ? 'selected' : '' }}>Books</option>
                                    <option value="sports" {{ old('category', $deal->category) == 'sports' ? 'selected' : '' }}>Sports</option>
                                    <option value="food" {{ old('category', $deal->category) == 'food' ? 'selected' : '' }}>Food & Dining</option>
                                    <option value="travel" {{ old('category', $deal->category) == 'travel' ? 'selected' : '' }}>Travel</option>
                                    <option value="general" {{ old('category', $deal->category) == 'general' ? 'selected' : '' }}>General</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Short Description -->
                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short Description</label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                      id="short_description" name="short_description" rows="2" 
                                      placeholder="Brief description for deal cards">{{ old('short_description', $deal->short_description) }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Full Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Full Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required>{{ old('description', $deal->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pricing -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="original_price" class="form-label">Original Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" min="0" 
                                           class="form-control @error('original_price') is-invalid @enderror" 
                                           id="original_price" name="original_price" value="{{ old('original_price', $deal->original_price) }}" required>
                                    @error('original_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="deal_price" class="form-label">Deal Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" min="0" 
                                           class="form-control @error('deal_price') is-invalid @enderror" 
                                           id="deal_price" name="deal_price" value="{{ old('deal_price', $deal->deal_price) }}" required>
                                    @error('deal_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Deal Duration -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" 
                                       id="start_date" name="start_date" value="{{ old('start_date', $deal->start_date->format('Y-m-d\TH:i')) }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" 
                                       id="end_date" name="end_date" value="{{ old('end_date', $deal->end_date->format('Y-m-d\TH:i')) }}" required>
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Merchant Information -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="merchant_name" class="form-label">Merchant Name</label>
                                <input type="text" class="form-control @error('merchant_name') is-invalid @enderror" 
                                       id="merchant_name" name="merchant_name" value="{{ old('merchant_name', $deal->merchant_name) }}">
                                @error('merchant_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="merchant_website" class="form-label">Merchant Website</label>
                                <input type="url" class="form-control @error('merchant_website') is-invalid @enderror" 
                                       id="merchant_website" name="merchant_website" value="{{ old('merchant_website', $deal->merchant_website) }}" 
                                       placeholder="https://example.com">
                                @error('merchant_website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Current Image Display -->
                        @if($deal->image)
                            <div class="mb-3">
                                <label class="form-label">Current Image</label>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $deal->image) }}" alt="{{ $deal->title }}" 
                                         class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                    <div class="ms-3">
                                        <p class="mb-0">Current deal image</p>
                                        <small class="text-muted">Upload a new image to replace this one</small>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Deal Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            <div class="form-text">Upload a new image for your deal (JPEG, PNG, JPG, GIF - Max 2MB)</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="mb-3">
                            <label for="terms_conditions" class="form-label">Terms & Conditions</label>
                            <textarea class="form-control @error('terms_conditions') is-invalid @enderror" 
                                      id="terms_conditions" name="terms_conditions" rows="3">{{ old('terms_conditions', $deal->terms_conditions) }}</textarea>
                            @error('terms_conditions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deal Status -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="active" {{ old('status', $deal->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $deal->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="expired" {{ old('status', $deal->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mt-4">
                                    <input type="hidden" name="featured" value="0">
                                    <input class="form-check-input" type="checkbox" value="1" 
                                           id="featured" name="featured" {{ old('featured', $deal->featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featured">
                                        Featured Deal
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Deal Statistics -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">Deal Statistics</h6>
                                        <div class="row text-center">
                                            <div class="col-md-4">
                                                <h5 class="text-primary">{{ $deal->view_count }}</h5>
                                                <small class="text-muted">Total Views</small>
                                            </div>
                                            <div class="col-md-4">
                                                <h5 class="text-success">${{ number_format($deal->savings, 2) }}</h5>
                                                <small class="text-muted">Customer Savings</small>
                                            </div>
                                            <div class="col-md-4">
                                                <h5 class="text-info">{{ $deal->created_at->diffForHumans() }}</h5>
                                                <small class="text-muted">Created</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('deals.show', $deal) }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Back to Deal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Update Deal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Calculate discount percentage automatically
    document.addEventListener('DOMContentLoaded', function() {
        const originalPrice = document.getElementById('original_price');
        const dealPrice = document.getElementById('deal_price');
        
        function updateDiscount() {
            const original = parseFloat(originalPrice.value) || 0;
            const deal = parseFloat(dealPrice.value) || 0;
            
            if (original > 0 && deal > 0 && deal < original) {
                const discount = Math.round(((original - deal) / original) * 100);
                const savings = original - deal;
                
                // You could display this to the user if you wanted
                console.log(`Discount: ${discount}%, Savings: $${savings.toFixed(2)}`);
            }
        }
        
        originalPrice.addEventListener('input', updateDiscount);
        dealPrice.addEventListener('input', updateDiscount);
    });
</script>
@endpush