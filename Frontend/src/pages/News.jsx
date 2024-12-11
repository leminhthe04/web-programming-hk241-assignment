import { useState, useEffect } from "react"
import Header from "../components/Header"
import Footer from "../components/Footer"
import Slider from "../components/Slider"


export default function News() {
    return (
        <div className="flex flex-col min-h-screen">
            <Header />

            <div className="breadcums my-5 ml-10">
                <span className="">Trang chủ</span> /
                <span className=" font-bold"> Tin tức</span>
            </div>
            <main className=" p-8 bg-gray-100">
                <Slider />
                <section className="mb-8  w-10/12 mx-auto">

                    <div className="grid grid-cols-2 mx-auto">
                        <div className="justify-center items-center my-auto "></div>
                            <h1 className="text-4xl font-bold mb-4">Tin tức</h1>
                            <p className="text-lg">
                                Đây là trang tin tức của chúng tôi. Cập
                            </p>
                    </div>
                </section>
            </main>
        </div>
    )
}