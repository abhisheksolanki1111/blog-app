<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Post;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run()
    {
        // Create categories
        $technology = Category::create([
            'name' => 'Technology',
            'slug' => 'technology',
            'description' => 'All about technology'
        ]);

        $travel = Category::create([
            'name' => 'Travel',
            'slug' => 'travel',
            'description' => 'Travel guides and tips'
        ]);

        // Create subcategories
        $programming = Subcategory::create([
            'name' => 'Programming',
            'slug' => 'programming',
            'category_id' => $technology->id,
            'description' => 'Programming languages and frameworks'
        ]);

        $gadgets = Subcategory::create([
            'name' => 'Gadgets',
            'slug' => 'gadgets',
            'category_id' => $technology->id,
            'description' => 'Latest gadgets and reviews'
        ]);

        $europe = Subcategory::create([
            'name' => 'Europe',
            'slug' => 'europe',
            'category_id' => $travel->id,
            'description' => 'Travel destinations in Europe'
        ]);

        $asia = Subcategory::create([
            'name' => 'Asia',
            'slug' => 'asia',
            'category_id' => $travel->id,
            'description' => 'Travel destinations in Asia'
        ]);

        // Create 10 posts
        $posts = [
            // Technology - Programming
            [
                'title' => 'Introduction to Laravel',
                'slug' => 'introduction-to-laravel',
                'content' => 'Laravel is a PHP framework that makes web development easy and enjoyable.',
                'category_id' => $technology->id,
                'subcategory_id' => $programming->id
            ],
            [
                'title' => 'React vs Vue: Which to Choose in 2023',
                'slug' => 'react-vs-vue-2023',
                'content' => 'Comparing the two most popular JavaScript frameworks for frontend development.',
                'category_id' => $technology->id,
                'subcategory_id' => $programming->id
            ],
            [
                'title' => 'Getting Started with Python',
                'slug' => 'getting-started-python',
                'content' => 'A beginner-friendly guide to Python programming language.',
                'category_id' => $technology->id,
                'subcategory_id' => $programming->id
            ],

            // Technology - Gadgets
            [
                'title' => 'Best Laptops for Developers in 2023',
                'slug' => 'best-laptops-for-developers-2023',
                'content' => 'Here are the top laptops that developers should consider in 2023.',
                'category_id' => $technology->id,
                'subcategory_id' => $gadgets->id
            ],
            [
                'title' => 'Top Smartphones of 2023',
                'slug' => 'top-smartphones-2023',
                'content' => 'The most impressive smartphones released this year.',
                'category_id' => $technology->id,
                'subcategory_id' => $gadgets->id
            ],
            [
                'title' => 'Must-Have Tech Accessories',
                'slug' => 'must-have-tech-accessories',
                'content' => 'Essential accessories to complement your tech devices.',
                'category_id' => $technology->id,
                'subcategory_id' => $gadgets->id
            ],

            // Travel - Europe
            [
                'title' => 'Top 10 Places to Visit in Italy',
                'slug' => 'top-10-places-italy',
                'content' => 'Italy is full of amazing destinations. Here are our top picks.',
                'category_id' => $travel->id,
                'subcategory_id' => $europe->id
            ],
            [
                'title' => 'Hidden Gems in France',
                'slug' => 'hidden-gems-france',
                'content' => 'Discover less-known but beautiful places in France.',
                'category_id' => $travel->id,
                'subcategory_id' => $europe->id
            ],

            // Travel - Asia
            [
                'title' => 'Best Beaches in Thailand',
                'slug' => 'best-beaches-thailand',
                'content' => 'Explore the most beautiful beaches in Thailand.',
                'category_id' => $travel->id,
                'subcategory_id' => $asia->id
            ],
            [
                'title' => 'Japan Travel Guide',
                'slug' => 'japan-travel-guide',
                'content' => 'Everything you need to know for your trip to Japan.',
                'category_id' => $travel->id,
                'subcategory_id' => $asia->id
            ]
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
