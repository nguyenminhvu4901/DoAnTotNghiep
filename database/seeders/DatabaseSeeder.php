<?php

namespace Database\Seeders;

use App\Domains\ProductDetail\Models\ProductDetail;
use Database\Seeders\Data\CategorySeeder;
use Database\Seeders\Data\ProductDetailSeeder;
use Database\Seeders\Data\ProductSeeder;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple([
            'activity_log',
            'failed_jobs',
        ]);

        $this->call(AuthSeeder::class);
        $this->call(AnnouncementSeeder::class);

        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductDetailSeeder::class);

        Model::reguard();
    }
}
