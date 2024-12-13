USE prismora;

DROP PROCEDURE IF EXISTS clearData;
CREATE PROCEDURE clearData()
BEGIN
    SET FOREIGN_KEY_CHECKS = 0;
    
    DELETE FROM users;
    DELETE FROM categories;
    DELETE FROM products;
    DELETE FROM product_images;
    DELETE FROM reviews;
    DELETE FROM product_in_orders;
    DELETE FROM orders;

    SET FOREIGN_KEY_CHECKS = 1;
END;

CALL clearData();


INSERT INTO categories (id, name) VALUES
(1, 'Điện thoại'),
(2, 'Laptop'),
(3, 'Máy tính bảng'),
(4, 'Đồng hồ thông minh'),
(5, 'Phụ kiện');



INSERT INTO products (id, name, description, price, quantity, category_id) VALUES 
(1, 
 'Laptop Lenovo Legion 7 16IRX9 83FD004MVN', 
 'Laptop Lenovo Legion 7 16IRX9 83FD004MVN sở hữu cấu hình cực khủng khi được trang bị chip Intel Core i9-14900HX, VGA NVIDIA GeForce RTX 4070 cùng 32GB RAM và ổ cứng SSD 512GB. Với màn hình 16 inch 3.2K, người dùng sẽ luôn trải nghiệm được những khung hình với độ sắc nét cao, mượt mà trong quá trình làm việc, chơi game. Đi kèm laptop Lenovo Legion này là một thiết kế cứng cáp, mạnh mẽ và sang trọng để phù hợp sử dụng trong nhiều không gian.',
 62990000, 
 100, 
 2),

(2, 
 'Xiaomi Pad 6S Pro Wifi 8GB 256GB', 
 'Máy tính bảng Xiaomi Pad 6S Pro là sản phẩm cao cấp với thiết kế sang trọng, khung viền chắc chắn và mặt lưng nhám mịn, giúp hạn chế dấu vân tay. Màn hình lớn 12.4 inch độ phân giải 3K, tần số quét 144Hz, mang đến trải nghiệm hình ảnh sắc nét và mượt mà. Với vi xử lý Snapdragon 8 Gen 2 cùng RAM lên đến 8GB, máy cho hiệu năng mạnh mẽ, phù hợp cả cho công việc lẫn giải trí. Pin 10.000mAh và sạc nhanh 120W đảm bảo thời gian sử dụng dài. Máy cũng có kết nối Wi-Fi hiện đại trải nghiệm mạng nhanh chóng.', 
 13990000, 
 100, 
 3),

(3, 
 'iPhone 15 Pro Max', 
 'iPhone 15 Pro Max sở hữu màn hình Super Retina XDR OLED 6.7 inches với độ phân giải 2796 x 1290 pixels, cung cấp trải nghiệm hình ảnh sắc nét, chân thực. So với các phiên bản tiền nhiệm, thế hệ iPhone 15 bản Pro Max đảm bảo mang tới hiệu năng mạnh mẽ với sự hỗ trợ của chipset Apple A17 Pro, cùng bộ nhớ ấn tượng. Đặc biệt hơn, điện thoại iPhone 15 ProMax mới này còn được đánh giá cao với camera sau 48MP và camera trước 12MP, hỗ trợ chụp ảnh với độ rõ nét cực đỉnh.', 
 29490000, 
 130, 
 1),

(4, 
 'iPad Pro M4 13 inch Wifi 1TB Nano', 
 'Màn hình Ultra Retina XDR công nghệ OLED hai lớp siêu mỏng.Chip Apple M4 cho hiệu năng như mơ, hoàn thành tác vụ đồ họa nhẹ nhàng.Pin dùng cả ngày để làm việc, học tập, sáng tạo và giải trí.Trang bị magic Keyboard, Apple Pencil Pro, Wi-Fi 6E, kết nối 5G.', 
 55990000, 
 100, 
 3),

(5, 
'Tai nghe Bluetooth chụp tai Sony WH-CH520', 
'Đặc điểm nổi bật<br/>Âm thanh kỹ thuật số DSEE cho chất âm chân thực, sống động trong từng nốt nhạc<br/>Thiết kế hiện đại, màu sắc thanh lịch cùng trọng lượng nhẹ giúp dễ dàng mang theo<br/>Thời gian sử dụng đến 40 giờ, cho bạn thoả sức trải nghiệm mà không lo gián đoạn<br/>Tích hợp micro có khả năng chống ồn tốt mang đến chất lượng đàm thoại rõ nét hơn<br/>Tai nghe Sony WH-CH520 sở hữu âm thanh kỹ thuật số DSEE giúp mang lại âm thanh chân thực cùng với đó là pin cho thời gian sử dụng tới 40 giờ. Bên cạnh đó, sản phẩm tai nghe Sony này sở hữu thiết kế khá gọn nhẹ cùng với thiết kế tích hợp micro vô cùng tiện lợi.<br/>Vì sao nên mua tai nghe Sony WH-CH520<br/>Sony là một thương hiệu âm thanh chất lượng với các sản phẩm đạt yêu cầu cao.<br/>Vậy Sony WH-CH520 có mang những đặc điểm của sản phẩm Sony trước đó, có đáng mua sử dụng không?<br/><br/>-  Âm thanh kỹ thuật số DSEE: Mang lại âm thanh sống động và chân thực trong từng nốt nhạc<br/><br/>-  Pin sử dụng 40 giờ: Giúp người dùng thỏa sức trải nghiệm giải trí mà không lo gián đoạn<br/><br/>-  Micro chống ồn: Mang lại khả năng đàm thoại với âm thanh rõ nét', 
1090000, 
103, 
5),

(6, 
 'Đồng hồ thông minh Huawei Watch Fit 3', 
 'Đặc điểm nổi bật<br/>Thiết kế viền siêu mỏng, mang lại cảm giác nhẹ tay, thoải mái<br/>Màn hình 1.82 inch Amoled rất sắc nét, hình vuông tràn viền<br/>Tích hợp công nghệ giúp chăm sóc sức khoẻ cực tốt<br/>Có nhiều chức năng tập luyện thể thao tiện lợi, hiện đại<br/>Huawei Watch Fit 3 chính là món phụ kiện hữu ích giúp bạn theo dõi các chỉ số sức khỏe đồng thời là một người bạn đồng hành trong quá trình tập luyện lý tưởng với nhiều tính năng tập luyện, huấn luyện viên ảo,…trong một mức giá hợp lý, hấp dẫn.<br/>- Màn hình AMOLED 1.82 inch : Chất lượng hiển thị sắc nét với 347 PPI và độ sáng 1500 nits, rõ ràng dưới mọi ánh sáng;<br/>- Theo dõi sức khỏe toàn diện : Cung cấp dữ liệu nhịp tim, chỉ số SpO2, giấc ngủ, và sức khỏe phụ nữ;<br/>- Hơn 100 chế độ luyện tập và GPS tích hợp : Giúp quản lý hoạt động thể chất một cách hiệu quả<br/>- Thời lượng pin lâu dài : Dung lượng 400mAh trên Huawei Fit 3 cho phép sử dụng tối đa 10 ngày và trung bình 7 ngày;<br/>- Hỗ trợ gọi thoại và nhận thông báo thông qua Bluetooth, không bỏ lỡ bất kỳ thông báo quan trọng nào;<br/>- Theo dõi lượng calo tiêu thụ và nhật ký ăn uống, giúp theo dõi quản lý sức khoẻ một cách khoa học;<br/>- Trang bị núm xoay cho phép phóng to thu nhỏ màn hình ứng dụng, điều chỉnh âm lượng hay cuộn lên xuống danh sách;', 
 2790000, 
 253, 
 4),

