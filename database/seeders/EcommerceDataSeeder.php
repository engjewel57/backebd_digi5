<?php
// database/seeders/EcommerceSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EcommerceHeroSection;
use App\Models\EcommerceFeature;
use App\Models\EcommerceProcessStep;
use App\Models\EcommerceDemoProject;
use App\Models\EcommerceClient;

class EcommerceDataSeeder extends Seeder
{
    public function run(): void
    {
        // Hero Section
        EcommerceHeroSection::create([
            'title' => 'আপনার স্বপ্নের ই-কমার্স সাইট',
            'subtitle' => 'বাংলাদেশের #১ ই-কমার্স সল্যুশন',
            'description' => 'সম্পূর্ণ কাস্টমাইজড, মোবাইল ফ্রেন্ডলি এবং SEO অপটিমাইজড',
            'cta1_text' => 'এখনই শুরু করুন',
            'cta2_text' => 'ডেমো দেখুন',
            'stats' => [
                ['number' => '৫০০+', 'label' => 'সফল প্রজেক্ট'],
                ['number' => '৯৯%', 'label' => 'ক্লায়েন্ট স্যাটিসফ্যাকশন'],
                ['number' => '২৪/৭', 'label' => 'সাপোর্ট']
            ],
            'is_active' => true
        ]);

        // Features
        $features = [
            ['title' => 'দ্রুত লোডিং', 'description' => 'অত্যাধুনিক প্রযুক্তি', 'icon' => 'Zap', 'gradient' => 'from-yellow-500 to-orange-600', 'icon_bg' => 'bg-yellow-100', 'display_order' => 1],
            ['title' => 'নিরাপদ পেমেন্ট', 'description' => 'SSL সার্টিফিকেট', 'icon' => 'Shield', 'gradient' => 'from-green-500 to-emerald-600', 'icon_bg' => 'bg-green-100', 'display_order' => 2],
            ['title' => 'মোবাইল ফ্রেন্ডলি', 'description' => 'সব ডিভাইসে পারফেক্ট', 'icon' => 'Globe', 'gradient' => 'from-blue-500 to-cyan-600', 'icon_bg' => 'bg-blue-100', 'display_order' => 3],
            ['title' => 'দ্রুত ডেলিভারি', 'description' => '৭ দিনে ওয়েবসাইট', 'icon' => 'Rocket', 'gradient' => 'from-purple-500 to-pink-600', 'icon_bg' => 'bg-purple-100', 'display_order' => 4],
            ['title' => 'SEO অপটিমাইজড', 'description' => 'গুগলে টপ র‍্যাংকিং', 'icon' => 'Sparkles', 'gradient' => 'from-red-500 to-pink-600', 'icon_bg' => 'bg-red-100', 'display_order' => 5],
            ['title' => '২৪/৭ সাপোর্ট', 'description' => 'সবসময় পাশে আছি', 'icon' => 'Clock', 'gradient' => 'from-indigo-500 to-blue-600', 'icon_bg' => 'bg-indigo-100', 'display_order' => 6],
        ];
        foreach ($features as $feature) {
            EcommerceFeature::create($feature);
        }

        // Process Steps
        $steps = [
            ['step_number' => '০১', 'title' => 'আলোচনা', 'description' => 'আপনার প্রয়োজন শুনি', 'gradient' => 'from-blue-500 to-cyan-600', 'icon_bg' => 'bg-blue-100', 'display_order' => 1],
            ['step_number' => '০২', 'title' => 'ডিজাইন', 'description' => 'সুন্দর UI তৈরি', 'gradient' => 'from-purple-500 to-pink-600', 'icon_bg' => 'bg-purple-100', 'display_order' => 2],
            ['step_number' => '০৩', 'title' => 'ডেভেলপমেন্ট', 'description' => 'কোডিং শুরু', 'gradient' => 'from-green-500 to-emerald-600', 'icon_bg' => 'bg-green-100', 'display_order' => 3],
            ['step_number' => '০৪', 'title' => 'ডেলিভারি', 'description' => 'লাইভ করা', 'gradient' => 'from-orange-500 to-red-600', 'icon_bg' => 'bg-orange-100', 'display_order' => 4],
        ];
        foreach ($steps as $step) {
            EcommerceProcessStep::create($step);
        }

        // Demo Projects
        $projects = [
            ['title' => 'ফ্যাশন স্টোর', 'description' => 'অনলাইন কাপড়ের দোকান', 'image_url' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=400', 'gradient' => 'from-pink-500 to-rose-600', 'display_order' => 1],
            ['title' => 'ইলেকট্রনিক্স শপ', 'description' => 'গ্যাজেট বিক্রয়', 'image_url' => 'https://images.unsplash.com/photo-1498049794561-7780e7231661?w=400', 'gradient' => 'from-blue-500 to-cyan-600', 'display_order' => 2],
            ['title' => 'ফুড ডেলিভারি', 'description' => 'খাবার অর্ডার', 'image_url' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=400', 'gradient' => 'from-orange-500 to-red-600', 'display_order' => 3],
            ['title' => 'বুক স্টোর', 'description' => 'অনলাইন বই বিক্রয়', 'image_url' => 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=400', 'gradient' => 'from-purple-500 to-indigo-600', 'display_order' => 4],
            ['title' => 'কসমেটিক্স', 'description' => 'সৌন্দর্য পণ্য', 'image_url' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=400', 'gradient' => 'from-pink-500 to-purple-600', 'display_order' => 5],
            ['title' => 'ফার্নিচার', 'description' => 'ঘরের সাজ', 'image_url' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400', 'gradient' => 'from-amber-500 to-orange-600', 'display_order' => 6],
        ];
        foreach ($projects as $project) {
            EcommerceDemoProject::create($project);
        }

        // Clients
        $clients = [
            ['name' => 'Daraz', 'domain' => 'daraz.com.bd', 'display_order' => 1],
            ['name' => 'Chaldal', 'domain' => 'chaldal.com', 'display_order' => 2],
            ['name' => 'Shwapno', 'domain' => 'shwapno.com', 'display_order' => 3],
            ['name' => 'ACI', 'domain' => 'aci-bd.com', 'display_order' => 4],
        ];
        foreach ($clients as $client) {
            EcommerceClient::create($client);
        }

        echo "✅ Ecommerce data seeded successfully!\n";
    }
}