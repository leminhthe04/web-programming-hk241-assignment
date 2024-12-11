import Footer from "../components/Footer";
import Header from "../components/Header";
import ProductCard from "../components/ProductCard";

export default function Shopping() {
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

                    {Array.from({ length: 4 }, (_, i) => (
                        <div className="w-full bg-product mt-10">
                            <div className="flex justify-between">
                                <div className="justify-center items-center">
                                    <span className="w-4 h-8 bg-red-500 inline-block"></span>
                                    <span className="px-4 text-red-500 font-bold ">Điện thoại</span>
                                </div>
                                <div>
                                    <button className=" bg-red-500 text-white p-2 rounded-lg m-2 hover:bg-red-700 ">Xem tất cả</button>
                                </div>
                            </div>

                            <div className="grid grid-cols-4 gap-6 py-6 ">
                                {Array.from({ length: 4 }, (_, i) => (
                                    <ProductCard />
                                ))}
                            </div>
                        </div>
                    ))}


                </div>


            </main>
            <Footer />

        </div>
    )
}