(7, 
 'Apple Watch Series 9 45mm (GPS) viền nhôm dây cao su | Chính hãng Apple Việt Nam', 
 'Đặc điểm nổi bật<br/>Trang bị chip S9 SiP mạnh mẽ hỗ trợ xử lý mọi tác vụ nhanh chóng với nhiều tiện ích<br/>Dễ dàng kết nối, nghe gọi, trả lời tin nhắn ngay trên cổ tay<br/>Trang bị nhiều tính năng sức khỏe như: Đo nhịp tim, điện tâm đồ, đo chu kỳ kinh nguyệt,...<br/>Độ sáng tối đa lên tới 2000 nit, dễ xem màn hình ngay dưới ánh nắng gắt<br/>Tích hợp nhiều chế độ tập luyện với các môn thể thao như: Bơi lội, chạy bộ, đạp xe,...<br/>Đồng hồ Apple Watch Series 9 45mm sở hữu on chip S9 SiP - CPU với 5,6 tỷ bóng bán dẫn giúp mang lại hiệu năng cải thiện hơn 60% so với thế hệ S8. Màn hình thiết bị với kích thước 45mm cùng độ sáng tối đa lên 2000 nit mang lại trải nghiệm hiển thị vượt trội. Cùng với đó, đồng hồ Apple Watch s9 này còn được trang bị nhiều tính năng hỗ trợ theo dõi sức khỏe và tập luyện thông minh.<br/>Apple Watch Series 9 45mm - Thiết kế sang trọng, tính năng mới mẻ<br/>Apple Watch 9 45mm có chất lượng hiển thị rất sắc nét, độ sáng cao lên tới 2.000 nits. Bên cạnh đó, thiết bị tích hợp cả tính năng Double Tap hiện đại, mở ứng dụng tương ứng nhanh chóng hơn.<br/>Thiết kế bo cong, màn hình độ sáng cao<br/>Tổng thể ngoại hình của chiếc đồng hồ này khá nhỏ gọn, đường góc cạnh cong mềm mại, nhìn trông khá bắt mắt.', 
 10790000, 
 254, 
 4),

(8, 
 'Samsung Galaxy S24 Plus', 
 'Samsung Galaxy S24 Plus có màn hình 6.7 inch, với tấm nền Dynamic AMOLED 2X giúp hình ảnh sống động đến từng chi tiết, độ làm mới liên tục từng giây. Camera của điện thoại gồm: camera chính 50MP và camera selfie 12MP, giúp ghi lại những khoảnh khắc đáng nhớ của bạn bên gia đình. Hiệu năng mạnh mẽ với dung lượng 8GB+256GB,viên pin 4.900 mAh kết hợp sạc nhanh 45W.', 
 21990000, 
 130, 
 1),

(9, 
 'Máy Tính Bảng Lenovo Tab M11 8GB 128GB ZADB0162VN', 
 'Máy tính bảng Lenovo Tab M11 là chiếc máy tính bảng đa năng có kiểu dáng bắt mắt với phần vỏ ngoài làm bằng nhôm tạo cảm giác sang trọng và bền bỉ. Phiên bản tablet này có màn hình rộng 11 inch với độ phân giải 1920x1200 và tần số làm mới 90Hz cho hình ảnh hiển thị chân thật. Mẫu máy tính bảng Lenovo này sở hữu cấu hình mạnh nhờ trang bị chip Helio G88 cùng dung lượng lưu trữ lớn với tùy chọn RAM 8GB và bộ nhớ 128GB.', 
 6490000, 
 100, 
 3),

(10, 
 'Tai nghe Bluetooth True Wireless JBL Live Pro 2', 
 'Đặc điểm nổi bật<br/>Đắm chìm trong không gian riêng tư với công nghệ chống ồn chủ động hiện đại<br/>Thoải mái đi xa mà không sợ bị gián đoạn với viên pin đến 40 giờ kèm hộp sạc<br/>Trò chuyện không giới hạn với 6 mic thoại được tích hợp giúp loại bỏ mọi tạp âm<br/>Công nghệ Bluetooth 5.4 hỗ trợ kết nối, chuyển đổi nhanh chóng giữa 2 thiết bị<br/>Tai nghe JBL Live Pro 2 – Trải nghiệm âm nhạc ấn tượng<br/>Sản phẩm JBL Live Pro 2 có thiết kế độc đáo, hút mắt cùng khả năng loại bỏ tiếng ồn tuyệt vời đã thu hút sự quan tâm của không ít người dùng. Dòng tai nghe không dây có thể thưởng thức âmnhạc, thực hiện cuộc gọi và không bị ảnh hưởng bởi bất kỳ tiếng ồn nào từ môi trường xung quanh.<br/>Âm thanh JBL Signature Sound vượt trội<br/>Tai nghe Live Pro 2 được trang bị âm thanh JBL Signature Sound kết hợp với driver kích thước 11mm mang lại cho người dùng trải nghiệm âm thanh vượt trội.<br/>Tai nghe JBL Live Pro 2<br/>Thiết kế nhỏ gọn, 6 micro đàm thoại chất lượng cao<br/>Tai nghe JBL Live Pro 2 có thiết kế nhỏ gọn và có hình bầu dục ở phần thân và đầu silicone. Không chỉ mang đến sự thoải mái cho người dùng khi sử dụng trong thời gian dài, tai nghe còn ôm sát vào vành tai, hỗ trợ chống ồn tốt hơn. Kết hợp với khả năng chống ồn được tích hợp sẵn trong thiết bị, chắc chắn tai nghe sẽ mang đến những bản nhạc trong trẻo, sinh động nhất.<br/>Tai nghe JBL Live Pro 2<br/>Với sự tích hợp của 6 micro bên trong, JBL Live Pro 2 còn có khả năng loại bỏ tiếng gió và tiếng ồn xung quanh, hỗ trợ chất lượng đàm thoại rõ ràng hơn, đặc biệt trong những điều kiện ồn ào.', 
 4990000, 
 100, 
 5),
 
(11, 
'Tai nghe Bluetooth True Wireless Edifier NeoBuds Pro 2',
'Đặc điểm nổi bật<br/>Trang bị khử ồn chủ động với MIC 2 chiều, tránh xa mọi nhiễu loạn từ bên ngoài<br/>Hiệu ứng âm thanh vòm sống động mang đến cho bạn trải nghiệm nghe cực đỉnh<br/>Thuật toán ENC mới cùng với micro kép mang lại khả năng khử tiếng ồn tốt hơn<br/>Tiết kiệm thời gian sạc nhờ tính năng sạc nhanh, chỉ với 15 phút sạc cho 2 giờ<br/>Tai nghe không dây Edifier NeoBuds Pro 2 - Ngoại hình hiện đại<br/>Tai nghe không dây Edifier NeoBuds Pro 2 có kiểu dáng thiết kế khá độc đáo, đậm chất Gaming. Bên cạnh đó, sản phẩm tai nghe Edifier đi cùng với những công nghệ hiện đại như ANC HI-RES, phát ra âm thanh hài hòa, trong trẻo.<br/>Ngoại hình bắt mắt<br/>Tai nghe không dây Edifier NeoBuds Pro 2 được nhà sản xuất thiết kế rất tỉ mỉ, một số đường góc cạnh vuông vức, tạo nên ngoại hình mạnh mẽ, phù hợp với những bạn game thủ.<br/>Thiết kế Edifier NeoBuds Pro 2<br/>Trọng lượng của thiết bị khá nhẹ, đem lại cảm giác đeo dễ chịu, không bị đau tai khi sử dụng thời gian dài. Ngoài ra, hộp đựng có họa tiết đường kẻ sọc trang bị đèn LED nhìn trông rất bí hiểm.<br/>Hỗ trợ nhiều tính năng hiện đại<br/>Tai nghe không dây Edifier NeoBuds Pro 2 trang bị tính năng khử tiếng ồn ANC, đảm bảo người dùng tận hưởng âm thanh trọn vẹn, không bị tác động bởi những tạp âm bên ngoài.<br/>Tính năng tai nghe Edifier NeoBuds Pro 2<br/>Thiết bị tích hợp công nghệ Bluetooth mới nhất, giúp đường truyền kết nối với smartphone, laptop, tablet,... ổn định, gần như không xảy ra hiện tượng khựng, hay rè âm thanh.<br/>Thời lượng pin của tai nghe không dây Edifier NeoBuds Pro 2 khá trâu, thoải mái sử dụng cả ngày dài một cách liền mạch.<br/>Mua ngay tai nghe không dây Edifier NeoBuds Pro 2 chính hãng, giá rẻ tại CellphoneS<br/>Như vậy, nếu bạn muốn sử dụng tai nghe không dây có khả năng khử tiếng ồn vượt trội, thiết kế hiện đại, thời lượng pin lâu dài thì nên mua ngay Edifier NeoBuds Pro 2 tại cửa hàng CellphoneS để nhận được hàng chính hãng nhé.', 
2390000, 
102, 5),

