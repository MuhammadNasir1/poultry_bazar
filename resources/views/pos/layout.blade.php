<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', '') - Poultry Bazar</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/DataTables-1.13.8/css/jquery.dataTables.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/default-logo-1.png') }}" type="image/x-icon">
    <style>
        #loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            z-index: 9999;
        }
    </style>
</head>

<body class="">
    <div class=" max-w-[1920px] mx-auto  relative">
        <div class="relative ">
            <div id="loading">
                <div class=" text-center z-[9999] h-screen w-screen flex justify-center items-center  ">
                    <svg aria-hidden="true"
                        class="w-12 h-12 mx-auto text-center text-gray-200 animate-spin fill-customOrangeLight"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                </div>
            </div>

            @include('layouts.navbar')

            <button data-drawer-target="sidebar" data-drawer-toggle="sidebar" aria-controls="sidebar" type="button"
                class="inline-flex items-center py-2 px-4 mt-[100px] pl-4 absolute  text-sm text-gray-500 rounded-lg ms-3 sm:hidden  ">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                    </path>
                </svg>
            </button>
            @php
                $user = session('user_details');
                $privileges = json_decode($user['user_privileges'], true)['permissions'] ?? [];
                // dd($privileges);
                $userRole = session('user_details')['user_role'];
            @endphp
            <aside id="sidebar"
                class="fixed top-0  z-40   w-64 h-[88vh]  transition-transform -translate-x-full  sm:translate-x-0  md:ml-[10px]  sm:mt-[100px]  left-auto   "
                aria-label="Sidebar">
                <div
                    class="h-full px-3 py-4  overflow-y-scroll scrollbar-hide  sidebar-main gradient-border-sidebar rounded-2xl z-20 relative">
                    <ul class="pb-10 space-y-2 font-medium">
                        @if ($userRole === 'superadmin')
                            <li>
                            <li class="relative z-20">
                                <span class="flex items-center py-1 px-4 rounded-md  text-white  gradient-bg   ">
                                    <svg class="h-8 w-8" viewBox="0 0 50 29" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M22.329 7.86882C20.4411 7.86882 18.5525 7.87617 16.6639 7.86514C15.7862 7.86072 15.2594 7.21329 15.4867 6.42827C15.6 6.03098 15.8649 5.75288 16.2924 5.68519C16.5103 5.65292 16.7305 5.63791 16.9508 5.64031C20.4695 5.63688 23.9885 5.63688 27.5077 5.64031C27.8579 5.64031 28.047 5.5454 28.1846 5.18711C28.9858 3.10427 30.4469 1.61149 32.4518 0.681537C33.1625 0.351933 33.9409 0.190073 34.7325 0.0716213C35.5682 -0.0481551 36.4186 -0.0175072 37.2435 0.162116C38.4545 0.414469 39.6288 0.865468 40.5786 1.70051C41.1561 2.20816 41.6432 2.81734 42.1766 3.37576C42.2867 3.47842 42.4035 3.57377 42.526 3.66122C42.6224 3.53541 42.7468 3.42063 42.8115 3.28085C43.1911 2.50834 43.5649 1.73583 43.9269 0.953019C44.1078 0.56235 44.3028 0.228331 44.7597 0.0767719C45.2342 -0.0814086 45.5822 0.064265 45.9045 0.378419C46.2532 0.719059 46.2974 1.14578 46.1127 1.55558C45.6242 2.64886 45.1003 3.7267 44.5875 4.80895C44.4073 5.19005 44.2131 5.5638 44.035 5.94564C43.9438 6.14207 44.0409 6.26935 44.2226 6.35249L48.3478 8.2433C48.9364 8.51405 49.2447 8.93635 49.2057 9.46681C49.163 10.0613 48.6377 10.6984 47.8409 10.4284C47.1008 10.1783 46.3945 9.82216 45.6808 9.49697C44.8892 9.13573 44.1071 8.75169 43.3162 8.38898C43.1006 8.29039 42.93 8.33894 42.8144 8.58762C42.0478 10.2437 41.2643 11.8932 40.4969 13.5486C39.6832 15.3026 38.8849 17.0632 38.0734 18.8179C37.5099 20.0384 36.9478 21.2605 36.3592 22.4692C36.1164 22.9681 35.6743 23.1939 35.1085 23.1932C31.9571 23.1888 28.806 23.1873 25.6552 23.1888C23.3872 23.1888 21.1187 23.1905 18.8497 23.1939C18.1839 23.1939 17.7572 22.9099 17.4732 22.2838C16.7375 20.6653 15.9436 19.0709 15.1925 17.4582C14.3743 15.7035 13.5842 13.9356 12.7704 12.1787C12.2554 11.0692 11.7206 9.97152 11.1975 8.86425C10.6332 7.67238 10.9525 7.87912 9.58403 7.87029C6.86186 7.85337 4.13968 7.85999 1.4175 7.84601C1.15185 7.8418 0.887999 7.80146 0.633223 7.72609C0.165303 7.59292 -0.0487922 6.93004 0.00932991 6.56291C0.0464595 6.33321 0.157619 6.12193 0.32589 5.96123C0.494161 5.80053 0.710328 5.69921 0.941491 5.67268C1.16106 5.64469 1.38231 5.63191 1.60364 5.63443C4.71796 5.63443 7.83227 5.64914 10.9473 5.62928C12.3275 5.62045 12.3084 5.96256 12.7785 6.87265C13.1773 7.64516 13.5099 8.45225 13.8704 9.24462C14.3059 10.2011 14.737 11.1575 15.1763 12.1139C15.3256 12.4594 15.4977 12.7947 15.6913 13.1175C15.7553 13.2197 15.9547 13.2823 16.0937 13.2845C16.9516 13.2985 17.8102 13.2904 18.6687 13.2896C20.8887 13.2896 23.1081 13.2896 25.327 13.2896C26.9206 13.2896 28.0772 12.5649 28.7283 11.117C29.1749 10.1253 29.0616 9.1269 28.5679 8.16237C28.4391 7.91075 28.2493 7.86808 27.9984 7.86808C26.1098 7.87397 24.222 7.86808 22.3334 7.86808L22.329 7.86882ZM16.8515 15.602C16.9391 15.8316 16.9854 15.9816 17.0516 16.1222C17.752 17.5936 18.476 19.0599 19.1425 20.5497C19.2801 20.8565 19.442 20.9176 19.7098 20.9235C19.8694 20.9235 20.0291 20.9235 20.188 20.9235C24.7985 20.9235 29.4091 20.9235 34.0196 20.9235C34.1663 20.9318 34.3133 20.9167 34.4552 20.8786C34.5648 20.8392 34.656 20.7606 34.7112 20.6579C35.2998 19.4072 35.8641 18.1498 36.449 16.8991C37.3399 14.9928 38.2427 13.0917 39.1388 11.1869C39.8009 9.78906 40.4631 8.38456 41.109 6.97786C41.1826 6.81158 41.2525 6.58645 41.2039 6.42386C40.8361 5.19667 40.1666 4.16666 39.1292 3.38826C37.5415 2.19713 35.7633 1.99627 33.924 2.53262C32.3885 2.98362 31.2467 3.99671 30.5176 5.44093C30.0805 6.30835 30.11 6.28922 30.5499 7.14266C30.8192 7.66502 31.0649 8.23521 31.1466 8.80834C31.2687 9.67355 31.2805 10.5542 31.009 11.4231C30.6321 12.6699 29.844 13.7523 28.7732 14.494C27.7432 15.2231 26.5984 15.5174 25.3447 15.5093C22.6961 15.4909 20.0475 15.5027 17.3989 15.5093C17.2223 15.5093 17.0457 15.5674 16.8515 15.602Z"
                                            fill="white" />
                                        <path
                                            d="M22.0312 28.8373C21.1115 28.8999 20.6296 28.1649 20.6428 27.449C20.6568 26.7133 21.1843 26.0511 22.0312 26.0769C22.8522 26.0997 23.4246 26.6456 23.429 27.4674C23.4334 28.2892 22.8669 28.8344 22.0312 28.8373Z"
                                            fill="white" />
                                        <path
                                            d="M31.836 28.836C31.0267 28.925 30.4624 28.0944 30.4882 27.447C30.5161 26.7451 31.0399 26.0278 31.9758 26.0638C32.7034 26.091 33.3001 26.8113 33.2898 27.4948C33.2832 28.1187 32.7248 28.953 31.836 28.836Z"
                                            fill="white" />
                                        <path
                                            d="M35.6772 5.34576C36.4659 5.34208 37.0751 5.95715 37.0839 6.75247C37.0812 7.12536 36.9327 7.4824 36.67 7.74711C36.4074 8.01182 36.0515 8.16317 35.6787 8.16874C34.9768 8.16874 34.3154 7.65373 34.294 6.77086C34.2867 6.5853 34.3172 6.4002 34.3836 6.22678C34.45 6.05335 34.5509 5.89522 34.6803 5.76196C34.8096 5.62871 34.9646 5.52311 35.136 5.45156C35.3074 5.38002 35.4915 5.34403 35.6772 5.34576Z"
                                            fill="white" />
                                    </svg>

                                    <span class="ms-3">Super Dashboard</span>
                                </span>
                                <div class="grid grid-cols-2 gap-2 mt-2 mb-5 bg-white">
                                    <a href="">
                                        <button
                                            class="flex drop-shadow w-full items-center  gap-[.5px] rounded-md py-[2px]">
                                            <img class="h-12 w-12"
                                                src="{{ asset('assets/icons/market updatesvg.svg') }}" alt="Markets">
                                            <h3 class="text-[12px] font-semibold tracking-wider">Markets</h3>
                                        </button>
                                    </a>
                                    <a href="">
                                        <button
                                            class="flex w-full drop-shadow items-center  gap-[.5px] rounded-md py-[2px]  {{ request()->is('pos*') ? 'bg-customOrangeDark text-white' : '' }}">
                                            <img class="h-12 w-12" src="{{ asset('assets/icons/pos.png') }}"
                                                alt="POS">
                                            <h3 class="text-[12px] font-semibold tracking-wider">POS</h3>
                                        </button>
                                    </a>
                                    <a href="">
                                        <button
                                            class="flex w-full drop-shadow items-center bg-gray-200  gap-[.5px] rounded-md py-[2px]">
                                            <img class="h-12 w-12" src="{{ asset('assets/icons/floks.png') }}"
                                                alt="FLOCK">
                                            <h3 class="text-[12px] font-semibold tracking-wider">Flocks</h3>
                                        </button>
                                    </a>
                                    <a href="">
                                        <button
                                            class="flex w-full drop-shadow items-center bg-gray-200 gap-[.5px] rounded-md py-[2px]">
                                            <img class="h-12 w-12" src="{{ asset('assets/icons/e-commerce.png') }}"
                                                alt="E-Commerce">
                                            <h3 class="text-[12px] font-semibold  tracking-widerwhitespace-nowrap">
                                                E-Com...</h3>
                                        </button>
                                    </a>
                                </div>
                            </li>
                            </li>
                        @endif
                     
                  
                            <li class="relative z-20">
                                <a href="../pos/users"
                                    class="flex items-center py-2 px-4 text-gray-900 rounded-full transition duration-200 hover:text-white dark:text-white hover:bg-customOrangeDark dark:hover:bg-gray-700 group {{ request()->is('pos/users') ? 'active gradient-bg text-white' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-black transition duration-75 dark:text-gray-400 group-hover:text-white {{ request()->is('pos/users') ? 'text-white' : '' }}"
                                        viewBox="0 0 448 512" fill="currentColor">
                                        <path
                                            d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z" />
                                    </svg>
                                    <span class="ms-3 ">Users</span>
                                </a>
                            </li>
                            <li class="relative z-20">
                                <a href="../pos/shops"
                                    class="flex items-center py-2 px-4 text-gray-900 rounded-full transition duration-200 hover:text-white dark:text-white hover:bg-customOrangeDark dark:hover:bg-gray-700 group {{ request()->is('pos/shops') ? 'active gradient-bg text-white' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-black transition duration-75 dark:text-gray-400 group-hover:text-white {{ request()->is('pos/shops') ? 'text-white' : '' }}"
                                        viewBox="0 0 448 512" fill="currentColor">
                                        <path
                                            d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z" />
                                    </svg>
                                    <span class="ms-3 ">Shops</span>
                                </a>
                            </li>
                  
                        <li class="relative z-20">
                            <a href="../setting"
                                class="flex items-center py-2 px-4 text-gray-900 transition duration-200 rounded-full hover:text-white dark:text-white hover:bg-customOrangeDark dark:hover:bg-gray-700 group {{ request()->is('setting') ? 'active gradient-bg text-white ' : '' }} ">
                                <svg class="flex-shrink-0  w-7 h-7 text-black transition duration-75 dark:text-gray-400 group-hover:text-white {{ request()->is('setting') ? 'text-white' : '' }}"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 22 22">
                                    <path
                                        d="M10.1064 8.45774C9.60514 8.45774 9.13573 8.65221 8.78031 9.00763C8.42658 9.36304 8.23043 9.83245 8.23043 10.3337C8.23043 10.835 8.42658 11.3044 8.78031 11.6598C9.13573 12.0135 9.60514 12.2097 10.1064 12.2097C10.6077 12.2097 11.0771 12.0135 11.4325 11.6598C11.7862 11.3044 11.9824 10.835 11.9824 10.3337C11.9824 9.83245 11.7862 9.36304 11.4325 9.00763C11.2589 8.8327 11.0523 8.69401 10.8246 8.59961C10.597 8.50521 10.3528 8.45699 10.1064 8.45774ZM17.0185 12.4058L15.9221 11.4687C15.974 11.1502 16.0009 10.8249 16.0009 10.5014C16.0009 10.1778 15.974 9.85089 15.9221 9.53404L17.0185 8.59689C17.1013 8.52599 17.1606 8.43155 17.1884 8.32614C17.2163 8.22073 17.2114 8.10933 17.1744 8.00677L17.1593 7.96319C16.8576 7.1194 16.4054 6.33727 15.8248 5.65469L15.7947 5.61948C15.7242 5.53658 15.6302 5.47699 15.5251 5.44856C15.4201 5.42013 15.3089 5.4242 15.2062 5.46022L13.8449 5.94472C13.342 5.53231 12.782 5.20707 12.1752 4.98075L11.912 3.55743C11.8921 3.4502 11.8401 3.35156 11.7628 3.2746C11.6856 3.19764 11.5867 3.14601 11.4794 3.12657L11.4342 3.11819C10.5624 2.9606 9.6437 2.9606 8.77193 3.11819L8.72667 3.12657C8.61937 3.14601 8.52052 3.19764 8.44327 3.2746C8.36601 3.35156 8.314 3.4502 8.29414 3.55743L8.02926 4.98745C7.42812 5.21558 6.86813 5.54003 6.37123 5.94807L4.99988 5.46022C4.89722 5.42391 4.78595 5.4197 4.68084 5.44815C4.57573 5.47659 4.48177 5.53635 4.41144 5.61948L4.38126 5.65469C3.80169 6.338 3.34968 7.11993 3.04679 7.96319L3.0317 8.00677C2.95626 8.21633 3.01829 8.45104 3.18762 8.59689L4.29744 9.5441C4.24547 9.85927 4.22032 10.1812 4.22032 10.4997C4.22032 10.8216 4.24547 11.1434 4.29744 11.4553L3.19097 12.4025C3.10814 12.4734 3.04886 12.5678 3.02101 12.6732C2.99316 12.7786 2.99806 12.89 3.03506 12.9926L3.05014 13.0362C3.35359 13.8794 3.8012 14.659 4.38461 15.3447L4.41479 15.3799C4.48529 15.4628 4.57926 15.5224 4.6843 15.5508C4.78935 15.5792 4.90054 15.5752 5.00323 15.5391L6.37458 15.0513C6.87417 15.462 7.43076 15.7873 8.03261 16.0119L8.29749 17.4419C8.31735 17.5492 8.36936 17.6478 8.44662 17.7248C8.52388 17.8017 8.62272 17.8533 8.73002 17.8728L8.77529 17.8812C9.65562 18.0396 10.5572 18.0396 11.4375 17.8812L11.4828 17.8728C11.5901 17.8533 11.6889 17.8017 11.7662 17.7248C11.8434 17.6478 11.8955 17.5492 11.9153 17.4419L12.1785 16.0186C12.7854 15.7906 13.3453 15.4671 13.8483 15.0546L15.2096 15.5391C15.3122 15.5755 15.4235 15.5797 15.5286 15.5512C15.6337 15.5228 15.7277 15.463 15.798 15.3799L15.8282 15.3447C16.4116 14.6556 16.8592 13.8794 17.1627 13.0362L17.1777 12.9926C17.2498 12.7847 17.1878 12.5517 17.0185 12.4058ZM10.1064 13.2809C8.47855 13.2809 7.15917 11.9616 7.15917 10.3337C7.15917 8.70586 8.47855 7.38648 10.1064 7.38648C11.7343 7.38648 13.0536 8.70586 13.0536 10.3337C13.0536 11.9616 11.7343 13.2809 10.1064 13.2809Z" />

                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">Settings</span>
                            </a>
                        </li>
                        <li class="relative z-20">
                            <a href="../Logout"
                                class="flex items-center py-2 px-4 text-gray-900 transition duration-200 rounded-full hover:text-white dark:text-white hover:bg-customOrangeDark dark:hover:bg-gray-700 group  {{ request()->is('logout') ? 'active gradient-bg text-white ' : '' }} ">
                                <svg class="flex-shrink-0  w-7 h-7 text-black transition duration-75 dark:text-gray-400 group-hover:text-white {{ request()->is('logout') ? 'text-white' : '' }}"
                                    class="flex items-center py-2 px-4 text-gray-900 transition duration-200 rounded-xl hover:text-white dark:text-white hover:bg-customOrangeDark dark:hover:bg-gray-700 group  "
                                    fill="currentColor">
                                    <path
                                        d="M5.83333 13.332L2.5 9.9987M2.5 9.9987L5.83333 6.66536M2.5 9.9987H14.1667M9.16667 13.332V14.1654C9.16667 14.8284 9.43006 15.4643 9.8989 15.9331C10.3677 16.402 11.0036 16.6654 11.6667 16.6654H15C15.663 16.6654 16.2989 16.402 16.7678 15.9331C17.2366 15.4643 17.5 14.8284 17.5 14.1654V5.83203C17.5 5.16899 17.2366 4.53311 16.7678 4.06426C16.2989 3.59542 15.663 3.33203 15 3.33203H11.6667C11.0036 3.33203 10.3677 3.59542 9.8989 4.06426C9.43006 4.53311 9.16667 5.16899 9.16667 5.83203V6.66536"
                                        stroke="currentColor" stroke-width="1.66667" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <span class="flex-1 ms-3 whitespace-nowrap">Log Out</span>
                            </a>
                        </li>
                    </ul>
     
                </div>
            </aside>

            <div class="p-4  sm:ml-64 pt-[100px]">
                @yield('content')
            </div>


        </div>
    </div>


    <script src="{{ asset('javascript/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('javascript/canvas.js') }}"></script>
    <script type="text/javascript" src="{{ asset('DataTables/DataTables-1.13.8/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('javascript/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        @php
            $pending_media_count = App\Models\Media::where('media_status', 2)->get()->count();
        @endphp
        $('#pendingMediaCount').text({{ $pending_media_count }});

        $(window).on('load', function() {
            $('#loading').hide();
        })
        $(document).ready(function() {
            $('#datatable').DataTable();
            $('select').select2({
                width: '100%'
            });
            $('#Items_dropdown').select2({
                minimumResultsForSearch: Infinity
            });
        });
    </script>
    @yield('js')
</body>

</html>
