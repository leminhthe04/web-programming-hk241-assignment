import { useEffect, useState } from "react";
import axios from 'axios';
import Header from "../components/Header";
import Footer from "../components/Footer";
import Pagination from "../components/Pagination";
import ProductUpdate from "./ProductUpdate";
import { useNavigate } from "react-router-dom";
import { PuffLoader } from "react-spinners";
import Modal from "react-modal";

export default function ProductsManagement() {
    const navigate = useNavigate();
    const [editMode, setEditMode] = useState(false);
    const [productList, setProductList] = useState([]);
    const [currentPage, setCurrentPage] = useState(0);
    const [page, setPage] = useState(null);
    const [count, setCount] = useState(0);
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        axios.get("http://localhost/Assignment/Backend/api/product/fetch/0/10",)
            .then((response) => {
                const responseData = response.data.data;
                setProductList(responseData.data);
                setPage(responseData.page_count);
            })
            .catch((error) => {
                if (error.response) {
                    alert(error.response.data.msg);
                } else {
                    console.error('Error:', error.message);
                }
            })
    }, [count])


    function disableEditMode() {
        setEditMode(false);
    }

    function handleUpdateProduct(prodID) {
        navigate(`/admin/edit-product/${prodID}`);
    }

    function handlePageClick(pageNum) {
        const index = Number(pageNum);
        const offset = index * 10;
        setLoading(true);

        axios.get(`http://localhost/Assignment/Backend/api/product/fetch/${offset}/10`,)
            .then((response) => {
                setCurrentPage(pageNum)
                const newresponseData = response.data.data;
                setProductList(newresponseData.data);
            })
            .catch((error) => {
                if (error.response.data) {
                    alert(error.response.data.msg);
                } else {
                    console.error('Error:', error.message);
                }
            })
            .finally(() => {
                setLoading(false);
            })
    }

    function handleSearch() {
        alert("Search");
        if (keyword == null) {
            alert("Hãy điền từ khóa để tìm kiếm")
        }
        axios.get(`http://localhost:8000/api/product/getAll?page=0&limit=5&filter=${keyword}`,)
            .then((response) => {
                console.log(response);
                const products = response.data.data;
                const pageNum = response.data.totalPage;
                setPage(pageNum);
                // console.log(JSON.stringify(products));
                setProductList(products);
            })
            .catch((error) => {
                if (error.response) {
                    alert(error.response.data.msg);
                } else {
                    console.error('Error:', error.message);
                }
            })

    }

    function handleDeleteProduct(prodID) {
        // axios.delete(`http://localhost:8000/api/product/DeleteProduct/${prodID}`, null, {
        //     headers: {
        //         Authorization: `Bearer ${token}`, // Replace <your-auth-token> with the actual token
        //     },
        // })
        //     .then((response) => {
        //         alert(response.data.msg);
        //         setCount((pre) => pre + 1);
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
        <>
            <Header page="product-manage" role="admin" />
            <Modal
                isOpen={loading}
                style={{
                    content: {
                        top: "50%",
                        left: "50%",
                        right: "auto",
                        bottom: "auto",
                        marginRight: "-50%",
                        transform: "translate(-50%, -50%)",
                        background: "transparent",
                        border: "none",
                    },
                    overlay: {
                        backgroundColor: "rgba(0, 0, 0, 0.5)",
                    },
                }}
            >
                <PuffLoader color="#ff6b6b" size={60} />
            </Modal>
            <div className="m-4 mb-10">
                <span className=" font-medium">All Products</span>
            </div>
            <main>

                <div className="flex">
                    <div className="flex items-center w-1/4 mb-10 m-auto border border-black rounded-md p-1">
                        <input
                            type="text"
                            className="flex-grow p-2 rounded-md outline-none"
                            placeholder="Find product ?"
                            onChange={(e) => {
                                setKeyword(e.target.value)
                            }}
                        />
                        <div className="p-2 bg-gray-300" onClick={handleSearch} >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                strokeWidth={1.5}
                                stroke="currentColor"
                                className="w-6 h-6 text-gray-500 font-bold hover:text-black "

                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                                />
                            </svg>
                        </div>

                    </div>
                    <div className="add-product inline-block bg-gray-300 h-full relative right-20 p-2 hover:bg-slate-200" onClick={() => { navigate("/admin/product-new") }}>
                        <div className="font-bold ">Thêm sản phẩm</div>
                    </div>

                </div>

                {editMode && (
                    <>
                        <ProductUpdate disableEditMode={disableEditMode} />
                        <div className="fixed inset-0 bg-black bg-opacity-30 z-10"></div>
                    </>
                )}
                <table className="w-11/12 min-h-80 text-center text-bold text-md m-auto">
                    <thead>
                        <tr className="h-14 bg-purple-1 border text-center rounded-e-sm">
                            <td className="w-1/12">Mã sản phẩm</td>
                            <td className="w-3/12">Tên sản phẩm</td>
                            <td className="w-1/12">Giá</td>
                            <td className="w-1/12">Trong kho</td>
                            <td className="w-1/12">Đã bán</td>
                            <td className="w-1/12">Trạng thái</td>
                            <td className="w-1/12"> Tùy chỉnh</td>
                        </tr>
                    </thead>
                    <tbody>

                        {productList.map((prod) => {
                            return (
                                <>
                                    <tr className=" border border-black  h-14 mt-2" key={prod.id}>
                                        <td>{prod.id}</td>
                                        <td className="text-left">{prod.name}</td>
                                        <td className="text-left">
                                            <span className="inline-block w-2/3 text-right p-4">{prod.price.toLocaleString()}</span>
                                            VND
                                        </td>
                                        <td>
                                            <div className="bg-white flex rounded-sm text-center m-auto">
                                                <span className="inline-block w-full text-center">{prod.quantity}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div className="bg-white flex rounded-sm text-center m-auto">
                                                <span className="inline-block w-full text-center">{prod.buy_count}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div className="bg-white flex rounded-sm text-center m-auto">
                                                <span className="inline-block w-full text-center">{prod.status}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div className="flex justify-center items-center">
                                                <button onClick={() => window.location.href= `/admin/edit-product/${prod.id}`} className="bg-green-600 px-4 rounded-md font-bold text-white uppercase">
                                                    Sửa
                                                </button>
                                                <div className="w-2"></div>
                                                <div className="bg-red-600 px-4 rounded-md font-bold text-white uppercase " onClick={() => handleDeleteProduct(prod.id)} >
                                                    Xóa
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </>

                            );
                        })}

                    </tbody>
                </table>

                <div className="h-10">

                </div>

                <div className="flex justify-end mr-20">
                    {/* <Pagination /> */}
                    {Array.from({ length: page }, (_, i) => (
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

                <div className="h-10">

                </div>


                <div>
                    <Footer />
                </div>
            </main>


        </>
    )

}