(12,
'OPPO Find X5 Pro', 
'OPPO Find X5 Pro sở hữu thiết kế tinh tế, đẳng cấp với mặt sau chất liệu gốm, thêm vào đó là camera Hasseblad cùng màn hình 1 tỷ màu Bionic và hiệu năng vượt trội từ chip Snapdragon 8 Gen 1. Hệ thống camera đột phá với 3 camera sau và camera selfie chất lượng cao cho những bức ảnh ấn tượng, đặc biệt là khả năng quay đếm 4K.', 
15990000, 
130, 
1),

(13,
'Máy Tính Bảng Huawei Matepad 11.5\'\'S 8GB 256GB Xám', 
'Huawei MatePad 11.5S là chiếc máy tính bảng mới ra mắt được trang bị chip Kirin 9000WL, dung lượng RAM 8GB cùng bộ nhớ trong 256GB. Máy sử dụng màn hình TFT LCD (paper mate) với kích thước 11.5 inch, độ sắc nét 2.8K (2800x1840px) và tốc độ làm mới 144Hz. Máy trang bị pin 8800mAh, có camera sau 13MP và trước 8MP.', 
13490000, 
100, 
3),

(14, 
'Tai nghe Bluetooth True Wireless Marshall Minor 3 (III)', 
'Đặc điểm nổi bật<br/>Thời lượng pin tốt, có thể hoạt động đến 5 giờ liên tục và 25 giờ khi kèm hộp sạc<br/>Màng loa 12mm được tuỳ chỉnh mang đến chất lượng âm thanh rõ ràng, sắc nét<br/>Trang bị kháng nước chuẩn IPX4 giúp bảo vệ tai nghe khỏi mồi hôi và nước bắn<br/>Tích hợp cảm biến tiệm cận có khả năng tự động dừng tắt nhạc khi tháo tai nghe<br/>Tai nghe không dây Marshall Minor 3 - Chất âm sống động, kiểu dáng nhỏ gọn, sang trọng<br/>Nếu bạn là người có sở thích nghe nhạc thì dòng tai nghe không dây Marshall Minor 3 sẽ là một trong những lựa chọn tuyệt vời không nên bỏ qua. Sở hữu chất lượng âm thanh tuyệt hảo, thiết kế sang trọng và khả năng kết nối không dây ổn định, thế hệ tai nghe Marshall này sẽ mang đến cho bạn nhiều trải nghiệm nghe nhạc chất lượng cao và cực kỳ thoải mái. Cùng tìm hiểu thêm về tai nghe Marshall ngay trong bài viết dưới này nhé!<br/>Trình xử lý âm thanh cỡ lớn, cho trải nghiệm âm nhạc tuyệt đỉnh<br/>Điểm nhấn ấn tượng trên thông số kỹ thuật của tai nghe không dây Marshall Minor 3 là trình xử lý âm thanh Driver Dynamic 12mm cao cấp. Thông qua khả năng tinh chỉnh chất âm đỉnh cao, Minor 3 sẽ mang tới cho người dùng những trải nghiệm âm nhạc mạnh mẽ, tái hiện sự sống động trên từng giai điệu.<br/>Tai nghe không dây Marshall Minor 3<br/>Đi kèm với đó là tính năng điều khiển cảm ứng siêu nhạy bén, cho phép người sử dụng dễ dàng thao tác trả lời thoại, chỉnh sửa âm lượng tai nghe mà không làm gián đoạn trải nghiệm. Đặc biệt, khi bạn buộc phải tháo tai nghe khỏi tai, hệ thống cũng sẽ tự động kích hoạt trạng thái tạm dừng của bản nhạc đang phát. Qua đó, bạn sẽ không bỏ lỡ bất kỳ giai điệu nào trong bài nhạc yêu thích của mình rồi nhé!<br/>Tạo hình Earbuds siêu gọn nhẹ, kiểu dáng sang trọng<br/>Thiết kế bên ngoài của tai nghe không dây Marshall Minor 3 nhận về vô số lời khen khi sở hữu kiểu dáng cổ điển sang trọng cùng tạo hình Earbuds vô cùng gọn nhẹ, tạo cảm giác thoải mái khi mang.<br/>Tai nghe không dây Marshall Minor 3 - Chất âm sống động, kiểu dáng nhỏ gọn, sang trọng<br/>Theo đó, với trọng lượng chỉ 40 gram, tai nghe này không gây bất kỳ ấp lực nào cho tai của người dùng mà ngược lại còn đảm bảo sự dễ chịu, nhẹ nhàng trong quá trình trải nghiệm. Sự kết hợp hoàn hảo giữa kích thước nhỏ gọn và thiết kế sang trọng đã tạo nên một sự tinh tế và tiện lợi tuyệt vời dành cho người dùng.<br/>Nâng cao độ bền bỉ với chỉ số chống nước đạt tới IPX4<br/>Về khả năng kháng nước, tai nghe Marshall Minor 3 đảm bảo độ bền bỉ cao khi được chứng nhận với chỉ số chống nước lên đến IPX4. Với ưu điểm kháng nước ấn tượng này, tai nghe Minor 3 có thể chống chịu được trong các môi trường ẩm ướt nhẹ.<br/>Tai nghe không dây Marshall Minor 3 - Chất âm sống động, kiểu dáng nhỏ gọn, sang trọng<br/>Chính vì vậy mà bạn có thể thoải mái trải nghiệm dòng tai nghe chính hãng này trong các hoạt động thể thao ngoài trời mà không lo bị hỏng hóc nữa rồi nhé!<br/>Không gián đoạn trải nghiệm với thời gian sạc siêu nhanh<br/>Thông số sạc pin trên tai nghe không dây Marshall Minor 3 cũng được đánh giá khá cao. Nó cho phép người sử dụng có được trải nghiệm giải trí liền mạch, không bị gián đoạn nhờ thời gian sạc siêu nhanh.<br/>Tai nghe không dây Marshall Minor 3 - Chất âm sống động, kiểu dáng nhỏ gọn, sang trọng<br/>Với chỉ 15 phút sạc, tai nghe Marshall Minor 3 cho phép bạn có thể thoải mái tận hưởng những phút giây giải trí tuyệt vời trong hơn 1.5 giờ. Còn khi được nạp đầy pin cho cả hộp sạc lẫn tai nghe. Thời lượng nghe nhạc, giải trí của bạn sẽ còn được kéo dài hơn rất nhiều, lên đến 25 giờ chỉ sau 1 lần sạc duy nhất khi dùng với hộp sạc.<br/>Kết nối linh hoạt đa thiết bị với chuẩn Bluetooth 5.2<br/>Nhờ được tích hợp công nghệ kết nối không dây Bluetooth 5.2 hiện đại, tai nghe Marshall Minor 3 có thể dễ dàng ghép nối và chuyển đổi giữa các thiết bị di động như điện thoại, tablet, laptop mà không gặp bất kỳ trục trặc kết nối gì.<br/>Kết nối linh hoạt đa thiết bị với chuẩn Bluetooth 5.2<br/>Đồng thời, độ ổn định cũng như tốc độ truyền tải của tai nghe Minor 3 cũng được cải thiện hơn các thế hệ tiền nhiệm rất nhiều. Nhờ đó mà mọi giai điệu được truyền tải từ thiết bị qua tai nghe Marshall Minor 3 đều vô cùng mượt mà và không bị gián đoạn trong phạm vi 10m.<br/>Mua tai nghe không dây Marshall Minor 3 giá tốt tại cửa hàng CellphoneS<br/>Dòng tai nghe không dây Marshall Minor 3 hiện đang có mặt tại cửa hàng công nghệ CellphoneS với mức giá cực ưu đãi cùng chất lượng đạt chuẩn chính hãng 100%. Liên hệ ngay tới cho CellphoneS để nhận thêm thông tin và được tư vấn đặt mua thế hệ tai nghe không dây Marshall này ngay bạn nhé.', 
2290000, 
101, 
5),

