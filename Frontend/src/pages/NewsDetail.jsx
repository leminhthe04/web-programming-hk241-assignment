import { useState } from "react";
import { Link } from "react-router-dom";
import { useParams } from "react-router-dom";
import Header from "../components/Header";
import Footer from "../components/Footer";
import Slider from "../components/Slider";



const articles = [
    {
      id: 1,
      title: "Đánh giá Asus ExpertBook P5: Laptop doanh nhân mạnh mẽ",
      content: `
        <img src="https://dlcdnwebimgs.asus.com/gain/382ede99-e7e7-4496-9fce-e83d6f957dc1/" alt="Asus ExpertBook P5" style="width:100%; height:auto; margin-bottom:20px;" />
        <p>
          Asus ExpertBook P5 là dòng laptop doanh nhân được thiết kế để đáp ứng nhu cầu công việc, đi kèm hiệu năng mạnh mẽ và thiết kế gọn nhẹ.
          Trong bài viết này, chúng tôi sẽ đánh giá chi tiết chiếc laptop này, từ thiết kế, hiệu năng, màn hình cho đến thời lượng pin.
        </p>
        <h2>Thiết kế và chất liệu</h2>
        <p>
          Laptop có thiết kế tối giản nhưng sang trọng với lớp vỏ làm từ hợp kim nhôm-magie. Trọng lượng chỉ 1.5kg giúp bạn dễ dàng mang theo
          khi đi công tác hoặc làm việc tại quán cà phê.
        </p>
        <h2>Hiệu năng mạnh mẽ</h2>
        <p>
          Asus ExpertBook P5 được trang bị bộ vi xử lý Intel Core i7 thế hệ 12 cùng RAM 16GB, đủ sức xử lý các tác vụ văn phòng, làm việc đa nhiệm
          và thậm chí chỉnh sửa video cơ bản. Ổ cứng SSD 512GB mang lại tốc độ đọc/ghi nhanh chóng, giảm thời gian chờ.
        </p>
        <h2>Màn hình sắc nét</h2>
        <p>
          Máy sở hữu màn hình 15.6 inch Full HD với độ sáng cao, góc nhìn rộng, rất phù hợp cho các buổi thuyết trình hoặc làm việc nhóm.
        </p>
        <img src="https://i.pcmag.com/imagery/articles/010RvPdwfx4utjgSigALdFu-1.fit_lim.size_1200x630.v1717437552.jpg" alt="Màn hình Asus ExpertBook P5" style="width:100%; height:auto; margin-bottom:20px;" />
        <h2>Thời lượng pin ấn tượng</h2>
        <p>
          Một trong những điểm mạnh của ExpertBook P5 là thời lượng pin lên tới 10 tiếng, đảm bảo bạn có thể làm việc cả ngày mà không lo gián đoạn.
        </p>
        <h2>Kết luận</h2>
        <p>
          Asus ExpertBook P5 là lựa chọn hoàn hảo cho doanh nhân và người làm việc chuyên nghiệp, với hiệu năng cao, thiết kế nhẹ nhàng và thời lượng pin ấn tượng.
        </p>
      `,
    },
    {
        id: 2,
        title: "MacBook Pro M1 2023: Hiệu suất vượt trội cho dân sáng tạo",
        content: `
          <img src="https://cdn2.cellphones.com.vn/insecure/rs:fill:0:0/q:90/plain/https://cellphones.com.vn/media/wysiwyg/laptop/macbook/cate-macbook-pro-9.jpg" alt="MacBook Pro M1 2023" style="width:100%; height:auto; margin-bottom:20px;" />
          <p>
            MacBook Pro M1 2023 là chiếc laptop được thiết kế để phục vụ các nhà sáng tạo nội dung, với chip M1 mạnh mẽ, màn hình Retina tuyệt đẹp
            và thời lượng pin bền bỉ. Hãy cùng tìm hiểu chi tiết về dòng sản phẩm này.
          </p>
          <h2>Thiết kế cao cấp</h2>
          <p>
            Thiết kế unibody bằng nhôm nguyên khối, trọng lượng chỉ 1.4kg, MacBook Pro M1 mang lại cảm giác cao cấp và độ bền vượt trội.
          </p>
          <h2>Chip M1 siêu việt</h2>
          <p>
            Với chip M1, MacBook Pro mang lại hiệu năng đồ họa mạnh mẽ, xử lý video 4K mượt mà và hỗ trợ nhiều tác vụ nặng như lập trình và chỉnh sửa ảnh.
          </p>
          <img src="https://cdn.tgdd.vn/Products/Images/44/282827/apple-macbook-air-m2-2022-161122-112221.jpg" alt="Chip M1 hiệu năng" style="width:100%; height:auto; margin-bottom:20px;" />
          <h2>Màn hình Retina chuẩn mực</h2>
          <p>
            Màn hình 14 inch Retina XDR của MacBook Pro mang lại độ sáng tối đa lên đến 1600 nits, cực kỳ sắc nét và phù hợp cho các nhà sáng tạo video.
          </p>
          <h2>Thời lượng pin vượt trội</h2>
          <p>
            Máy có thể hoạt động liên tục tới 20 giờ chỉ với một lần sạc, lý tưởng cho công việc ngoài trời hoặc di chuyển.
          </p>
          <h2>Kết luận</h2>
          <p>
            MacBook Pro M1 là một sự đầu tư đáng giá cho bất kỳ ai muốn có một thiết bị mạnh mẽ, thiết kế đẹp và thời lượng pin dài.
          </p>
        `,
      },
      {
        id: 3,
        title: "Dell XPS 13: Laptop siêu di động cho doanh nhân",
        content: `
          <img src="https://laptopre.vn/upload/picture/picture-31618558877.jpg" alt="Dell XPS 13" style="width:100%; height:auto; margin-bottom:20px;" />
          <p>
            Dell XPS 13 là dòng laptop siêu di động với thiết kế tinh tế, hiệu năng mạnh mẽ và màn hình sắc nét. Hãy cùng khám phá tại sao nó
            lại là lựa chọn hàng đầu của nhiều doanh nhân.
          </p>
          <h2>Thiết kế siêu mỏng nhẹ</h2>
          <p>
            Với độ mỏng chỉ 13.9mm và trọng lượng 1.2kg, Dell XPS 13 dễ dàng mang theo trong các buổi họp hay khi di chuyển.
          </p>
          <h2>Hiệu năng mạnh mẽ</h2>
          <p>
            Trang bị vi xử lý Intel Core i5 thế hệ 13, RAM 8GB, Dell XPS 13 xử lý mượt mà các tác vụ văn phòng và hội họp trực tuyến.
          </p>
          <h2>Màn hình InfinityEdge</h2>
          <p>
            Màn hình 13.4 inch với công nghệ InfinityEdge giúp tối ưu hóa không gian hiển thị, đồng thời cung cấp chất lượng hình ảnh sống động.
          </p>
          <img src="https://cdn.tgdd.vn/Files/2021/09/02/1379747/h11_1280x720-800-resize.jpg" alt="Màn hình Dell XPS 13" style="width:100%; height:auto; margin-bottom:20px;" />
          <h2>Kết luận</h2>
          <p>
            Dell XPS 13 là sự kết hợp hoàn hảo giữa thiết kế, hiệu năng và tính di động, phù hợp với phong cách làm việc chuyên nghiệp.
          </p>
        `,
      },      
      {
        id: 4,
        title: "HP Spectre x360: Laptop đa chế độ với thiết kế tinh tế",
        content: `
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTi74Ef3P6SecmDBVgDTWkPO85z8MkeejTvEA&s" alt="HP Spectre x360" style="width:100%; height:auto; margin-bottom:20px;" />
        <p>
          HP Spectre x360 là dòng laptop 2-trong-1 với khả năng xoay 360 độ, cho phép sử dụng ở nhiều chế độ khác nhau. Với thiết kế đẹp mắt và hiệu năng ổn định, 
          đây là một lựa chọn hàng đầu cho những người cần sự linh hoạt trong công việc.
        </p>
        <h2>Thiết kế và tính linh hoạt</h2>
        <p>
          Laptop có thiết kế vỏ nhôm CNC với viền cắt kim cương tạo cảm giác sang trọng. Chế độ xoay 360 độ giúp bạn dễ dàng chuyển đổi giữa laptop, tablet 
          hoặc chế độ trình chiếu.
        </p>
        <h2>Hiệu năng và màn hình</h2>
        <img src="https://hanoilab.com/wp-content/uploads/2024/10/HP-Spectre-x360-i7-1165G7-Ha-Noi-Lab-3.jpg" alt="Màn hình laptop HP Spectre x360" style="width:100%; height:auto; margin-bottom:20px;" />
        <p>
          Được trang bị Intel Core i7 thế hệ 12 và RAM 16GB, HP Spectre x360 đáp ứng tốt các tác vụ văn phòng và đồ họa nhẹ. Màn hình OLED 4K mang lại chất lượng 
          hiển thị tuyệt đẹp với màu sắc sống động và độ sáng cao.
        </p>
        `,
    },
    {
        id: 5,
        title: "Lenovo ThinkPad X1 Carbon Gen 10: Sự lựa chọn cho doanh nhân",
        content: `
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRL9S_sbEuhZFlIADQSmEzF2f4Aw5pcTFatHg&s" alt="Lenovo ThinkPad X1 Carbon Gen 10" style="width:100%; height:auto; margin-bottom:20px;" />
        <p>
          ThinkPad X1 Carbon Gen 10 của Lenovo tiếp tục giữ vững vị thế là chiếc laptop doanh nhân đỉnh cao với trọng lượng nhẹ, độ bền cao và hiệu năng mạnh mẽ. 
          Đây là lựa chọn hoàn hảo cho những người dùng cần sự di động và đáng tin cậy.
        </p>
        <h2>Thiết kế bền bỉ và tiện dụng</h2>
        <p>
          Laptop được làm từ sợi carbon kết hợp hợp kim nhôm, đạt tiêu chuẩn độ bền quân đội MIL-STD 810H. Trọng lượng chỉ 1.1kg giúp dễ dàng mang theo trong các chuyến công tác.
        </p>
        <h2>Hiệu năng và tính năng bảo mật</h2>
        <p>
          Lenovo ThinkPad X1 Carbon Gen 10 sử dụng Intel Core i7 thế hệ 12, đi kèm RAM 16GB và ổ SSD 1TB. Các tính năng bảo mật như cảm biến vân tay, nhận diện khuôn mặt 
          và chip TPM 2.0 giúp bảo vệ dữ liệu hiệu quả.
        </p>
        `,
    },

  ];


const NewsDetail = () => {
    const { id } = useParams();  // Lấy id từ URL
    // const [newsItem, setNewsItem] = useState(null);
    // const [loading, setLoading] = useState(true);
    // const [error, setError] = useState(null);

    const article = articles.find((item) => item.id === parseInt(id));

    if (!article) {
        return <p>Bài viết không tồn tại.</p>;
      }
    
    return (
        <div className="flex flex-col min-h-screen">
        <Header />
        <div className="breadcums my-5 ml-10">
            <span className="">Trang chủ</span> /
            <span className="font-bold"> Tin tức</span>
        </div>
        <main className="p-8 bg-gray-100">
            {/* <Slider /> */}
            <section className="mb-8 w-10/12 mx-auto">
                <div className="grid grid-cols-2 mx-auto">
                    {/* <h1 className="text-4xl font-bold mb-4">Tin tức</h1> */}
                </div>
                <div style={{ padding: "20px" }}>
                    <h1 className="text-3xl">{article.title}</h1>
                    <div dangerouslySetInnerHTML={{ __html: article.content }}></div>
                </div>
            </section>
        </main>
        <Footer />
    </div>
    );
};

export default NewsDetail;
