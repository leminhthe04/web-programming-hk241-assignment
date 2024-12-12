import { useState } from "react"
import RenderStars from "./RenderStart"

export default function NewReview() {
    const [rating, setRating] = useState(0);

    return(
        <div className="w-full rounded-md border"> 
            {/* <div className="userInfo">
                Huynh Bao Ngoc
            </div>

            <textarea name="" id="" className="border border-black block min-w-80" placeholder="Bạn nghĩ gì về sản phẩm">
            </textarea>

            <div className="flex justify-end">
                <button className="bg-red-500 p-1  text-white font-bold">Thêm nhận xét</button>
            </div> */}
        <div className="review border border-black rounded-md  p-2">
                <div className="flex flex-row space-x-2 items-baseline">
                    <span className="font-semibold mr-2">Bảo Ngọc</span>
                    <div className=" text-gray-500 italic text-sm">12-02-2024</div>


                </div>
                <div>
                    <span  className={`star filled ${rating >= 1 ? "text-yellow-400" : ''}`}
                        onClick={() => setRating(1)}    
                        >★</span>
                    <span  className={`star filled ${rating >= 2 ? "text-yellow-400" : ''}`}
                        onClick={() => setRating(2)}    
                        >★</span>
                    <span  className={`star filled ${rating >= 3 ? "text-yellow-400" : ''}`}
                        onClick={() => setRating(3)}    
                        >★</span>
                    <span  className={`star filled ${rating >= 4 ? "text-yellow-400" : ''}`}
                        onClick={() => setRating(4)}    
                     >★</span>
                    <span  className={`star filled ${rating === 5 ? "text-yellow-400" : ''}`}
                        onClick={() => setRating(5)}    
                        >★</span>
                </div>
                <textarea className="comment border border-black w-full p-1">
                    
                </textarea>

                <div className="flex justify-end">
                    <button className="bg-red-500 p-1  text-white font-bold">Thêm nhận xét</button>
                </div> 
            </div>
        </div>
    )
}