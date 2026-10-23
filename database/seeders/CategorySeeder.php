<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = now()->format('Y-m-d H:i:s');
        $date = now()->format('m/d/Y');
        $names = [
            'videography', 
            'photography', 
            'live streaming', 
            'lighting', 
            'A/V', 
            'sound', 
            'hardware', 
            'software', 
        ];
        $categories = array_map(fn($name) => [
            'name' => $name, 
            'uuid' => Str::uuid(), 
            'created_at' => $timestamp, 
            'updated_at' => $timestamp, 
        ], $names);
        Category::insert($categories);
    }
}
