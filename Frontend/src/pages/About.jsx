import Footer from "../components/Footer";
import Header from "../components/Header";

export default function About() {
    return (
        <div className="flex flex-col min-h-screen">
            <Header />

            <div className="breadcums my-5 ml-10">
                <span className="">Trang chủ</span> /
                <span className=" font-bold"> Giới thiệu</span>
            </div>
            <main className=" p-8 bg-gray-100">
                <section className="mb-8  w-10/12 mx-auto">

                    <div className="grid grid-cols-2 mx-auto">
                        <div className="justify-center items-center my-auto ">
                            <h1 className="text-4xl font-bold mb-4">Công ty Exclusive</h1>
                            <p className="text-lg">
                                Vào năm 2024, công ty Exclusive được thành lâp với mục tiêu trở thành công ty hàng đầu
                                trong lĩnh vực thương mại điện tử. Chúng tôi cung cấp các sản phẩm chất lượng cao với giá cả hợp lý. Chúng tôi luôn lắng nghe ý kiến của khách hàng và không ngừng cải thiện dịch vụ của mình.
                                <br />
                                Đến nay, công ty Exclusive tự hào là một trong các đơn vị phân phối hàng đầu ở thị trường trong và ngoài nước. Chúng tôi đã hợp tác với hơn 100+
                                thương hiệu, nhãn hàng, có hơn 200+ sản phẩm để phục vụ
                            </p>
                        </div>
                        <div className="ml-10 w-full">
                            <img src="../vng-campus-scaled.webp" alt="About Us" className="object-cover rounded" />
                        </div>
                    </div>
                </section>

                <section className="mb-8 w-10/12 mx-auto">
                    <h2 className="text-3xl font-semibold mb-4">Đội ngũ</h2>
                    <p className="text-lg">
                        Our team is composed of dedicated professionals who are passionate about what they do. Meet some of our key team members:
                    </p>
                    <div className="grid grid-cols-2 md:grid-cols-2 gap-10 mt-4 justify-center items-center border w-10/12 mx-auto">

                        <div className="bg-white p-4 rounded shadow">
                            <img src="../ourTeam/SauRom.jpg" alt="Team Member" className="w-full h-60 object-cover rounded mb-4" />
                            <h3 className="text-xl font-semibold">Sâu róm</h3>
                            <p className="text-gray-600">Backend developer</p>
                        </div>
                        <div className="bg-white p-4 rounded shadow">
                            <img src="../ourTeam/CuaBien.jpg" alt="Team Member" className="w-full h-60 object-cover rounded mb-4" />
                            <h3 className="text-xl font-semibold">Cua biển</h3>
                            <p className="text-gray-600">Frontend developer</p>
                        </div>
                    </div>
                </section>

                <section className="mb-8">
                    <h2 className="text-3xl font-semibold mb-4">Contact Us</h2>
                    <p className="text-lg">
                        If you have any questions or would like to learn more about our company, please feel free to contact us at:
                    </p>
                    <p className="text-lg mt-2">
                        Email: <a href="mailto:info@company.com" className="text-blue-500">info@company.com</a>
                    </p>
                    <p className="text-lg">
                        Phone: <a href="tel:+1234567890" className="text-blue-500">+1 (234) 567-890</a>
                    </p>
                </section>
            </main>

            <Footer />
        </div>
    )
}