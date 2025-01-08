@extends('landingPage.layout')
@section('content')
    <div class=" section" id="home">
        <div
            class="container relative z-20 flex flex-col items-center justify-center w-full px-6 mx-auto mt-10 xl:px-14 lg:flex-row lg:justify-between xl:mx-auto">

            <!-- Welcome Section -->
            <div class="relative z-40 flex flex-col items-center lg:mt-0 mt-10 xl:mx-auto justify-center w-[70vw] h-full ">
                <div id="welcomeDiv" class=" text-left">
                    <h2 class="text-4xl font-bold leading-tight lg:text-5xl text-customOrangeDark">
                        <span>Welcome to</span><br> Poultry Bazar
                    </h2>
                    <p class="mt-4 text-sm font-light text-gray-600 lg:text-base">
                        Stay informed with live updates on the latest poultry market rates. This feature provides users
                        with real-time price trends for chickens across different regions. Gain insights to make
                        informed decisions on buying and selling, helping you maximize your profits in a competitive
                        market.
                    </p>
                </div>
            </div>
            <!-- Signup Form Section (Initially hidden) -->
            <div class="hidden w-[30vw] h-full lg:block">
                <div class="p-5 w-5xl xl:px-5 xl:p-0">
                    <div>
                        <div class="absolute z-20 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                            <img id="henImage" class="xl:w-[260px]  object-contain lg:w-[20vw]"
                                style="transform: rotateY(360deg)" src="{{ asset('assets/hen-avatar-withbg.png') }}"
                                alt="hen">
                        </div>
                        <div class="absolute z-10 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                            <div style="box-shadow: 0px 0px 179px 300px #FCB276A0;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="z-40 flex items-center justify-center  lg:justify-end w-[80vw] px-2 mt-6 md:mt-4 md:px-0 ">
                {{-- <div class="grid grid-cols-2 gap-5 ">
                <div class="max-w-[250px]  p-4 text-center bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-center mx-auto mb-4 ">
                        <img src="{{ asset('assets/icons/Group 44.png') }}" alt="Market Rates Icon"
                            class="w-24 h-24">
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-gray-800">Market Rates</h3>
                    <p class="text-sm text-gray-600">Get real-time poultry prices to stay ahead in the market.</p>
                </div>
                <div class="max-w-[250px] p-4 text-center bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-center mx-auto mb-4 ">
                        <img src="{{ asset('assets/icons/pos.png') }}" alt="Market Rates Icon" class="w-24 h-24">
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-gray-800">Market Rates</h3>
                    <p class="text-sm text-gray-600">Get real-time poultry prices to stay ahead in the market.</p>
                </div>
                <div class="max-w-[250px] p-4 text-center bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-center mx-auto mb-4 ">
                        <img src="{{ asset('assets/icons/floks.png') }}" alt="Market Rates Icon"
                            class="w-24 h-24">
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-gray-800">Market Rates</h3>
                    <p class="text-sm text-gray-600">Get real-time poultry prices to stay ahead in the market.</p>
                </div>
                <div class="max-w-[250px] p-4 text-center bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-center mx-auto mb-4 ">
                        <img src="{{ asset('assets/icons/e-commerce.png') }}" alt="Market Rates Icon"
                            class="w-24 h-24">
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-gray-800">Market Rates</h3>
                    <p class="text-sm text-gray-600">Get real-time poultry prices to stay ahead in the market.</p>
                </div>
            </div> --}}
                <img src="{{ asset('assets/icons/svgsection1/imagesvgsec.svg') }}" alt="">
            </div>
        </div>
        {{-- @php
            $cities = [
                'Lahore',
                'Karachi',
                'Islamabad',
                'Quetta',
                'Peshawar',
                'Multan',
                'Faisalabad',
                'Sialkot',
                'Rawalpindi',
                'Hyderabad',
                'Gujranwala',
            ];

                        @php
                            $marketRate = rand(100, 500); // Random rate between 100 and 500
                            $randomCity = $cities[array_rand($cities)]; // Random city
                        @endphp
        @endphp --}}
        <div class="container xl:mt-20 mt-20  md:px-12 mx-auto px-4">
            <div class="swiper mySwiper ">
                <div class="swiper-wrapper">
                    @foreach ($marketRates as $market)
                        <div class="swiper-slide">
                            <div class="w-full h-auto border rounded-lg border-customOrangeDark">
                                <div class="flex justify-between   m-4 ">
                                    <div>
                                        <h1 class="font-semibold"> {{ $market->market_rate }} <span
                                                class="text-xs text-gray-500">Rs</span>   <span
                                                class="text-xs text-gray-500">| <span class="text-black">{{$market->market_doc}}</span> DOC</span></h1>
                                        <p class="font-semibold text-customOrangeDark">{{ $market->market_name }}</p>
                                    </div>
                                    <div class="flex flex-col justify-center ">
                                        {{-- <svg width="20" height="12" viewBox="0 0 20 12" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19 11L11 3L7 7L1 1M19 11H13M19 11V5" stroke="#EB2424"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg> --}}
                                        {{-- <svg width="20" height="12" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19 1L11 9L7 5L1 11M19 1H13M19 1V7" stroke="#06C230" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg> --}}

                                        @if (rand(0, 1) === 0)
                                            <!-- First SVG -->
                                            <svg width="20" height="12" viewBox="0 0 20 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M19 11L11 3L7 7L1 1M19 11H13M19 11V5" stroke="#EB2424"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        @else
                                            <!-- Second SVG -->
                                            <svg width="20" height="12" viewBox="0 0 20 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M19 1L11 9L7 5L1 11M19 1H13M19 1V7" stroke="#06C230"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="swiper-slide">

                        <div class="w-full h-20 border rounded-lg border-customOrangeDark">
                            <div class="m-4 ms-6">
                                <h1 class="font-bold">{{ $marketCount }}+ <span class="text-gray-500 text-xs">More</span></h1>
                                <p class="font-bold lg:text-[15px] md:text-[12px] text-customOrangeDark whitespace-nowrap">
                                    Cities in App</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div>
            {{-- <div
            class="container overflow-x-auto flex  gap-6 px-4 py-4 mx-auto mt-10 md:gap-10 ">

            <div class="w-full h-20 border rounded-lg border-customOrangeDark">
                <div class="m-4 ms-6">
                    <h1 class="font-bold">20+More</h1>
                    <p class="font-bold lg:text-[15px] md:text-[12px] text-customOrangeDark whitespace-nowrap">Cities in App</p>
                </div>
            </div>

        </div> --}}
        </div>
        <div class="section" id="services">
            <div class="container mx-auto p-5 mt-12">
                <div class="text-center">
                    <h2 class="text-2xl font-semibold text-customOrangeDark">Services</h2>
                    <p class="sm:mx-[150px] mt-2 text-gray-500">Transform your poultry business with innovative
                        solution to Boost efficiency, improve management, expand market
                        access, enhance industry knowledge, empowering you to achieve growth and success with ease</p>
                </div>
            </div>

            <div class="flex items-center justify-center mt-16">
                <div class="container px-5 ">
                    <div class="grid grid-cols-1 gap-8 text-center md:grid-cols-3">
                        <!-- Card 1 -->
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('assets/icons/market updatesvg.svg') }}" alt="">
                            <h3 class="text-2xl font-semibold text-customOrangeDark">Market Updates</h3>
                            <p class="mt-2 text-sm text-gray-500">Stay informed with live updates on poultry market
                                rates, providing real-time price trends for chickens across regions. This feature helps
                                you make informed decisions, adapt to price changes, and maximize profits in the
                                competitive poultry market.</p>
                        </div>
                        <!-- Card 2 -->
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('assets/icons/possvg.svg') }}" alt="">
                            <h3 class="text-2xl font-semibold text-customOrangeDark">Point of Sale</h3>
                            <p class="mt-2 text-sm text-gray-500 ">Streamline sales and financial management with an
                                integrated Point of Sale system. Track sales, generate invoices, and gain insights into
                                daily transactions. A free printer and initial receipt roll will be provided by POUL3Y
                                to help you start smoothly.</p>
                        </div>
                        <!-- Card 3 -->
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('assets/icons/flokssvg.svg') }}" alt="Flock Management">

                            <h3 class="text-2xl font-semibold text-customOrangeDark">Flock Management</h3>
                            <p class="mt-2 text-sm text-gray-500">Manage flock health, productivity, and expenses with
                                comprehensive tools. Improve flock health, streamline operations, and optimize
                                profitability. Monitor feed, track growth, and ensure flocks thrive with this all-in-one
                                solution designed for poultry farming success.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center mt-8">
                <div class="container px-4 mx-auto">
                    <div class="grid grid-cols-1 gap-8 text-center md:grid-cols-3">
                        <!-- Card 1 -->
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('assets/icons/e-commercesvg.svg') }}" alt="E-Commerce">

                            <h3 class="text-2xl font-semibold text-customOrangeDark">E-Commerce </h3>
                            <p class="mt-2 text-sm text-gray-500">Expand your reach with the E-Commerce module to buy
                                and sell poultry products online. Simplify online trading, attract new customers, and
                                boost revenue while streamlining operations for greater efficiency and profitability.
                            </p>
                        </div>
                        <!-- Card 2 -->
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('assets/icons/knowledge-Center.png') }}" alt="Knowledge Center">
                            <h3 class="text-2xl font-semibold text-customOrangeDark">Knowledge Center </h3>
                            <p class="mt-2 text-sm text-gray-500">Enhance your expertise with the Knowledge Center
                                module, offering easy access to resources on poultry management. Get valuable guides,
                                best practices, and insights to make informed decisions and optimize your farm's
                                productivity.</p>
                        </div>
                        <!-- Card 3 -->
                        <div class="flex flex-col items-center">
                            <img src="{{ asset('assets/icons/job-portal.png') }}" alt="Job portal">
                            <h3 class="text-2xl font-semibold text-customOrangeDark">Job Portal</h3>
                            <p class="mt-2 text-sm text-gray-500">Connect with top talent using the Job Portal module.
                                Post job openings, review applications, and find the right candidates. Streamline
                                recruitment to build a skilled, motivated team to drive your business forward.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="flex items-center justify-center px-4 mt-14">
        <div class="text-center">
            <!-- App Store Buttons -->
            <div class="flex justify-center gap-4 mb-4">
                <img src="{{ asset('assets/app and apple store.png') }}" alt="App Store and Google Play"
                    class="h-auto w-80">
            </div>

            <!-- Section Title -->
            <h2 class="text-xl font-semibold text-gray-800">Choose the plan that’s right for your business</h2>
            <h1 class="mt-6"><span class="font-bold">Start with free plan </span>to try our platform for an
                unlimited period of time.
                <span class="text-customOrangeDark"> Get Started</span>
            </h1>
        </div>
    </div>
    <div class="section" id="price">

        <div class="container flex items-center justify-center mx-auto mt-14">
            <div class="px:0 md:px-4 ">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <!-- Card 1 -->
                    <div
                        class="flex flex-col justify-between overflow-hidden text-center bg-white rounded-lg shadow-2xl xl:w-full xl:h-full lg:w-full lg:h-full md:h-full ">
                        <div class="px-4 py-6">
                            <h3 class="text-lg font-semibold text-customOrangeDark">Start up</h3>
                            <p class="mt-2 text-gray-500">Fast start your business with this</p>
                            <p class="mt-4 text-2xl font-bold">$10 <span class="text-sm font-normal">/mon</span>
                            </p>
                            <ul class="mt-4 space-y-2 text-sm text-gray-600">
                                <div class="flex justify-between pt-2">
                                    <div>
                                        <li>Client Panel</li>
                                    </div>
                                    <div>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 6V14M1 10C1 11.1819 1.23279 12.3522 1.68508 13.4442C2.13738 14.5361 2.80031 15.5282 3.63604 16.364C4.47177 17.1997 5.46392 17.8626 6.55585 18.3149C7.64778 18.7672 8.8181 19 10 19C11.1819 19 12.3522 18.7672 13.4442 18.3149C14.5361 17.8626 15.5282 17.1997 16.364 16.364C17.1997 15.5282 17.8626 14.5361 18.3149 13.4442C18.7672 12.3522 19 11.1819 19 10C19 8.8181 18.7672 7.64778 18.3149 6.55585C17.8626 5.46392 17.1997 4.47177 16.364 3.63604C15.5282 2.80031 14.5361 2.13738 13.4442 1.68508C12.3522 1.23279 11.1819 1 10 1C8.8181 1 7.64778 1.23279 6.55585 1.68508C5.46392 2.13738 4.47177 2.80031 3.63604 3.63604C2.80031 4.47177 2.13738 5.46392 1.68508 6.55585C1.23279 7.64778 1 8.8181 1 10Z"
                                                stroke="url(#paint0_linear_1789_9048)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <linearGradient id="paint0_linear_1789_9048" x1="10"
                                                    y1="1" x2="10" y2="19"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#FCB376" />
                                                    <stop offset="1" stop-color="#FE8A29" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between pt-2 ">
                                    <div>
                                        <li>Single User</li>
                                    </div>
                                    <div>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 6V14M1 10C1 11.1819 1.23279 12.3522 1.68508 13.4442C2.13738 14.5361 2.80031 15.5282 3.63604 16.364C4.47177 17.1997 5.46392 17.8626 6.55585 18.3149C7.64778 18.7672 8.8181 19 10 19C11.1819 19 12.3522 18.7672 13.4442 18.3149C14.5361 17.8626 15.5282 17.1997 16.364 16.364C17.1997 15.5282 17.8626 14.5361 18.3149 13.4442C18.7672 12.3522 19 11.1819 19 10C19 8.8181 18.7672 7.64778 18.3149 6.55585C17.8626 5.46392 17.1997 4.47177 16.364 3.63604C15.5282 2.80031 14.5361 2.13738 13.4442 1.68508C12.3522 1.23279 11.1819 1 10 1C8.8181 1 7.64778 1.23279 6.55585 1.68508C5.46392 2.13738 4.47177 2.80031 3.63604 3.63604C2.80031 4.47177 2.13738 5.46392 1.68508 6.55585C1.23279 7.64778 1 8.8181 1 10Z"
                                                stroke="url(#paint0_linear_1789_9048)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <linearGradient id="paint0_linear_1789_9048" x1="10"
                                                    y1="1" x2="10" y2="19"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#FCB376" />
                                                    <stop offset="1" stop-color="#FE8A29" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between pt-2">
                                    <div>
                                        <li>5 Drivers</li>
                                    </div>
                                    <div>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 6V14M1 10C1 11.1819 1.23279 12.3522 1.68508 13.4442C2.13738 14.5361 2.80031 15.5282 3.63604 16.364C4.47177 17.1997 5.46392 17.8626 6.55585 18.3149C7.64778 18.7672 8.8181 19 10 19C11.1819 19 12.3522 18.7672 13.4442 18.3149C14.5361 17.8626 15.5282 17.1997 16.364 16.364C17.1997 15.5282 17.8626 14.5361 18.3149 13.4442C18.7672 12.3522 19 11.1819 19 10C19 8.8181 18.7672 7.64778 18.3149 6.55585C17.8626 5.46392 17.1997 4.47177 16.364 3.63604C15.5282 2.80031 14.5361 2.13738 13.4442 1.68508C12.3522 1.23279 11.1819 1 10 1C8.8181 1 7.64778 1.23279 6.55585 1.68508C5.46392 2.13738 4.47177 2.80031 3.63604 3.63604C2.80031 4.47177 2.13738 5.46392 1.68508 6.55585C1.23279 7.64778 1 8.8181 1 10Z"
                                                stroke="url(#paint0_linear_1789_9048)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <linearGradient id="paint0_linear_1789_9048" x1="10"
                                                    y1="1" x2="10" y2="19"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#FCB376" />
                                                    <stop offset="1" stop-color="#FE8A29" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between pt-2">
                                    <div>
                                        <li>50 Google Map API Call</li>
                                    </div>
                                    <div>
                                        <svg width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 6V14M1 10C1 11.1819 1.23279 12.3522 1.68508 13.4442C2.13738 14.5361 2.80031 15.5282 3.63604 16.364C4.47177 17.1997 5.46392 17.8626 6.55585 18.3149C7.64778 18.7672 8.8181 19 10 19C11.1819 19 12.3522 18.7672 13.4442 18.3149C14.5361 17.8626 15.5282 17.1997 16.364 16.364C17.1997 15.5282 17.8626 14.5361 18.3149 13.4442C18.7672 12.3522 19 11.1819 19 10C19 8.8181 18.7672 7.64778 18.3149 6.55585C17.8626 5.46392 17.1997 4.47177 16.364 3.63604C15.5282 2.80031 14.5361 2.13738 13.4442 1.68508C12.3522 1.23279 11.1819 1 10 1C8.8181 1 7.64778 1.23279 6.55585 1.68508C5.46392 2.13738 4.47177 2.80031 3.63604 3.63604C2.80031 4.47177 2.13738 5.46392 1.68508 6.55585C1.23279 7.64778 1 8.8181 1 10Z"
                                                stroke="url(#paint0_linear_1789_9048)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <linearGradient id="paint0_linear_1789_9048" x1="10"
                                                    y1="1" x2="10" y2="19"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#FCB376" />
                                                    <stop offset="1" stop-color="#FE8A29" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                            </ul>
                            <button
                                class="px-4 py-2 mt-8 font-semibold text-black bg-white border rounded-md">SIGN
                                UP
                                NOW</button>
                        </div>
                        <!-- SVG Wave -->
                        <div class="bottom-0 left-0 w-full overflow-hidden ">
                            <svg width="100%" height="auto" viewBox="0 0 389 186" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0 0L16.2083 31C32.4167 62 64.8333 54 97.25 85C129.667 116 162.083 116 194.5 89.4286C226.917 62.8571 259.333 79.7143 291.75 53.1429C324.167 26.5714 356.583 26.5714 372.792 26.5714H389V186H372.792C356.583 186 324.167 186 291.75 186C259.333 186 226.917 186 194.5 186C162.083 186 129.667 186 97.25 186C64.8333 186 32.4167 186 16.2083 186H0V0Z"
                                    fill="url(#paint0_linear_1789_9076)" />
                                <defs>
                                    <linearGradient id="paint0_linear_1789_9076" x1="194.5" y1="0"
                                        x2="194.5" y2="186" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FCB376" />
                                        <stop offset="1" stop-color="#FE8A29" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                    </div>
                    <div
                        class="flex flex-col justify-between overflow-hidden text-center bg-white rounded-lg shadow-2xl xl:w-full xl:h-full lg:w-full lg:h-full md:h-full ">
                        <div class="px-4 py-6">
                            <h3 class="text-lg font-semibold text-customOrangeDark">Small Company</h3>
                            <p class="mt-2 text-gray-500">Fast start your business with this</p>
                            <p class="mt-4 text-2xl font-bold">$20 <span class="text-sm font-normal">/mon</span>
                            </p>
                            <ul class="mt-4 space-y-2 text-sm text-gray-600">
                                <div class="flex justify-between pt-2">
                                    <div>
                                        <li>Client Panel</li>
                                    </div>
                                    <div>
                                        <svg width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 6V14M1 10C1 11.1819 1.23279 12.3522 1.68508 13.4442C2.13738 14.5361 2.80031 15.5282 3.63604 16.364C4.47177 17.1997 5.46392 17.8626 6.55585 18.3149C7.64778 18.7672 8.8181 19 10 19C11.1819 19 12.3522 18.7672 13.4442 18.3149C14.5361 17.8626 15.5282 17.1997 16.364 16.364C17.1997 15.5282 17.8626 14.5361 18.3149 13.4442C18.7672 12.3522 19 11.1819 19 10C19 8.8181 18.7672 7.64778 18.3149 6.55585C17.8626 5.46392 17.1997 4.47177 16.364 3.63604C15.5282 2.80031 14.5361 2.13738 13.4442 1.68508C12.3522 1.23279 11.1819 1 10 1C8.8181 1 7.64778 1.23279 6.55585 1.68508C5.46392 2.13738 4.47177 2.80031 3.63604 3.63604C2.80031 4.47177 2.13738 5.46392 1.68508 6.55585C1.23279 7.64778 1 8.8181 1 10Z"
                                                stroke="url(#paint0_linear_1789_9048)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <linearGradient id="paint0_linear_1789_9048" x1="10"
                                                    y1="1" x2="10" y2="19"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#FCB376" />
                                                    <stop offset="1" stop-color="#FE8A29" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between pt-2 ">
                                    <div>
                                        <li>Single User</li>
                                    </div>
                                    <div>
                                        <svg width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 6V14M1 10C1 11.1819 1.23279 12.3522 1.68508 13.4442C2.13738 14.5361 2.80031 15.5282 3.63604 16.364C4.47177 17.1997 5.46392 17.8626 6.55585 18.3149C7.64778 18.7672 8.8181 19 10 19C11.1819 19 12.3522 18.7672 13.4442 18.3149C14.5361 17.8626 15.5282 17.1997 16.364 16.364C17.1997 15.5282 17.8626 14.5361 18.3149 13.4442C18.7672 12.3522 19 11.1819 19 10C19 8.8181 18.7672 7.64778 18.3149 6.55585C17.8626 5.46392 17.1997 4.47177 16.364 3.63604C15.5282 2.80031 14.5361 2.13738 13.4442 1.68508C12.3522 1.23279 11.1819 1 10 1C8.8181 1 7.64778 1.23279 6.55585 1.68508C5.46392 2.13738 4.47177 2.80031 3.63604 3.63604C2.80031 4.47177 2.13738 5.46392 1.68508 6.55585C1.23279 7.64778 1 8.8181 1 10Z"
                                                stroke="url(#paint0_linear_1789_9048)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <linearGradient id="paint0_linear_1789_9048" x1="10"
                                                    y1="1" x2="10" y2="19"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#FCB376" />
                                                    <stop offset="1" stop-color="#FE8A29" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between pt-2">
                                    <div>
                                        <li>5 Drivers</li>
                                    </div>
                                    <div>
                                        <svg width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 6V14M1 10C1 11.1819 1.23279 12.3522 1.68508 13.4442C2.13738 14.5361 2.80031 15.5282 3.63604 16.364C4.47177 17.1997 5.46392 17.8626 6.55585 18.3149C7.64778 18.7672 8.8181 19 10 19C11.1819 19 12.3522 18.7672 13.4442 18.3149C14.5361 17.8626 15.5282 17.1997 16.364 16.364C17.1997 15.5282 17.8626 14.5361 18.3149 13.4442C18.7672 12.3522 19 11.1819 19 10C19 8.8181 18.7672 7.64778 18.3149 6.55585C17.8626 5.46392 17.1997 4.47177 16.364 3.63604C15.5282 2.80031 14.5361 2.13738 13.4442 1.68508C12.3522 1.23279 11.1819 1 10 1C8.8181 1 7.64778 1.23279 6.55585 1.68508C5.46392 2.13738 4.47177 2.80031 3.63604 3.63604C2.80031 4.47177 2.13738 5.46392 1.68508 6.55585C1.23279 7.64778 1 8.8181 1 10Z"
                                                stroke="url(#paint0_linear_1789_9048)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <linearGradient id="paint0_linear_1789_9048" x1="10"
                                                    y1="1" x2="10" y2="19"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#FCB376" />
                                                    <stop offset="1" stop-color="#FE8A29" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between pt-2">
                                    <div>
                                        <li>50 Google Map API Call</li>
                                    </div>
                                    <div>
                                        <svg width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 6V14M1 10C1 11.1819 1.23279 12.3522 1.68508 13.4442C2.13738 14.5361 2.80031 15.5282 3.63604 16.364C4.47177 17.1997 5.46392 17.8626 6.55585 18.3149C7.64778 18.7672 8.8181 19 10 19C11.1819 19 12.3522 18.7672 13.4442 18.3149C14.5361 17.8626 15.5282 17.1997 16.364 16.364C17.1997 15.5282 17.8626 14.5361 18.3149 13.4442C18.7672 12.3522 19 11.1819 19 10C19 8.8181 18.7672 7.64778 18.3149 6.55585C17.8626 5.46392 17.1997 4.47177 16.364 3.63604C15.5282 2.80031 14.5361 2.13738 13.4442 1.68508C12.3522 1.23279 11.1819 1 10 1C8.8181 1 7.64778 1.23279 6.55585 1.68508C5.46392 2.13738 4.47177 2.80031 3.63604 3.63604C2.80031 4.47177 2.13738 5.46392 1.68508 6.55585C1.23279 7.64778 1 8.8181 1 10Z"
                                                stroke="url(#paint0_linear_1789_9048)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <linearGradient id="paint0_linear_1789_9048" x1="10"
                                                    y1="1" x2="10" y2="19"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#FCB376" />
                                                    <stop offset="1" stop-color="#FE8A29" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                            </ul>
                            <button
                                class="px-4 py-2 mt-8 font-semibold text-white rounded-md bg-customOrangeDark">SIGN
                                UP
                                NOW</button>
                        </div>
                        <!-- SVG Wave -->
                        <div class="bottom-0 left-0 w-full overflow-hidden ">
                            <svg width="100%" height="auto" viewBox="0 0 389 186" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0 0L16.2083 31C32.4167 62 64.8333 54 97.25 85C129.667 116 162.083 116 194.5 89.4286C226.917 62.8571 259.333 79.7143 291.75 53.1429C324.167 26.5714 356.583 26.5714 372.792 26.5714H389V186H372.792C356.583 186 324.167 186 291.75 186C259.333 186 226.917 186 194.5 186C162.083 186 129.667 186 97.25 186C64.8333 186 32.4167 186 16.2083 186H0V0Z"
                                    fill="url(#paint0_linear_1789_9076)" />
                                <defs>
                                    <linearGradient id="paint0_linear_1789_9076" x1="194.5" y1="0"
                                        x2="194.5" y2="186" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FCB376" />
                                        <stop offset="1" stop-color="#FE8A29" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div
                        class="flex flex-col justify-between overflow-hidden text-center bg-white rounded-lg shadow-2xl xl:w-full xl:h-full lg:w-full lg:h-full md:h-full ">
                        <div class="px-4 py-6">
                            <h3 class="text-lg font-semibold text-customOrangeDark">Advance</h3>
                            <p class="mt-2 text-gray-500">Fast start your business with this</p>
                            <p class="mt-4 text-2xl font-bold">$50 <span class="text-sm font-normal">/mon</span>
                            </p>
                            <ul class="mt-4 space-y-2 text-sm text-gray-600">
                                <div class="flex justify-between pt-2">
                                    <div>
                                        <li>Client Panel</li>
                                    </div>
                                    <div>
                                        <svg width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 6V14M1 10C1 11.1819 1.23279 12.3522 1.68508 13.4442C2.13738 14.5361 2.80031 15.5282 3.63604 16.364C4.47177 17.1997 5.46392 17.8626 6.55585 18.3149C7.64778 18.7672 8.8181 19 10 19C11.1819 19 12.3522 18.7672 13.4442 18.3149C14.5361 17.8626 15.5282 17.1997 16.364 16.364C17.1997 15.5282 17.8626 14.5361 18.3149 13.4442C18.7672 12.3522 19 11.1819 19 10C19 8.8181 18.7672 7.64778 18.3149 6.55585C17.8626 5.46392 17.1997 4.47177 16.364 3.63604C15.5282 2.80031 14.5361 2.13738 13.4442 1.68508C12.3522 1.23279 11.1819 1 10 1C8.8181 1 7.64778 1.23279 6.55585 1.68508C5.46392 2.13738 4.47177 2.80031 3.63604 3.63604C2.80031 4.47177 2.13738 5.46392 1.68508 6.55585C1.23279 7.64778 1 8.8181 1 10Z"
                                                stroke="url(#paint0_linear_1789_9048)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <linearGradient id="paint0_linear_1789_9048" x1="10"
                                                    y1="1" x2="10" y2="19"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#FCB376" />
                                                    <stop offset="1" stop-color="#FE8A29" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between pt-2 ">
                                    <div>
                                        <li>Single User</li>
                                    </div>
                                    <div>
                                        <svg width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 6V14M1 10C1 11.1819 1.23279 12.3522 1.68508 13.4442C2.13738 14.5361 2.80031 15.5282 3.63604 16.364C4.47177 17.1997 5.46392 17.8626 6.55585 18.3149C7.64778 18.7672 8.8181 19 10 19C11.1819 19 12.3522 18.7672 13.4442 18.3149C14.5361 17.8626 15.5282 17.1997 16.364 16.364C17.1997 15.5282 17.8626 14.5361 18.3149 13.4442C18.7672 12.3522 19 11.1819 19 10C19 8.8181 18.7672 7.64778 18.3149 6.55585C17.8626 5.46392 17.1997 4.47177 16.364 3.63604C15.5282 2.80031 14.5361 2.13738 13.4442 1.68508C12.3522 1.23279 11.1819 1 10 1C8.8181 1 7.64778 1.23279 6.55585 1.68508C5.46392 2.13738 4.47177 2.80031 3.63604 3.63604C2.80031 4.47177 2.13738 5.46392 1.68508 6.55585C1.23279 7.64778 1 8.8181 1 10Z"
                                                stroke="url(#paint0_linear_1789_9048)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <linearGradient id="paint0_linear_1789_9048" x1="10"
                                                    y1="1" x2="10" y2="19"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#FCB376" />
                                                    <stop offset="1" stop-color="#FE8A29" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between pt-2">
                                    <div>
                                        <li>5 Drivers</li>
                                    </div>
                                    <div>
                                        <svg width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 6V14M1 10C1 11.1819 1.23279 12.3522 1.68508 13.4442C2.13738 14.5361 2.80031 15.5282 3.63604 16.364C4.47177 17.1997 5.46392 17.8626 6.55585 18.3149C7.64778 18.7672 8.8181 19 10 19C11.1819 19 12.3522 18.7672 13.4442 18.3149C14.5361 17.8626 15.5282 17.1997 16.364 16.364C17.1997 15.5282 17.8626 14.5361 18.3149 13.4442C18.7672 12.3522 19 11.1819 19 10C19 8.8181 18.7672 7.64778 18.3149 6.55585C17.8626 5.46392 17.1997 4.47177 16.364 3.63604C15.5282 2.80031 14.5361 2.13738 13.4442 1.68508C12.3522 1.23279 11.1819 1 10 1C8.8181 1 7.64778 1.23279 6.55585 1.68508C5.46392 2.13738 4.47177 2.80031 3.63604 3.63604C2.80031 4.47177 2.13738 5.46392 1.68508 6.55585C1.23279 7.64778 1 8.8181 1 10Z"
                                                stroke="url(#paint0_linear_1789_9048)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <linearGradient id="paint0_linear_1789_9048" x1="10"
                                                    y1="1" x2="10" y2="19"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#FCB376" />
                                                    <stop offset="1" stop-color="#FE8A29" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between pt-2">
                                    <div>
                                        <li>50 Google Map API Call</li>
                                    </div>
                                    <div>
                                        <svg width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 6V14M1 10C1 11.1819 1.23279 12.3522 1.68508 13.4442C2.13738 14.5361 2.80031 15.5282 3.63604 16.364C4.47177 17.1997 5.46392 17.8626 6.55585 18.3149C7.64778 18.7672 8.8181 19 10 19C11.1819 19 12.3522 18.7672 13.4442 18.3149C14.5361 17.8626 15.5282 17.1997 16.364 16.364C17.1997 15.5282 17.8626 14.5361 18.3149 13.4442C18.7672 12.3522 19 11.1819 19 10C19 8.8181 18.7672 7.64778 18.3149 6.55585C17.8626 5.46392 17.1997 4.47177 16.364 3.63604C15.5282 2.80031 14.5361 2.13738 13.4442 1.68508C12.3522 1.23279 11.1819 1 10 1C8.8181 1 7.64778 1.23279 6.55585 1.68508C5.46392 2.13738 4.47177 2.80031 3.63604 3.63604C2.80031 4.47177 2.13738 5.46392 1.68508 6.55585C1.23279 7.64778 1 8.8181 1 10Z"
                                                stroke="url(#paint0_linear_1789_9048)" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <defs>
                                                <linearGradient id="paint0_linear_1789_9048" x1="10"
                                                    y1="1" x2="10" y2="19"
                                                    gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#FCB376" />
                                                    <stop offset="1" stop-color="#FE8A29" />
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                            </ul>
                            <button
                                class="px-4 py-2 mt-8 font-semibold text-black bg-white border rounded-md">SIGN
                                UP
                                NOW</button>
                        </div>
                        <!-- SVG Wave -->
                        <div class="bottom-0 left-0 w-full overflow-hidden ">
                            <svg width="100%" height="auto" viewBox="0 0 389 186" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0 0L16.2083 31C32.4167 62 64.8333 54 97.25 85C129.667 116 162.083 116 194.5 89.4286C226.917 62.8571 259.333 79.7143 291.75 53.1429C324.167 26.5714 356.583 26.5714 372.792 26.5714H389V186H372.792C356.583 186 324.167 186 291.75 186C259.333 186 226.917 186 194.5 186C162.083 186 129.667 186 97.25 186C64.8333 186 32.4167 186 16.2083 186H0V0Z"
                                    fill="url(#paint0_linear_1789_9076)" />
                                <defs>
                                    <linearGradient id="paint0_linear_1789_9076" x1="194.5" y1="0"
                                        x2="194.5" y2="186" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#FCB376" />
                                        <stop offset="1" stop-color="#FE8A29" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
        <section id="blogs" class="container py-10 mx-auto mt-20 xl:px-0">
            <div class="px-4 mx-auto lg:px-8">
                <!-- Header -->
                <div class="flex items-center justify-between mb-8">
                    <h2 class="pb-1 text-3xl font-bold text-customOrangeDark">Our Latest Blog Posts</h2>
                    <a href="../knowledgeCenter"><button
                            class="px-6 py-3 font-semibold text-white rounded-full shadow-md gradient-bg text-nowrap ">
                            See All
                        </button>
                    </a>
                </div>

                <div class="py-4">
                    <div class="swiper mySwiper1 pb-5">
                        <div class="swiper-wrapper">
                            @foreach ($medias as $media)
                                <div class="swiper-slide">
                                    <a href="../knowledgeCenter">
                                        <div class="transition bg-white rounded-lg  h-[430px] shadow hover:shadow-lg">



                                            <img src="{{ $media->media_image ?? asset('assets/default-logo-req.png') }}"
                                                alt="Blog Post Image" class="object-cover w-full h-48 rounded-t-lg">

                                            <div class="p-4">
                                                <div class="flex items-center mb-2 text-sm text-customOrangeDark">
                                                    <span
                                                        class="px-2 py-1 bg-orange-100 rounded-full">{{ $media->category_name }}</span>
                                                </div>
                                                <div class="flex items-center mb-4 text-xs text-gray-500">
                                                    <span class="mr-2">{{ $media->media_author }}</span> | <span
                                                        class="ml-2">{{ $media->date }}</span>
                                                </div>
                                                <h3 class="mb-2 text-lg font-semibold text-gray-800">
                                                    {{ \Illuminate\Support\Str::limit($media->media_title, 45, '...') }}
                                                </h3>
                                                <p class="text-sm text-gray-600">
                                                    {{ \Illuminate\Support\Str::limit($media->media_description, 70, '...') }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endsection
