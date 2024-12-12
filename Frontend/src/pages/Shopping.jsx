import { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import Footer from "../components/Footer";
import Header from "../components/Header";
import ProductCartSmall from "../components/ProductCardSmall";
import axios from "axios";

export default function Shopping() {    
    const [smartphoneList, setSmartphoneList] = useState([]);
    const [laptopList, setLaptopList] = useState([]);
    const [tabletList, setTabletList] = useState([]);  
    const [watchList, setWatchList] = useState([]);
    const [otherList, setOtherList] = useState([]); 
    
    useState(() => {    
        const fetchData = async () => {
            try { 
                const fetchSmartphone = axios.get(`http://localhost/Assignment/Backend/api/product/category/1/fetch/0/4`);
                const fetchLaptop = axios.get(`http://localhost/Assignment/Backend/api/product/category/2/fetch/0/4`);
                const fetchTablet = axios.get(`http://localhost/Assignment/Backend/api/product/category/3/fetch/0/4`);  
                const fetchWatch = axios.get(`http://localhost/Assignment/Backend/api/product/category/4/fetch/0/4`);
                const fetchOther = axios.get(`http://localhost/Assignment/Backend/api/product/category/5/fetch/0/4`);   

                const response = await axios.all([fetchSmartphone, fetchLaptop, fetchTablet, fetchWatch, fetchOther]);
            }
            catch(error) {

            }
        }
       

    
    }, [])

    return (
        <div className="flex flex-col min-h-screen">
            <Header />


            <main className="flex-grow mt-10">
                <div className="w-10/12 mx-auto">
                    <span>
                        <a href="customer/shopping" className="font-bold ">Mua sắm {"/"} </a>
                    </span>
                </div>
                <div className=" w-10/12 m-auto">

                    <div className="w-full bg-product mt-10">
                        <div className="flex justify-between">
                            <div className="justify-center items-center">
                                <span className="w-4 h-8 bg-red-500 inline-block"></span>
                                <span className="px-4 text-red-500 font-bold ">Điện thoại</span>
                            </div>
                            <div>
                                <button className=" bg-red-500 text-white p-2 rounded-lg m-2 hover:bg-red-700 "

                                >Xem tất cả</button>
                            </div>
                        </div>

                        <div className="grid grid-cols-4 gap-6 py-6 ">
                            {Array.from({ length: 4 }, (_, i) => (
                                <ProductCartSmall prodID={1} prodName={"sfasfas"} prodPrice={123} prodRating={2} prodImage={""} />
                            ))}
                        </div>
                    </div>

                    {/* {Array.from({ length: 4 }, (_, i) => (
                        <div className="w-full bg-product mt-10">
                            <div className="flex justify-between">
                                <div className="justify-center items-center">
                                    <span className="w-4 h-8 bg-red-500 inline-block"></span>
                                    <span className="px-4 text-red-500 font-bold ">Điện thoại</span>
                                </div>
                                <div>
                                    <button className=" bg-red-500 text-white p-2 rounded-lg m-2 hover:bg-red-700 "
                                        
                                    >Xem tất cả</button>
                                </div>
                            </div>

                            <div className="grid grid-cols-4 gap-6 py-6 ">
                                {Array.from({ length: 4 }, (_, i) => (
                                    <ProductCartSmall prodID={1} prodName={"sfasfas"} prodPrice={123} prodRating={2} prodImage={""} />
                                ))}
                            </div>
                        </div>
                    ))} */}


                </div>


            </main>
            <Footer />

        </div>
    )
}