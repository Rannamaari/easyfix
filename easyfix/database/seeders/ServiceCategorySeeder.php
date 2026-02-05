<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Plumbing',
                'slug' => 'plumbing',
                'icon' => 'heroicon-o-wrench',
                'description' => 'All plumbing services',
                'services' => [
                    ['name' => 'Leak Repair', 'base_price' => 50],
                    ['name' => 'Drain Cleaning', 'base_price' => 75],
                    ['name' => 'Toilet Repair', 'base_price' => 60],
                    ['name' => 'Pipe Installation', 'base_price' => 150],
                ],
            ],
            [
                'name' => 'Electrical',
                'slug' => 'electrical',
                'icon' => 'heroicon-o-bolt',
                'description' => 'Electrical services',
                'services' => [
                    ['name' => 'Outlet Installation', 'base_price' => 40],
                    ['name' => 'Light Fixture', 'base_price' => 60],
                    ['name' => 'Circuit Breaker', 'base_price' => 100],
                    ['name' => 'Wiring Repair', 'base_price' => 80],
                ],
            ],
            [
                'name' => 'AC & Cooling',
                'slug' => 'ac-cooling',
                'icon' => 'heroicon-o-sun',
                'description' => 'Air conditioning services',
                'services' => [
                    ['name' => 'AC Repair', 'base_price' => 100],
                    ['name' => 'AC Installation', 'base_price' => 300],
                    ['name' => 'AC Maintenance', 'base_price' => 75],
                    ['name' => 'Filter Replacement', 'base_price' => 30],
                ],
            ],
            [
                'name' => 'Cleaning',
                'slug' => 'cleaning',
                'icon' => 'heroicon-o-sparkles',
                'description' => 'Cleaning services',
                'services' => [
                    ['name' => 'Home Cleaning', 'base_price' => 80],
                    ['name' => 'Deep Cleaning', 'base_price' => 150],
                    ['name' => 'Office Cleaning', 'base_price' => 120],
                    ['name' => 'Move-out Cleaning', 'base_price' => 200],
                ],
            ],
            [
                'name' => 'Handyman',
                'slug' => 'handyman',
                'icon' => 'heroicon-o-wrench-screwdriver',
                'description' => 'General handyman services',
                'services' => [
                    ['name' => 'Furniture Assembly', 'base_price' => 50],
                    ['name' => 'TV Mounting', 'base_price' => 60],
                    ['name' => 'Shelf Installation', 'base_price' => 40],
                    ['name' => 'Door Repair', 'base_price' => 70],
                ],
            ],
            [
                'name' => 'Mechanic',
                'slug' => 'mechanic',
                'icon' => 'heroicon-o-cog-6-tooth',
                'description' => 'Auto mechanic services',
                'services' => [
                    ['name' => 'Oil Change', 'base_price' => 40],
                    ['name' => 'Brake Service', 'base_price' => 150],
                    ['name' => 'Battery Replacement', 'base_price' => 80],
                    ['name' => 'Tire Change', 'base_price' => 25],
                ],
            ],
        ];

        foreach ($categories as $index => $categoryData) {
            $services = $categoryData['services'];
            unset($categoryData['services']);

            $categoryData['sort_order'] = $index;
            $category = ServiceCategory::create($categoryData);

            foreach ($services as $serviceIndex => $serviceData) {
                $category->services()->create([
                    'name' => $serviceData['name'],
                    'slug' => \Str::slug($serviceData['name']),
                    'base_price' => $serviceData['base_price'],
                    'sort_order' => $serviceIndex,
                ]);
            }
        }
    }
}
