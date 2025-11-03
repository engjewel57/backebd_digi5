<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogReview;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data to avoid duplicates
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        BlogReview::truncate();
        BlogPost::truncate();
        BlogCategory::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create Categories
        $categories = [
            [
                'name' => 'সোশ্যাল মিডিয়া',
                'slug' => 'social-media',
                'display_order' => 1,
                'is_active' => true
            ],
            [
                'name' => 'ই-কমার্স',
                'slug' => 'ecommerce',
                'display_order' => 2,
                'is_active' => true
            ],
            [
                'name' => 'ওয়েব ডেভেলপমেন্ট',
                'slug' => 'web-development',
                'display_order' => 3,
                'is_active' => true
            ],
            [
                'name' => 'বিজনেস কনসালটিং',
                'slug' => 'business-consulting',
                'display_order' => 4,
                'is_active' => true
            ],
            [
                'name' => 'ডিজিটাল মার্কেটিং',
                'slug' => 'digital-marketing',
                'display_order' => 5,
                'is_active' => true
            ],
            [
                'name' => 'চাটবট সেটআপ',
                'slug' => 'chatbot-setup',
                'display_order' => 6,
                'is_active' => true
            ],
            [
                'name' => 'ল্যান্ডিং পেজ',
                'slug' => 'landing-page',
                'display_order' => 7,
                'is_active' => true
            ],
            [
                'name' => 'গ্রাফিক ডিজাইন',
                'slug' => 'graphic-design',
                'display_order' => 8,
                'is_active' => true
            ]
        ];

        foreach ($categories as $category) {
            BlogCategory::create($category);
        }

        // Create Blog Posts
        $posts = [
            [
                'title' => 'ফেসবুক বুস্টিং দিয়ে আপনার ব্যবসা বাড়ান',
                'slug' => 'facebook-boosting-guide',
                'excerpt' => 'ফেসবুক বুস্টিং কীভাবে আপনার টার্গেটেড অডিয়েন্সে পৌঁছাতে এবং বিক্রয় বাড়াতে সাহায্য করতে পারে তা জানুন।',
                'content' => $this->getFacebookBoostingContent(),
                'category_id' => BlogCategory::where('slug', 'social-media')->first()->id,
                'author' => 'তানভীর হাসান',
                'image_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&h=600&q=80',
                'read_time' => '৫ মিনিট',
                'featured' => true,
                'is_active' => true,
                'display_order' => 1,
                'meta_title' => 'ফেসবুক বুস্টিং গাইড - এসএমই কিউব',
                'meta_description' => 'ফেসবুক বুস্টিং কীভাবে আপনার টার্গেটেড অডিয়েন্সে পৌঁছাতে এবং বিক্রয় বাড়াতে সাহায্য করতে পারে তা জানুন।',
                'meta_keywords' => 'ফেসবুক বুস্টিং, সোশ্যাল মিডিয়া মার্কেটিং, ফেসবুক অ্যাডস, ডিজিটাল মার্কেটিং',
                'og_image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&h=600&q=80',
                'sections' => $this->getFacebookBoostingSections(),
                'key_points' => [
                    'টার্গেটেড অডিয়েন্স রিচ',
                    'কস্ট-ইফেক্টিভ মার্কেটিং',
                    'রিয়েল-টাইম পারফরম্যান্স ট্র্যাকিং',
                    'হাই কনভার্শন রেট'
                ],
                'tips' => [
                    'সবসময় A/B টেস্টিং করুন',
                    'বিভিন্ন টাইম স্লটে টেস্ট করুন',
                    'আপনার কম্পিটিটর অ্যানালাইসিস করুন',
                    'রেগুলারলি আপনার স্ট্র্যাটেজি আপডেট করুন',
                    'মোবাইল ইউজারদের জন্য অপ্টিমাইজ করুন'
                ],
                'cta_title' => 'আপনার ব্যবসার জন্য ফেসবুক বুস্টিং শুরু করতে চান?',
                'cta_button_text' => 'সার্ভিস ডিটেইলস দেখুন',
                'cta_button_link' => '/services/facebook-boosting'
            ],
            [
                'title' => 'ই-কমার্স সলিউশন: অনলাইন ব্যবসার ভবিষ্যৎ',
                'slug' => 'ecommerce-solution',
                'excerpt' => 'আধুনিক ই-কমার্স প্ল্যাটফর্মের সুবিধা এবং কীভাবে এটি আপনার ব্যবসাকে রূপান্তরিত করতে পারে।',
                'content' => $this->getEcommerceContent(),
                'category_id' => BlogCategory::where('slug', 'ecommerce')->first()->id,
                'author' => 'সারাহ আহমেদ',
                'image_url' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&h=600&q=80',
                'read_time' => '৭ মিনিট',
                'featured' => true,
                'is_active' => true,
                'display_order' => 2,
                'meta_title' => 'ই-কমার্স সলিউশন গাইড - এসএমই কিউব',
                'meta_description' => 'আধুনিক ই-কমার্স প্ল্যাটফর্মের সুবিধা এবং কীভাবে এটি আপনার ব্যবসাকে রূপান্তরিত করতে পারে।',
                'meta_keywords' => 'ই-কমার্স, অনলাইন ব্যবসা, ইকমার্স প্ল্যাটফর্ম, ডিজিটাল মার্কেটিং',
                'og_image' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&h=600&q=80',
                'sections' => $this->getEcommerceSections(),
                'key_points' => [
                    'ইউজার-ফ্রেন্ডলি ডিজাইন',
                    'ফাস্ট লোডিং স্পিড',
                    'মোবাইল রেসপনসিভ',
                    'সিকিউর পেমেন্ট গেটওয়ে',
                    'এফিশিয়েন্ট ডেলিভারি সিস্টেম'
                ],
                'tips' => [
                    'কন্টেন্ট মার্কেটিং করুন',
                    'সোশ্যাল মিডিয়া মার্কেটিং ব্যবহার করুন',
                    'এসইও অপ্টিমাইজেশন করুন',
                    'ইমেল মার্কেটিং করুন',
                    'মোবাইল ফার্স্ট অ্যাপ্রোচ নিন'
                ],
                'cta_title' => 'আপনার ই-কমার্স ব্যবসা শুরু করতে চান?',
                'cta_button_text' => 'ই-কমার্স সার্ভিস দেখুন',
                'cta_button_link' => '/services/ecommerce-solution'
            ],
            [
                'title' => 'কেন আপনার ওয়েবসাইট রেসপন্সিভ হওয়া উচিত?',
                'slug' => 'responsive-web-design',
                'excerpt' => 'রেসপন্সিভ ওয়েব ডিজাইনের গুরুত্ব এবং এটি আপনার ব্যবসার জন্য কীভাবে উপকারী।',
                'content' => $this->getResponsiveDesignContent(),
                'category_id' => BlogCategory::where('slug', 'web-development')->first()->id,
                'author' => 'রাকিবুল ইসলাম',
                'image_url' => 'https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=600&q=80',
                'read_time' => '৬ মিনিট',
                'featured' => true,
                'is_active' => true,
                'display_order' => 3,
                'meta_title' => 'রেসপন্সিভ ওয়েব ডিজাইন গাইড - এসএমই কিউব',
                'meta_description' => 'রেসপন্সিভ ওয়েব ডিজাইনের গুরুত্ব এবং এটি আপনার ব্যবসার জন্য কীভাবে উপকারী।',
                'meta_keywords' => 'রেসপন্সিভ ডিজাইন, ওয়েব ডেভেলপমেন্ট, মোবাইল ফ্রেন্ডলি, ওয়েবসাইট',
                'og_image' => 'https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=600&q=80',
                'sections' => $this->getResponsiveDesignSections(),
                'key_points' => [
                    'মোবাইল ইউজার এক্সপেরিয়েন্স',
                    'সার্চ ইঞ্জিন অপ্টিমাইজেশন',
                    'ক্রস-ডিভাইস কম্প্যাটিবিলিটি',
                    'ইমপ্রুভড কনভার্শন রেট'
                ],
                'tips' => [
                    'মোবাইল-ফার্স্ট ডিজাইন করুন',
                    'ফ্লেক্সিবল গ্রিড ব্যবহার করুন',
                    'CSS Media Queries প্রয়োগ করুন',
                    'পারফরম্যান্স অপ্টিমাইজ করুন',
                    'রেগুলার টেস্টিং করুন'
                ],
                'cta_title' => 'আপনার ওয়েবসাইট রেসপন্সিভ করতে চান?',
                'cta_button_text' => 'ওয়েব ডেভেলপমেন্ট সার্ভিস',
                'cta_button_link' => '/services/web-development'
            ],
            [
                'title' => 'বিজনেস কনসালটিং: সফলতার পথে আপনার গাইড',
                'slug' => 'business-consulting-guide',
                'excerpt' => 'ব্যবসায়িক পরামর্শ কীভাবে আপনার কৌশল উন্নত করতে এবং লক্ষ্য অর্জনে সহায়তা করে।',
                'content' => $this->getBusinessConsultingContent(),
                'category_id' => BlogCategory::where('slug', 'business-consulting')->first()->id,
                'author' => 'ফারিয়া রহমান',
                'image_url' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=600&q=80',
                'read_time' => '৮ মিনিট',
                'featured' => true,
                'is_active' => true,
                'display_order' => 4,
                'meta_title' => 'বিজনেস কনসালটিং গাইড - এসএমই কিউব',
                'meta_description' => 'ব্যবসায়িক পরামর্শ কীভাবে আপনার কৌশল উন্নত করতে এবং লক্ষ্য অর্জনে সহায়তা করে।',
                'meta_keywords' => 'বিজনেস কনসালটিং, ব্যবসায়িক পরামর্শ, স্ট্র্যাটেজি প্ল্যানিং, বিজনেস গ্রোথ',
                'og_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=600&q=80',
                'sections' => $this->getBusinessConsultingSections(),
                'key_points' => [
                    'স্ট্র্যাটেজিক প্ল্যানিং',
                    'মার্কেট অ্যানালাইসিস',
                    'ফাইনান্সিয়াল ম্যানেজমেন্ট',
                    'অপারেশনাল অপ্টিমাইজেশন'
                ],
                'tips' => [
                    'ক্লিয়ার গোল সেট করুন',
                    'ডেটা-ড্রিভেন ডিসিশন নিন',
                    'রেগুলার রিভিউ করুন',
                    'এডাপ্ট টু মার্কেট চেঞ্জ',
                    'ইনভেস্ট ইন টিম ডেভেলপমেন্ট'
                ],
                'cta_title' => 'আপনার ব্যবসার জন্য কনসালটিং চান?',
                'cta_button_text' => 'কনসালটিং সার্ভিস',
                'cta_button_link' => '/services/business-consulting'
            ],
            [
                'title' => 'ডিজিটাল মার্কেটিং: ২০২৫ এর ট্রেন্ড',
                'slug' => 'digital-marketing-trends',
                'excerpt' => 'ডিজিটাল মার্কেটিংয়ের সর্বশেষ ট্রেন্ড এবং কীভাবে সেগুলো আপনার ব্যবসার জন্য কাজে লাগাবেন।',
                'content' => $this->getDigitalMarketingContent(),
                'category_id' => BlogCategory::where('slug', 'digital-marketing')->first()->id,
                'author' => 'নুসরাত জাহান',
                'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=600&q=80',
                'read_time' => '১০ মিনিট',
                'featured' => false,
                'is_active' => true,
                'display_order' => 5,
                'meta_title' => 'ডিজিটাল মার্কেটিং ট্রেন্ডস ২০২৫ - এসএমই কিউব',
                'meta_description' => 'ডিজিটাল মার্কেটিংয়ের সর্বশেষ ট্রেন্ড এবং কীভাবে সেগুলো আপনার ব্যবসার জন্য কাজে লাগাবেন।',
                'meta_keywords' => 'ডিজিটাল মার্কেটিং, মার্কেটিং ট্রেন্ডস, অনলাইন মার্কেটিং, ডিজিটাল স্ট্র্যাটেজি',
                'og_image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=600&q=80',
                'sections' => $this->getDigitalMarketingSections(),
                'key_points' => [
                    'AI-পাওয়ার্ড মার্কেটিং',
                    'ভিডিও কন্টেন্ট ডোমিনেন্স',
                    'পার্সোনালাইজেশন',
                    'ভয়েস সার্চ অপ্টিমাইজেশন'
                ],
                'tips' => [
                    'ভিডিও কন্টেন্ট ফোকাস করুন',
                    'AI টুলস ব্যবহার করুন',
                    'মোবাইল অপ্টিমাইজ করুন',
                    'ডেটা অ্যানালিটিক্স ব্যবহার করুন',
                    'অটোমেশন ইমপ্লিমেন্ট করুন'
                ],
                'cta_title' => 'আপনার মার্কেটিং প্ল্যান রেডি করুন',
                'cta_button_text' => 'মার্কেটিং সার্ভিস',
                'cta_button_link' => '/services/digital-marketing'
            ],
            [
                'title' => 'চাটবট সেটআপের মাধ্যমে কাস্টমার সাপোর্ট উন্নত করুন',
                'slug' => 'chatbot-setup-guide',
                'excerpt' => 'অটোমেটেড চাটবট কীভাবে ২৪/৭ গ্রাহক সেবা প্রদান করে এবং লিড জেনারেশন বাড়ায়।',
                'content' => $this->getChatbotContent(),
                'category_id' => BlogCategory::where('slug', 'chatbot-setup')->first()->id,
                'author' => 'মাহমুদুল হক',
                'image_url' => 'https://images.unsplash.com/photo-1531746790731-6c087fecd65a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=600&q=80',
                'read_time' => '৫ মিনিট',
                'featured' => false,
                'is_active' => true,
                'display_order' => 6,
                'meta_title' => 'চাটবট সেটআপ গাইড - এসএমই কিউব',
                'meta_description' => 'অটোমেটেড চাটবট কীভাবে ২৪/৭ গ্রাহক সেবা প্রদান করে এবং লিড জেনারেশন বাড়ায়।',
                'meta_keywords' => 'চাটবট, কাস্টমার সাপোর্ট, অটোমেশন, AI চাটবট',
                'og_image' => 'https://images.unsplash.com/photo-1531746790731-6c087fecd65a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=600&q=80',
                'sections' => $this->getChatbotSections(),
                'key_points' => [
                    '২৪/৭ কাস্টমার সাপোর্ট',
                    'ইনস্ট্যান্ট রেসপন্স',
                    'লিড জেনারেশন',
                    'কস্ট রিডাকশন'
                ],
                'tips' => [
                    'ক্লিয়ার কনভারসেশন ফ্লো ডিজাইন করুন',
                    'রেগুলারলি আপডেট করুন',
                    'হিউম্যান হ্যান্ডওভার অপশন রাখুন',
                    'এনালিটিক্স মনিটর করুন',
                    'মাল্টি-ল্যাঙ্গুয়েজ সাপোর্ট যোগ করুন'
                ],
                'cta_title' => 'চাটবট সেটআপ করতে চান?',
                'cta_button_text' => 'চাটবট সার্ভিস',
                'cta_button_link' => '/services/chatbot-setup'
            ],
            [
                'title' => 'ল্যান্ডিং পেজ ডিজাইনের কৌশল',
                'slug' => 'landing-page-strategies',
                'excerpt' => 'উচ্চ কনভার্শন রেটের জন্য ল্যান্ডিং পেজ ডিজাইনের সেরা কৌশলগুলো জানুন।',
                'content' => $this->getLandingPageContent(),
                'category_id' => BlogCategory::where('slug', 'landing-page')->first()->id,
                'author' => 'আরিফ হোসেন',
                'image_url' => 'https://images.unsplash.com/photo-1522542550221-31fd19575a2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=600&q=80',
                'read_time' => '৬ মিনিট',
                'featured' => false,
                'is_active' => true,
                'display_order' => 7,
                'meta_title' => 'ল্যান্ডিং পেজ ডিজাইন স্ট্র্যাটেজি - এসএমই কিউব',
                'meta_description' => 'উচ্চ কনভার্শন রেটের জন্য ল্যান্ডিং পেজ ডিজাইনের সেরা কৌশলগুলো জানুন।',
                'meta_keywords' => 'ল্যান্ডিং পেজ, কনভার্শন রেট, ওয়েব ডিজাইন, মার্কেটিং',
                'og_image' => 'https://images.unsplash.com/photo-1522542550221-31fd19575a2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=600&q=80',
                'sections' => $this->getLandingPageSections(),
                'key_points' => [
                    'ক্লিয়ার ক্যাল টু অ্যাকশন',
                    'কম্পেলিং হেডলাইন',
                    'ট্রাস্ট ইন্ডিকেটর',
                    'মোবাইল অপ্টিমাইজেশন'
                ],
                'tips' => [
                    'সিঙ্গেল ফোকাস মেইন্টেন করুন',
                    'স্ট্রং হেডলাইন ব্যবহার করুন',
                    'ভিজুয়াল হায়ারার্কি ফলো করুন',
                    'সোশ্যাল প্রুফ যোগ করুন',
                    'A/B টেস্ট করুন'
                ],
                'cta_title' => 'ল্যান্ডিং পেজ তৈরি করতে চান?',
                'cta_button_text' => 'ল্যান্ডিং পেজ সার্ভিস',
                'cta_button_link' => '/services/landing-page'
            ],
            [
                'title' => 'গ্রাফিক ডিজাইনের মাধ্যমে ব্র্যান্ডিং',
                'slug' => 'graphic-design-branding',
                'excerpt' => 'আকর্ষণীয় লোগো এবং ভিজুয়াল ডিজাইন দিয়ে আপনার ব্র্যান্ডকে শক্তিশালী করুন।',
                'content' => $this->getGraphicDesignContent(),
                'category_id' => BlogCategory::where('slug', 'graphic-design')->first()->id,
                'author' => 'শারমিন আক্তার',
                'image_url' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=600&q=80',
                'read_time' => '৭ মিনিট',
                'featured' => false,
                'is_active' => true,
                'display_order' => 8,
                'meta_title' => 'গ্রাফিক ডিজাইন ব্র্যান্ডিং গাইড - এসএমই কিউব',
                'meta_description' => 'আকর্ষণীয় লোগো এবং ভিজুয়াল ডিজাইন দিয়ে আপনার ব্র্যান্ডকে শক্তিশালী করুন।',
                'meta_keywords' => 'গ্রাফিক ডিজাইন, ব্র্যান্ডিং, লোগো ডিজাইন, ভিজুয়াল আইডেন্টিটি',
                'og_image' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=600&q=80',
                'sections' => $this->getGraphicDesignSections(),
                'key_points' => [
                    'ব্র্যান্ড রিকগনিশন',
                    'প্রফেশনাল ইমেজ',
                    'কনসিসটেন্ট ভিজুয়াল আইডেন্টিটি',
                    'ইমোশনাল কানেকশন'
                ],
                'tips' => [
                    'সিম্পল ডিজাইন রাখুন',
                    'কনসিসটেন্ট কালার স্কিম ব্যবহার করুন',
                    'টাইপোগ্রাফি কেয়ারfully চয়েজ করুন',
                    'স্কেলেবিলিটি consider করুন',
                    'টার্গেট অডিয়েন্স understand করুন'
                ],
                'cta_title' => 'ব্র্যান্ড ডিজাইন করতে চান?',
                'cta_button_text' => 'গ্রাফিক ডিজাইন সার্ভিস',
                'cta_button_link' => '/services/graphic-design'
            ]
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }

        // Create Reviews
        $reviews = [
            [
                'name' => 'আহমেদ হাসান',
                'role' => 'ই-কমার্স ব্যবসায়ী',
                'review' => 'এসএমই কিউবের সার্ভিসে আমার অনলাইন স্টোরের বিক্রয় ৩০০% বেড়েছে। তাদের টিম খুব প্রফেশনাল এবং সাপোর্টিভ।',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face',
                'display_order' => 1,
                'is_active' => true
            ],
            [
                'name' => 'ফাতেমা বেগম',
                'role' => 'ফ্যাশন ব্র্যান্ড মালিক',
                'review' => 'গ্রাফিক ডিজাইন এবং সোশ্যাল মিডিয়া মার্কেটিং সার্ভিস এক্সিলেন্ট। আমার ব্র্যান্ড ভিজিবিলিটি অনেক বেড়েছে।',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=100&h=100&fit=crop&crop=face',
                'display_order' => 2,
                'is_active' => true
            ],
            [
                'name' => 'রফিকুল ইসলাম',
                'role' => 'রেস্টুরেন্ট মালিক',
                'review' => 'ওয়েবসাইট এবং ডেলিভারি চাটবট সেটআপ করার পর অর্ডার ৫০% বেড়েছে। ২৪/৭ কাস্টমার সাপোর্ট এখন সম্ভব।',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face',
                'display_order' => 3,
                'is_active' => true
            ],
            [
                'name' => 'নুসরাত জাহান',
                'role' => 'এডুকেশন কনসালটেন্ট',
                'review' => 'বিজনেস কনসালটিং এবং ডিজিটাল মার্কেটিং স্ট্র্যাটেজি আমার ব্যবসাকে সম্পূর্ণ নতুন লেভেলে নিয়ে গেছে।',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=face',
                'display_order' => 4,
                'is_active' => true
            ],
            [
                'name' => 'কামরুল হাসান',
                'role' => 'স্টার্টআপ ফাউন্ডার',
                'review' => 'ল্যান্ডিং পেজ এবং ফেসবুক বুস্টিং কম্বিনেশন আমার লিড জেনারেশনকে রূপান্তরিত করেছে। হাইলি রিকমেন্ডেড!',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop&crop=face',
                'display_order' => 5,
                'is_active' => true
            ]
        ];

        foreach ($reviews as $review) {
            BlogReview::create($review);
        }

        echo "✅ Blog data seeded successfully!\n";
    }

    // Content methods for each blog post...
    private function getFacebookBoostingContent(): string
    {
        return '<h2>ফেসবুক বুস্টিং কী?</h2>
        <p>ফেসবুক বুস্টিং হল একটি শক্তিশালী টুল যা আপনার ব্যবসার পোস্টগুলোকে আরও বেশি মানুষের কাছে পৌঁছে দিতে সাহায্য করে। এটি মূলত একটি পেইড প্রমোশন সিস্টেম যার মাধ্যমে আপনি আপনার কন্টেন্টকে স্পেসিফিক অডিয়েন্সের কাছে টার্গেট করতে পারেন।</p>';
    }

    private function getFacebookBoostingSections(): array
    {
        return [
            [
                'title' => 'বুস্টিং এর স্টেপ বাই স্টেপ গাইড',
                'content' => '<h3>স্টেপ ১: সঠিক পোস্ট সিলেক্ট করুন</h3>
                <p>এমন পোস্ট সিলেক্ট করুন যেটা ইতিমধ্যে ভালো এনগেজমেন্ট পেয়েছে। হাই-কোয়ালিটি ইমেজ এবং ক্যাপশন সহ পোস্ট সবচেয়ে ভালো কাজ করে।</p>'
            ]
        ];
    }

    private function getEcommerceContent(): string
    {
        return '<h2>ই-কমার্স বিপ্লব</h2>
        <p>গত এক দশকে ই-কমার্স ইন্ডাস্ট্রি বিশ্বব্যাপী একটি বিপ্লব সৃষ্টি করেছে। বাংলাদেশেও অনলাইন শপিং এর জনপ্রিয়তা দিন দিন বাড়ছে।</p>';
    }

    private function getEcommerceSections(): array
    {
        return [
            [
                'title' => 'ই-কমার্স প্ল্যাটফর্ম টাইপস',
                'content' => '<h3>১. রেডিমেড প্ল্যাটফর্ম</h3>
                <p>Shopify, WooCommerce এর মতো প্ল্যাটফর্ম যেগুলো প্রি-বিল্ট সলিউশন অফার করে।</p>'
            ]
        ];
    }

    // Similar methods for other blog posts...
    private function getResponsiveDesignContent(): string { return '<p>রেসপন্সিভ ডিজাইন সম্পর্কে কন্টেন্ট...</p>'; }
    private function getResponsiveDesignSections(): array { return []; }
    private function getBusinessConsultingContent(): string { return '<p>বিজনেস কনসালটিং সম্পর্কে কন্টেন্ট...</p>'; }
    private function getBusinessConsultingSections(): array { return []; }
    private function getDigitalMarketingContent(): string { return '<p>ডিজিটাল মার্কেটিং সম্পর্কে কন্টেন্ট...</p>'; }
    private function getDigitalMarketingSections(): array { return []; }
    private function getChatbotContent(): string { return '<p>চাটবট সম্পর্কে কন্টেন্ট...</p>'; }
    private function getChatbotSections(): array { return []; }
    private function getLandingPageContent(): string { return '<p>ল্যান্ডিং পেজ সম্পর্কে কন্টেন্ট...</p>'; }
    private function getLandingPageSections(): array { return []; }
    private function getGraphicDesignContent(): string { return '<p>গ্রাফিক ডিজাইন সম্পর্কে কন্টেন্ট...</p>'; }
    private function getGraphicDesignSections(): array { return []; }
}