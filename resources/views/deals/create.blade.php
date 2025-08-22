@extends('layouts.app')

@section('title', 'Create New Deal')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-plus me-2"></i>Create New Deal
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('deals.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Basic Information -->
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="title" class="form-label">Deal Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select @error('category') is-invalid @enderror" 
                                        id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="electronics" {{ old('category') == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                    <option value="clothing" {{ old('category') == 'clothing' ? 'selected' : '' }}>Clothing</option>
                                    <option value="home" {{ old('category') == 'home' ? 'selected' : '' }}>Home & Garden</option>
                                    <option value="books" {{ old('category') == 'books' ? 'selected' : '' }}>Books</option>
                                    <option value="sports" {{ old('category') == 'sports' ? 'selected' : '' }}>Sports</option>
                                    <option value="food" {{ old('category') == 'food' ? 'selected' : '' }}>Food & Dining</option>
                                    <option value="travel" {{ old('category') == 'travel' ? 'selected' : '' }}>Travel</option>
                                    <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>General</option>
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
                                      placeholder="Brief description for deal cards">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Full Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Full Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
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
                                           id="original_price" name="original_price" value="{{ old('original_price') }}" required>
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
                                           id="deal_price" name="deal_price" value="{{ old('deal_price') }}" required>
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
                                       id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" 
                                       id="end_date" name="end_date" value="{{ old('end_date') }}" required>
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
                                       id="merchant_name" name="merchant_name" value="{{ old('merchant_name') }}">
                                @error('merchant_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="merchant_website" class="form-label">Merchant Website</label>
                                <input type="url" class="form-control @error('merchant_website') is-invalid @enderror" 
                                       id="merchant_website" name="merchant_website" value="{{ old('merchant_website') }}" 
                                       placeholder="https://example.com">
                                @error('merchant_website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Deal Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            <div class="form-text">Upload an image for your deal (JPEG, PNG, JPG, GIF - Max 2MB)</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="mb-3">
                            <label for="terms_conditions" class="form-label">Terms & Conditions</label>
                            <textarea class="form-control @error('terms_conditions') is-invalid @enderror" 
                                      id="terms_conditions" name="terms_conditions" rows="3">{{ old('terms_conditions') }}</textarea>
                            @error('terms_conditions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deal Status -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mt-4">
                                    <input type="hidden" name="featured" value="0">
                                    <input class="form-check-input" type="checkbox" value="1" 
                                           id="featured" name="featured" {{ old('featured') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featured">
                                        Featured Deal
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('deals.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Create Deal
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