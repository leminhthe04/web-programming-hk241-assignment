import Footer from "../components/Footer";
import Header from "../components/Header";

import { useLocation, useParams } from "react-router-dom";
import { useState, useEffect } from "react";
import axios from "axios";

export default function Checkout() {
    const { prodID } = useParams();
    const location = useLocation();
    const { quantity, img, prodName, price } = location.state || 0;

    const [user_id, setUser_id] = useState(null);
    const [userName, setUserName] = useState(null);
    const [email, setEmail] = useState(null);
    const [phone, setPhone] = useState(null);
    const [address, setAddress] = useState(null);

    function formatPrice(price) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(price);
    }

    useEffect(() => {
        const userID = localStorage.getItem("userID");
        setUser_id(userID);
        if (!userID) {
            return alert("Vui lòng đăng nhập để tiếp tục");
        }
        axios.get(`http://localhost/Assignment/Backend/api/user/detail/${userID}`)
            .then((response) => {
                if (response.status === 200) {
                    console.log(response.data.data[0]);
                    const userDATA = response.data.data[0];
                    setUserName(userDATA.name);
                    setEmail(userDATA.email);
                    setPhone(userDATA.phone);
                    setAddress(userDATA.address);
                }
            })
            .catch((error) => {
                if (error.response.data) {
                    alert(error.response.data.msg);
                } else {
                    console.error('Error:', error.message);
                }
            })
    }, [])

    function handlePlaceOrder()  {
        const orderData = {
            product_id: prodID,
            customer_id: user_id,
            quantity: quantity,
            shipping_address: address,
        }

        console.log("CHECK ORDER: ", orderData);

        axios.post(`http://localhost/Assignment/Backend/api/order/create`, orderData)
            .then((response) => {
                if(response.status === 201 ) {
                    alert("Tạo đơn hàng thành công");
                }
            })
            .catch((error) => {
                if (error.response.data) {
                  alert(error.response.data.msg);
                } else {
                  console.error('Error:', error.message);
                }
            })
    }

    return (
        <div className="flex flex-col min-h-screen">
            <Header />

            <main className="flex-grow">
                <div className="w-11/12 m-auto">
                    <div className="my-4 ml-10">
                        <span className="text-gray-600">Cửa hàng / </span>
                        <span className="font-medium">Thanh toán</span>
                    </div>
                    <h1 className="text-3xl font-bold mb-6 ml-10">Xác nhận đặt hàng</h1>
                    <div className="flex flex-row " >
                        <div className="col-1 w-1/2 text-sm">
                            <div className="w-10/12 ml-10">
                                <div className="mb-4 flex items-end w-full">
                                    <div className="w-full">
                                        <div>Họ tên</div>
                                        <input
                                            type="text"
                                            id="name"
                                            name="lastName"
                                            className={`mt-1 p-2  w-4/5 bg-gray-100 text-gray-600 outline-none disabled`}
                                            value={userName}
                                            disabled
                                        />
                                    </div>

                                </div>
                                <div className="mb-4">
                                    <div>Email</div>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        className={`mt-1 p-2  w-4/5 bg-gray-100 text-gray-600 `}
                                        value={email}
                                        disabled
                                    />

                                </div>

                                <div className="mb-4">
                                    <div>Số điện thoại</div>
                                    <input
                                        type="number"
                                        id="phone"
                                        name="phone"
                                        className={`mt-1 p-2  w-4/5  bg-gray-100 text-gray-600`}
                                        value={phone}
                                        disabled
                                    />

                                </div>

                                <div className="mb-4">
                                    <div>Địa chỉ</div>
                                    <textarea
                                        type="address"
                                        id="address"
                                        name="address"
                                        className={`mt-1 p-2 w-4/5 min-h-24 bg-gray-100 hover:bg-blue-100 `}
                                        value={address}
                                        onChange={(e) => setAddress(e.target.value)}
                                    > </textarea>
                                </div>


                            </div>
                        </div>
                        <div className="col-2  w-1/2">
                            <div className="products w-8/12 space-y-4 m-auto">
                                <div className="flex flex-row items-center ">
                                    <div className=" w-2/5 flex items-center space-x-2">
                                        <span>
                                            <img src={img} alt="" width={"50px"} />
                                        </span>
                                        <span>{prodName}</span>
                                    </div>
                                    <div className=" w-2/5 text-right ">{formatPrice(price)}</div>
                                    <div className=" w-1/5 text-right mr-20">x {(quantity)}</div>
                                </div>

                                <div className="border-b border-gray-600 mr-20"></div>

                                <div className="flex justify-between mr-20">
                                    <div className="font-semibold">Tổng tiền</div>
                                    <div>{formatPrice(price * quantity)}</div>
                                </div>

                                <div className="payment-method">
                                    <label htmlFor="method" className="font-bold">Chọn phương thức thanh toán: </label>
                                    <div className="p-2 ml-2">
                                        <div className="space-x-2">
                                            <input type="radio" value="cash" name="payment" className="" />
                                            <span>Trả tiền khi nhận hàng</span>
                                        </div>

                                    </div>
                                </div>

                                <div className="flex justify-center items-center">
                                    <div className="bg-red-600 text-white font-bold p-2 rounded-md"
                                        onClick={handlePlaceOrder}
                                    >
                                        Đặt hàng
                                    </div>
                                </div>
                            </div>

                            <div className="h-10"></div>

                        </div>
                    </div>
                </div>
            </main>
            <Footer />
        </div>
    )
}