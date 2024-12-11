import { useState, useEffect } from "react";
import Footer from "../components/Footer";
import Header from "../components/Header";

export default function ProductDetail() {
    const [quantity, setQuantity] = useState(1);
    const increaseQuantity = () => setQuantity((prev) => prev + 1);
    const decreaseQuantity = () => setQuantity((prev) => (prev > 1 ? prev - 1 : 1));

    return (
        <div className="flex flex-col min-h-screen">
            <Header />
            <main className="flex-grow mt-6">
                <div className="w-10/12 mx-auto h-10 justify-center">
                    <span><a href="customer/shopping">
                        Mua sắm
                    </a></span> /
                    <span><a href="customer/shopping">
                        ... Danh mục
                    </a></span> /
                    <span>
                        <a href="customer/shopping" className="font-bold "> ... tên sp </a>
                    </span>
                </div>

                <div className="prod-info w-10/12 mx-auto flex flex-row">
                    <div className="w-full flex flex-row">
                        <div className="col-1 w-1/5 flex flex-col">
                            <div className="bg-gray-200 py-2 mb-2 rounded-md"><img src="https://cdn2.fptshop.com.vn/unsafe/384x0/filters:quality(100)/xiaomi_14t_black_1_bb226cd286.png" alt="" className="w-3/5 mx-auto" /></div>
                            <div className="bg-gray-200 py-2 mb-2 rounded-md"><img src="https://cdn2.fptshop.com.vn/unsafe/384x0/filters:quality(100)/xiaomi_14t_black_1_bb226cd286.png" alt="" className="w-3/5 mx-auto" /></div>
                            <div className="bg-gray-200 py-2 mb-2 rounded-md"><img src="https://cdn2.fptshop.com.vn/unsafe/384x0/filters:quality(100)/xiaomi_14t_black_1_bb226cd286.png" alt="" className="w-3/5 mx-auto" /></div>
                            <div className="bg-gray-200 py-2 mb-2 rounded-md"><img src="https://cdn2.fptshop.com.vn/unsafe/384x0/filters:quality(100)/xiaomi_14t_black_1_bb226cd286.png" alt="" className="w-3/5 mx-auto" /></div>
                        </div>
                        <div className="w-4/5 ml-2">
                            <div className=" h-full flex items-center justify-center bg-gray-200">
                                <img
                                    src="https://cdn2.fptshop.com.vn/unsafe/384x0/filters:quality(100)/xiaomi_14t_black_1_bb226cd286.png"
                                    alt=""
                                    className="block w-3/5 h-auto"
                                />
                            </div>
                        </div>
                    </div>

                    {/* Element chứu thông tin cơ bản của prodct */}
                    <div className="w-full space-y-1 ml-6">
                        <div className="text-left font-bold text-2xl">PS5 Wireless Controller</div>
                        <div class="rating space-x-1 ">
                            <span class="star filled text-yellow-400">★</span>
                            <span class="star filled text-yellow-400">★</span>
                            <span class="star filled text-yellow-400">★</span>
                            <span class="star text-yellow-400">★</span>
                            <span class="star">★</span>
                        </div>
                        <div className="price text-lg font-bold">192.000.000 VND</div>
                        <div className="short-descript w-10/12">Sản phẩm chính hãng, được cung cấp bởi.... Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit officia ut tempora, laboriosam, doloribus provident voluptate, cum aliquid delectus temporibus nostrum iure veniam quidem necessitatibus sed quasi. Perspiciatis, eveniet laudantium?</div>


                        <div className="border border-b-1 w-10/12 "></div>
                        <div className="h-6"></div>
                        <div className="flex flex-row mt-10 space-x-4">
                            <div className="border border-black w-32 flex items-center justify-between">
                                {/* Nút giảm số lượng */}
                                <button
                                    onClick={decreaseQuantity}
                                    className="bg-gray-300 text-black h-full w-10 hover:bg-gray-400"
                                >
                                    -
                                </button>
                                {/* Hiển thị số lượng */}
                                <div className="quantity text-lg font-semibold">{quantity}</div>
                                {/* Nút tăng số lượng */}
                                <button
                                    onClick={increaseQuantity}
                                    className="bg-gray-300 text-black h-full w-10 hover:bg-gray-400"
                                >
                                    +
                                </button>
                            </div>
                            <div className="bg-red-500 font-bold text-white p-2">Mua ngay</div>
                        </div>
                    </div>




                </div>

                {/* Element chứ thông tin chi tiết của sản phẩm */}
                <div className="mt-10 w-10/12 mx-auto">
                    <h2 className="text-2xl text-red-500 text-center font-semibold">Thông tin chi tiết</h2>
                    <p className="font-serif tracking-wide leading-relaxed p-6 text-justify">

                        Vẻ ngoài cao cấp, thanh lịch từng đường nét
                        Về thiết kế, điện thoại OPPO Find X8 mang dáng vẻ hiện đại với kiểu dáng khá vuông vức cùng các góc được bo cong nhẹ nhàng, tạo cảm giác mạnh mẽ nhưng không quá cứng nhắc. Phần khung viền máy được làm từ chất liệu nhôm siêu nhẹ, tăng thêm sự cao cấp của tổng thể sản phẩm, thu hút người dùng ngay từ ánh nhìn đầu tiên.



                        Bên cạnh đó, thiết bị chỉ nặng 193 gram, một con số hợp lý để bạn cầm lâu mà không bị mỏi tay. Điều này khiến điện thoại trở thành một lựa chọn hấp dẫn với những ai yêu thích sự nhẹ nhàng và thường có thói quen sử dụng liên tục.



                        Với tiêu chuẩn IP69 và IP68 cùng chứng nhận 5 sao SGS về khả năng chống rơi vỡ, mang đến cho người dùng sự yên tâm tuyệt đối. Bạn có thể thoải mái tận hưởng những trải nghiệm giải trí, làm việc mà không lo lắng về các tác động từ môi trường bên ngoài.



                        Công nghệ màn hình sắc nét, chân thực
                        Màn hình của máy có kích thước 6.59 inch, khá lý tưởng cho nhu cầu giải trí hay làm việc hằng ngày. Điều đáng chú ý là phần viền sản phẩm được thiết kế siêu mỏng, chỉ 1.45 mm, nhỏ hơn hẳn so với người anh em tiền nhiệm Find X7, vốn dày 1.94 mm, cho phép người dùng đắm chìm hơn vào các nội dung được hiển thị.

                        Với độ phân giải 1.5K+, điện thoại OPPO Find X8 mang đến hình ảnh sắc nét, sống động. Mỗi khung hình đều rõ ràng và chân thực, tạo cảm giác cuốn hút, giúp người dùng thưởng thức nội dung một cách trọn vẹn nhất.


                    </p>
                </div>

                <div className="w-10/12 mx-auto">
                    <div className="text-2xl text-red-500 text-center font-semibold mb-4">Đánh giá và nhận xét</div>
                    <div className="review border border-black rounded-md  p-2">
                        <div className="flex flex-row space-x-2 items-baseline">
                            <span className="font-semibold mr-2">Bảo Ngọc</span>
                            <div className=" text-gray-500 italic text-sm">12-02-2024</div>
                           
                            
                        </div>
                        <div class="inline-block rating space-x-1 ">
                                <span class="star filled text-yellow-400">★</span>
                                <span class="star filled text-yellow-400">★</span>
                                <span class="star filled text-yellow-400">★</span>
                                <span class="star text-yellow-400">★</span>
                                <span class="star">★</span>
                            </div>
                            <div className="comment">
                                <p className="pl-6">Sản phẩm chất lượng, đúng mô tả,...</p>
                            </div>
                    </div>
                </div>
            </main>
            <div className="h-60"></div>
            <Footer />

        </div>
    )
}