import { useParams } from "react-router-dom";
import { useState, useEffect } from "react";
import Header from "../components/Header";
import Footer from "../components/Footer";

// import ProductCard from "../components/ProductCard";
import ProductCartSmall from "../components/ProductCardSmall";

export default function ProductByCat() {
    const { catName } = useParams();


    // const [editMode, setEditMode] = useState(false);
    // const [productList, setProductList] = useState([]);
    // const [priceToggle, setPriceToggle] = useState(false);
    // const [nameToggle, setNameToggle] = useState(false);
    const [currentPage, setCurrentPage] = useState(0);
    // const [page, setPage] = useState(null);
    // const [errors, setErrors] = useState(null);
    // const [token, setToken] = useState(null);
    // const [count, setCount] = useState(0);
    // const [keyword, setKeyword] = useState("");

    function handlePageClick(pageNum) {
        const index = Number(pageNum);
        // axios.get(`http://localhost:8000/api/product/getAll?page=${index}&limit=5`,)
        //     .then((response) => {
        //         console.log(response);
        //         setCurrentPage(pageNum)
        //         const products = response.data.data;
        //         // console.log(JSON.stringify(products));
        //         setProductList(products);
        //     })
        //     .catch((error) => {
        //         if (error.response) {
        //             alert(error.response.data.msg);
        //         } else {
        //             console.error('Error:', error.message);
        //         }
        //     })
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
                    {Array.from({ length: 10 }, (_, i) => (
                                <ProductCartSmall />
                            ))}
                    </div>
                    <div className="h-10"></div>  
                </div>


                <div className="flex justify-end w-10/12 mx-auto my-4">
                        {Array.from({ length: 4 }, (_, i) => (
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