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
            title: "Cập nhật xu hướng công nghệ 2024",
            summary: "Năm 2024 hứa hẹn sẽ có những thay đổi lớn trong ngành công nghệ với các xu hướng mới như AI, Blockchain và IoT.",
            image: "https://elcom.com.vn/storage/uploads/images/Fnju1yIhX4xswktmP8boatuF3SYRU1ElmPs1hMAF.jpg",
        },
        {
            id: 2,
            title: "Kinh tế toàn cầu năm 2024: Triển vọng và thách thức",
            summary: "Năm 2024, kinh tế toàn cầu đối mặt với nhiều thách thức, nhưng cũng mở ra cơ hội mới trong các lĩnh vực đầu tư và phát triển.",
            image: "https://static.tapchimattran.vn/Uploaded/htnhung/2024_02_05/116vtqf_OHOR.jpg",
        },
        {
            id: 3,
            title: "Đánh giá ASUS ExpertBook P5: Làm việc mượt hơn với trợ lý AI, pin 14 tiếng, business laptop nhưng hiệu năng gaming?",
            summary: "Không chỉ có ngoại hình nhỏ nhẹ, mềm mại và chuyên nghiệp, ASUS ExpertBook P5 sở hữu tất cả những tố chất, sức mạnh và tiềm năng cho tương lai để đảm đương mọi công việc một cách tròn vai, chu đáo miễn chê.",
            image: "https://cdn-media.sforum.vn/storage/app/media/nhatquang519/danh-gia-asus-expertbook-p5/danh-gia-asus-expertbook-p5-2024-cover.jpg",
        },
        {
            id: 4,
            title: "Những thay đổi trong luật Công nghiệp công nghệ số",
            summary: "Các quốc gia sẽ điều chỉnh và áp dụng các chính sách Công nghiệp công nghệ số để thích nghi với những thay đổi trong năm 2024.",
            image: "https://media.vneconomy.vn/640x360/images/upload/2021/08/26/luat-cong-nghe-so.jpg",
        },
        {
            id: 5,
            title: "Giới thiệu sản phẩm công nghệ mới của năm 2024",
            summary: "Năm 2024 sẽ là năm phát triển của các sản phẩm công nghệ, từ điện thoại thông minh đến các thiết bị thông minh khác.",
            image: "https://cdnphoto.dantri.com.vn/nDP3y18deL8bVOlQ50OgOYZSnZE=/2024/02/29/laptop-man-hinh-trong-suot-1-1709142433023.png",
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
                                <Link to={`/news/${item.id}`} className="text-blue-600 hover:underline">Xem thêm</Link>
                            </div>
                        ))}
                    </div>
                </section>
            </main>
            <Footer />
        </div>
    );
}
