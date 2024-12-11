import { useState, useEffect } from "react";
import Footer from "../components/Footer";
import Header from "../components/Header";

export default function Account() {
    return (
        <div className="flex flex-col min-h-screen">
            <Header />
            <main className="flex-grow">
                <div className="my-4 ml-10">
                    <span className="text-gray-600">Mua sắm / </span>
                    <span className="font-medium">Tài khoản</span>
                </div>
                <div className="w-10/12 mx-auto bg-purple-1 p-6">
                    <div className="w-9/12 mx-auto bg-purple-1 p-6">
                        <h1 className="text-red-700 font-bold text-2xl">Thông tin cá nhân</h1>
                        <div className="grid grid-cols-2">
                            <div>
                                <div className="my-4 space-y-2 flex flex-col min-w-48 w-1/2">

                                    <label htmlFor="name" className="">Tên khách hàng</label>
                                    <input type="text" className="bg-gray-200 p-2 outline-none"
                                        value={"Huynh Bao Ngoc"}
                                    />
                                </div>

                                <div className="my-4 space-y-2 flex flex-col min-w-48 w-1/2 ">
                                    <label htmlFor="email" className="">Email</label>
                                    <input type="text" className="bg-gray-200 p-2 outline-none"
                                        value={"Huynh Bao Ngoc"}
                                    />
                                </div>
                            </div>
                            <div className="h-full w-full ">
                                <div className="w-full flex flex-col space-y-2 ">

                                    <label htmlFor="address" className="">Địa chỉ</label>
                                    <textarea className="bg-gray-200 p-2 block w-full min-h-20 overflow-auto break-words outline-none">
                                        Huynh Bao Ngoc sfasfasfasfasdfafasdffasfdasdfasfdasdfasdfasdfasdfasdfa
                                    </textarea>

                                </div>
                            </div>
                        </div>

                         {/* Element thay đổi mật khẩu */}
                         <div className="w-full flex flex-col space-y-2">
                            <label htmlFor="newPass" className="text-red-700 font-bold">Thay đổi mật khẩu</label>
                            <div className="flex flex-col space-y-2">
                                <div className="inline-block w-40">Mật khẩu hiện tại</div>
                                <input type="text" className="inline-block outline-none bg-gray-200 p-2 w-full min-w-60" />
                            </div>

                            <div className="flex flex-col space-y-2">
                                <div className="inline-block w-40">Mật khẩu hiện tại</div>
                                <input type="text" className="inline-block outline-none bg-gray-200 p-2 w-full min-w-60" />
                            </div>

                            <div className="flex flex-col space-y-2">
                                <div className="inline-block w-40">Mật khẩu hiện tại</div>
                                <input type="text" className="inline-block outline-none bg-gray-200 p-2 w-full min-w-60" />
                            </div>
                        </div> 
                        <div className=" flex justify-end mt-6">
                            <div className="flex flex-row">
                                <button className="border border-black p-2 px-4 rounded-md">
                                    Hủy
                                </button>

                                <button className="bg-red-700 text-white font-semibold p-2 ml-10 rounded-md">
                                    Lưu thay đổi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <div className="h-40">

            </div>
            <Footer />
        </div>
    )
}