(15, 
'Laptop ASUS ROG Zephyrus G16 GA605WI-QR090WS',
'Laptop Asus ROG Zephyrus G16 GA605WI-QR090WS trang bị CPU AMD Ryzen AI 9 HX 370 với 12 nhân, xung nhịp tối đa 5.1GHz và card đồ họa RTX 4070 8GB GDDR6. Máy có RAM 32GB LPDDR5X và ổ cứng SSD 1TB, hỗ trợ nâng cấp tối đa 2TB. Sản phẩm laptop Asus ROG có màn hình OLED 16 inch WQXGA 240Hz, sử dụng viên pin 90Wh, nhiều cổng giao tiếp.', 
77990000, 
100,
2),

(16, 
'Xiaomi 14T Pro',
'Xiaomi 14T Pro 5G là một trong những mẫu smartphone cao cấp được mong đợi hàng đầu trong nửa cuối năm 2024. Sau nhiều tin đồn, Xiaomi chính thức ra mắt dòng sản phẩm vào ngày 26/9/2024 tại Berlin và ngày 27/9/2024 tại Việt Nam. Được kế thừa nhiều thành công từ dòng kế nhiệm, dòng kế nhiệm lần này được kỳ vọng là sẽ mang đến nhiều cải tiến đáng giá, đặc biệt là trong hiệu năng và thiết kế.', 
17990000, 
130, 
1), 

(17, 
'Tai nghe KZ EDX Pro',
'Đặc điểm nổi bật Kiểu dáng housing trong suốt, trẻ trung cùng trọng lượng siêu nhẹ Thiết kế công thái học tạo cảm giác thoải mái ngay cả khi đeo lâu Driver 10 mm cho chất âm to rõ, phù hợp với nhiều thể loại nhạc Dây đeo được nâng cấp giúp không bị rối và sử dụng lâu dài hơn Tai nghe KZ EDX Pro - Âm thanh khác biệt Thật khó tìm trên thị trường có những chiếc tai nghe có dây hỗ trợ cho trải nghiệm âm thanh chuẩn xác. Nhưng đâu đó, chúng ta vẫn tìm ra được một sản phẩm, mang tên tai nghe KZ EDX Pro, tích hợp những công nghệ bậc nhất trên thị trường. Thiết kế housing trong suốt, trọng lượng nhẹ dễ đeo Về tổng quan, tai nghe KZ EDX Pro sở hữu vẻ ngoài mang tính thẩm mỹ cao. Bởi phủ một lớp nhựa trong suốt, cho phép thể hiện rõ những cấu tạo ở bên trong tai nghe. Thiết kế housing trong suốt, trọng lượng nhẹ dễ đeo Bên cạnh đó, trọng lượng cũng là yếu tố hàng đầu để giúp cho tai nghe dễ dàng cảm nhận bởi người dùng. Với trọng lượng siêu nhẹ, bạn dễ dàng đeo tai nghe trong thời gian lâu dài mà không hề cảm thấy mỏi. Drive kích thước lớn, âm thanh mạch từ kép KZ EDX Pro đã lựa chọn sử dụng bộ âm thanh mạch từ kép làm nền tảng để phát triển các chức năng của tai nghe. Bằng cách tận dụng âm trầm và đẩy âm vocal lên, tai nghe này đã thể hiện rất rõ khả năng phát những bài hát cổ điển, acoustic một cách đầy ấn tượng. Drive kích thước lớn, âm thanh mạch từ kép Thành phần dây đeo của KZ EDX Pro được hoàn thiện từ chất liệu chống rối đặc biệt. Từ đó, hỗ trợ cho người dùng không phải tốn nhiều thời gian chỉ để gỡ rối. Mua ngay KZ EDX Pro chính hãng, giá rẻ tại CellphoneS Hãy đến ngay cửa hàng CellphoneS để tận tay trải nghiệm ngay phiên bản KZ EDX Pro giá rẻ. Hiện sản phẩm đang được bán với mức giá bán chính hãng cùng 12 tháng bảo hành.', 
300000, 
200, 
5),

(18, 
'Laptop Gaming Acer Nitro V ANV15-51-75GS', 
'Laptop Gaming Acer Nitro V ANV15-51-75GS là mẫu máy tính xách tay siêu đa dụng khi được trang bị con chip Core i7 13620H cùng VGA RTX 4050. Màn hình 15,6 inch sở hữu độ phân giải Full HD cùng tần số 144 Hz chuẩn gaming sẽ mang tới những giây phút giải trí đầy chất lượng. Đi kèm là một thiết kế cực ngầu để Acer Nitro V ANV15-51-75GS trở thành một trong những mẫu laptop gaming tầm trung đáng sở hữu nhất.', 
28990000, 
100, 
2),

(19, 
'Laptop MSI Pulse 17 AI C1VGKG-017VN', 
'Laptop MSI Pulse 17 AI C1VGKG-017VN đáp ứng mọi nhu cầu về đồ họa và gaming với CPU Intel Core Ultra 7 155H và VGA NVIDIA GeForce RTX 4070 8GB GDDR6. Với 32GB RAM DDR5 và ổ cứng 1TB NVMe PCIe, máy cung cấp tốc độ truy cập dữ liệu nhanh chóng và dung lượng lưu trữ lớn. Ngoài ra, sản phẩm sở hữu màn hình 17.0 Inch QHD+ IPS 240Hz cùng bàn phím RGB cực chất.', 
50490000, 
100, 
2),

