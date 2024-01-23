<?php

namespace Database\Seeders\Data;

use App\Domains\Auth\Models\User;
use App\Domains\Staff\Models\Staff;
use Carbon\Carbon;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataStaff = [
            [
                'type' => User::TYPE_USER,
                'name' => 'Staff 1',
                'email' => 'nhanvien1@gmail.com',
                'password' => 'nhanvien1',
                'email_verified_at' => now(),
                'active' => true,
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'Staff 2',
                'email' => 'nhanvien2@gmail.com',
                'password' => 'nhanvien2',
                'email_verified_at' => now(),
                'active' => true,
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'Staff 3',
                'email' => 'nhanvien3@gmail.com',
                'password' => 'nhanvien3',
                'email_verified_at' => now(),
                'active' => true,
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'Staff 4',
                'email' => 'nhanvien4@gmail.com',
                'password' => 'nhanvien4',
                'email_verified_at' => now(),
                'active' => true,
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'Staff 5',
                'email' => 'nhanvien5@gmail.com',
                'password' => 'nhanvien5',
                'email_verified_at' => now(),
                'active' => true,
            ],
        ];

        foreach ($dataStaff as $staff) {
            $existingStaff = User::where('email', $staff['email'])->first();

            if (!$existingStaff) {
                $createdStaff = User::create($staff);
                $createdStaff->assignRole(User::ROLE_CUSTOMER);

                Staff::create([
                    'user_id' => $createdStaff->id,
                    'gender' => rand(0, 2),
                    'birthday' => Carbon::now()->subYears(30)->toDateString(),
                    'phone' => '0912345678',
                    'bio' => $createdStaff->name . ' là một nhân viên trang sức tài năng và đam mê, mang lại sự sáng tạo và phong cách đặc sắc cho ngành công nghiệp này. Với bề dày kinh nghiệm lâu năm và sự kiên trì trong nghệ thuật thiết kế, Phương đã xây dựng danh tiếng của mình như một chuyên gia sáng tạo nổi bật.
                                                    Với sự sáng tạo không ngừng, bạn âấy luôn tìm kiếm những ý tưởng mới và xu hướng tiên tiến để tạo ra những mảnh trang sức độc đáo và phản ánh cá tính của từng người. Bằng cách kết hợp tinh tế giữa nghệ thuật và kỹ thuật, bạn ấy đã tạo ra những kiệt tác trang sức không chỉ là vật trang trí mà còn là biểu tượng của phong cách và đẳng cấp.
                                                    Khả năng giao tiếp xuất sắc và sự nhạy bén trong việc đọc hiểu ý muốn của khách hàng là một trong những đặc điểm nổi bật của Bạn ấy. Bạn ấy không chỉ tạo ra những sản phẩm tuyệt vời mà còn xây dựng mối quan hệ chặt chẽ với khách hàng, đồng đội và đối tác.',
                ]);
            }
        }
    }
}
