import { useEffect, useState } from "react";
import Footer from "../components/Footer";
import Header from "../components/Header";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faMobile } from "@fortawesome/free-solid-svg-icons";


export default function Homepage() {
    const [role, setRole] = useState("customer");
    const [token, setToken] = useState(null);

    useEffect(() => {
        const loadRole = localStorage.getItem("role");
        const loadToken = localStorage.getItem("token");
        if (loadRole) {
            setRole(loadRole)
        }
        if (loadToken) {
            setToken(loadToken)
        }
    })

    {
        return (
            <>
                <Header />


                <main className="w-screen">
                    <div class="grid grid-cols-[20vw_80vw] mt-2 w-10/12 mx-auto">
                        <div className="flex items-center">
                            <ul className="w-3/4 font-semibold space-y-6 my-auto pr-6 border-r-2 border-gray-200 ">
                                <li className="border-b-2 border-black ">Điện thoại</li>
                                <li className="border-b-2 border-black ">Laptop</li>
                                <li className="border-b-2 border-black ">Máy tính bảng</li>
                                <li className="border-b-2 border-black ">Đồng hồ thông minh</li>
                                <li className="border-b-2 border-black ">Phụ kiện</li>
                            </ul>

                        </div>
                        <div className="">
                            <img src="../../public/banner1.jpg" alt="" width="900px" h="400px" />
                        </div>
                    </div>

                    <div className="h-20"></div>


                    {/* Sản phẩm nổi bật  */}
                    <div className="h-80 w-10/12 mx-auto bg-product">
                        <div className="font-bold text-red-500 flex flex-row items-center ">
                            <span className="w-4 h-8 bg-red-600 inline-block"></span>
                            <span className="px-4 text-red-600">Sản phẩm nổi bật</span>
                        </div>

                        <div className="flex flex-row space-x-20 pt-6 px-6 justify-center">
                            <div className="w-56 h-56 border bg-white flex justify-center align-center">
                                <img src="https://cdn2.fptshop.com.vn/unsafe/384x0/filters:quality(100)/xiaomi_14t_black_1_bb226cd286.png" alt="" />
                            </div>

                            <div className="w-56 h-56 border bg-white flex justify-center align-center">
                                <img src="https://cdn2.fptshop.com.vn/unsafe/384x0/filters:quality(100)/xiaomi_14t_black_1_bb226cd286.png" alt="" />
                            </div>

                            <div className="w-56 h-56 border bg-white flex justify-center align-center">
                                <img src="https://cdn2.fptshop.com.vn/unsafe/384x0/filters:quality(100)/xiaomi_14t_black_1_bb226cd286.png" alt="" />
                            </div>

                            <div className="w-56 h-56 border bg-white flex justify-center align-center">
                                <img src="https://cdn2.fptshop.com.vn/unsafe/384x0/filters:quality(100)/xiaomi_14t_black_1_bb226cd286.png" alt="" />
                            </div>

                        </div>

                    </div>

                    <div className="w-full flex justify-center items-center my-6">
                        <div className="bg-red-600 text-white w-44 text-center p-2 rounded-md">Xem tất cả sản phẩm</div>
                    </div>

                    {/* Danh mục sản phẩm */}
                    <div className="w-10/12 mx-auto bg-product">
                        <div className="font-bold text-red-500 flex flex-row items-center ">
                            <span className="w-4 h-8 bg-red-600 inline-block"></span>
                            <span className="px-4 text-red-600">Danh mục</span>
                        </div>
                        <div className="w-11/12 mx-auto grid grid-cols-5 gap-6">
                            <div className="border border-black  ">
                                <div className="">
                                    <img src="../../public/mobile.jpg" alt="" className="" />
                                </div>
                                <div>Điện thoại </div>
                            </div>
                            <div className="border border-black ">
                                <div className=" ">
                                    <img src="../../public/laptop.jpg" alt="" className="" />
                                </div>
                                <div>Điện thoại </div>
                            </div>

                            <div className="border border-black ">
                                <div className="">
                                    <img src="../../public/tablet.jpg" alt="" className="" />
                                </div>
                                <div>Điện thoại </div>
                            </div>

                            <div className="border border-black ">
                                <div className="">
                                    <img src="../../public/watch.png" alt="" className="" />
                                </div>
                                <div>Điện thoại </div>
                            </div>

                            <div className="border border-black ">
                                <div className="">
                                    <img src="../../public/mobile.jpg" alt="" className="" />
                                </div>
                                <div>Điện thoại </div>
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