(20, 
'Đồng hồ thông minh trẻ em Myalo K74',
'Đặc điểm nổi bật Thực hiện cuộc thông thường hay video call với sim 4G Nhiều trang bị tiện ích giúp chăm sóc bé cả ngày dài Phụ huynh dễ dàng kiểm tra bé với chế độ định vị Có thể nghư gọi trên cả đồng hồ Thời lượng pin sử dụng lên đến 60 giờ Đồng hồ thông minh trẻ em Myalo K74 – Bảo vệ an toàn từ xa Đồng hồ thông minh trẻ em Myalo K74 là mẫu đồng hồ trẻ em thông minh được kết hợp hoàn hảo giữa chiếc điện thoại của bố mẹ và đồng hồ của bé. Sự liên kết này sẽ giúp bố mẹ sẽ dễ dàng liên lạc, theo dõi và bảo vệ an toàn cho con từ xa. Liên lạc dễ dàng và đơn giản Đồng hồ thông minh trẻ em Myalo K74 hỗ trợ bố mẹ có thể dễ dàng liên lạc với con mọi lúc mọi nơi thông qua chức năng nghe gọi và nhắn tin thoại với âm lượng vang rõ ràng. Nhờ ứng dụng myAlo myKids bố mẹ có thể cài đặt danh bạ cho con và đồng thời ngăn chặn các cuộc gọi lạ đến đồng hồ để bảo vệ con một cách an toàn và toàn diện. Đồng hồ thông minh trẻ em Myalo K74 Thiết bị đồng hồ thông minh của Myalo cho phép các bé thực hiện cuộc gọi khẩn cấp SOS đến ba mẹ hoặc người thân ngay khi gặp nguy hiểm. Ngoài ra, trên chiếc thiết bị có khả năng thiết lập vùng an toàn trong phạm vi địa điểm đã được thiết lập sẵn. Nhờ đó bố mẹ sẽ cảm thấy an tâm hơn và thoải mái hơn về sự an toàn của con nhờ tính năng này. Thiết kế êm ái, nhẹ nhàng Đồng hồ thông minh trẻ em Myalo K74 được thiết kế xinh xắn, năng động cùng với trọng lượng cực kỳ nhẹ tạo sự thoải mái cho bé khi đeo trong thời gian dài. Mặc khác, chiếc đồng hồ này còn chống thấm nước, giúp các bé tha hồ tham gia các hoạt động vui chơi dưới nước mà không phải lo lắng đồng hồ sẽ bị hư khi ướt nước. Thiết kế đồng hồ thông minh trẻ em Myalo K74 Mua ngay đồng hồ thông minh trẻ em Myalo K74 tại CellphoneS Một chiếc đồng hồ thông minh trẻ em Myalo K74 mang nhiều tính năng thông minh để bảo vệ an toàn cho con từ xa tốt nhất mà ba mẹ nên trang bị. Đồng hồ thông minh trẻ em K74 của hãng Myalo hiện đang được bán tại các cửa hàng CellphoneS trên toàn quốc, hãy đến mua sắm ngay để nhận được nhiều ưu đãi bạn nhé!', 
2090000, 
252,
4),

(21, 
'Đồng hồ thông minh Huawei Watch GT 4', 
'Đồng hồ thông minh Huawei Watch GT 4 là mẫu đồng hồ thể thao cao cấp đến từ Huawei. Sản phẩm có khả năng chống nước lên đến 5ATM, cùng với cảm biến HR và ECG giúp theo dõi sức khỏe hiệu quả. Ngoài ra, thiết bị này còn hỗ trợ GPS, theo dõi giấc ngủ, đo độ SPO2, và có thể hoạt động liên tục lên đến 14 ngày. Với màn hình AMOLED 1.43 inch, đồng hồ này hứa hẹn mang đến cho người dùng những trải nghiệm tuyệt vời.', 
5490000, 
50,
4),

(22, 'Samsung Galaxy Tab S10 Ultra 5G 16GB 1TB', 
'Tab S10 Ultra 1TB là phiên bản dung lượng lưu trữ lớn nhất trong series. Với 1TB bộ nhớ trong, người dùng có thể lưu trữ hàng nghìn tập tin tài liệu, hình ảnh, video và tải các game đồ hoạ nặng mà không cần lo thiếu dung lượng. Cùng series, Samsung cũng cho ra mắt Tab S110 Ultra 5G phiên bản 256GB dành cho những ai có nhu cầu lưu trữ cơ bản, nhưng vẫn có cấu hình mạnh mẽ cho các tác vụ cần thiết.', 
39990000, 
100,
3),


