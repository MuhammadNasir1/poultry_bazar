@extends('layouts.layout')

@section('title')
    Dasboard
@endsection
@section('content')
@php
    $user = session('user_details');
    $privileges = json_decode($user['user_privileges'], true)['permissions'] ?? [];
    // dd($privileges);
    $userRole = session('user_details')['user_role'];
@endphp
    <div class="min-h-[88vh] p-8 py-2 rounded-2xl gradient-border ">
        @if (session('user_details')['user_role'] == 'superadmin')
            <h1 class="text-[32px] mt-[10px]  font-bold">Dashboard</h1>
            <div class="grid grid-cols-1 gap-4 mt-10 mb-4 xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-2">
                <div
                    class="flex items-center justify-between w-full h-full p-4 bg-orange-100 border-4 shadow-sm border-customOrangeLight rounded-xl">
                    <div>
                        <h2 class="mb-1 text-sm font-medium text-gray-400">Operators</h2>
                        <p class="text-2xl font-bold text-gray-800 ">{{ $totalOperators < 10 ? '0' . $totalOperators : $totalOperators }}</p>
                    </div>
                    <div class="flex items-center justify-center rounded-full">
                        <img class="h-14 w-14" src="{{ asset('assets/icons/dex icon1.png') }}" alt="">
                    </div>
                </div>
                <div
                    class="flex items-center justify-between w-full h-full p-4 bg-orange-100 border-4 shadow-sm border-customOrangeLight rounded-xl">
                    <div>
                        <h2 class="mb-1 text-sm font-medium text-gray-400">Cities</h2>
                        <p class="text-2xl font-bold text-gray-800 ">{{$totalCities < 10 ? '0' . $totalCities : $totalCities}}</p>
                    </div>
                    <div class="flex items-center justify-center rounded-full">
                        <img class="h-14 w-14" src="{{ asset('assets/icons/dex icon2.png') }}" alt="">
                    </div>
                </div>
                <div
                    class="flex items-center justify-between w-full h-full p-4 bg-orange-100 border-4 shadow-sm border-customOrangeLight rounded-xl">
                    <div>
                        <h2 class="mb-1 text-sm font-medium text-gray-400">Blogs</h2>
                        <p class="text-2xl font-bold text-gray-800 ">{{$totalBlogs < 10 ? '0' . $totalBlogs : $totalBlogs}}</p>
                    </div>
                    <div class="flex items-center justify-center rounded-full">
                        <img class="h-14 w-14" src="{{ asset('assets/icons/dex icon3.png') }}" alt="">
                    </div>
                </div>
                <div
                    class="flex items-center justify-between w-full h-full p-4 bg-orange-100 border-4 shadow-sm border-customOrangeLight rounded-xl">
                    <div>
                        <h2 class="mb-1 text-sm font-medium text-gray-400">Diseases</h2>
                        <p class="text-2xl font-bold text-gray-800 ">{{$totalDiseases < 10 ? '0' . $totalDiseases : $totalDiseases}}</p>
                    </div>
                    <div class="flex items-center justify-center rounded-full">
                        <img class="h-14 w-14" src="{{ asset('assets/icons/dex icon4.png') }}" alt="">
                    </div>
                </div>
            </div>
        @else
            <h1 class="text-[32px] mt-[10px]  font-bold">Dashboard</h1>
            <h1 class="text-[15px] mt-[7px] font-semibold"> {{ now()->format('j, F Y') }}</h1>
            <div class="grid grid-cols-1 gap-4 mt-3 mb-4 xl:grid-cols-4 lg:grid-cols-4 md:grid-cols-2">
                <div
                    class="flex items-center justify-between w-full h-full p-4 bg-orange-100 border-4 shadow-sm border-customOrangeLight rounded-xl">
                    <div>
                        <h2 class="mb-1 text-sm font-medium text-gray-400">Total Markets</h2>
                        <p class="text-2xl font-bold text-gray-800 ">{{$totalMarkets < 10 ? '0' . $totalMarkets : $totalMarkets}}</p>
                    </div>
                    <div class="flex items-center justify-center rounded-full">
                        <img class="w-16 h-16" src="{{ asset('assets/icons/dex icon1.png') }}" alt="">
                    </div>
                </div>
                <div
                    class="flex items-center justify-between w-full h-full p-4 bg-orange-100 border-4 shadow-sm border-customOrangeLight rounded-xl">
                    <div>
                        <h2 class="mb-1 text-sm font-medium text-gray-400">Total Blogs</h2>
                        <p class="text-2xl font-bold text-gray-800 ">{{$totalBlogs < 10 ? '0' . $totalBlogs : $totalBlogs}}</p>
                    </div>
                    <div class="flex items-center justify-center rounded-full">
                        <img class="w-16 h-16" src="{{ asset('assets/icons/dex icon2.png') }}" alt="">
                    </div>
                </div>
                <div
                    class="flex items-center justify-between w-full h-full p-4 bg-orange-100 border-4 shadow-sm border-customOrangeLight rounded-xl">
                    <div>
                        <h2 class="mb-1 text-sm font-medium text-gray-400">Diseases</h2>
                        <p class="text-2xl font-bold text-gray-800 ">{{ $totalDiseases < 10 ? '0' . $totalDiseases : $totalDiseases}}</p>
                    </div>
                    <div class="flex items-center justify-center rounded-full">
                        <img class="w-16 h-16" src="{{ asset('assets/icons/dex icon3.png') }}" alt="">
                    </div>
                </div>
                <div
                    class="flex items-center justify-between w-full h-full p-4 bg-orange-100 border-4 shadow-sm border-customOrangeLight rounded-xl">
                    <div>
                        <h2 class="mb-1 text-sm font-medium text-gray-400">Pending Queries</h2>
                        <p class="text-2xl font-bold text-gray-800 ">{{$pendingQuries < 10 ? '0' . $pendingQuries : $pendingQuries}}</p>
                    </div>
                    <div class="flex items-center justify-center rounded-full">
                        <img class="w-16 h-16" src="{{ asset('assets/icons/dex icon4.png') }}" alt="">
                    </div>
                </div>
            </div>

            <div class="mx-auto my-3 ">
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                    @if (isset($privileges['Blogs']['view']))
                    <!-- Blogs Section -->
                    <div class="bg-white border-4 rounded-xl shadow-lg border-customOrangeLight">
                        <div class="flex items-center justify-between p-3 mb-4 bg-orange-100 rounded-t-lg">
                            <h1 class="text-lg font-bold text-gray-800">Blogs</h1>
                            <a href="/media/blogs"><button
                                class="py-2 px-3 text-sm shadow-md font-medium text-orange-500 transition-colors bg-white rounded-full ">
                                Add New
                            </button></a>
                        </div>
                        @foreach ($blogs as $blog )
                        <div class="p-2 m-2 space-y-4 rounded-lg border-[2px] ">
                            <div class="flex items-start">
                                <img class="flex-shrink-0 object-cover w-20 h-20 rounded"
                                    src="{{ $blog->media_image ?? asset('assets/default-logo-squere.png') }}" alt="Blog Image">
                                <div class="ml-4">
                                    <h3 class="text-xs xl:text-[16px] font-semibold">{{$blog->media_title}}</h3>
                                    <p>{{ \Illuminate\Support\Str::limit($blog->media_description ?? '', 60, '...') }}</p>

                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                @endif
                @if (isset($privileges['Diseases']['view']))
                    <!-- Diseases Section -->
                    <div class="bg-white border-4 rounded-xl shadow-lg border-customOrangeLight">
                        <div class="flex items-center justify-between p-3 mb-4 bg-orange-100 rounded-t-lg">
                            <h1 class="text-lg font-bold text-gray-800">Diseases</h1>
                            <a href="/media/diseases"><button
                                class="py-2 px-3 text-sm shadow-md font-medium text-orange-500 transition-colors bg-white rounded-full ">
                                Add New
                            </button></a>
                        </div>
                        @foreach ($diseases as $disease )
                        <div class="p-2 m-2 space-y-4 rounded-lg border-[2px] ">
                            <div class="flex items-start">
                                <img class="flex-shrink-0 object-cover w-20 h-20 rounded"
                                    src="{{ $disease->media_image ?? asset('assets/default-logo-squere.png') }}" alt="Disease Image">
                                <div class="ml-4">
                                    <h3 class="text-xs xl:text-[16px] font-semibold">{{$disease->media_title}}</h3>
                                    <p>{{ \Illuminate\Support\Str::limit($disease->media_description ?? '', 60, '...') }}</p>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @if (isset($privileges['Consultancy']['view']))
                    <!-- Consultancy Videos Section -->
                    <div class="bg-white border-4 rounded-xl shadow-lg border-customOrangeLight">
                        <div class="flex items-center justify-between p-3 mb-4 bg-orange-100 rounded-t-lg">
                            <h1 class="text-lg font-bold text-gray-800">Consultancy Videos</h1>
                            <a href="/media/consultancy"><button
                                class="py-2 px-3 text-sm shadow-md font-medium text-orange-500 transition-colors bg-white rounded-full ">
                                Add New
                            </button></a>
                        </div>

                        @foreach ($consultancy as $consultan )
                        <div class="p-2 m-2 space-y-4 rounded-lg border-[2px] ">
                            <div class="flex items-start">
                                <img class="flex-shrink-0 object-cover w-20 h-20 rounded"
                                    src="{{ $disease->consultan ?? asset('assets/default-logo-squere.png') }}" alt="consultancy Image">
                                <div class="ml-4">
                                    <h3 class="text-xs xl:text-[16px] font-semibold">{{$consultan->media_title}}</h3>
                                    <p>{{ \Illuminate\Support\Str::limit($consultan->media_description ?? '', 60, '...') }}</p>

                                </div>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- <div class="container p-4 mx-auto">
            <div class="grid-cols-1 gap-4 gird md:grid-cols-2">
                <div class="flex p-4 bg-white rounded-lg shadow-md">
                    <img class="rounded-lg" src="{{ asset('assets/Rectangle 403.jpg') }}" alt="">
                    <h2 class="mt-4 font-bold text-md">
                        Lorem ipsum dolor sit amet consectetur.
                    </h2>
                    <p class="text-sm text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>


                </div>

            </div>
        </div> --}}
    </div>
@endsection
