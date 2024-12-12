// import { useState, useEffect } from "react"
// import Header from "../components/Header"
// import Footer from "../components/Footer"
// import Slider from "../components/Slider"


// export default function News() {
//     return (
//         <div className="flex flex-col min-h-screen">
//             <Header />

//             <div className="breadcums my-5 ml-10">
//                 <span className="">Trang chủ</span> /
//                 <span className=" font-bold"> Tin tức</span>
//             </div>
//             <main className=" p-8 bg-gray-100">
//                 <Slider />
//                 <section className="mb-8  w-10/12 mx-auto">

//                     <div className="grid grid-cols-2 mx-auto">
//                         <div className="justify-center items-center my-auto "></div>
//                             <h1 className="text-4xl font-bold mb-4">Tin tức</h1>
//                             <p className="text-lg">
//                                 Đây là trang tin tức của chúng tôi. Cập
//                             </p>
//                     </div>
//                 </section>
//             </main>
//         </div>
//     )
// }



import { useState } from "react";
import { Link } from "react-router-dom";
import Header from "../components/Header";
import Footer from "../components/Footer";
import Slider from "../components/Slider";

export default function News() {
    // Mảng dữ liệu tin tức mẫu
    const news = [
        {
            id: 1,
            title: "Đánh giá Asus ExpertBook P5: Laptop doanh nhân mạnh mẽ",
            summary: "Asus ExpertBook P5 là dòng laptop doanh nhân được thiết kế để đáp ứng nhu cầu công việc, đi kèm hiệu năng mạnh mẽ và thiết kế gọn nhẹ.Trong bài viết này, chúng tôi sẽ đánh giá chi tiết chiếc laptop này, từ thiết kế, hiệu năng, màn hình cho đến thời lượng pin.",
            image: "https://dlcdnwebimgs.asus.com/gain/382ede99-e7e7-4496-9fce-e83d6f957dc1/",
        },
        {
            id: 2,
            title: "MacBook Pro M1 2023: Hiệu suất vượt trội cho dân sáng tạo",
            summary: "MacBook Pro M1 2023 là chiếc laptop được thiết kế để phục vụ các nhà sáng tạo nội dung, với chip M1 mạnh mẽ, màn hình Retina tuyệt đẹp và thời lượng pin bền bỉ. Hãy cùng tìm hiểu chi tiết về dòng sản phẩm này.",
            image: "https://cdn2.cellphones.com.vn/insecure/rs:fill:0:0/q:90/plain/https://cellphones.com.vn/media/wysiwyg/laptop/macbook/cate-macbook-pro-9.jpg",
        },
        {
            id: 3,
            title: "Dell XPS 13: Laptop siêu di động cho doanh nhân",
            summary: "Dell XPS 13 là dòng laptop siêu di động với thiết kế tinh tế, hiệu năng mạnh mẽ và màn hình sắc nét. Hãy cùng khám phá tại sao nó lại là lựa chọn hàng đầu của nhiều doanh nhân.",
            image: "https://laptopre.vn/upload/picture/picture-31618558877.jpg",
        },
        {
            id: 4,
            title: "HP Spectre x360: Laptop đa chế độ với thiết kế tinh tế",
            summary: "HP Spectre x360 là dòng laptop 2-trong-1 với khả năng xoay 360 độ, cho phép sử dụng ở nhiều chế độ khác nhau. Với thiết kế đẹp mắt và hiệu năng ổn định, đây là một lựa chọn hàng đầu cho những người cần sự linh hoạt trong công việc.",
            image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTi74Ef3P6SecmDBVgDTWkPO85z8MkeejTvEA&s",
        },
        {
            id: 5,
            title: "Lenovo ThinkPad X1 Carbon Gen 10: Sự lựa chọn cho doanh nhân",
            summary: "ThinkPad X1 Carbon Gen 10 của Lenovo tiếp tục giữ vững vị thế là chiếc laptop doanh nhân đỉnh cao với trọng lượng nhẹ, độ bền cao và hiệu năng mạnh mẽ. Đây là lựa chọn hoàn hảo cho những người dùng cần sự di động và đáng tin cậy.",
            image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRL9S_sbEuhZFlIADQSmEzF2f4Aw5pcTFatHg&s",
        }
    ];


    return (
        <div className="flex flex-col min-h-screen">
            <Header />
            <div className="breadcums my-5 ml-10">
                <span className="">Trang chủ</span> /
                <span className="font-bold"> Tin tức</span>
            </div>
            <main className="p-8 bg-gray-100">
                <Slider />
                <section className="mb-8 w-10/12 mx-auto">
                    <div className="grid grid-cols-2 mx-auto">
                        <h1 className="text-4xl font-bold mb-4">Tin tức</h1>
                    </div>
                    <div className="grid grid-cols-3 gap-6">
                        {news.map((item) => (
                            <div key={item.id} className="bg-white p-6 rounded-lg shadow-md">
                                <img src={item.image} alt={item.title} className="w-full h-48 object-cover rounded-md mb-4" />
                                <h2 className="text-xl font-bold mb-2">{item.title}</h2>
                                <p className="text-gray-600 mb-4">{item.summary}</p>
                                <Link to={`/customer/news/${item.id}`} className="text-blue-600 hover:underline">Xem thêm</Link>
                            </div>
                        ))}
                    </div>
                </section>
            </main>
            <Footer />
        </div>
    );
}
