<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Deal::query();

        // Filter by category
        if ($request->filled('category')) {
            $query->category($request->category);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('merchant_name', 'like', "%{$search}%");
            });
        }

        // Only show active deals for public view
        $query->active();

        // Order by featured first, then by created date
        $deals = $query->orderBy('featured', 'desc')
                      ->orderBy('created_at', 'desc')
                      ->paginate(12);

        $categories = Deal::distinct()->pluck('category');

        return view('deals.index', compact('deals', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('deals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'original_price' => 'required|numeric|min:0',
            'deal_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'merchant_name' => 'nullable|string|max:255',
            'merchant_website' => 'nullable|url',
            'terms_conditions' => 'nullable|string',
            'featured' => 'boolean'
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('deals', 'public');
        }

        Deal::create($data);

        return redirect()->route('deals.index')->with('success', 'Deal created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deal $deal)
    {
        // Increment view count
        $deal->incrementViewCount();

        // Get related deals (same category, excluding current deal)
        $relatedDeals = Deal::active()
                           ->category($deal->category)
                           ->where('id', '!=', $deal->id)
                           ->limit(4)
                           ->get();

        return view('deals.show', compact('deal', 'relatedDeals'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal)
    {
        return view('deals.edit', compact('deal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deal $deal)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'original_price' => 'required|numeric|min:0',
            'deal_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'merchant_name' => 'nullable|string|max:255',
            'merchant_website' => 'nullable|url',
            'terms_conditions' => 'nullable|string',
            'featured' => 'boolean'
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($deal->image) {
                Storage::disk('public')->delete($deal->image);
            }
            $data['image'] = $request->file('image')->store('deals', 'public');
        }

        $deal->update($data);

        return redirect()->route('deals.index')->with('success', 'Deal updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal)
    {
        // Delete image if exists
        if ($deal->image) {
            Storage::disk('public')->delete($deal->image);
        }

        $deal->delete();

        return redirect()->route('deals.index')->with('success', 'Deal deleted successfully!');
    }

    /**
     * Display featured deals for homepage
     */
    public function featured()
    {
        $featuredDeals = Deal::active()->featured()->limit(6)->get();
        return view('deals.featured', compact('featuredDeals'));
    }
}
