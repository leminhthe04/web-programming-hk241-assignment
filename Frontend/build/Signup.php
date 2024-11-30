<<<<<<< HEAD:Frontend/build/Signup.php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/output.css">
</head>

<body>

    <div class="">

        <div class="flex w-full">
            <div class="w-7/12 p-4 flex items-center justify-center">
                <img src="https://static.vecteezy.com/system/resources/previews/005/879/539/original/cloud-computing-modern-flat-concept-for-web-banner-design-man-enters-password-and-login-to-access-cloud-storage-for-uploading-and-processing-files-illustration-with-isolated-people-scene-free-vector.jpg" alt="" class="w-3/4">

            </div>

            <div class="w-5/12 p-4 flex justify-center items-center">
                <div class="w-full">
                    <h1 class="text-3xl font-bold text-left mt-6 mb-4">Tạo tài khoản</h1>
                    <div class="text-sm mb-6">Vui lòng điền các thông tin sau </div>

                    <form action="#" method="POST">

                        <div class="space-y-6 w-full">

                            <div class="mb- flex items-end w-full">
                                <div class="w-1/2">
                                    <div>Họ</div>
                                    <input
                                        type="text"
                                        id="name"
                                        name="firstName"
                                        class="mt-1 p-2  w-4/5 border-b border-black hover:bg-blue-100 "
                                        placeholder="Huỳnh Bảo" />
                                </div>

                                <div class="w-1/2">
                                    <div>Tên</div>
                                    <input
                                        type="text"
                                        id="name"
                                        name="lastName"
                                        class="mt-1 p-2  w-4/5 border-b border-black hover:bg-blue-100"
                                        placeholder="Ngọc" />
                                </div>

                            </div>
                            <div class="mb-4">
                                <div>Email</div>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="mt-1 p-2  w-4/5 border-b border-black hover:bg-blue-10"
                                    placeholder="ngoc@gmail.com" />

                            </div>

                            <div>
                                <div>Số điện thoại</div>
                                <input
                                    type="number"
                                    id="phone"
                                    name="phone"
                                    class="mt-1 p-2  w-4/5 border-b border-black hover:bg-blue-100"
                                    placeholder="09xxxx" />

                            </div>

                            <div class="mb-4">
                                <div>Mật khẩu</div>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="mt-1 p-2 w-4/5 border-b border-black"
                                    placeholder="****" />
                            </div>

                            <div class="mb-4 flex space-x-2">
                                <div class="pr-4">Giới tính</div>
                                <input type="radio" id="male" value="male" name="gender" />
                                <label htmlFor="male">Nam</label>
                                <input type="radio" id="female" value="female" name="gender" />
                                <label htmlFor="female">Nữ</label>
                                <input type="radio" id="null" value="null" name="gender" />
                                <label htmlFor="null">Khác</label>
                            </div>

                            <div class="dob-container">
                                <div class="flex items-center">
                                    <span class="pr-4">Ngày sinh:</span>
                                    <div class="flex">
                                        <span class="inline-block w-20">
                                            <input
                                                type="number"
                                                min={0}
                                                max={31}
                                                name="day"
                                                value={day}
                                                onChange={handleInputChange}
                                                placeholder="DD"
                                                class="border-b text-center inline-block w-20" />
                                        </span>/
                                        <span class="inline-block w-20">
                                            <input
                                                type="number"
                                                name="month"
                                                value={month}
                                                onChange={handleInputChange}
                                                placeholder="MM"
                                                class="border-b text-center inline-block w-20" />
                                        </span>/
                                        <span class="inline-block w-20">
                                            <input
                                                type="number"
                                                name="year"
                                                value={year}
                                                onChange={handleInputChange}
                                                placeholder="YYYY"
                                                class="border-b text-center inline-block w-20" />
                                        </span>
                                    </div>

                                </div>
                            </div>

                            <div class="role flex space-x-2">
                                <div>Bạn là nhân viên ? </div>
                                <input type="radio" value="admin" name="role" />
                                <label htmlFor="role">Đúng</label>
                                <input type="radio" value="customer" name="role" />
                                <label htmlFor="role">Không</label>
                            </div>
                        </div>


                        <div class="flex items-center mt-6">
                            <button
                                type="button"
                                class="p-6 bg-red-600 text-white py-2 rounded-lg  hover:bg-red-700 w-4/5"
                                onClick={handleSignUp}>
                                Đăng ký tài khoản
                            </button>


                        </div>

                        <div class="block my-6 space-x-4">
                            <span>Tôi đã có tài khoản?</span>
                            <span class="border-b border-black p-1">
                                Đăng nhập
                            </span>
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

