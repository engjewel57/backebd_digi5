<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PricingPlan;
use App\Models\ExtraService;
use App\Models\PlanComparison;

class PricingSeeder extends Seeder
{
    public function run(): void
    {
        // Pricing Plans
        PricingPlan::create([
            'name' => 'স্টার্টার',
            'type' => 'monthly',
            'subtitle' => 'ছোট ব্যবসার জন্য আদর্শ',
            'price' => 5000,
            'price_unit' => 'BDT',
            'price_period' => '/মাস',
            'features' => [
                '১টি ওয়েবসাইট/পেজ',
                'বেসিক ডিজাইন',
                '৫ GB হোস্টিং',
                'SSL সার্টিফিকেট',
                'মাসিক সাপোর্ট',
                '১টি ইমেইল একাউন্ট',
                'মোবাইল রেসপন্সিভ'
            ],
            'is_popular' => false,
            'display_order' => 1,
            'is_active' => true
        ]);

        PricingPlan::create([
            'name' => 'প্রফেশনাল',
            'type' => 'monthly',
            'subtitle' => 'বাড়ন্ত ব্যবসার জন্য সেরা',
            'price' => 10000,
            'price_unit' => 'BDT',
            'price_period' => '/মাস',
            'features' => [
                '৩টি ওয়েবসাইট/পেজ',
                'প্রিমিয়াম ডিজাইন',
                '২০ GB হোস্টিং',
                'SSL সার্টিফিকেট',
                '২৪/৭ সাপোর্ট',
                '৫টি ইমেইল একাউন্ট',
                'SEO অপটিমাইজেশন',
                'সোশ্যাল মিডিয়া ইন্টিগ্রেশন',
                'মাসিক রিপোর্ট'
            ],
            'is_popular' => true,
            'display_order' => 2,
            'is_active' => true
        ]);

        PricingPlan::create([
            'name' => 'এন্টারপ্রাইজ',
            'type' => 'monthly',
            'subtitle' => 'বড় প্রতিষ্ঠানের জন্য',
            'price' => 20000,
            'price_unit' => 'BDT',
            'price_period' => '/মাস',
            'features' => [
                'আনলিমিটেড ওয়েবসাইট/পেজ',
                'কাস্টম ডিজাইন',
                '৫০ GB হোস্টিং',
                'SSL সার্টিফিকেট',
                'প্রাইয়োরিটি ২৪/৭ সাপোর্ট',
                'আনলিমিটেড ইমেইল',
                'অ্যাডভান্স SEO',
                'ই-কমার্স ফিচার',
                'ডেডিকেটেড ম্যানেজার',
                'সাপ্তাহিক রিপোর্ট',
                'ফ্রি মেইনটেনেন্স'
            ],
            'is_popular' => false,
            'display_order' => 3,
            'is_active' => true
        ]);

        // Extra Services
        $services = [
            ['title' => 'ফেসবুক বুস্টিং', 'price' => 3000, 'unit' => '/মাস', 'display_order' => 1],
            ['title' => 'গ্রাফিক ডিজাইন প্যাকেজ', 'price' => 5000, 'unit' => '/মাস', 'display_order' => 2],
            ['title' => 'বাল্ক এসএমএস', 'price' => 0.25, 'unit' => '/এসএমএস', 'display_order' => 3],
            ['title' => 'চাটবট সেটআপ', 'price' => 8000, 'unit' => '/একবার', 'display_order' => 4],
            ['title' => 'ডোমেইন রেজিস্ট্রেশন', 'price' => 1200, 'unit' => '/বছর', 'display_order' => 5],
            ['title' => 'কন্টেন্ট রাইটিং', 'price' => 500, 'unit' => '/পোস্ট', 'display_order' => 6],
        ];

        foreach ($services as $service) {
            ExtraService::create($service);
        }

        // Plan Comparisons
        $comparisons = [
            ['feature_name' => 'ওয়েবসাইট সংখ্যা', 'starter_value' => '১টি', 'professional_value' => '৩টি', 'enterprise_value' => 'আনলিমিটেড'],
            ['feature_name' => 'হোস্টিং স্পেস', 'starter_value' => '৫ GB', 'professional_value' => '২০ GB', 'enterprise_value' => '৫০ GB'],
            ['feature_name' => 'ইমেইল একাউন্ট', 'starter_value' => '১টি', 'professional_value' => '৫টি', 'enterprise_value' => 'আনলিমিটেড'],
            ['feature_name' => 'সাপোর্ট', 'starter_value' => 'মাসিক', 'professional_value' => '২৪/৭', 'enterprise_value' => 'প্রাইয়োরিটি ২৪/৭'],
            ['feature_name' => 'SEO', 'starter_value' => '✗', 'professional_value' => '✓', 'enterprise_value' => '✓ অ্যাডভান্স'],
            ['feature_name' => 'ই-কমার্স', 'starter_value' => '✗', 'professional_value' => '✗', 'enterprise_value' => '✓'],
        ];

        foreach ($comparisons as $comparison) {
            PlanComparison::create($comparison);
        }
    }
}