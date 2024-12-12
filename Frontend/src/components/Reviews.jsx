import RenderStars from "./RenderStart";

export default function Reviews({rating}) {
    return (
        <div className="w-full">
            
            <div className="review border border-black rounded-md  p-2">
                <div className="flex flex-row space-x-2 items-baseline">
                    <span className="font-semibold mr-2">Bảo Ngọc</span>
                    <div className=" text-gray-500 italic text-sm">12-02-2024</div>


                </div>
                <RenderStars rating={rating} />
                <div className="comment">
                    <p className="pl-6">Sản phẩm chất lượng, đúng mô tả,...</p>
                </div>
            </div>
        </div>
    )
}