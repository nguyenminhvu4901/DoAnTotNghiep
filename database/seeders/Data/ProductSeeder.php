<?php

namespace Database\Seeders\Data;

use App\Domains\Category\Models\Category;
use App\Domains\Category\Services\CategoryService;
use App\Domains\Product\Models\Product;
use App\Domains\Product\Services\ProductService;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use DisableForeignKeys;

    protected ProductService $productService;
    protected CategoryService $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataNhan = [
            ['id' => 1,
                'name' => 'Nhẫn Bạc S925 Thăng Long Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Chế tác kỷ niệm nhân dịp năm mới 2024 Giáp Thìn, lấy cảm hứng từ rồng thời Lý, hình tượng rồng mang nét thuần Việt nhất trong các triều đại xưa.
                            Rồng thời Lý hiện lên với đầy đủ những đặc trưng: Thân rồng uốn nhịp hình sin uyển chuyển quanh đai nhẫn, bờm phất phơ theo gió, râu lượn như sóng nước, miệng ngậm ngọc quý.
                            Cách điệu mây và tre càng thể hiện rõ ý nghĩa của rồng thời Lý, của chiếc nhẫn Thăng long này.
                            Đó chính là khí thế vươn tới trời cao của dân tộc và sự phát triển phồn thịnh của đất nước Việt Nam.',
                'creator_id' => 1],

            ['id' => 2,
                'name' => 'Nhẫn Bạc S925 Horus Ring x Tattoo Chair Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế:
Lấy cảm hứng từ vị thần Horus của Ai Cập, Helios đã cùng Tattoo Chair tạo nên chế tác nhẫn mới: Horus!
Với dáng signet quyền lực, mặt nhẫn được chạm khắc tỉ mỉ hình ảnh thần Horus đầu chim ưng, bao quanh bởi phần viền mô phỏng loài rắn sa mạc.
Hai bên đai nhẫn nhấn nhá thêm bằng những biểu tượng thiêng liêng trong văn hóa Ai Cập: Ký tự Ankh quyền năng, kim tự tháp bí ẩn và đặc biệt là con mắt Horus - con mắt ngàn năm tượng trưng cho sức mạnh và sự bảo hộ lâu dài.',
                'creator_id' => 1],

            ['id' => 3,
                'name' => 'Nhẫn Bạc S925 Combatant Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Không có trận chiến nào dễ dàng, mọi thắng lợi luôn phải đánh đổi bằng mồ hôi, nước mắt và thậm chí là máu.
Đó chính là thông điệp ẩn sau Bloodstone - loại đá tượng trưng cho vệt máu chiến binh, cho lòng dũng cảm được tôi rèn nơi chiến trường.
Khi xưa, Bloodstone cũng được các chiến binh Hy Lạp đem bên mình khi ra trận để tiếp thêm sức mạnh và khả năng chống chịu.
Từ ý nghĩa ấy, Helios đã tạo nên chế tác nhẫn mới Combatant, kết hợp mặt đá Bloodstone cứng cỏi cùng họa tiết kiến trúc Hy Lạp đặc trưng.',
                'creator_id' => 1
            ],

            ['id' => 4,
                'name' => 'Nhẫn Bạc S925 Aurora Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Chế tác đầu tiên của năm 2024: Nhẫn Aurora.
                                “Aurora” mang nghĩa là rạng đông, thời khắc đất trời và vạn vật khởi đầu ngày mới với một nguồn sinh khí dồi dào.
                                Chiếc nhẫn mang thiết kế hình thoi cùng họa tiết Lotus độc bản, đại diện cho năng lượng cân bằng và mạnh mẽ nhất.',
                'creator_id' => 1
            ],

            ['id' => 4,
                'name' => 'Nhẫn Bạc S925 Aurora Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Chế tác đầu tiên của năm 2024: Nhẫn Aurora.
                                “Aurora” mang nghĩa là rạng đông, thời khắc đất trời và vạn vật khởi đầu ngày mới với một nguồn sinh khí dồi dào.
                                Chiếc nhẫn mang thiết kế hình thoi cùng họa tiết Lotus độc bản, đại diện cho năng lượng cân bằng và mạnh mẽ nhất.',
                'creator_id' => 1
            ],

            ['id' => 5,
                'name' => 'Nhẫn Bạc S925 Sage Ring Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Chế tác ra đời dựa trên câu chuyện về Viên đá của nhà hiền triết (Lapis Philosophorum) hay còn gọi là Hòn đá giả kim.
                        Tương truyền, nó là biểu tượng trung tâm của giả kim thuật, tạo nên từ 4 nguyên tố của sự sống Đất - Nước - Lửa - Khí.
                        Người sở hữu có khả năng tạo ra mọi vật chất, chữa lành bách bệnh hay thậm chí nắm giữ chìa khóa của sự bất tử.
                        Cái tên Sage mang nghĩa là nhà hiền triết, đồng thời mặt đá Lapis ở trung tâm cũng gợi nhắc đến tên gọi của đá giả kim trong tiếng Latin.',
                'creator_id' => 1
            ],

            ['id' => 6,
                'name' => 'Nhẫn Bạc S925 Legal Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Chế tác được thiết kế với mặt nhẫn khắc nổi hình quân vua, kết hợp đường lưới tượng trưng cho các ô cờ đen trắng.
Thân nhẫn qua kỹ thuật cut out tỉ mỉ đã trở thành điểm nhấn độc đáo, đậm chất sắc sảo của nghệ thuật Gothic.
LEGAL gợi đến bộ quy tắc, luật chơi trong cờ vua, mang ý nghĩa rằng kỷ luật chính là thói quen của người đàn ông thực thụ.',
                'creator_id' => 1
            ],

            ['id' => 7,
                'name' => 'Nhẫn Bạc S925 Pusi Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Chiếc nhẫn Pusi lấy cảm hứng từ đỉnh Phan Xi Păng - đỉnh núi cao nhất tại Việt Nam và cả khu vực Đông Dương.

Hình ảnh ấy được tái hiện bằng những chi tiết chóp núi, đan xen là biểu trưng Lotus khắc nổi sắc nét.

Tượng trưng cho hành trình chinh phục thử thách và vươn tới đỉnh trời, hay nói cách khác là chạm đến những cột mốc vĩ đại trong cuộc sống.',
                'creator_id' => 1
            ],

            ['id' => 8,
                'name' => 'Nhẫn thời trang nam nữ Helios Black Heart Ring',
                'description' => 'Câu chuyện của sản phẩm: Black Heart Ring cách điệu từ hình ảnh hoa hướng dương, giữ trọn nét mềm mại và thêm vào tinh thần gai góc, bụi bặm đặc trưng của nghệ thuật Gothic.
Chiếc nhẫn được thiết kế với đai nhẫn hở, mang đến trải nghiệm phóng khoáng thoải mái khi đeo.',
                'creator_id' => 1
            ],

            ['id' => 9,
                'name' => 'Nhẫn Bạc S925 Clytze Old Detail Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Chiếc nhẫn Old Detail lấy cảm hứng từ truyền thuyết về loài hoa hướng dương.
Dựa trên nét đặc trưng của kiến trúc Gothic, chế tác được hoàn thiện với đường cut-out sắc khỏe, tạo nên dải hoa văn Sunflower độc đáo.
Cái tên Old Detail gợi lên một vẻ đẹp có chút cổ điển nhưng mãi trường tồn, cũng giống như chính tình yêu đôi lứa vậy.',
                'creator_id' => 1
            ],

            ['id' => 10,
                'name' => 'Nhẫn Bạc S925 Cro Red Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Chế tác mang hình ảnh của một con rắn uốn lượn với đôi mắt đỏ rực mê hoặc.
Đây là loài vật tượng trưng cho những ý niệm phức tạp, nó được tôn sùng như một thực thể huyền bí, hiện thân của thánh thần, tái sinh, bảo hộ hoặc sự hủy diệt, cám dỗ, hỗn loạn.
Vừa thiêng liêng cũng vừa gây khiếp sợ, ám ảnh, chính vì thế mà tạo nên sức hút hấp dẫn trí tò mò của con người.',
                'creator_id' => 1
            ],

            ['id' => 11,
                'name' => 'Nhẫn Bạc S925 Nương Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Mỗi linh hồn con người đều được hoàn thiện bởi 1 nửa ánh sáng và 1 nửa bóng tối.
Một nửa hướng thiện, thanh khiết như đóa sen, trong trẻo tựa thiếu nữ. Một nửa hướng ác, hiểm độc như nọc rắn, khiến người đời phải sợ hãi, dè chừng.
Ranh giới ở giữa vốn rất mong manh, chỉ cần không vững vàng, con người sẽ đánh mất bản ngã của mình, sa chân vào màn đêm của sự xấu xa.',
                'creator_id' => 1
            ],

            ['id' => 12,
                'name' => 'Nhẫn Bạc S925 Poseidon Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Nhẫn Poseidon dựa trên vị vua cai quản đại dương trong thần thoại Hy Lạp, có quyền năng thao túng những cơn sóng thần cuộn trào.
Nổi bật trên mặt nhẫn là họa tiết đinh ba, vỏ sò, những đường lượn sóng, cùng hai dãy ký tự POSEIDON và ΠΟΣΕΙΔΩΝ - tên của vị thần viết bằng chữ Hy Lạp cổ.
Với form tròn và đường nét khỏe khoắn, chế tác Poseidon mang đến cho anh em vẻ ngoài phóng khoáng, táo bạo đúng với tinh thần khám phá của BST Atlantis.',
                'creator_id' => 1
            ],

            ['id' => 13,
                'name' => 'Nhẫn Bạc S925 Dreamy Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Những định kiến xưa cũ luôn bó buộc vẻ dẹp của người phụ nữ chỉ dừng lại ở việc phải thật dịu dàng, thùy mị.
                                Thế nhưng mọi người biết không, những người phụ nữ thân yêu của chúng ta còn hơn thế nữa. 
                                Họ tình cảm, họ mạnh mẽ, họ độc lập. Họ quyến rũ, sắc sảo nhưng vẫn không kém phần mềm mại.',
                'creator_id' => 1
            ],

            ['id' => 14,
                'name' => 'Nhẫn Bạc S925 Rome Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Lấy cảm hứng từ kỳ quan kiến trúc mang tên đấu trường La Mã.
                                Tái hiện kết cấu độc đáo và bền bỉ qua thời gian của công trình này.
                                Đóng vai trò như một chứng nhân lịch sử, đánh dấu thời đại hoàng kim đế chế La Mã hùng mạnh.',
                'creator_id' => 1
            ],

            [
                'id' => 15,
                'name' => 'Nhẫn Bạc S925 Tea Lotus Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Nằm trong BST Lotus của Helios, chế tác mới nhất dưới đây chắc chắn sẽ không làm anh em thất vọng.

Tea Lotus nổi bật với mặt nhẫn hình tam giác, được kết hợp từ nhiều bông hoa sen sắc sảo. Chính thiết kế này tạo nên cách đeo và phối cực mới mẻ, gây chú ý mạnh mẽ với người xung quanh.

Bằng cách đeo đồng thời cả 2 chiếc, anh em sẽ có ngay một món chế tác mặt hình thoi sắc cạnh, sở hữu nét đẹp vừa khỏe khoắn vừa độc đáo.

Với tính chất cân xứng của tam giác lẫn hình thoi, Tea Lotus cũng chứa đựng những ý niệm về sự cân bằng, hài hòa giữa mọi yếu tố, khía cạnh trong cuộc sống của ta.',
                'creator_id' => 1
            ],
        ];

        $productNhan = [];
        //Nhan
        foreach ($dataNhan as $nhan) {
            $existingProduct = Product::where('name', $nhan['name'])->first();

            if (!$existingProduct) {
                $createdProduct = Product::create($nhan);
                $productNhan[] = $createdProduct->id;
            }
        }

        if (!empty($productNhan)) {
            $categoryNhan = $this->categoryService->getById(1);
            $categoryNhan->syncProducts($productNhan);
        }

        $dataDayChuyen = [
            [
                'id' => 16,
                'name' => 'Dây chuyền nam Helios Mắt Xích Bạc',
                'description' => 'Dây chuyền là món phụ kiện gần như sẽ thu hút ánh nhìn và để lại ấn tượng rất lớn với người đối diện, thế nên món phụ kiện này là thứ không thế thiếu trong set đồ của bạn.

1. Yên tâm về chất lượng
Các mẫu Dây chuyền nam, vòng cổ nam  tại Helios được lựa chọn và sàng lọc một cách kĩ càng về chất lượng, với chất liệu và dây được làm từ hợp kim trắng, đá, dây dù... cực kì chắc chắn và bền bỉ theo thời gian.

2. Mẫu mã đa dạng
Luôn luôn update những mẫu mặt dây chuyền theo mùa, theo trend, theo phong cách của giới trẻ, đã có hơn 100 mẫu dây chuyền cập bên tại Helios, với nhiều chất liệu, kiểu cách. Và không dừng ở con số đó, mỗi ngày Helios đều sẽ tiếp tục update các mẫu sản phẩm mới.

3. Giá cả hợp lý 
Đến với các sản phẩm của Helios, khách hàng có quyền yên tâm về sản phẩm với mức giá mình bỏ ra. Luôn có các event, các ưu đãi cho khách hàng mới, tri ân khách hàng cũ. 

Ngoài ra, các sản phẩm của Helios đều có chế độ bảo hành theo từng dòng sản phẩm, chúng tôi làm tất cả để khách hàng có thể yên tâm khi sử dụng sản phẩm tại Helios.',
                'creator_id' => 1
            ],

            [
                'id' => 17,
                'name' => 'Dây chuyền nam, nữ Helios Gravitate DCN200',
                'description' => 'Dây chuyền là món phụ kiện gần như sẽ thu hút ánh nhìn và để lại ấn tượng rất lớn với người đối diện, thế nên món phụ kiện này là thứ không thế thiếu trong set đồ của bạn.

1. Yên tâm về chất lượng
Các mẫu Dây chuyền nam, vòng cổ nam  tại Helios được lựa chọn và sàng lọc một cách kĩ càng về chất lượng, với chất liệu và dây được làm từ hợp kim trắng, đá, dây dù... cực kì chắc chắn và bền bỉ theo thời gian.

2. Mẫu mã đa dạng
Luôn luôn update những mẫu mặt dây chuyền theo mùa, theo trend, theo phong cách của giới trẻ, đã có hơn 100 mẫu dây chuyền cập bên tại Helios, với nhiều chất liệu, kiểu cách. Và không dừng ở con số đó, mỗi ngày Helios đều sẽ tiếp tục update các mẫu sản phẩm mới.

3. Giá cả hợp lý 
Đến với các sản phẩm của Helios, khách hàng có quyền yên tâm về sản phẩm với mức giá mình bỏ ra. Luôn có các event, các ưu đãi cho khách hàng mới, tri ân khách hàng cũ. 

Ngoài ra, các sản phẩm của Helios đều có chế độ bảo hành theo từng dòng sản phẩm, chúng tôi làm tất cả để khách hàng có thể yên tâm khi sử dụng sản phẩm tại Helios.',
                'creator_id' => 1
            ],

            [
                'id' => 18,
                'name' => 'Dây Chuyền Bạc S925 Triarchy Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Tổng lãnh Thiên sứ, hay còn được gọi là Archangels, là những thực thể thiêng liêng dẫn đầu trong cuộc chiến giữa Thiên đàng và Địa ngục. 

Ba vị đứng đầu trong hàng ngũ các Archangels là Michael, Gabriel và và Raphael, lần lượt đại diện cho ba ý niệm Bảo vệ - Truyền tin - Chữa lành.

Họ oai vệ, quyền năng như những chiến binh của trời, sẵn sàng hy sinh để thực hiện nhiệm vụ cao cả của mình, xứng đáng với vị thế thủ lĩnh nơi Thiên đàng.

3 vị Tổng lãnh Thiên sứ tối cao chính là nguồn cảm hứng cho chế tác dây chuyền Triarchy tại Helios.',
                'creator_id' => 1
            ],

            [
                'id' => 19,
                'name' => 'Dây Chuyền Bạc S925 Chain Helios Rise x Lotus Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Dây chuyền Rise x Lotus được thiết kế theo dáng Oval Cable, đặc trưng bởi các mắt xích dày khỏe khoắn và phóng khoáng.
                            Phần khóa cài được chạm khắc tỉ mỉ họa tiết Lotus độc bản của Helios.
                            Tạo nên một điểm nhấn đơn giản mà mạnh mẽ cho bộ trang phục của anh em.',
                'creator_id' => 1
            ],

            [
                'id' => 20,
                'name' => 'Dây Chuyền Bạc S925 Ngọc Trai Smile 50cm Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Như chính tên gọi, Smile chỉ đơn giản là biểu tượng cảm xúc mặt cười quen thuộc với chúng ta.
Tinh thần phá cách của Helios thể hiện qua việc phủ kín Smile với những viên đá CZ.',
                'creator_id' => 1
            ],

            [
                'id' => 21,
                'name' => 'Dây Chuyền Bạc S925 River Lotus 12mm Helios Silver Original - 50cm DCBN107',
                'description' => 'Câu chuyện từ nhà thiết kế: Chế tác River Lotus được thiết kế theo dáng vòng Cuban huyền thoại. 
Thay vì đính đá hay làm trơn, Helios đã chạm khắc tỉ mỉ hoa văn Lotus độc bản lên từng mắt xích nhỏ.
Toát lên một vẻ rất ngông, rất chiến khi đeo lên tay.',
                'creator_id' => 1
            ],

            [
                'id' => 22,
                'name' => 'Dây Chuyền Bạc S925 Cuban Twinkle Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Cuban Twinkle là chế tác mang đậm tinh thần đường phố và hiphop khi sở hữu dáng Cuban Iced Out chất ngầu và cực phá cách.
Từng mắt xích của dây chuyền đều được đính tỉ mỉ 24 viên đá CZ, tạo nên vẻ ngoài không thể bị lu mờ.',
                'creator_id' => 1
            ],

            [
                'id' => 23,
                'name' => 'Dây Chuyền Bạc S925 Tennis Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Dựa trên thiết kế của một loại trang sức được các vận động viên quần vợt 70s yêu thích, dây chuyền Tennis rất nhẹ, êm, thoải mái dù đeo ở bất cứ đâu.
Vẻ lấp lánh bao trọn sợi dây là điểm nhấn cực kỳ thời thượng, giúp anh em flexing mà chẳng cần phải cầu kỳ.',
                'creator_id' => 1
            ],

            [
                'id' => 24,
                'name' => 'Dây Chuyền Bạc S925 Hạt Ngọc Trai Trắng Helios Silver Original',
                'description' => 'Mô tả
Câu hỏi thường gặp
Tại sao nên mua Dây Chuyền Bạc tại HeliSilver?
1. Cam kết về chất lượng
Các mẫu Dây Chuyền Bạc nam, vòng cổ bạc nam tại HeliSilver được lựa chọn và sàng lọc một cách kĩ càng về chất lượng, với chất liệu và dây chuẩn bạc Ý hoặc bạc Thái S925, các họa tiết đính đá... bền bỉ theo thời gian.

2. Mẫu mã đa dạng
HeliSilver liên tục nghiên cứu và cho ra mắt nhiều mẫu mã Dây Chuyền Bạc nam, mặt Dây Chuyền Bạc nam phù hợp với phong cách, xu hướng thời thời trang của giới trẻ. Xu hướng ưu tiên các mẫu dây chuyền thiết kế giới hạn, mang đậm dấu ấn cá nhân của từng khách, đảm bảo khách hàng sẽ khó tìm thấy chiếc dây chuyền tương tự nào như tại HeliSilver có!

3. Giá cả hợp lý
Đến với các sản phẩm của HeliSilver, khách hàng có quyền yên tâm về sản phẩm với mức giá mình bỏ ra. Luôn có các event, các ưu đãi cho khách hàng mới, tri ân khách hàng cũ. Ngoài ra, các sản phẩm của Helíilver đều có chế độ bảo hành theo từng dòng sản phẩm, chúng tôi làm tất cả để khách hàng có thể yên tâm khi sử dụng sản phẩm tại HeliSilver.',
                'creator_id' => 1
            ],

            [
                'id' => 25,
                'name' => 'Dây chuyền nam, nữ Helios Dice Smile DCN225',
                'description' => 'Câu chuyện từ nhà thiết kế: Giống như trò chơi xúc xắc, cuộc sống là chuỗi những thử thách đầy bất ngờ.

Mỗi mặt hiện lên cũng chính là một bước ngoặt mới, đòi hỏi ta phải lựa chọn hướng đi trong hoàn cảnh ấy.

Nhưng thay vì chạy theo một con số mơ hồ, một cái đích vô định, người đàn ông sẽ luôn giữ nụ cười để đón nhận mọi kết quả.

Tâm thế trầm ổn, bình thản đó mới là thứ vũ khí mạnh mẽ nhất, chứ không phải gồng mình gắng gượng.',
                'creator_id' => 1
            ],

        ];

        $productDayChuyen = [];
        //Day Chuyen
        foreach ($dataDayChuyen as $dayChuyen) {
            $existingProduct = Product::where('name', $dayChuyen['name'])->first();

            if (!$existingProduct) {
                $createdProduct = Product::create($dayChuyen);
                $productDayChuyen[] = $createdProduct->id;
            }
        }

        if (!empty($productDayChuyen)) {
            $categoryDayChuyen = $this->categoryService->getById(2);
            $categoryDayChuyen->syncProducts($productDayChuyen);
        }

        $dataVongTay = [
            [
                'id' => 26,
                'name' => 'Vòng Tay Bạc S925 Diamond Tennis Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Dựa trên thiết kế vòng tay kim cương của các vận động viên quần vợt thập niên 70, Diamond Tennis rất nhẹ, êm, thoải mái dù đeo ở bất cứ đâu.
Vẻ lấp lánh bao trọn chiếc vòng là điểm nhấn cực kỳ thời thượng, giúp anh em flexing mà chẳng cần phải cầu kỳ.',
                'creator_id' => 1
            ],

            [
                'id' => 27,
                'name' => 'Vòng Tay Bạc S925 Eden x Lotus Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Vòng tay Eden x Lotus được thiết kế theo dáng Foxtail Chain, đặc trưng bởi các mắt xích chữ V ấn tượng.
Phần khóa cài được chạm khắc tỉ mỉ họa tiết Lotus độc bản của Helios.
Tạo nên một điểm nhấn đơn giản mà mạnh mẽ cho bộ trang phục của anh em.',
                'creator_id' => 1
            ],

            [
                'id' => 28,
                'name' => 'Vòng Tay Bạc S925 POWERFUL WHEEL Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Powerful Wheel sở hữu tạo hình như một chiếc bánh xe, thể hiện cho sức mạnh và sự gan góc của dân biker đích thực.
Đây chính là hình ảnh đặc trưng nhất và luôn gắn liền với họ trên mọi hành trình.',
                'creator_id' => 1
            ],

            [
                'id' => 29,
                'name' => 'Vòng tay kim loại Helios Chain Black',
                'description' => 'Câu chuyện của sản phẩm: Chiếc vòng mới nhất tại Helios Accessories được phát triển từ dáng Byzantine Box Chain đậm chất streetwear.

Các mắt xích móc nối chắc chắn, bao phủ một tông màu đen xước cực bụi bặm và phóng khoáng..

Phần khóa cài đóng mở thuận tiện, đảm bảo cho trải nghiệm đeo dễ chịu nhất.',
                'creator_id' => 1
            ],

            [
                'id' => 30,
                'name' => 'Vòng Tay Bạc S925 Lotus x Tramhuong Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Vòng tay Lotus x Tramhuong là kết quả của quá trình tết dây tỉ mỉ và chắc chắn theo phong cách Macrame độc đáo.

Đan xen giữa các miếng gỗ vuông phá cách là 3 mặt charm Lotus bạc Thái, tạo nên một vẻ đẹp khỏe khoắn và thô mộc cho sản phẩm.

Bên cạnh đó, chất liệu trầm hương sánh chìm còn sở hữu một mùi thơm tự nhiên dễ chịu, giúp tinh thần trở nên khoan khoái và thư giãn hơn. 

Kết hợp với hình ảnh hoa sen thanh khiết, chế tác này mang ý niệm về sự bình an và thuận lợi trong cuộc sống.',
                'creator_id' => 1
            ],

            [
                'id' => 31,
                'name' => 'Vòng Tay Bạc S925 Chain Helios Gle x Lotus Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Vòng tay Gle x Lotus được thiết kế theo dáng Box Chain cong, đặc trưng bởi các mắt xích hình hộp.

Phần khóa cài được chạm khắc tỉ mỉ họa tiết Lotus độc bản của Helios.

Tạo nên một điểm nhấn đơn giản mà mạnh mẽ cho bộ trang phục của anh em.',
                'creator_id' => 1
            ],

            [
                'id' => 32,
                'name' => 'Vòng Tay Bạc S925 ThuanThien X Lotus Bracelet Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Thuanthien x Lotus là sự kết hợp của hai biểu tượng đến từ 2 BST mang đậm tinh thần dân tộc tại Helios.

Nếu hoa sen kết tinh từ những phẩm chất tốt đẹp, thuần khiết nhất, thì Thuận Thiên kiếm lại thể hiện sức mạnh, ý chí đấu tranh để bảo vệ bờ cõi.

Đối lập nhưng lại bổ sung hoàn hảo cho nhau, nói lên giá trị truyền thống trong văn hóa và lịch sử Việt Nam.',
                'creator_id' => 1
            ],

            [
                'id' => 33,
                'name' => 'Vòng Tay Bạc S925 Lotus Silk Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Mặt trước là hoa văn Lotus chạm nổi sắc nét, biểu tượng cho vẻ đẹp tinh khiết nhưng cũng đầy bí ẩn.

Phần khóa của vòng tay được thiết kế thẩm mỹ mà không làm giảm sự chắc chắn và tiện dụng khi đeo. 

Với kiểu dáng dày dặn và khỏe khoắn, vòng tay Lotus Silk sẽ mang đến cho anh em cảm giác tự tin, từ đó khẳng định dấu ấn thời trang của chính mình..

Tạo nên một điểm nhấn đơn giản mà mạnh mẽ cho bộ trang phục của anh em.',
                'creator_id' => 1
            ],

            [
                'id' => 34,
                'name' => 'Vòng Tay Bạc S925 Gậy Như Ý Bạc Helios Original s925 VTBN0050',
                'description' => 'Câu chuyện từ nhà thiết kế: Chế tác mang tạo hình như gậy như ý của Tôn Ngộ Không trong trong Tây Du Ký.

Gậy Như Ý tùy tâm sử dụng, muốn lớn thì sẽ lớn, muốn nhỏ thì sẽ nhỏ, đại diện cho chí khí của con người.

Tên ban đầu của nó là “Định Hải Thần Trâm Thiết”, cũng nói lên ý nghĩa đó: Tâm người định thì biển lặng trời yên, tâm bất định ắt sẽ là cuồng phong bão tố.',
                'creator_id' => 1
            ],

            [
                'id' => 35,
                'name' => 'Vòng Tay Bạc S925 Cuban Twinkle 2 hàng đá Helios SIlver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Cuban Twinkle là chế tác mang đậm tinh thần đường phố và hiphop khi sở hữu dáng Cuban Iced Out chất ngầu và cực phá cách.

Từng mắt xích của chiếc vòng đều được đính tỉ mỉ 24 viên đá CZ, tạo nên vẻ ngoài không thể bị lu mờ.',
                'creator_id' => 1
            ],

            [
                'id' => 36,
                'name' => 'Vòng Tay Bạc S925 Chain Helios Rise x Lotus Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Vòng tay Rise x Lotus được thiết kế theo dáng Oval Cable, đặc trưng bởi các mắt xích dày khỏe khoắn và phóng khoáng.

Phần khóa cài được chạm khắc tỉ mỉ họa tiết Lotus độc bản của Helios.

Tạo nên một điểm nhấn đơn giản mà mạnh mẽ cho bộ trang phục của anh em.',
                'creator_id' => 1
            ],

            [
                'id' => 37,
                'name' => 'Vòng Tay Bạc S925 Ancient Dinosaurs Helios Silver Original VTBN0145',
                'description' => 'Ancient Dinosaurs Bracelet

Mỗi chiếc nhẫn, mặt dây chuyền, bông tai, vòng tay của HeliSilver đều được thiết kế và chế tác thủ công với chất liệu bạc s925 bởi các thợ kim hoàn bậc thầy tại xưởng sản xuất của chúng tôi ở Hà Nội.
Phù hợp với nhiều phong cách, trang phục.
Thanh lịch, bụi bặm, sang trọng, từ đơn giản tới tinh tế.
Sản phẩm có nhiều size hoặc có thể điều chỉnh size dễ dàng, phù hợp cho mọi lứa tuổi, giới tính.

Vòng tay bạc nam nữ tại HeliSilver được chế tác chuẩn bạc Thái S925, cực bền bỉ theo thời gian. Nó sẽ là món phụ kiện đồng hành bên bạn qua bao thăng trầm thì vẫn luôn mới và đẹp.

Các mẫu vòng tay bạc, lắc tay bạc tại HeliSilver được tuyển chọn kĩ với thiết kế đặc biệt, nhiều phong cách khác nhau, chiếc vòng tay sẽ làm nổi bật set đồ khi đi làm, đi chơi hay thậm chí là đi dự tiệc đều có thể đeo.',
                'creator_id' => 1
            ],

            [
                'id' => 38,
                'name' => 'Vòng Tay Bạc S925 Zenger x Lotus Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Vòng tay Zenger x Lotus được thiết kế theo dáng Curb Chain, đặc trưng bởi các mắt xích dẹt.

Phần khóa cài được chạm khắc tỉ mỉ họa tiết Lotus độc bản của Helios.

Tạo nên một điểm nhấn đơn giản mà chất ngầu cho bộ trang phục của anh em.',
                'creator_id' => 1
            ],

            [
                'id' => 39,
                'name' => 'Vòng tay kim loại nam, nữ Helios Emoji VTKL0108',
                'description' => 'Câu chuyện của sản phẩm: Quay ngược thời gian, trở lại ngày tháng thanh xuân với chiếc vòng tay Emoji khỏe khoắn.

Đan kết từ ngọc trai cùng phần charm emoji, skull thú vị, vừa cool ngầu lại vừa có chút nghịch ngợm.

Chứa đựng tinh thần của tuổi trẻ, sự tự tin vào chất riêng của bản thân. ',
                'creator_id' => 1
            ],

            [
                'id' => 40,
                'name' => 'Vòng tay kim loại Helios Good Luck VTKL0072',
                'description' => 'Chất liệu: Hợp kim trắng, mạ màu khi đúc, cực bền màu.

Size: Phù hợp với cổ tay từ 15~20 cm.

Kiểu dáng: Mẫu vòng tay kim loại mix giữa kiểu xích hầm hố pha thêm sợi chain nhỏ cực kỳ tinh tế. Charm treo khắc sắc nét tạo ra vẻ đẹp hoàn mĩ cho chiếc vòng.

PHONG CÁCH!

Đây có lẽ là phong cách cao cấp nhất của vòng đeo tay nam. Chúng là vật dụng khá liên quan và phù hợp với suit, sơ mi, cà vạt. Sự đa dạng về kiểu dáng là vô hạn nhưng tính hiệu quả của chúng thì như nhau: là phát ngôn táo bạo cho tính cách trên cổ tay người đàn ông – những chiếc vòng lớn, trơn và sáng luôn thể hiện sự cứng rắn, mạnh mẽ, nam tính.

CÁCH MIX VÒNG KIM LOẠI.

Hãy đeo một chiếc vòng tay kim loại khi bạn muốn nổi bật và thu hút sự chú ý của người khác, đồng thời kết hợp với quần áo đơn giản nhưng thanh lịch, sang trọng để nó tự “tỏa sáng” mỗi khi xuất hiện sau gấu tay áo của bạn. Bạn có thể chọn chiếc áo sơ mi có tay áo ngắn hơn một chút so với thông thường, điều này phụ thuộc vào độ dày của chiếc vòng mà bạn đeo trên cánh tay. Nếu chiều dài tay áo phù hợp, chiếc vòng đôi khi sẽ “lấp ló” và thu hút cái nhìn của người đối diện.

NHỮNG CHÚ Ý THƯỜNG GẶP KHI ĐEO.

Hãy tránh xa những chiếc vòng quá hào nhoáng và lấp lánh. Vòng kim loại chỉ nên có một hay hai màu là đủ. Nếu muốn kết hợp với đồng hồ, lời khuyên chân thành là hãy chọn những chiếc vòng mỏng và ít họa tiết, bạn nên hiểu rằng đây là sự kết hợp mang tính bổ trợ chứ không phải sự kết hợp tương đương.',
                'creator_id' => 1
            ],

        ];

        $productVongTay = [];
        //VongTay
        foreach ($dataVongTay as $vongTay) {
            $existingProduct = Product::where('name', $vongTay['name'])->first();

            if (!$existingProduct) {
                $createdProduct = Product::create($vongTay);
                $productVongTay[] = $createdProduct->id;
            }
        }

        if (!empty($productVongTay)) {
            $categoryVongTay = $this->categoryService->getById(3);
            $categoryVongTay->syncProducts($productVongTay);
        }

        $dataKhuyenTai = [
            [
                'id' => 41,
                'name' => 'Khuyên Tai Bạc S925 Devil’s Piercing Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Devil’s Piercing nằm trong dự án hợp tác giữa Helios và Viet Devils - Cộng đồng fan Man United Việt Nam.

Chế tác dựa trên dáng Hoop cơ bản của dòng khuyên tai, được thiết kế với hình ảnh cây đinh ba khỏe khoắn của Quỷ Đỏ.

Đây là chi tiết đặc trưng nhất của đội bóng MU, bởi nó toát lên khí thế hừng hực mỗi trận cầu và vẻ ngạo nghễ trên đỉnh vinh quang.',
                'creator_id' => 1
            ],

            [
                'id' => 42,
                'name' => 'Khuyên Tai Bạc S925 Lotus Tiny Bud Helios Silver Original',
                'description' => 'Bảo hành: Theo chính sách bảo hành và nhận đánh sáng sản phẩm trọn đời

Câu chuyện từ nhà thiết kế: Thiết kế phát triển từ chế tác Lotus Buds Stud, lấy cảm hứng từ hình ảnh hoa sen đậm chất Việt.

Kết hợp đường nét của nghệ thuật Gothic để tôn lên vẻ sắc sảo mà mềm mại, gai góc mà uyển chuyển.

Với kích thước nhỏ chỉ bằng 2/3 Lotus Buds Stud, cực tinh tế nhưng vẫn không kém ấn tượng và chất ngầu.',
                'creator_id' => 1
            ],

            [
                'id' => 43,
                'name' => 'Khuyên Tai Bạc S925 Kê Túc Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Xa xưa, trong dân gian lưu truyền một cách đoán mệnh thông qua tướng chân gà.

Người xem có thể tường tận điềm tốt - điềm xấu, những thuận lợi - rủi ro trong năm. Thế nhưng suy cho cùng, mọi thứ đều do chính bản thân ta quyết định.

Không thể vì sự dự báo mà thay đổi mình, không thể vì ngoại cảnh mà biến chất, trở thành một con người hoàn toàn khác.',
                'creator_id' => 1
            ],

            [
                'id' => 44,
                'name' => 'Khuyên Tai Bạc S925 Phi Thuyền Frieza Duong Minh Hai x Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Lấy cảm hứng từ bộ manga huyền thoại Dragon Ball.

Phi Thuyền Frieza dựa trên con tàu vũ trụ đưa Goku từ hành tinh Vegeta đến Trái Đất. 

Đây cũng là dạng tàu mà rất nhiều nhân vật m sử dụng để du hành trong không gian, trong đó có Frieza - Kẻ thù không đội trời chung của người Saiyan.',
                'creator_id' => 1
            ],

            [
                'id' => 45,
                'name' => 'Khuyên Tai Bạc S925 Flying Nimbus Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: Lấy cảm hứng từ bộ manga huyền thoại Dragon Ball.

Flying Nimbus gợi nhắc tới Cân Đẩu Vân - Phương tiện di chuyển khi nhỏ của Son Goku. 

Chỉ những ai có trái tim nhân hậu, thuần khiết, chính trực mới có thể đứng được trên đó.',
                'creator_id' => 1
            ],

            [
                'id' => 46,
                'name' => 'Khuyên Tai Bạc S925 Double Standard Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: DOUBLE STANDARD - Tiêu chuẩn Kép. 
Chiếc khuyên được thiết kế với 2 vòng dây kẽm song song, đại diện cho tiêu chuẩn kép mà xã hội luôn mặc định, gán ghép cho người đàn ông.',
                'creator_id' => 1
            ],

            [
                'id' => 47,
                'name' => 'Khuyên Tai Bạc S925 Rebellion Helios Silver Original',
                'description' => 'Câu chuyện từ nhà thiết kế: REBELLION - Nổi loạn. 

Việc đeo khuyên ở nam giới tuy đã phổ biến, nhưng dáng ear cuff (khuyên kẹp vành) vẫn bị coi là “kỳ lạ”, “khác thường”.

Chế tác Rebellion được ra đời như lời phủ định mạnh mẽ đối với những quy chuẩn đó.

Cũng tương tự như cuộc đời của người đàn ông, không thiếu những lần nổi loạn để thể hiện cá tính của riêng mình, đấu tranh để thoát khỏi những khuôn mẫu mà gia đình - xã hội áp đặt.',
                'creator_id' => 1
            ],

            [
                'id' => 48,
                'name' => 'Khuyên Tai Bạc S925 Tiny Diamond 6mm Helios Silver Original KTB322',
                'description' => 'Câu chuyện từ nhà thiết kế: Chế tác được hoàn thiện với tinh thần “Less is More”.

Không cần quá hào nhoáng, phô trương, chỉ đơn giản là một chiếc khuyên tai nhỏ với viên đá CZ đã đủ tôn lên bộ trang phục của anh em.',
                'creator_id' => 1
            ],
        ];

        $productKhuyenTai = [];
        //VongTay
        foreach ($dataKhuyenTai as $khuyenTai) {
            $existingProduct = Product::where('name', $khuyenTai['name'])->first();

            if (!$existingProduct) {
                $createdProduct = Product::create($khuyenTai);
                $productKhuyenTai[] = $createdProduct->id;
            }
        }

        if (!empty($productKhuyenTai)) {
            $categoryKhuyenTai = $this->categoryService->getById(4);
            $categoryKhuyenTai->syncProducts($productKhuyenTai);
        }

        $dataDongHo = [
            [
                'id' => 49,
                'name' => 'Helios Watch Sun',
                'description' => 'Chất liệu vỏ: Thép không gỉ 316L được đa số hãng đồng hồ lớn sử dụng, mạ màu vàng hồng và màu bạc đánh xước, không bị phai màu

                Mặt đồng hồ: 40mm
                
                Mặt kính: Kính Minerals, dày 2mm
                
                Chất liệu dây: Da thật Genuine Leather
                
                Size dây: 22mm
                
                Máy sử dụng: Miyota 2115. Máy sản xuất tại NHẬT BẢN hãng Miyota
                
                Chống nước 3 ATM',
                'creator_id' => 1
            ],

            [
                'id' => 50,
                'name' => 'Dây da đồng hồ Apple Watch Lotus',
                'description' => 'Tác phẩm mới này sự kết hợp hoàn hảo bởi đôi bàn tay của người thợ da lành nghề và người thợ kim hoàn bậc thầy.
                            Được hoàn thiện bằng:
                            ▪️ Chất liệu Da Epsom cho bản phối màu đen.
                            ▪️ Charm bạc s925 đính đá Cz.
                            Sản phẩm được gia công phù hợp cho 2 size khác nhau cho Apple Watch.',
                'creator_id' => 1
            ],
        ];

        $productDongHo = [];
        //Dong Ho
        foreach ($dataDongHo as $dongHo) {
            $existingProduct = Product::where('name', $dongHo['name'])->first();

            if (!$existingProduct) {
                $createdProduct = Product::create($dongHo);
                $productDongHo[] = $createdProduct->id;
            }
        }

        if (!empty($productDongHo)) {
            $categoryDongHo = $this->categoryService->getById(5);
            $categoryDongHo->syncProducts($productDongHo);
        }
    }
}
