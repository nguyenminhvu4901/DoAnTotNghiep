<?php

namespace Database\Seeders\Data;

use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    use DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataCustomer = [
            [
                'type' => User::TYPE_USER,
                'name' => 'Customer 1',
                'email' => 'khachhang1@gmail.com',
                'password' => 'khachhang1',
                'email_verified_at' => now(),
                'active' => true,
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'Customer 2',
                'email' => 'khachhang2@gmail.com',
                'password' => 'khachhang2',
                'email_verified_at' => now(),
                'active' => true,
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'Customer 3',
                'email' => 'khachhang3@gmail.com',
                'password' => 'khachhang3',
                'email_verified_at' => now(),
                'active' => true,
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'Customer 4',
                'email' => 'khachhang4@gmail.com',
                'password' => 'khachhang4',
                'email_verified_at' => now(),
                'active' => true,
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'Customer 5',
                'email' => 'khachhang5@gmail.com',
                'password' => 'khachhang5',
                'email_verified_at' => now(),
                'active' => true,
            ],
        ];

        foreach ($dataCustomer as $customer) {
            $existingCustomer = User::where('email', $customer['email'])->first();

            if (!$existingCustomer) {
                $createdCustomer = User::create($customer);
                $createdCustomer->assignRole(User::ROLE_CUSTOMER);
            }
        }
    }
}
