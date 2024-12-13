
import { useState, useEffect } from "react";
import Header from "../components/Header";
import axios from "axios";
import { useNavigate, useRevalidator } from "react-router-dom";

export default function UsersManagement() {
    const navigate = useNavigate();
    const [userList, setUserList] = useState([]);   
    const [page, setTotalPage] = useState(null);
    const [currentPage, setCurrentPage] = useState(0);

    useEffect(() => {
        axios.get(`http://localhost/Assignment/Backend/api/user/fetch/0/10`,)
        .then((response) => {
            console.log(response.data.data);
            const resData = response.data.data;
            setUserList(resData.data);
            setCurrentPage(0);
            setTotalPage(resData.page_count);   
        })
        .catch((error) => {
            if (error.response) {
                alert(error.response.data.msg);
            } else {
                console.error('Error:', error.message);
            }
        })
    }, [])


    function handlePageClick(pageNum) {
        const index = Number(pageNum);
        const offset = index * 10;
        axios.get(`http://localhost/Assignment/Backend/api/user/fetch/${offset}/10`,)
        .then((response) => {
            console.log(response.data.data);
            const resData = response.data.data;
            setUserList(resData.data);
            setCurrentPage(0);
            setTotalPage(resData.page_count);   
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
        <div className="flex flex-col min-h-screen w-full">
            <Header />
            <div className="h-10"></div>
            <main className="flex-grow bg-purple-2 w-full">
                <div className="m-4 pl-20">
                    <span className="text-gray-600">Shop / </span>
                    <span className="font-medium">User Management</span>
                </div>

                <div className="bg-white w-10/12 min-h-96 m-auto mt-10 rounded-3xl">
                    <div className="font-bold text-lg px-6 pt-6">Tất cả người bán</div>


                    <div className="w-10/12 m-auto mt-6" style={{ height: "500px" }} >
                        <table className="border-none w-full" >
                            <thead>
                                <tr className="w-full h-6 font-bold text-base">
                                    <td className="w-1/6 text-center ">STT</td>
                                    <td className="w-1/6 ">Tên người bán</td>
                                    <td className="w-1/6 ">Số điện thoại</td>
                                    <td className="w-1/6 px-2 ">Email</td>
                                    <td className="w-1/6 ">Vai trò</td>
                                    <td className="w-1/6">Thông tin</td>

                                </tr>
                                <tr className="h-2 border-b border-zinc-300 my-10"></tr>

                            </thead>
                            <tbody>

                                {userList.length > 0 && userList.map((user, index) => (
                                    <>
                                    <tr className="h-2"></tr>
                                    <tr className="w-full h-6  text-base" >
                                        <td className="w-1/6 text-center ">{index + 1}</td>
                                        <td className="w-1/6 ">{user.name}</td>
                                        <td className="w-1/6 ">{user.phone}</td>
                                        <td className="w-1/6 px-2 ">{user.email}</td>
                                        <td className="w-1/6 ">{user.role}</td>
                                        <td className="w-1/6">
                                            <button className="bg-green-700 text-white px-4 py-1 rounded-sm"
                                                onClick={() => {navigate(`/admin/history/${user.id}`)}}
                                            >Chi tiết</button>    
                                        </td>

                                    </tr>
                                    </>
                                   
                                ))}
                            </tbody>
                        </table>


                    </div>
                    <div className="h-16 flex flex-end justify-end items-end">
                        <div className="mb-4 mr-10">
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
                        </div>
                    </div>
                </div>




                <div className="h-20">

                </div>
            </main >

            <div className="h-10"></div>
        </div >
    )

}