<?php

namespace Database\Seeders;

use App\Models\Deal;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deals = [
            [
                'title' => 'MacBook Pro 16" - 50% Off Limited Time',
                'description' => 'Get the latest MacBook Pro 16" with M2 chip at an amazing discount. Perfect for developers, designers, and creative professionals. Features 16GB RAM, 512GB SSD, and stunning Retina display.',
                'short_description' => 'Latest MacBook Pro with M2 chip at 50% off',
                'original_price' => 2499.00,
                'deal_price' => 1249.50,
                'category' => 'electronics',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(30),
                'status' => 'active',
                'merchant_name' => 'Apple Store',
                'merchant_website' => 'https://apple.com',
                'terms_conditions' => 'Limited time offer. Valid for new customers only. Cannot be combined with other offers.',
                'featured' => true,
            ],
            [
                'title' => 'Nike Air Jordan Sneakers - Up to 40% Off',
                'description' => 'Step up your style with authentic Nike Air Jordan sneakers. Available in multiple colors and sizes. Premium quality materials and iconic design.',
                'short_description' => 'Authentic Nike Air Jordan sneakers with huge savings',
                'original_price' => 189.99,
                'deal_price' => 113.99,
                'category' => 'clothing',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(15),
                'status' => 'active',
                'merchant_name' => 'Nike',
                'merchant_website' => 'https://nike.com',
                'terms_conditions' => 'While supplies last. Free shipping on orders over $50.',
                'featured' => true,
            ],
            [
                'title' => 'Samsung 65" 4K Smart TV - Incredible Deal',
                'description' => 'Experience entertainment like never before with this Samsung 65" 4K Smart TV. Features HDR10+, built-in streaming apps, and voice control.',
                'short_description' => 'Samsung 65" 4K Smart TV with streaming apps',
                'original_price' => 1299.99,
                'deal_price' => 799.99,
                'category' => 'electronics',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(20),
                'status' => 'active',
                'merchant_name' => 'Samsung',
                'merchant_website' => 'https://samsung.com',
                'terms_conditions' => 'Free delivery and installation included.',
                'featured' => false,
            ],
            [
                'title' => 'Instant Pot 8-Quart Pressure Cooker',
                'description' => 'Cook faster and healthier meals with this versatile 8-quart Instant Pot. 7-in-1 functionality including pressure cooker, slow cooker, rice cooker, and more.',
                'short_description' => '8-quart Instant Pot with 7-in-1 functionality',
                'original_price' => 149.99,
                'deal_price' => 89.99,
                'category' => 'home',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(25),
                'status' => 'active',
                'merchant_name' => 'Kitchen Essentials',
                'merchant_website' => 'https://kitchenessentials.com',
                'terms_conditions' => '1-year warranty included. Recipe book included.',
                'featured' => false,
            ],
            [
                'title' => 'Premium Coffee Subscription - 3 Months',
                'description' => 'Enjoy freshly roasted premium coffee delivered to your door. Choose from various blends and roast levels. Perfect for coffee enthusiasts.',
                'short_description' => '3-month premium coffee subscription service',
                'original_price' => 89.99,
                'deal_price' => 59.99,
                'category' => 'food',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(10),
                'status' => 'active',
                'merchant_name' => 'Artisan Coffee Co.',
                'merchant_website' => 'https://artisancoffee.com',
                'terms_conditions' => 'Free shipping included. Can cancel anytime.',
                'featured' => true,
            ],
            [
                'title' => 'Bestselling Fiction Book Bundle',
                'description' => 'Collection of 10 bestselling fiction books from award-winning authors. Perfect for book lovers and makes a great gift.',
                'short_description' => '10 bestselling fiction books in one bundle',
                'original_price' => 199.99,
                'deal_price' => 79.99,
                'category' => 'books',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(45),
                'status' => 'active',
                'merchant_name' => 'BookWorld',
                'merchant_website' => 'https://bookworld.com',
                'terms_conditions' => 'Physical books only. Free shipping worldwide.',
                'featured' => false,
            ],
            [
                'title' => 'Yoga Mat & Accessories Set',
                'description' => 'Complete yoga set including premium non-slip mat, blocks, strap, and carrying bag. Perfect for beginners and experienced practitioners.',
                'short_description' => 'Complete yoga set with mat and accessories',
                'original_price' => 79.99,
                'deal_price' => 49.99,
                'category' => 'sports',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(30),
                'status' => 'active',
                'merchant_name' => 'Fitness Plus',
                'merchant_website' => 'https://fitnessplus.com',
                'terms_conditions' => 'Eco-friendly materials. 30-day money-back guarantee.',
                'featured' => false,
            ],
            [
                'title' => 'Weekend Getaway Package - Beach Resort',
                'description' => 'Relax and unwind with this weekend getaway package at a luxury beach resort. Includes accommodation, breakfast, and spa access.',
                'short_description' => 'Luxury beach resort weekend package',
                'original_price' => 599.99,
                'deal_price' => 349.99,
                'category' => 'travel',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(14),
                'status' => 'active',
                'merchant_name' => 'Paradise Resorts',
                'merchant_website' => 'https://paradiseresorts.com',
                'terms_conditions' => 'Valid for weekends only. Subject to availability.',
                'featured' => true,
            ],
        ];

        foreach ($deals as $dealData) {
            Deal::create($dealData);
        }
    }
}
