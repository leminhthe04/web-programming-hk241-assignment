<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>

    <?php 
        include 'Header.php';
    ?>

    <main class="flex justify-center items-center h-screen">
        <div class="flex w-full">
            <div class="w-7/12 p-4 flex items-center justify-center">
                <img src="https://static.vecteezy.com/system/resources/previews/005/879/539/original/cloud-computing-modern-flat-concept-for-web-banner-design-man-enters-password-and-login-to-access-cloud-storage-for-uploading-and-processing-files-illustration-with-isolated-people-scene-free-vector.jpg" alt="" class="w-3/4">

            </div>

            <div class="w-5/12 p-4 flex justify-center items-center">
                <div class="w-full">
                    <h1 class="text-3xl font-bold text-left mb-6">Đăng nhập</h1>


                    <form action="#" method="POST">

                        <div class="mb-4">
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="mt-1 p-2  w-4/5 border-b border-black hover:bg-blue-100"
                                placeholder="Email" />
                        </div>

                        <div class="mb-4">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="mt-1 p-2 w-4/5 border-b border-black"
                                placeholder="Mật khẩu" />
                        </div>

                        <div class="flex items-center">
                            <button
                                type="button"
                                class="p-6 bg-red-600 text-white py-2 rounded-lg  hover:bg-red-700">
                                Đăng nhập
                            </button>
                            <div class="mt-4 text-center ml-20 ">
                                <a href="#" class=" text-red-500 hover:text-red-700 text-md">Quên mật khẩu ?</a>
                            </div>


                        </div>

                        <div class="block my-4 space-x-4">
                            <span>Bạn chưa có tài khoản?</span>
                            <span class="border-b border-black p-1">
                                Đăng ký
                            </span>
                        </div>

    </main>
</body>

</html>