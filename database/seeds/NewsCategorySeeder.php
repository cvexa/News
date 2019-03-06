<?php

use Illuminate\Database\Seeder;
use App\Category;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['sport','crime','world'];
        foreach ($categories as $key => $category) {
            App\Category::create([
                'category' => $category,
            ]);
        }
    }
}
