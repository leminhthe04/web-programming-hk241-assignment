import { useParams } from "react-router-dom";
import { useState, useEffect } from "react";
import Header from "../components/Header";
import Footer from "../components/Footer";
import axios from "axios";

// import ProductCard from "../components/ProductCard";
import ProductCartSmall from "../components/ProductCardSmall";

export default function ProductByCat() {
    const { catName } = useParams();
    let catID = 0 ;
    if (catName === "smartphone") {catID = 1}
    else if(catName === "laptop") {catID = 2}
    else if(catName === "tablet") {catID = 3}
    else if(catName === "watch") {catID = 4}
    else  (catID = 5);
    const [productList, setProductList] = useState([]);
    const [currentPage, setCurrentPage] = useState(0);
    const [pageNum, setPageNum] = useState(0);

    useEffect(() => {
                 axios.get(`http://localhost/Assignment/Backend/api/product/category/${catID}/fetch/0/10`)
                     .then((response) => {
                         if (response.status === 200) {
                             setProductList(response.data.data.data);
                             setPageNum(response.data.data.page_count);
                             console.log("CHECK RESPONSE data: ", response.data.data.data);
                             console.log("CHECK RESPONSE page_count: ", response.data.data.page_count);
                         }
                     })
                     .catch((error) => {
                         if (error.response) {
                             alert(error.response.data.msg);
                         } else {
                             console.error('Error:', error.message);
                         }
                     })
    }, [])



    // const [editMode, setEditMode] = useState(false);
    // const [productList, setProductList] = useState([]);
    // const [priceToggle, setPriceToggle] = useState(false);
    // const [nameToggle, setNameToggle] = useState(false);
    // const [currentPage, setCurrentPage] = useState(0);
    // const [page, setPage] = useState(null);
    // const [errors, setErrors] = useState(null);
    // const [token, setToken] = useState(null);
    // const [count, setCount] = useState(0);
    // const [keyword, setKeyword] = useState("");

    function handlePageClick(pageNum) {
        setCurrentPage(pageNum);
        const index = Number(pageNum);
        const offset = index*3;
        axios.get(`http://localhost/Assignment/Backend/api/product/category/${catID}/fetch/${offset}/10`)
        .then((response) => {
            if (response.status === 200) {
                setProductList(response.data.data.data);
                setPageNum(response.data.data.page_count);
                console.log("CHECK RESPONSE data: ", response.data.data.data);
                console.log("CHECK RESPONSE page_count: ", response.data.data.page_count);
            }
        })
        .catch((error) => {
            if (error.response) {
                alert(error.response.data.msg);
            } else {
                console.error('Error:', error.message);
            }
        })
    }

    return (
        <div className="flex flex-col min-h-screen">
            <Header />

            <main className="flex-grow  mt-6">
                <div className="w-10/12 mx-auto h-10 justify-center">
                    <span><a href="customer/shopping">
                        Mua sắm
                    </a></span> /
                    <span>
                        <a href="customer/shopping" className="font-bold "> {catName === "smartphone" ? "Điện thoại" : null} </a>
                    </span>
                </div>

                <div className="w-10/12 mx-auto bg-product">
                    <div className="h-10"></div>
                    <div className="grid grid-cols-5 gap-y-10 ">
                        {/* {Array.from({ length: 10 }, (_, i) => (
                                <ProductCartSmall prodName={} />
                            ))} */}

                        {productList.map((product, index) => (
                            <ProductCartSmall key={index} prodName={product.name} prodPrice={product.price} prodID={product.id} prodRating={product.avg_rating} prodImage={product.image[0].url} />
                        ))}
                    </div>
                    <div className="h-10"></div>
                </div>


                <div className="flex justify-end w-10/12 mx-auto my-4">
                    {Array.from({ length: pageNum }, (_, i) => (
                        <button
                            key={i}
                            onClick={() => handlePageClick(i)} // Pass the page number to the handler
                            className={`px-3 py-1 mx-1 hover:bg-blue-300 ${currentPage === i ? "bg-blue-500 text-white" : "bg-gray-200"
                                } rounded`}
                        >
                            {i + 1}
                        </button>
                    ))}
                </div>
            </main>
            <Footer />
        </div>
    )
}