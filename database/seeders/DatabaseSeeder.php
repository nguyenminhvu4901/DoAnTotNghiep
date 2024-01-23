<?php

namespace Database\Seeders;

use App\Domains\ProductDetail\Models\ProductDetail;
use App\Domains\ProductImage\Models\ProductImage;
use Database\Seeders\Data\CategorySeeder;
use Database\Seeders\Data\CouponSeeder;
use Database\Seeders\Data\CustomerSeeder;
use Database\Seeders\Data\ProductDetailSeeder;
use Database\Seeders\Data\ProductImageSeeder;
use Database\Seeders\Data\ProductSeeder;
use Database\Seeders\Data\StaffSeeder;
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
        $this->call(ProductImageSeeder::class);
        $this->call(CouponSeeder::class);

//        $this->call(StaffSeeder::class);
//        $this->call(CustomerSeeder::class);
        //art db:seed --class=Database\\Seeders\\Data\\StaffSeeder
        //art db:seed --class=Database\\Seeders\\Data\\CustomerSeeder
        Model::reguard();
    }
}
