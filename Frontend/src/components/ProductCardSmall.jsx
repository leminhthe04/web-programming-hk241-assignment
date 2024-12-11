import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faCartShopping } from "@fortawesome/free-solid-svg-icons";
import { useState } from "react";
import { useNavigate } from "react-router-dom";

export default function ProductCartSmall({prodID, prodName, prodPrice, prodRating}) {
    const navigate = useNavigate();
    const [showBuy, setShowBuy] = useState(false);

    return (
        <div className="w-48 inline-block justify-center items-center mx-auto">
            <div className="relative w-44 h-44 border bg-white flex justify-center items-center align-center rounded-lg"
                onMouseOver={() => setShowBuy(true)}
                onMouseOut={() => setShowBuy(false)}
                onClick={() => navigate(`/customer/productDetail/${prodID}`)}
            >
                <img src="https://cdn2.fptshop.com.vn/unsafe/384x0/filters:quality(100)/xiaomi_14t_black_1_bb226cd286.png" alt="" className="w-auto h-28" />
                {/* <div className="cart-icon absolute right-2 top-2  rounded-full p-2 bg-indigo-300 hover:bg-indigo-400 ">
                    <FontAwesomeIcon icon={faCartShopping} />
                </div> */}
                {showBuy ? 
                    <div className="buy-now absolute bottom-0 bg-black text-white w-full text-center p-1"
                        onClick={(e) => 
                            {e.stopPropagation();
                            navigate(`/customer/pay/${prodID}`)
                        }}
                    >
                        Buy Now
                    </div> : null}
                
            </div>
            <div className="w-full pl-2">
                <h1 className="font-bold text-sm">SamSung Galaxy S24 Plus</h1>
                <div className="price text-sm">
                    <span className="text-red-600">21.990.000 VND</span>
                    <span className="mx-2 line-through">22.000.000</span>
                </div>
                <div class="rating space-x-1 text-sm">
                    <span class="star filled text-yellow-400">★</span>
                    <span class="star filled text-yellow-400">★</span>
                    <span class="star filled text-yellow-400">★</span>
                    <span class="star text-yellow-400">★</span>
                    <span class="star">★</span>

                    <span>(88)</span>
                </div>

            </div>
        </div>
    )
}