(23, 'Đồng hồ thông minh Huawei Watch GT 5 Pro', 
'Đặc điểm nổi bật<br/>Thiết kế với dây cao su đen mang lại vẻ ngoài thể thao, phù hợp cho những người yêu thích hoạt động ngoài trời.<br/>Màn hình AMOLED lớn với độ phân giải sắc nét giúp hiển thị thông tin rõ ràng và dễ dàng theo dõi.<br/>Đồng hồ tích hợp nhiều chức năng theo dõi sức khỏe, từ nhịp tim đến giấc ngủ, giúp bạn quản lý sức khỏe hiệu quả.<br/>Thời gian sử dụng pin dài, bạn có thể thoải mái sử dụng đồng hồ mà không cần thường xuyên sạc pin.<br/>Đồng hồ thông minh Huawei Watch GT 5 Pro sở hữu màn hình AMOLED cao cấp 1.43 inch, độ phân giải cao 466 x 466 pixel, cho trải nghiệm hiển thị sắc nét. Thêm vào đó, sản phẩm đồng hồ thông minh Huawei Watch này còn có khả năng kháng nước 5 ATM và IP69K, mang lại sự an tâm khi sử dụng trong các hoạt động thể thao dưới nước. Đồng thời, thời lượng pin của đồng hồ cũng lên đến 14 ngày, cho phép người sử dụng không phải lo lắng nhiều về việc sạc pin liên tục.<br/><br/>Vì sao nên mua đồng hồ thông minh Huawei Watch GT 5 Pro?<br/><br/>Đồng hồ thông minh Huawei Watch GT 5 Pro không chỉ là một thiết bị đeo tay thông thường mà còn là một phụ kiện thời trang hiện đại với tính năng vượt trội. Dưới đây là 4 lý do nổi bật mà bạn nên cân nhắc sở hữu Huawei Watch GT 5 Pro.<br/><br/>- Thiết kế sang trọng và bền bỉ : Sự kết hợp giữa khung kim titan tạo nên vẻ ngoài sang trọng và đẳng cấp trong từng chi tiết cho Huawei Watch GT 5 Pro.<br/><br/>- Màn hình AMOLED độ phân giải cao : Hỗ trợ hiển thị rõ ràng, chân thực ngay cả trong môi trường ánh sáng mạnh, giúp theo dõi thông tin dễ dàng.<br/><br/>- Khả năng kháng nước ưu việt : Khả năng kháng nước 5ATM cùng IP69K thích hợp cho các môn thể thao dưới nước và ngoài trời.<br/><br/>- Thời lượng pin dài : Sử dụng lên đến 14 ngày, mang lại trải nghiệm sử dụng liền mạch mà không cần sạc thường xuyên.<br/><br/>Vì sao nên mua đồng hồ thông minh Huawei Watch GT 5 Pro?<br/><br/>Đồng hồ thông minh Huawei Watch GT 5 Pro - Theo dõi sức khoẻ toàn diện, kiểu dáng năng động, hiện đại<br/><br/>Đồng hồ thông minh Huawei Watch GT 5 Pro với thiết kế nổi bật cùng các tính năng theo dõi sức khỏe tiên tiến, không chỉ hỗ trợ người dùng trong quản lý sức khỏe hàng ngày mà còn tạo điểm nhấn phong cách thu hút. Từ chế độ theo dõi giấc ngủ đến cảm biến nhịp tim hiện đại, Huawei Watch GT 5 Pro có thể dễ dàng đáp ứng nhu cầu của người dùng trong cả hoạt động thường ngày lẫn các môn thể thao chuyên nghiệp.<br/><br/>Tạo hình sang trọng, đẳng cấp cùng khung titan bền bỉ<br/><br/>Huawei Watch GT 5 Pro sở hữu thiết kế tinh tế kích thước 46 mm. Phiên bản này có khung được chế tác từ hợp kim titan chuẩn hàng không vũ trụ cao cấp, mang đến cảm giác mạnh mẽ và bền bỉ nhưng vẫn vô cùng thanh lịch, nhẹ nhàng. Kèm theo đó là mặt kính cao cấp với khả năng chống trầy xước tối ưu, đảm bảo độ bền và giữ cho màn hình của Huawei Watch GT 5 Pro sáng bóng như mới. <br/><br/>Đồng hồ thông minh Huawei Watch GT 5 Pro - Theo dõi sức khoẻ toàn diện, kiểu dáng năng động, hiện đại<br/><br/>Thời lượng pin suốt nhiều ngày cùng khả năng sạc không dây tiện lợi<br/><br/>Đồng hồ thông minh Huawei Watch GT 5 Pro sở hữu thời lượng pin ấn tượng, giúp người dùng không phải lo lắng về việc sạc pin thường xuyên. Cụ thể, phiên bản 46mm có thể được sử dụng liên tục tối đa tới 14 ngày với các tác vụ thông thường, lên đến 9 ngày khi dùng thường xuyên và lên đến 5 ngày khi bật AOD (Always-On Display). <br/><br/>Thời lượng pin suốt nhiều ngày cùng khả năng sạc không dây tiện lợi<br/><br/>Ngoài ra, tính năng sạc không dây của thế hệ Huawei smartwatch này cũng giúp quá trình sạc trở nên dễ dàng và tiện lợi, chỉ mất khoảng 60 phút để sạc đầy.<br/><br/>Theo dõi sức khỏe toàn diện cùng đa dạng chế độ thể thao chuyên nghiệp.<br/><br/>Huawei Watch GT 5 Pro không chỉ là một chiếc đồng hồ thông minh mà còn là người bạn đồng hành đáng tin cậy cho việc chăm sóc sức khỏe và tập luyện thể thao. Theo đó, ấn phẩm smartwatch cao cấp này bị được trang bị cảm biến tim, cho phép theo dõi điện tâm đồ và phát hiện các vấn đề về tim mạch. Chưa hết, đồng hồ cũng tích hợp cảm biến đo nhịp tim, giấc ngủ, và rối loạn nhịp tim, giúp người dùng nhận biết tình trạng sức khỏe một cách toàn diện. <br/><br/>Đồng hồ thông minh Huawei Watch GT 5 Pro - Theo dõi sức khoẻ toàn diện, kiểu dáng năng động, hiện đại<br/><br/>Ngoài ra, Huawei Watch GT 5 Pro còn hỗ trợ đa dạng chế độ tập luyện, bao gồm các môn thể thao phổ biến như golf, lặn sâu, và chạy bộ. Đặc biệt, chế độ lặn tự do trên smartwatch cũng hỗ trợ lặn tới độ sâu 40m, mở ra nhiều trải nghiệm mới cho người dùng yêu thích thể thao dưới nước.<br/><br/>Hướng dẫn kết nối đồng hồ thông minh Huawei Watch GT 5 Pro với smartphone<br/><br/>Việc kết nối Huawei Watch GT 5 Pro với smartphone không quá phức tạp và có thể tiến hành nhanh chóng, cho phép bạn đồng bộ dữ liệu và tận hưởng mọi tính năng tiện ích của đồng hồ. Bằng cách làm theo các bước kết nối cơ bản dưới đây, bạn sẽ có thể trải nghiệm các tính năng thông minh trên Huawei Watch GT 5 Pro một cách dễ dàng.<br/><br/>- Bước 1 : Bạn tìm kiếm và tải xuống app Huawei Health thông qua trình duyệt web trên smartphone. Sau khi tải, cài đặt và chấp thuận các yêu cầu quyền truy cập để sử dụng ứng dụng.<br/><br/>- Bước 2 : Sau khi Huawei Health được cài đặt, bạn mở ứng dụng này và tìm kiếm Huawei Health. Kế đó, bạn tiến hành tìm và download Huawei Health về điện thoại.<br/><br/>Hướng dẫn kết nối đồng hồ thông minh Huawei Watch GT 5 Pro với smartphone<br/><br/>- Bước 3 : Tiếp đó, bạn khởi động và đăng nhập thành công vào app Huawei Health. Tại giao diện chính của Huawei Health, bạn chọn mục Devices (Thiết bị) và nhấn vào tùy chọn Add device (Thêm thiết bị).<br/><br/>- Bước 4 : Tại bước thứ tư, bạn cần đưa Huawei Watch GT 5 Pro lại gần điện thoại và ứng dụng Huawei Health sẽ tự động quét và tìm đồng hồ. Khi Huawei Watch xuất hiện trong danh sách tìm kiếm, bạn chọn Link để tiến hành ghép nối. Xác nhận kết nối Bluetooth trên cả điện thoại và đồng hồ là quá trình ghép nối Huawei Watch GT 5 Pro với smartphone đã thành công rồi nhé!<br/><br/>Lưu ý: Các hướng dẫn trên chỉ mang tính chất tham khảo, bạn vui lòng đọc kỹ HDSD kèm theo hoặc liên hệ nhân viên để được hướng dẫn chi tiết nhé.<br/><br/>Mua đồng hồ thông minh Huawei Watch GT 5 Pro tại CellphoneS<br/><br/>CellphoneS là hệ thống cửa hàng uy tín, chuyên cung cấp các sản phẩm công nghệ chính hãng từ các thương hiệu nổi tiếng. Tại đây, bạn có thể tìm thấy đồng hồ thông minh Huawei Watch GT 5 Pro trong tầm giá cả cạnh tranh và nhiều chương trình khuyến mãi hấp dẫn. <br/>Không chỉ cung cấp sản phẩm chất lượng, CellphoneS còn nổi bật với dịch vụ hậu mãi tốt, cùng đội ngũ nhân viên tận tình luôn sẵn sàng hỗ trợ khách hàng tìm ra dòng sản phẩm công nghệ ưng ý. Đặc biệt, hệ thống cửa hàng trên toàn quốc của CellphoneS còn hỗ trợ người tiêu dùng mua sắm với dịch vụ trả góp linh hoạt, hứa hẹn mang đến trải nghiệm mua sắm thuận tiện và dễ dàng hơn bao giờ hết.', 
7490000,
250, 
4),


(24,
'Viettel T2 4G', 
'Viettel T2 4G sở hữu dung lượng pin 1400mAh kết hợp cùng mạng di động 4G VoLTE nên có thể đáp ứng tốt các nhu cầu nghe gọi và giải trí hàng ngày. Ngoài ra, sản phẩm điện thoại phổ thông của Viettel còn có camera sau sở hữu độ phân giải 0.08MP. Đi kèm theo Viettel T2 4G là kích thước màn hình 2.4 inch cùng tấm nền QVGA TN sắc nét.', 
550000,
130,
1),

(25, 
'MacBook Pro 16 M3 Pro 36GB - 512GB | Chính hãng Apple Việt Nam', 
'Macbook Pro 16 inch M3 Pro 36GB 512GB với màn hình 16.2 inch cho hiển thị thoải mái, cùng hiệu năng mạnh mẽ nhờ chip Apple M3 Pro giúp bạn trải nghiệm hoàn hảo hơn. Thiết kế sản phẩm Macbook Pro 2023 này với 79 phím bao gồm 12 phím chức năng với chiều cao tiêu chuẩn,… Touch ID vừa tiện lợi vừa tăng độ bảo mật, RAM 36GB cùng ổ cứng 512GB giúp lưu trữ thoải mái.', 
73990000,
100,
2);


DELETE FROM product_images;
INSERT INTO product_images (id, product_id, url) VALUES
(1, 1,   'https://cdn2.cellphones.com.vn/x/media/catalog/product/t/e/text_ng_n_-_2024-04-21t212610.523.png'),
(2, 1,   'https://cdn2.cellphones.com.vn/x/media/catalog/product/t/e/text_ng_n_-_2024-04-21t212624.848.png'),
(3, 1,   'https://cdn2.cellphones.com.vn/x/media/catalog/product/t/e/text_ng_n_-_2024-04-21t212726.683.png'),
(4, 1,   'https://cdn2.cellphones.com.vn/x/media/catalog/product/t/e/text_ng_n_-_2024-04-21t212733.527.png'),

