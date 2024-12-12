import { useEffect, useState } from "react";
import Footer from "../components/Footer";
import Header from "../components/Header";
import ProductCardSmall from "../components/ProductCardSmall";

import Slider from "../components/Slider";
import { useNavigate } from "react-router-dom";
import axios from "axios";

export default function Homepage() {
    const navigate = useNavigate();
    const [productList, setProductList] = useState([]);


    useEffect(() => {
        axios.get(`http://localhost/Assignment/Backend/api/product/fetch/0/5`)
            .then((response) => {
                if(response.status === 200) {
                    console.log("Check response: ", response.data.data.data);
                    const resultData = response.data.data.data;
                    setProductList(resultData);
                }
            })
            .catch((error) => {
                if (error.response.data) {
                    alert(error.response.data.msg);
                } else {
                    console.error('Error:', error.message);
                }
            })
    }, []);

    {
        return (
            <>
                <Header />

                <main className="w-screen">
                    <div class="grid grid-cols-[20vw_80vw] mt-2 w-10/12 mx-auto">
                        <div className="flex items-center">
                            <ul className="w-3/4 font-semibold space-y-6 my-auto pr-6 border-r-2 border-gray-200 ">
                                <li className="border-b-2 border-black "
                                    onClick={() =>  window.location.href = (`/customer/category/smartphone`)}
                                >Điện thoại</li>
                                <li className="border-b-2 border-black "
                                    onClick={() =>  window.location.href = (`/customer/category/laptop`)}
                                >Laptop</li>
                                <li className="border-b-2 border-black "
                                    onClick={() =>  window.location.href = (`/customer/category/tablet`)}
                                >Máy tính bảng</li>
                                <li className="border-b-2 border-black "
                                    onClick={() =>  window.location.href = (`/customer/category/watch`)}
                                >Đồng hồ thông minh</li>
                                <li className="border-b-2 border-black "
                                    onClick={() =>  window.location.href = (`/customer/category/other`)}
                                >Phụ kiện</li>
                            </ul>
                        </div>
                        <Slider />
                    </div>

                    <div className="h-20"></div>


                    {/* Sản phẩm nổi bật  */}
                    <div className="w-10/12 mx-auto bg-product">
                        <div className="font-bold text-red-500 flex flex-row items-center mb-6">
                            <span className="w-4 h-8 bg-red-600 inline-block"></span>
                            <span className="px-4 text-red-600">Sản phẩm nổi bật</span>
                        </div>
                        <div className="w-11/12 mx-auto flex justify-between pb-6">
                        {productList.map((prod, index) => (<ProductCardSmall prodID={prod.id} prodName={prod.name} prodPrice={prod.price} prodRating={prod.avg_rating} prodImage={prod.image[0].url} />))}
                        </div>
                      
                    </div>
                    

                    <div className="w-full flex justify-center items-center my-6">
                        <div className="bg-red-600 text-white w-44 text-center p-2 rounded-md"
                            onClick={() => {navigate("/customer/shopping")}}
                        >Xem tất cả sản phẩm</div>
                    </div>

                    {/* DANH MỤC SẢN PHẨM */}
                    <div className="w-10/12 mx-auto bg-product pb-6">
                        <div className="font-bold text-red-500 flex flex-row items-center mb-6">
                            <span className="w-4 h-8 bg-red-600 inline-block"></span>
                            <span className="px-4 text-red-600">Danh mục</span>
                        </div>
                        <div className="w-11/12 mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                            <div className="border rounded-lg overflow-hidden bg-white pt-2 hover:shadow-md transition-shadow duration-300"
                                 onClick={() =>  window.location.href = (`/customer/category/smartphone`)}
                            >
                                <div className="flex justify-center items-center h-48">
                                    <img src="../../public/mobile.jpg" alt="Điện thoại" className="max-w-full max-h-full" />
                                </div>
                                <div className="text-center py-2 font-semibold">Điện thoại</div>
                            </div>
                            <div className="border rounded-lg overflow-hidden bg-white pt-2 hover:shadow-md transition-shadow duration-300"
                                 onClick={() =>  window.location.href = (`/customer/category/laptop`)}
                            >
                                <div className="flex justify-center items-center h-48">
                                    <img src="../../public/laptop.jpg" alt="Laptop" className="max-w-full max-h-full" />
                                </div>
                                <div className="text-center py-2 font-semibold">Laptop</div>
                            </div>
                            <div className="border rounded-lg overflow-hidden bg-white pt-2 hover:shadow-md transition-shadow duration-300"
                                 onClick={() =>  window.location.href = (`/customer/category/tablet`)}
                            >
                                <div className="flex justify-center items-center h-48">
                                    <img src="../../public/tablet.jpg" alt="Tablet" className="max-w-full max-h-full" />
                                </div>
                                <div className="text-center py-2 font-semibold">Tablet</div>
                            </div>
                            <div className="border rounded-lg overflow-hidden bg-white pt-2 hover:shadow-md transition-shadow duration-300"
                                 onClick={() =>  window.location.href = (`/customer/category/watch`)}
                            >
                                <div className="flex justify-center items-center h-48">
                                    <img src="../../public/watch.png" alt="Watch" className="max-w-full max-h-full" />
                                </div>
                                <div className="text-center py-2 font-semibold">Watch</div>
                            </div>
                            <div className="border border-gray-300 rounded-lg overflow-hidden bg-white pt-2 hover:shadow-md transition-shadow duration-300"
                                 onClick={() =>  window.location.href = (`/customer/category/other`)}
                            >
                                <div className="flex justify-center items-center h-48">
                                    <img src="../../public/mobile.jpg" alt="Điện thoại" className="max-w-full max-h-full" />
                                </div>
                                <div className="text-center py-2 font-semibold">Phụ kiện</div>
                            </div>
                        </div>
                    </div>

                    <div className="h-60"></div>
                </main>

                <div>
                    <Footer />
                </div>

            </>
        )
    }

}