=======
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/output.css">
</head>

<body>
    <?php 
        include 'Header.php';
    ?>
    <div class="">

        <div class="flex w-full">
            <div class="w-7/12 p-4 flex items-center justify-center">
                <img src="https://static.vecteezy.com/system/resources/previews/005/879/539/original/cloud-computing-modern-flat-concept-for-web-banner-design-man-enters-password-and-login-to-access-cloud-storage-for-uploading-and-processing-files-illustration-with-isolated-people-scene-free-vector.jpg" alt="" class="w-3/4">

            </div>

            <div class="w-5/12 p-4 flex justify-center items-center">
                <div class="w-full">
                    <h1 class="text-3xl font-bold text-left mt-6 mb-4">Tạo tài khoản</h1>
                    <div class="text-sm mb-6">Vui lòng điền các thông tin sau </div>

                    <form action="#" method="POST">

                        <div class="space-y-6 w-full">

                            <div class="w-full">
                                <div>Họ tên</div>
                                <input
                                    type="text"
                                    id="name"
                                    name="firstName"
                                    class="mt-1 p-2  w-4/5 border-b border-black hover:bg-blue-100 "
                                    placeholder="Huỳnh Bảo" />
                            </div>
                            <div class="mb-4">
                                <div>Email</div>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="mt-1 p-2  w-4/5 border-b border-black hover:bg-blue-10"
                                    placeholder="ngoc@gmail.com" />

                            </div>

                            <div>
                                <div>Số điện thoại</div>
                                <input
                                    type="number"
                                    id="phone"
                                    name="phone"
                                    class="mt-1 p-2  w-4/5 border-b border-black hover:bg-blue-100"
                                    placeholder="09xxxx" />

                            </div>

                            <div class="mb-4">
                                <div>Mật khẩu</div>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="mt-1 p-2 w-4/5 border-b border-black"
                                    placeholder="****" />
                            </div>

                            <div class="mb-4 flex space-x-2">
                                <div class="pr-4">Giới tính</div>
                                <input type="radio" id="male" value="male" name="gender" />
                                <label htmlFor="male">Nam</label>
                                <input type="radio" id="female" value="female" name="gender" />
                                <label htmlFor="female">Nữ</label>
                                <input type="radio" id="null" value="null" name="gender" />
                                <label htmlFor="null">Khác</label>
                            </div>

                            <div class="dob-container">
                                <div class="flex items-center">
                                    <span class="pr-4">Ngày sinh:</span>
                                    <div class="flex">
                                        <span class="inline-block w-20">
                                            <input
                                                type="number"
                                                min={0}
                                                max={31}
                                                name="day"
                                                value={day}
                                                onChange={handleInputChange}
                                                placeholder="DD"
                                                class="border-b text-center inline-block w-20" />
                                        </span>/
                                        <span class="inline-block w-20">
                                            <input
                                                type="number"
                                                name="month"
                                                value={month}
                                                onChange={handleInputChange}
                                                placeholder="MM"
                                                class="border-b text-center inline-block w-20" />
                                        </span>/
                                        <span class="inline-block w-20">
                                            <input
                                                type="number"
                                                name="year"
                                                value={year}
                                                onChange={handleInputChange}
                                                placeholder="YYYY"
                                                class="border-b text-center inline-block w-20" />
                                        </span>
                                    </div>

                                </div>
                            </div>

                            <div class="role flex space-x-2">
                                <div>Bạn là nhân viên ? </div>
                                <input type="radio" value="admin" name="role" />
                                <label htmlFor="role">Đúng</label>
                                <input type="radio" value="customer" name="role" />
                                <label htmlFor="role">Không</label>
                            </div>
                        </div>


                        <div class="flex items-center mt-6">
                            <button
                                type="button"
                                class="p-6 bg-red-600 text-white py-2 rounded-lg  hover:bg-red-700 w-4/5"
                                onClick={handleSignUp}>
                                Đăng ký tài khoản
                            </button>


                        </div>

                        <div class="block my-6 space-x-4">
                            <span>Tôi đã có tài khoản?</span>
                            <span class="border-b border-black p-1">
                                Đăng nhập
                            </span>
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

<?php
include 'Footer.php';
?>

>>>>>>> main:Front-end/build/Signup.php
</html>