(5, 2,   'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/d/i/dien-thoai-itel-p55_96_.png'),
(6, 2,   'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/may-tinh-bang-xiaomi-pad-6s-pro_1__1.png'),
(7, 2,   'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/may-tinh-bang-xiaomi-pad-6s-pro_3__1.png'),
(8, 2,   'https://cdn2.cellphones.com.vn/x/media/catalog/product/m/a/may-tinh-bang-xiaomi-pad-6s-pro_2__1.png'),

(9, 3,   'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_3.png'),
(10, 3,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_4__1.jpg'),
(11, 3,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_5__1.jpg'),
(12, 3,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-15-pro-max_6__1.jpg'),

(13, 4,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/f/r/frame_100_1_2__2_1_1_2.png'),
(14, 4,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/ipad-pro-m4-13-inch_1__2_1.png'),
(15, 4,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/ipad-pro-m4-13-inch_3__2_1.png'),
(16, 4,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/ipad-pro-m4-13-inch_5__2_1.png'),

(17, 5,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/a/tai-nghe-chup-tai-sony-wh-ch520-_1.png'),
(18, 5,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/a/tai-nghe-chup-tai-sony-wh-ch520-_4_.png'),
(19, 5,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/a/tai-nghe-chup-tai-sony-wh-ch520-trang.png'),
(20, 5,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:58:58/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/a/tai-nghe-chup-tai-sony-wh-ch520-_1_.png'),

(21, 6,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/_/n/_ng_h_th_ng_minh_huawei_watch_fit_3_-_4.png'),
(22, 6,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/_/n/_ng_h_th_ng_minh_huawei_watch_fit_3_-_3.png'),
(23, 6,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/d/o/dong-ho-thong-minh-huawei-watch-fit-3_2.jpg'),
(24, 6,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:58:58/q:90/plain/https://cellphones.com.vn/media/catalog/product/_/n/_ng_h_th_ng_minh_huawei_watch_fit_3_-_2_1.png'),

(25, 7,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/a/p/apple-watch-series-9-45mm-_10_.png'),
(26, 7,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/a/p/apple-watch-series-9-45mm-.png'),
(27, 7,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/a/p/apple-watch-series-9-45mm-_1_.png'),
(28, 7,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/a/p/apple_lte_3__1.png'),

(29, 8,  'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQo4o-BsKvAxtD_QToHfZpRnMrDXjrCpdrhjI_1Z6pv8_cjJ7IqGzx1AS74s10gx6um5haqVHIlD_oYvAnOEtZGVKdIE_MxB6X-u1v1vkCMKFcbttSQo0LO&usqp=CAE'),
(30, 8,  'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcTX--8xl6Z6Yyn2tmFesGFJDNgyD7tW_fZM9GRzh-dxUnKh1odKV4RIx3srA8MCTRmXOonQr2-W5pwZ5zGgssmxTAAsz6FoUooweoeUKtU&usqp=CAE'),
(31, 8,  'https://encrypted-tbn2.gstatic.com/shopping?q=tbn:ANd9GcQU8TIZxNAyDtpcsmO9oZ8APwJFtPSzGfAYjMIeOZb3OyFEiCLHI-gFMMCLA6D46UmR6e3F8JzelMTUNbzi8ZcBU45S8cX7kZryOv7_bKEcMMkoOREq93sCBw&usqp=CAE'),
(32, 8,  'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcSXavjQZt3emCstMhz12lOCITaMgYD1xMadGNov8OK0HPTxGUifbeyj_-io7Vdnmf5CUptyHsW1GlqclbO1J3SqcPsMLVHMyvNeDNBKB_wEXbKyfn6AzKbnSw&usqp=CAE'),

(33, 9,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/_/m_y_t_nh_b_ng_lenovo_tab_m11_4gb_128gb_zadb0066vn_1.png'),
(34, 9,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/may-tinh-bang-lenovo-tab-m11-8gb-128gb.png'),
(35, 9,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/may-tinh-bang-lenovo-tab-m11_1__2.png'),
(36, 9,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/may-tinh-bang-lenovo-tab-m11_2__2.png'),

(37, 10,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/1/1/11_43_4.png'),
(38, 10,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/1/2/12_29_2.png'),
(39, 10,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/9/_/9_84_4.png'),
(40, 10,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/g/r/group_157_1.png'),

(41, 11,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/a/tai-nghe-khong-day-edifier-neobuds-pro-2_10_.png'),
(42, 11,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/a/tai-nghe-khong-day-edifier-neobuds-pro-2_11_.png'),
(43, 11,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/a/tai-nghe-khong-day-edifier-neobuds-pro-2_12_.png'),
(44, 11,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/g/r/group_245_3_.png'),

(45, 12,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/d/o/download_1__6_6.png'),
(46, 12,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/o/p/oppo-find-x5-pro-4.png'),
(47, 12,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/o/p/oppo-find-x5-pro-5.png'),
(48, 12,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/o/p/oppo-find-x5-pro-6.png'),

(49, 13,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/may-tinh-bang-huawei-matepad-11-5-s_41_.png'),
(50, 13,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/may-tinh-bang-huawei-matepad-11-5-s_42_.png'),
(51, 13,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/may-tinh-bang-huawei-matepad-11-5-s_43_.png'),
(52, 13,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/may-tinh-bang-huawei-matepad-11-5-s_44_.png'),


(53, 14,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/a/tai-nghe-bluetooth-marshall-minor-3-1.jpg'),
(54, 14,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/a/tai-nghe-bluetooth-marshall-minor-3-2.jpg'),
(55, 14,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/a/tai-nghe-bluetooth-marshall-minor-3-3.jpg'),
(56, 14,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/g/r/group_150_1_3.png'),

(57, 15,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/e/text_ng_n_25__2_28.png'),
(58, 15,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/e/text_ng_n_27__3_23.png'),
(59, 15,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/e/text_ng_n_28__4_21.png'),
(60, 15,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/e/text_ng_n_29__5_18.png'),

(61, 16,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/x/i/xiaomi_14t_pro_14_.png'),
(62, 16,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/x/i/xiaomi_14t_pro_15_.png'),
(63, 16,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/x/i/xiaomi_14t_pro_16_.png'),
(64, 16,  'https://cdn2.cellphones.com.vn/x/media/catalog/product/x/i/xiaomi_14t_pro_2_.png'),

(65, 17,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:58:58/q:90/plain/https://cellphones.com.vn/media/catalog/product/f/r/frame_1_4_2.png'),
(66, 17,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:58:58/q:90/plain/https://cellphones.com.vn/media/catalog/product/k/z/kz_edx_pro_1.png'),
(67, 17,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:58:58/q:90/plain/https://cellphones.com.vn/media/catalog/product/k/z/kz_edx_pro_2.png'),
(68, 17,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:58:58/q:90/plain/https://cellphones.com.vn/media/catalog/product/k/z/kz_edx_pro_4.png'),

(69, 18,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/e/text_ng_n_25__1_12.png'),
(70, 18,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/e/text_ng_n_28__1_10.png'),
(71, 18,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/e/text_ng_n_29__2_10.png'),
(72, 18,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/e/text_ng_n_31__1_7.png'),

(73, 19,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/l/a/laptop-msi-pulse-17-ai-c1vgkg-017vn.png'),
(74, 19,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/l/a/laptop-msi-pulse-17-ai-c1vgkg-017vn_1_.png'),
(75, 19,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/l/a/laptop-msi-pulse-17-ai-c1vgkg-017vn_2_.png'),
(76, 19,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/l/a/laptop-msi-pulse-17-ai-c1vgkg-017vn_3_.png'),

(77, 20,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:58:58/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/y/my_alo_k64.png'),
(78, 20,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/y/my_alo_k64.png'),
(79, 20,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:58:58/q:90/plain/https://cellphones.com.vn/media/catalog/product/f/r/frame_1_2__2_4.png'),
(80, 20,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:58:58/q:90/plain/https://cellphones.com.vn/media/catalog/product/f/r/frame_1_7_2.png'),

(81, 21,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/g/r/group_551_5__1.png'),
(82, 21,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/g/r/group_551_6__1.png'),
(83, 21,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:58:58/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/e/text_ng_n_-_2024-08-12t135312.897.png'),
(84, 21,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:58:58/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/e/text_ng_n_-_2024-08-12t135406.775.png'),

(85, 22,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/may-tinh-bang-samsung-galaxy-tab-s10-plus-5g_1__3.png'),
(86, 22,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/may-tinh-bang-samsung-galaxy-tab-s10-plus-5g_3.png'),
(87, 22,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/may-tinh-bang-samsung-galaxy-tab-s10-plus-5g_3__3.png'),
(88, 22,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/may-tinh-bang-samsung-galaxy-tab-s10-plus-5g_4__3.png'),

(89, 23,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/e/text_ng_n_59__1_17.png'),
(90, 23,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/e/text_ng_n_61__2_12.png'),
(91, 23,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/e/text_ng_n_62__1_10.png'),
(92, 23,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/t/e/text_ng_n_63__1_10.png'),

(93, 24,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/d/i/dien-thoai-viettel-t2-4g_2_.png'),
(94, 24,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/d/i/dien-thoai-viettel-t2-4g_3_.png'),
(95, 24,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/d/i/dien-thoai-viettel-t2-4g_4_.png'),
(96, 24,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/d/i/dien-thoai-viettel-t2-4g_6_.png'),

(97, 25,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/macbook-pro-16-inch-m3-max-2023_1__3.png'),
(98, 25,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/macbook-pro-16-inch-m3-max-2023_4__3.png'),
(99, 25,  'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/macbook-pro-16-inch-m3-max-2023_5__3.png'),
(100, 25, 'https://cdn2.cellphones.com.vn/insecure/rs:fill:0:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/m/a/macbook-pro-16-inch-m3-max-2023_6__3.png');

-- SELECT * FROM product_images WHERE product_id = 1;


INSERT INTO users (id, name, sex, avt_url, address, email, password, phone, role) VALUES
(1, 'Nguyễn Văn Nam', 'M', 'https://icdn.dantri.com.vn/thumb_w/960/2019/06/25/chang-trai-bac-lieu-dep-trai-nhu-tai-tudocx-1561438179557.jpeg',
 '123 Đường 3/2, Phường 12, Quận 10, TP.HCM', 'nam19038@gmail.com', 'aksjdfioa93i293uksnkdvjiou192u4i2r', '0349492879', 'customer'),
(2, 'Võ Thị Tuyết Nhung', 'F', 'https://i.pinimg.com/736x/2e/41/7e/2e417eccaa6a1a491ba25e5d61317545.jpg',
 '24 Đường Võ Văn Ngân, Phường Linh Đông, Quận Thủ Đức, TP.HCM', 'nhungcute295@gmail.com', 'kvmnzsdf09024tjfiojio2u390ri0oj23ior2', '0392859385', 'customer'),
(3, 'Trần Văn Hùng', 'M', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBscOJdXeVpIpTANW0CJsRdgzdIvF37rrdlw&s',
 '24 Trần Hưng Đạo, Phường 1, Quận 5, TP.HCM', 'hungtran.depzai@gmail.com', 'aksjdfioa93i293uksnkdvjiou192u4i2r', '0923847592', 'customer'),
(4, 'Nguyễn Thị Thanh Thảo', 'F', 'https://vienthammydiva.vn/wp-content/uploads/2022/05/gai-xinh-trung-quoc-2-1.jpg',
 '99 Tăng Nhơn Phú A, Phường Phước Long B, Quận 9, TP.HCM', 'thanhthaokhongbuon304@gmail.com', 'weroioxv098923908sdnkasj2i3ru', '0724958326', 'customer'),
(5, 'Lê Văn Đức', 'M', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_mAyKyupeRsK3Kcghe1VxTIvntHvvY-9DmQ&s',
 '69 Đồng Khởi, Phường Bến Thành, Quận 1, TP.HCM', 'itsducday6969@gmail.com', 'aksjdfioa93i293uksnkdvjiou192u4i2r', '0394857395', 'customer'),

(6, 'Nguyễn Đức Triết', 'M', 'https://product.hstatic.net/1000333436/product/1_02d9c8a89f154b4f9e81866c1b3b1215_master.jpg',
 '415 Bến Nghé 2, Phường 2, Quận 8, TP.HCM', 'trietadmin@gmail.com', 'aksjdfioa93i293uksnkdvjiou192u4i2r', '0969993493', 'admin'),
(7, 'Đặng Bình An', 'F', 'https://bizweb.dktcdn.net/100/409/545/products/ukak2210002-de-1721201150363.jpg?v=1727402254453',
 '23 Điện Biên Phủ, Phường 15, Quận Bình Thạnh, TP.HCM', 'binhanadmin@gmail.com', 'aksjdfioa93i293uksnkdvjiou192u4i2r', '0994857395', 'admin'),
(8, 'Nguyễn Miên Phú', 'M', 'https://lh5.googleusercontent.com/CiTo8DGuqCKi_EICisBT4Fm-oHwIEWnJFsOwDAmwcG4GHCUSbPsFA3mZFyoGx-C9SFCBpMmWh2aHfSLQDMgZaHM7R1zCNiFUdGxMGzpieJ51NC2H0olJ4UnySS_RKW6Rd0XJqGWCJRHeN7VBf4UF9Xg',
 '103 Huyền Trân Công Chúa, Phường 8, Quận 3, TP.HCM', 'phuadmin@gmail.com', 'aksjdfioa93i293uksnkdvjiou192u4i2r', '0939549582', 'admin'),
(9, 'Bùi Anh Thư', 'F', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVtEZ1zDcbqSOFqCmL9p5ogeIRh1ZITDm-ZA&s',
 '49 Lộc Cát, Ba Đình, Hà Nội', 'anhthuadmin@prismora.com', 'aksjdfioa93i293uksnkdvjiou192u4i2r', '0994828573', 'admin'),
(10, 'Nguyễn Văn Nguyễn', 'M', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPc2cV5ODgkjEDqRmUJrnA-r85XCQ1hif8rQ&s',
 '85 Hai Bà Trưng, Phường 6, Quận 3, TP.HCM', 'nguyenadmin@prismora.com', 'aksjdfioa93i293uksnkdvjiou192u4i2r', '0948274622', 'admin');


DELETE FROM orders;
INSERT INTO orders (id, customer_id, shipping_address) VALUES
(1, 1, 'Shipping Address'), (2, 2, 'Shipping Address'), (3, 3, 'Shipping Address'), 
(4, 4, 'Shipping Address'), (5, 5, 'Shipping Address'), (6, 1, 'Shipping Address'), 
(7, 3, 'Shipping Address'), (8, 5, 'Shipping Address'), (9, 2, 'Shipping Address'),
(10, 4, 'Shipping Address'),
(11, 1, 'Q. 12, TP. HCM'), (12, 1, 'Ba Đình. Hà Nội'), (13, 1, 'Hải Phòng');

DELETE FROM product_in_orders;
INSERT INTO product_in_orders (id, order_id, product_id, quantity) VALUES
(1, 1, 2, 2),
(2, 2, 6, 1),
(3, 3, 19, 1),
(4, 4, 23, 1),
(5, 5, 25, 1),
(6, 6, 1, 1),
(7, 7, 5, 1),
(8, 8, 9, 1),
(9, 9, 13, 1),
(10, 10, 17, 1),
(11, 11, 21, 1),
(12, 12, 25, 1),
(13, 13, 22, 1);




INSERT INTO reviews (id, customer_id, product_id, rating, comment) VALUES
(1, 1, 1, 3, 'Sản phẩm này rất tốt'),
(2, 2, 2, 4, 'Thật tuyệt!');