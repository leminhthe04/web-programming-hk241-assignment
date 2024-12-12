import { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import Header from "../components/Header";
import Footer from "../components/Footer";
import axios from "axios";
import DayPick from "../components/DayPick.jsx";

export default function Login() {
  const navigate = useNavigate();
  const [errors, setErrors] = useState([]);
  const [mode, setMode] = useState("login");
  const [email, setEmail] = useState("");
  const [pass, setPass] = useState("");
  const [name, setName] = useState(null);
  const [address, setAddress] = useState(null);
  // const [fname, setFname] = useState("");
  // const [lname, setLname] = useState("");
  const [phone, setPhone] = useState(null);
  const [gender, setGender] = useState('M');
  const [role, setRole] = useState("customer");
  const [dateOfBirth, setDateOfBirth] = useState({
    day: "",
    month: "",
    year: "",
  });

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setDateOfBirth({
      ...dateOfBirth,
      [name]: value,
    });
  };

  const { day, month, year } = dateOfBirth;


  async function handleLogin(e) {
    axios.post("http://localhost/Assignment/Backend/api/user/login", {
        email: email,
        password: pass
      })
      .then((response) => {
        console.log(response);
        if (response.status == 200) {
          const token = response.data.data.token;
          const userType = response.data.data.userType;
          console.log(response, "token: ", token);
          localStorage.setItem("token", token);
          localStorage.setItem("role", userType);
          if(userType == "customer") navigate("/customer/homepage")
          else navigate("/admin/product-manage")
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

  async function handleSignUp(e) {
    const newUserData = {
      name: name,
      sex: gender,
      email: email,
      password: pass,
      address: address,
      phone: phone,
      avt_url: "null.png"
    }

    console.log(newUserData);
    axios.post("http://localhost/Assignment/Backend/api/user/signup", JSON.stringify(newUserData))
      .then((response) => {
        if (response.status == 201) {
          alert("Create account success");
          navigate("/")
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

  if (mode == "login") {
    return (
      <div className="flex flex-col min-h-screen">
        <Header role="customer" />

        <div className="flex-grow flex">
          <div className="w-6/12 p-4 flex items-center justify-center">
            <img src="./login.png" alt="login-img" className="w-3/4" />
          </div>

          <div className="w-5/12 p-4 flex justify-center items-center">
            <div className="w-full">
              <h1 className="text-3xl font-bold text-left mb-6" >Đăng nhập</h1>


              <form action="#" method="POST">

                <div className="mb-4">
                  <input
                    type="email"
                    id="email"
                    name="email"
                    className={`mt-1 p-2  w-4/5 border-b border-black hover:bg-blue-100 ${email != "" ? 'bg-blue-100' : null}`}
                    placeholder="Email"
                    onChange={(e) => setEmail(e.target.value)}
                  />
                </div>

                <div className="mb-4">
                  <input
                    type="password"
                    id="password"
                    name="password"
                    className={`mt-1 p-2 w-4/5 border-b border-black hover:bg-blue-100 ${pass != "" ? "bg-blue-100" : null}`}
                    placeholder="Mật khẩu"
                    onChange={(e) => setPass(e.target.value)}
                  />
                </div>

                <div className="flex items-center">
                  <button
                    type="button"
                    className="p-6 bg-red-600 text-white py-2 rounded-lg  hover:bg-red-700"
                    onClick={handleLogin}
                  >
                    Đăng nhập
                  </button>
                  <div className="mt-4 text-center ml-20 ">
                    <a href="#" className=" text-red-500 hover:text-red-700 text-md">Quên mật khẩu ?</a>
                  </div>


                </div>

                <div className="block my-4 space-x-4">
                  <span>Bạn chưa có tài khoản?</span>
                  <span className="border-b border-black p-1" onClick={() => setMode((prev) => {
                    if (prev == "login") "signup"
                    else "login"
                  })}>
                    Đăng ký
                  </span>
                </div>

                {/* <div className="block my-4 space-x-4">
                  <span>Bạn là chủ shop?</span>
                  <span className="border-b border-black p-1">Kênh người bán</span>
                </div> */}
              </form>

            </div>
          </div>
        </div>

        <Footer />
      </div>
    )
  }
  else {
    return (

      <div className="">
        <Header role="customer" />

        <div className="flex w-full">
          <div className="w-6/12 p-4 flex items-center justify-center">
            <img src="./login.png" alt="login-img" className="w-3/4" />
          </div>

          <div className="w-5/12 p-4 flex justify-center items-center">
            <div className="w-full">
              <h1 className="text-3xl font-bold text-left mt-6 mb-4">Tạo tài khoản</h1>
              <div className="text-sm mb-6">Vui lòng điền các thông tin sau </div>

              <form action="#" method="POST">

                <div className="space-y-6 w-full">

                  <div className="items-end w-full">
                      <div>Họ và tên</div>
                      <input
                        type="text"
                        id="name"
                        name="firstName"
                        className={`outline-none mt-1 p-2  w-4/5 border-b border-black hover:bg-blue-100 ${name != "" ? 'bg-blue-100' : null}`}
                        placeholder="Huỳnh Bảo "
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                      />
                  </div>
                  <div className="mb-4">
                    <div>Email</div>
                    <input
                      type="email"
                      id="email"
                      name="email"
                      className={`mt-1 p-2  w-4/5 border-b border-black hover:bg-blue-100 ${email !== "" ? 'bg-blue-100' : null}`}
                      placeholder="ngoc@gmail.com"
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                    />

                  </div>

                  <div>
                    <div>Số điện thoại</div>
                    <input
                      type="text"
                      id="phone"
                      name="phone"
                      className={`mt-1 p-2  w-4/5 border-b border-black hover:bg-blue-100 ${phone != "" ? 'bg-blue-100' : null}`}
                      placeholder="09xxxx"
                      value={phone}
                      onChange={(e) => setPhone(e.target.value)}
                    />

                  </div>


                  <div className="mb-4">
                    <div>Địa chỉ</div>
                    <input
                      type="text"
                      id="address"
                      name="address"
                      className={`mt-1 p-2 w-4/5 border-b border-black  ${pass != "" ? "bg-blue-100" : null}`}
                      placeholder="100 Ly Thuong Kiet, Quan 10, TPHCM"
                      value={address}
                      onChange={(e) => setAddress(e.target.value)}
                    />
                  </div>

                  <div className="mb-4">
                    <div>Mật khẩu</div>
                    <input
                      type="password"
                      id="password"
                      name="password"
                      className={`mt-1 p-2 w-4/5 border-b border-black  ${pass != "" ? "bg-blue-100" : null}`}
                      placeholder="****"
                      value={pass}
                      onChange={(e) => setPass(e.target.value)}
                    />
                  </div>

                  <div className="mb-4 flex space-x-2">
                    <div className="pr-4">Giới tính</div>
                    <input type="radio" id="male" value="M" name="gender" onClick={() => {setGender("M")}} />
                    <label htmlFor="male">Nam</label>
                    <input type="radio" id="female" value="F" name="gender" onClick={() => {setGender("F")}} />
                    <label htmlFor="female">Nữ</label>
                  </div>


                  
                </div>


                <div className="flex items-center mt-6">
                  <button
                    type="button"
                    className="p-6 bg-red-600 text-white py-2 rounded-lg  hover:bg-red-700 w-4/5"
                    onClick={handleSignUp}
                  >
                    Đăng ký tài khoản
                  </button>


                </div>

                <div className="block my-6 space-x-4">
                  <span>Tôi đã có tài khoản?</span>
                  <span className="border-b border-black p-1" onClick={() => setMode("login")}>
                    Đăng nhập
                  </span>
                </div>


              </form>

            </div>
          </div>
        </div>

        <Footer />
      </div>
    )
  }
}
