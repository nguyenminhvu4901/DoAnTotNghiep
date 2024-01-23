<?php

namespace Database\Seeders\Data;

use App\Domains\Category\Models\Category;
use App\Domains\Category\Services\CategoryService;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use DisableForeignKeys;

    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                "name" => "Nhẫn",
                'creator_id' => 1
            ],
            [
                'id' => 2,
                "name" => "Dây chuyền",
                'creator_id' => 1
            ],
            [
                'id' => 3,
                "name" => "Vòng tay",
                'creator_id' => 1
            ],
            [
                'id' => 4,
                "name" => "Khuyên tai",
                'creator_id' => 1
            ],
            [
                'id' => 5,
                "name" => "Đồng hồ",
                'creator_id' => 1
            ],
        ];

        foreach ($categories as $category) {
            if (!$this->categoryService->isExistByName($category['name'])) {
                Category::create($category);
            }
        }
    }
}
