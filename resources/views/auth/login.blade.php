<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Poultry Bazar</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/DataTables-1.13.8/css/jquery.dataTables.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <style>
        /* Keyframes for fade and slide animations */
        .hidden {
            display: none;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        #welcomeDiv {
            /* By default, apply fadeIn when the element loads */
            animation: fadeIn 1s ease-in-out forwards;
        }

        @keyframes moveLeftRight {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }

            50% {
                transform: translateX(10%);
            }

            100% {
                transform: translateX(0%);
                opacity: 1;
            }
        }

        .animate-moveLeftRight {
            animation: moveLeftRight 1.5s ease-in-out;
            animation-delay: 0.5s;
            /* Delay before the animation starts */
        }

        @keyframes slideIn {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slideIn {
            animation: slideIn 1.2s ease-out;
            animation-delay: 0s;
            /* Form slides in after half a second */
            animation-fill-mode: forwards;
            /* Keeps the final state after animation */
        }

        @keyframes slideOut {
            0% {
                transform: translateX(100%);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slideout {
            animation: slideOut 1.1s ease-in;
            animation-delay: 0s;
            /* Form slides in after half a second */
            animation-fill-mode: forwards;
        }

        /* Use this class to trigger the fade-out animation */
    </style>


    <div class="relative w-full h-full">
        <div class="p-5 w-5xl xl:px-5 xl:p-0">
            <div>
                <div class="absolute z-20 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    <img id="henImage" class="xl:w-[360px] object-contain lg:w-[23vw]"
                        style="transform: rotateY(360deg)" src="{{ asset('assets/hen-avatar-withbg.png') }}"
                        alt="hen">
                </div>
                <div class="absolute z-10 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    <div style="box-shadow: 0px 0px 179px 300px #FCB276A0;"></div>
                </div>
            </div>
            <div id="mainContent"
                class="flex flex-col-reverse lg:flex-row items-center lg:justify-between h-[100vh] mx-[10px] lg:mx-[100px] xl:mx-auto z-50 relative transition-all duration-700 max-w-[1450px]">
                <div id="loginDiv"
                    class="max-w-[480px] my-2 p-12 animate-slideout px-8 flex flex-col justify-center pt-10 items-center h-full xl:h-auto w-full rounded-2xl transition-all duration-700 ease-in-out"
                    style="box-shadow: 0px 0px 8px 0px #00000026; background:rgba(255, 255, 255, 0.389)">
                    <div class="w-full " id="loginContainer">
                        <div>
                            <h1 class="text-customBlackColor font-bold text-[44px] text-center">Log in</h1>
                        </div>
                        <form id="loginForm" action="">
                            @csrf
                            {{-- <form id="animatedForm" action=""> --}}
                            <div class="mt-20">
                                <div>
                                    <label for="email" class="block text-sm text-customGrayColorDark">Email</label>
                                    <input type="email" id="email" required
                                        class="w-full mt-1 bg-white border border-gray-400 rounded-2xl placeholder:text-customGrayColorDark placeholder:text-sm focus:border-customOrangeDark focus:outline-none"
                                        placeholder="Enter your email" name="email">
                                </div>
                                <div class="relative mt-5">
                                    <label for="password"
                                        class="block text-sm text-customGrayColorDark">Password</label>
                                    <div class="relative mt-1">
                                        <input type="password" id="password" required
                                            class="w-full pr-12 bg-white border border-customGrayColorDark rounded-2xl placeholder:text-customGrayColorDark placeholder:text-sm focus:border-customOrangeDark focus:outline-none"
                                            placeholder="Enter your password" name="password">
                                        <span class="absolute inset-y-0 flex items-center cursor-pointer right-4"
                                            id="togglePassword">
                                            <i class="fa-solid fa-eye-slash text-customGrayColorDark"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="flex justify-end">

                                    <button type="button" class="mt-5 text-xs text-right text-customOrangeDark"
                                        id="showForgot">Forgot password?</button>
                                </div>

                                <button type="submit" id="loginbutton"
                                    class="w-full mt-8 text-lg text-white rounded-full gradient-bg font-semi-bold h-14">
                                    <div class="hidden text-center " id="spinner">
                                        <svg aria-hidden="true"
                                            class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-white"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                    </div>
                                    <div class="" id="text">
                                        Login
                                    </div>
                                </button>
                                <h2
                                    class="absolute bottom-1 left-1/2 -translate-x-1/2 text-sm text-customGrayColorDark">
                                    Version 1.0.1</h2>
                            </div>
                        </form>
                    </div>


                    <div class="w-full hidden" id="ForgotContainer">
                        <div>
                            <h1 class="text-customBlackColor font-bold text-[44px] text-center">Forgot Password</h1>
                        </div>
                        <form id="forgotForm" action="">
                            @csrf
                            {{-- <form id="animatedForm" action=""> --}}
                            <div class="mt-10">
                                <div>
                                    <label for="Femail" class="block text-sm text-center">Enter your Email to receive
                                        password reset link.</label>
                                    <input type="email" id="Femail" required
                                        class="w-full mt-3 bg-white border border-gray-400 rounded-2xl placeholder:text-customGrayColorDark placeholder:text-sm focus:border-customOrangeDark focus:outline-none"
                                        placeholder="Enter your email" name="email">
                                </div>


                                <div class="flex justify-center items-center mt-4 gap-1">
                                    <span>Remember your password?</span>
                                    <button type="button" class=" text-customOrangeDark" id="showLogin">Login
                                        In</button>
                                </div>

                                <button type="submit" id="forgotbutton"
                                    class="w-full mt-8 text-lg text-white rounded-full gradient-bg font-semi-bold h-14">
                                    <div class="hidden text-center " id="Fspinner">
                                        <svg aria-hidden="true"
                                            class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-white"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                    </div>
                                    <div class="" id="Ftext">
                                        Continue
                                    </div>
                                </button>
                                <h2
                                    class="absolute bottom-1 left-1/2 -translate-x-1/2 text-sm text-customGrayColorDark">
                                    Version 1.0.1</h2>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Welcome Section -->
                <div id="welcomeDiv"
                    class="flex flex-col lg:justify-center  items-center h-full w-full relative z-40 max-w-[530px] transition-all duration-700 ease-in-out">
                    <div>
                        <h2 class="text-[55px] text-customOrangeDark font-bold leading-none">
                            <span class="text-[45px]">Welcome to</span><br> Poultry Bazar
                        </h2>
                        <p class="flex justify-start mt-4 font-normal text-black text-custom16">
                            Start your new journey with us and join <br> our community
                        </p>
                    </div>
                    <button id="switchToLoginBtn" type="button"
                        class="w-1/2 mt-10 text-lg font-semibold text-white rounded-full  lg:w-[70%] lg:mt-10 gradient-bg h-14">
                        Get Access
                    </button>
                </div>
            </div>
            <div id="signupSection"
                class="flex flex-col justify-center lg:flex-row items-center lg:justify-between min-h-[100vh]    mx-[50px] lg:mx-[100px]  z-20 relative hidden max-w-[1500px] xl:mx-auto ">
                <div class="flex flex-col justify-center items-center h-full w-full relative z-40 max-w-[480px]">
                    <div id="welcomeDiv" class="flex flex-col  justify-start">
                        <h2 class="text-[50px] text-customOrangeDark font-bold leading-none">
                            <span class="text-[40px]">Join Us at</span><br> Poultry Bazar
                        </h2>
                        <p class="flex justify-start mt-4 font-normal text-black text-custom16">
                            Become a member and start your journey with <br> Poultry Bazar
                        </p>
                        <button id="backToLoginBtn" type="button"
                            class="w-1/2 mt-10 text-lg font-semibold text-white rounded-full lg:w-full lg:mt-10 gradient-bg h-14">Login</button>
                    </div>
                </div>
                <!-- Signup Form Section (Initially hidden) -->
                <form id="registerForm" method="POST"
                    class="max-w-[480px] animate-slideIn px-8 lg:py-0 py-4 my-2 flex flex-col justify-center items-center h-auto  w-[100%] rounded-2xl transition-all duration-700 ease-in-out"
                    style="box-shadow: 0px 0px 8px 0px #00000026; background:rgba(255, 255, 255, 0.389)">
                    @csrf
                    <div id="signupForm" class="w-full h-full m-5 ">
                        <h1 class="text-customBlackColor font-bold text-[44px] text-center mt-5">Get Access
                        </h1>
                        <div class="mt-10">
                            <div>
                                <label for="fullName" class="block mt-5 text-sm text-customGrayColorDark">Full
                                    Name</label>
                                <input type="text" id="fullName" name="fullName" required
                                    class="w-full mt-1 bg-white border border-gray-400 requiredFields rounded-2xl placeholder:text-customGrayColorDark placeholder:text-sm focus:border-customOrangeDark focus:outline-none"
                                    placeholder="Enter Full Name">
                            </div>
                            <div class="mt-4">
                                <label for="email" class="block text-sm text-customGrayColorDark">Email</label>
                                <input type="email" id="regEmail" name="email" required
                                    class="w-full mt-1 bg-white border border-gray-400 requiredFields rounded-2xl placeholder:text-customGrayColorDark placeholder:text-sm focus:border-customOrangeDark focus:outline-none"
                                    placeholder="Enter your email">
                            </div>
                            <div class="mt-4">
                                <label for="phone" class="block text-sm text-customGrayColorDark">Phone</label>
                                <input type="text" id="regPhone" name="phone" required
                                    class="w-full mt-1 bg-white border requiredFields border-customGrayColorDark rounded-2xl placeholder:text-customGrayColorDark placeholder:text-sm focus:border-customOrangeDark focus:outline-none"
                                    placeholder="Enter phone No">
                            </div>
                            <div class="relative mt-4">
                                <label for="password" class="block text-sm text-customGrayColorDark">Password</label>
                                <input type="password" id="regPassword" name="password" required
                                    class="w-full mt-1 bg-white border requiredFields border-customGrayColorDark rounded-2xl placeholder:text-customGrayColorDark placeholder:text-sm focus:border-customOrangeDark focus:outline-none"
                                    placeholder="Enter your password">
                                <span class="absolute inset-y-0 flex items-center cursor-pointer right-4 top-6"
                                    id="togglePasswordRegister">
                                    <i class="fa-solid fa-eye-slash text-customGrayColorDark"></i>
                                </span>
                            </div>
                            <button id="nextBtn" type="button"
                                class="w-full mt-8 text-lg text-white rounded-full gradient-bg font-semi-bold h-14">Next</button>
                        </div>

                    </div>
                    <div id="extraSection" class="flex flex-col hidden w-full h-full py-8 mx-auto">
                        <h2 class="mb-6 text-4xl font-bold text-center">Select Panel</h2>
                        <div
                            class="relative z-10 grid grid-cols-1 gap-4 mb-8 text-center sm:grid-cols-2 max-h-[460px] overflow-y-auto">

                            <!-- Market Box 1 -->

                            @foreach ($modules as $module)
                                <div class="relative">
                                    <input type="checkbox" name="module_id[]" value="{{ $module->module_id }}"
                                        id="market-{{ $module->module_id }}"
                                        class="absolute w-6 h-6 transition-all border-2 border-gray-300 rounded-full top-4 right-4 peer checked:text-customOrangeDark checked:bg-customOrangeDark">
                                    <label for="market-{{ $module->module_id }}"
                                        class="block h-auto p-4 transition-all bg-white border-2 border-gray-200 cursor-pointer rounded-xl peer-checked:bg-orange-100 peer-checked:border-orange-300">
                                        <img class="w-[88px] h-[88px] rounded-full object-contain bg-black z-0"
                                            src="{{ $module->module_image }}" alt="Market icon">
                                        <h3 class="mt-2 text-lg font-semibold text-customGrayColorDark">
                                            {{ $module->module_name }}</h3>
                                        <button type="button" data-modal-target="modal"" data-modal-toggle="modal"
                                            data-modal-text="{{ $module->module_description }}"
                                            data-modal-image="{{ $module->module_image }}"
                                            class="w-full h-10 mt-4 text-sm transition-colors bg-white border-2 rounded-full text-customOrangeDark peer-checked:text-customOrangeDark hover:text-orange-600">
                                            View info
                                        </button>
                                    </label>
                                    {{-- <div
                                        class="z-0 absolute w-6 h-6 transition-all border-2 border-gray-300 rounded-full top-4 right-4 peer-checked:border-customOrangeDark peer-checked:bg-customOrangeDark">
                                    </div> --}}
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" id="submitBtn"
                            class="block w-full py-3 text-lg font-semibold text-white transition duration-300 rounded-full gradient-bg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50">
                            <div class="hidden text-center " id="Sspinner">
                                <svg aria-hidden="true"
                                    class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-white"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                            </div>
                            <div class="" id="Stext">
                                Get Access
                            </div>
                        </button>
                        <button data-modal-target="signup-Modal" data-modal-toggle="signup-Modal"
                            class="hidden"></button>
                    </div>


                    <div id="formSuccess" class=" w-full flex flex-col justify-center hidden h-[480px]">
                        <h2 class="text-3xl font-bold text-center">Get Access</h2>
                        <div class="flex justify-center space-y-2 md:p-5">
                            <img class="h-[100%] " src="{{ asset('assets/modal-success-icon.png') }}"
                                alt="success-icon">
                        </div>
                        <h2 class="text-2xl font-bold text-center">
                            Your request has been sent <br>
                            <span>wait for confirmation.</span>
                        </h2>
                        <h1 class="mt-10 text-center text-1xl text-customGrayColorDark">
                            Or <br>
                            <span class="">
                                Call Us (+92 300 1234567)
                            </span>
                        </h1>
                    </div>
                </form>
            </div>
        </div>

    </div>


    <!-- Modal -->
    <div id="modal"
        class="fixed inset-0 z-50 flex items-center justify-center hidden overflow-x-hidden overflow-y-auto outline-none focus:outline-none">
        <div class="relative w-auto max-w-lg mx-auto my-4">
            <!-- Modal content -->
            <div
                class="relative flex flex-col w-full md:min-w-[600px] bg-white h-[100%] rounded-[40px] shadow-lg outline-none modal-content focus:outline-none">
                <!-- Icon at the top -->
                <div class="absolute transform -translate-x-1/2 -top-20 left-1/2">
                    <div>
                        <img class="object-contain bg-black rounded-full w-36 h-36"
                            src="{{ asset('assets/icons/Group 44.png') }}" alt="icon">
                    </div>
                </div>
                <div class="flex flex-col items-center mt-3">
                    <!-- Modal header -->
                    <div class="pt-16 ">
                        <h3 class="text-3xl font-extrabold"></h3>
                    </div>
                    <!-- Modal body -->
                    <div class="relative px-10 mt-4 mb-5">
                        <p class="text-xl leading-relaxed text-justify text-gray-400"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalOverlay" class="fixed inset-0 z-[52] hidden bg-black opacity-75"></div>

    <!-- Main modal -->
    <div id="signup-Modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 transition-opacity">
            <div id="backdrop" class="absolute inset-0 opacity-75 bg-slate-800"></div>
        </div>
        <div class="relative w-full max-w-2xl max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white h-[450px] mb-24 rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 rounded-t md:p-5 dark:border-gray-600">
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="signup-Modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="flex justify-center space-y-2 md:p-5">
                    <img class="h-[100%] " src="{{ asset('assets/Group 1000006301.png') }}" alt="">
                </div>
                <h1 class="text-2xl font-bold text-center">
                    Plase wait for conformation <br>
                    <span>from the admin</span>
                </h1>
                <h1 class="mt-10 text-center text-1xl text-customGrayColorDark">
                    Or <br>
                    <span class="">
                        Call Us (+92 300 1234567)
                    </span>
                </h1>


            </div>
        </div>
    </div>

    <div class="absolute flex justify-center  w-full  bottom-1 z-50">
        <p class="text-sm text-black">Powered by <span class="text-customOrangeDark">Poul3yBazar</span> &
            Developed by
            <a target="_blank" class="text-blue-500" href="https://thewebconcept.com/">TheWebConcept</a>.
        </p>
    </div>


    <script src="{{ asset('javascript/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('javascript/canvas.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/DataTables-1.13.8/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('javascript/script.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>


    <script>
        document.querySelectorAll('[data-modal-target="modal"]').forEach(button => {
            button.addEventListener('click', function() {
                // Get the modal content element
                const modal = document.getElementById('modal');

                // Get the data attributes for the modal content
                const modalText = this.getAttribute('data-modal-text');
                const modalImage = this.getAttribute('data-modal-image');

                // Update the modal content
                modal.querySelector('.modal-content p').textContent = modalText;
                modal.querySelector('.modal-content img').src = modalImage;

                // Show the modal
                modal.classList.remove('hidden');
            });
        });

        // Close the modal when clicking outside of it or on close button (if any)
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('modal');
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#togglePasswordRegister').on('click', function() {
                const passwordField = $('#regPassword');
                const icon = $(this).find('i');

                // Toggle password visibility
                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye'); // Change to "eye" icon
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash'); // Change back to "eye-slash" icon
                }

            });
            $('#showForgot').click(function() {
                $('#ForgotContainer').removeClass('hidden')
                $('#loginContainer').addClass('hidden')

            });
            $('#showLogin').click(function() {
                $('#ForgotContainer').addClass('hidden')
                $('#loginContainer').removeClass('hidden')

            });

            $("#loginForm").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                // Send the AJAX request
                $.ajax({
                    type: "POST",
                    url: "/Login",
                    data: formData,
                    dataType: "json",
                    beforeSend: function() {
                        $('#spinner').removeClass('hidden');
                        $('#text').addClass('hidden');
                        $('#loginbutton').attr('disabled', true);
                    },
                    success: function(response) {
                        // Handle the success response here
                        if (response.success == true) {
                            $('#text').removeClass('hidden');
                            $('#spinner').addClass('hidden');

                            window.location.href = '../dashboard';

                        } else if (response.success == false) {
                        
                            Swal.fire({
                            position: "center",
                            icon: "warning",
                            title: "Error",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000,
                        });

                        }
                    },
                    error: function(jqXHR) {

                        let response = JSON.parse(jqXHR.responseText);

                 
                        Swal.fire({
                            position: "center",
                            icon: "warning",
                            title: "Error",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000,
                        });

                        $('#text').removeClass('hidden');
                        $('#spinner').addClass('hidden');
                        $('#loginbutton').attr('disabled', false);
                    }
                });
            });


            $("#registerForm").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                // Send the AJAX request
                $.ajax({
                    type: "POST",
                    url: "/register",
                    data: formData,
                    dataType: "json",
                    beforeSend: function() {
                        $('#Sspinner').removeClass('hidden');
                        $('#Stext').addClass('hidden');
                        $('#submitBtn').attr('disabled', true);
                    },
                    success: function(response) {
                        // Handle the success response here

                        if (response.success == true) {
                            $('#Stext').removeClass('hidden');
                            $('#Sspinner').addClass('hidden');

                            $('#signupForm').addClass('hidden');
                            $('#extraSection').addClass('hidden');
                            $('#formSuccess').removeClass('hidden');
                            // $('#signup-Modal').removeClass('hidden');
                            // $('#signup-Modal').addClass('flex');
                            // window.location.href = '/';

                        } else if (response.success == false) {
                          
                        Swal.fire({
                            position: "center",
                            icon: "warning",
                            title: "Error",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000,
                        });

                        }
                    },
                    error: function(jqXHR) {

                        let response = JSON.parse(jqXHR.responseText);

                        if (response.message == "Request already sent") {
                            $('#signup-Modal').removeClass('hidden');
                            $('#signup-Modal').addClass('flex');

                        } else {
                           
                        Swal.fire({
                            position: "center",
                            icon: "warning",
                            title: "Error",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000,
                        });



                        }
                        $('#signupForm').removeClass('hidden');
                        $('#extraSection').addClass('hidden');

                        $('#Stext').removeClass('hidden');
                        $('#Sspinner').addClass('hidden');

                        $('#submitBtn').attr('disabled', false);
                    }
                });
            });
            $("#forgotForm").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                // Send the AJAX request
                $.ajax({
                    type: "POST",
                    url: "/forgotPassword",
                    data: formData,
                    dataType: "json",
                    beforeSend: function() {
                        $('#Fspinner').removeClass('hidden');
                        $('#Ftext').addClass('hidden');
                        $('#forgotbutton').attr('disabled', true);
                    },
                    success: function(response) {
                        // Handle the success response here

                        if (response.success == true) {
                            $('#Ftext').removeClass('hidden');
                            $('#Fspinner').addClass('hidden');
                            $('#forgotbutton').attr('disabled', true);
                            $('#Ftext').text("Mail Send!");
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Success",
                                text: response.message,
                            });


                        } else if (response.success == false) {
                            Swal.fire({
                                position: "center",
                                icon: "warning",
                                title: "Error",
                                text: response.message,
                                showConfirmButton: false,
                                timer: 2000,
                            });
                        }
                    },
                    error: function(jqXHR) {

                        let response = JSON.parse(jqXHR.responseText);

                        Swal.fire({
                            position: "center",
                            icon: "warning",
                            title: "Error",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000,
                        });

                        $('#Ftext').removeClass('hidden');
                        $('#Fspinner').addClass('hidden');
                        $('#forgotbutton').attr('disabled', false);
                    }
                });
            });

            const $switchToLoginBtn = $('#switchToLoginBtn');
            const $mainContent = $('#mainContent');
            const $signupSection = $('#signupSection');
            const $henImage = $('#henImage');
            const $welcomeDiv = $('#welcomeDiv');
            const $loginDiv = $('#loginDiv');
            const $backToLoginBtn = $('#backToLoginBtn'); // New button for switching back

            // Switch to Signup Form
            $switchToLoginBtn.on('click', function() {
                $welcomeDiv.toggleClass('order-last');
                $loginDiv.toggleClass('order-first');
                $mainContent.addClass('fadeOut');

                $henImage.css({
                    'transition': 'transform 1s ease',
                    'transform': 'rotateY(180deg)'
                });

                // Transition between login form and signup form
                setTimeout(function() {
                    $mainContent.addClass('hidden'); // Hide the main content
                    $signupSection.removeClass('hidden').addClass(
                        'slideInLeft'); // Show the signup section
                }, 100); // Wait for animation to complete before switching
            });

            // Switch back to Login Form
            $backToLoginBtn.on('click', function() {
                $signupSection.addClass('slideOutRight');

                $henImage.css({
                    'transition': 'transform 1s ease',
                    'transform': 'rotateY(360deg)'
                });

                setTimeout(function() {
                    $signupSection.addClass('hidden');
                    $mainContent.removeClass('hidden fadeOut').addClass(
                        'fadeIn'); // Show the login section
                }, 100);
            });

            // Input focus animation
            $('input').on('focus', function() {
                $(this).addClass('input-slide-in');
            });

            $('input').on('blur', function() {
                $(this).removeClass('input-slide-in').addClass('input-slide-out');
            });

            // Signup form section reveal logic

        });
        $(document).ready(function() {

            $('#nextBtn').click(function() {
                let allFieldsFilled = true;
                $('.requiredFields').each(function() {
                    if ($(this).val().trim() === '') {
                        allFieldsFilled = false;
                    }
                });

                if (allFieldsFilled) {
                    $('#signupForm').addClass('hidden');
                    $('#extraSection').removeClass('hidden');
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "warning",
                        title: "All Fields Required",
                        text: "Please fill data in all required fields.",
                        showConfirmButton: false,
                        timer: 2000,
                        // showConfirmButton: false,
                        // timer: 2000,
                    });
                }



            })
        });
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    </script>
</body>

</html>
