@extends('landingPage.layout')
    @section('title')
    Knowledge Center
    @endsection
    
@section('content')
    <div class="mt-10">
        <div class="bg-gradient-to-b from-[#fcb2764c] to-[#fe89296f]  min-h-[360px] flex justify-center items-center">
            <div class="xl:w-[70%] p-6  ">
                <h2 class="text-customOrangeDark md:text-6xl text-4xl font-semibold text-center">Knowledge Center</h2>
                <p class="text-gray-500 mt-8 text-center">Stay informed with live updates on the latest poultry market rates.
                    This feature provides users with real-time price trends for chickens across different regions. Gain
                    insights to make informed decisions on buying and selling, helping you maximize your profits in a
                    competitive market.</p>
            </div>
        </div>  

        <div class="m-10   container mx-auto">


            <div class="mb-4  ">
                <ul class="  text-sm font-medium text-center grid grid-cols-3 xl:gap-32 lg:gap-10" id="default-tab"
                    data-tabs-toggle="#default-tab-content" role="tablist"  
                    data-tabs-active-classes="text-white bg-[#FE8A29]">
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block tabBtn p-4 border-2 border-gray-200 rounded-full w-full lg:py-6 md:py-4 py-2 sm:text-lg text-sm md:text-2xl text-gray-600 "
                            id="blog-tab" data-tabs-target="#blog" type="button" role="tab" aria-controls="blog"
                            aria-selected="false">Blogs</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block tabBtn p-4 border-2 border-gray-200 rounded-full w-full lg:py-6 md:py-4 py-2 sm:text-lg text-sm md:text-2xl text-gray-600    hover:border-gray-300 "
                            id="disease-tab" data-tabs-target="#disease" type="button" role="tab"
                            aria-controls="disease" aria-selected="false">Disease</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block tabBtn p-4 border-2 border-gray-200 rounded-full w-full lg:py-6 md:py-4 py-2 sm:text-lg text-sm md:text-2xl text-gray-600   hover:border-gray-300 "
                            id="Consultancy-tab" data-tabs-target="#Consultancy" type="button" role="tab"
                            aria-controls="Consultancy" aria-selected="false">Consultancy</button>
                    </li>

                </ul>
            </div>
            <div id="default-tab-content" class="mt-10 px-4">
                <div class="hidden p-4" id="blog" role="tabpanel" aria-labelledby="blog-tab">
                    <div class="grid  xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-x-6 gap-y-10">
                        {{-- @for ($i = 1; $i < 8; $i++) --}}
                        @foreach ($data['blogs'] as $blog)
                            <div data-modal-target="details-Modal" data-modal-toggle="details-Modal"
                                class="transition detailBtn h-[430px] bg-white rounded-lg shadow hover:shadow-lg cursor-pointer"
                                mediaTitle="{{ $blog->media_title }}" mediaAuthor="{{ $blog->media_author }}"
                                mediaCategory="{{ $blog->category_name }}" mediaDate="{{ $blog->date }}"
                                mediaDescription="{{ $blog->media_description }}" mediaId="{{ $blog->media_id }}"
                                mediaImage="{{ $blog->media_image ?? asset('assets/default-logo-req.png') }}">
                                <img loading="lazy"
                                    src="{{ $blog->media_image ?? asset('assets/default-logo-req.png') }}"
                                    alt="Blog Post Image" class="object-cover w-full h-60 rounded-t-lg rounded-b-none">
                                <div class="p-4">
                                    <div class="flex items-center mb-2 text-sm text-customOrangeDark">
                                        <span class="px-2 py-1 bg-orange-100 rounded-full">{{ $blog->category_name }}</span>
                                    </div>
                                    <div class="flex items-center mb-4 text-xs text-gray-500">
                                        <span class="mr-2">{{ $blog->media_author }}</span> | <span
                                            class="ml-2">{{ $blog->date }}</span>
                                    </div>
                                    <h3 class="mb-2 text-lg font-semibold text-gray-800">{{  \Illuminate\Support\Str::limit($blog->media_title, 45, '...')}}</h3>
                                    <p class="text-sm text-gray-600 break-words">{{   Str::limit($blog->media_description, 70, '...') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="hidden p-4 " id="disease" role="tabpanel"
                    aria-labelledby="disease-tab">
                    <div class="grid  xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-x-6 gap-y-10">

                        @foreach ($data['diseases'] as $diseases)
                            <div data-modal-target="details-Modal" data-modal-toggle="details-Modal"
                                class="transition detailBtn h-[430px] bg-white rounded-lg shadow hover:shadow-lg cursor-pointer"
                                mediaTitle="{{ $blog->media_title }}" mediaAuthor="{{ $diseases->media_author }}"
                                mediaCategory="{{ $diseases->category_name }}" mediaDate="{{ $diseases->date }}"
                                mediaDescription="{{ $diseases->media_description }}" mediaId="{{ $diseases->media_id }}"
                                mediaImage="{{ $diseases->media_image ?? asset('assets/default-logo-req.png') }}">
                                <img src="{{ $diseases->media_image ?? asset('assets/default-logo-req.png') }}"
                                    alt="Blog Post Image" class="object-cover w-full h-60 rounded-t-lg rounded-b-none">
                                <div class="p-4">
                                    <div class="flex items-center mb-2 text-sm text-customOrangeDark">
                                        <span
                                            class="px-2 py-1 bg-orange-100 rounded-full">{{ $diseases->category_name }}</span>
                                    </div>
                                    <div class="flex items-center mb-4 text-xs text-gray-500">
                                        <span class="mr-2">{{ $diseases->media_author }}</span> | <span
                                            class="ml-2">{{ $diseases->date }}</span>
                                    </div>
                                    <h3 class="mb-2 text-lg font-semibold text-gray-800">{{ \Illuminate\Support\Str::limit($diseases->media_title, 45, '...') }}</h3>
                                    <p class="text-sm text-gray-600">{{   Str::limit($diseases->media_description, 70, '...') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="hidden p-4 " id="Consultancy" role="tabpanel"
                    aria-labelledby="Consultancy-tab">
                    <div class="grid  xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-x-6 gap-y-10">

                        @foreach ($data['consultancy'] as $consultancy)
                            <div data-modal-target="details-Modal" data-modal-toggle="details-Modal"
                                class="transition detailBtn h-[430px] bg-white rounded-lg shadow hover:shadow-lg cursor-pointer"
                                mediaTitle="{{ $consultancy->media_title }}"
                                mediaAuthor="{{ $consultancy->media_author }}"
                                mediaCategory="{{ $consultancy->category_name }}" mediaDate="{{ $consultancy->date }}"
                                mediaDescription="{{ $consultancy->media_description }}"
                                mediaId="{{ $consultancy->media_id }}" mediaImage="{{ $consultancy->media_image }}">
                                {{-- <img loading="lazy"
                                    src="{{ $consultancy->media_image ?? asset('assets/default-logo-squere.png') }}"
                                    alt="Blog Post Image" class="object-cover w-full h-60 rounded-t-lg rounded-b-none"> --}}

                                <video loading="lazy"
                                    poster="{{ $consultancy->media_image ? '' : asset('assets/default-logo-req.png') }}"
                                    class="h-60 bg-black w-full rounded-md" height="140px" width="170px"
                                    {{ $consultancy->media_image ? 'controls' : '' }}
                                    src="{{ $consultancy->media_image ?? asset('assets/default-logo-req.png') }}">
                                </video>

                                <div class="p-4">
                                    <div class="flex items-center mb-2 text-sm text-customOrangeDark">
                                        <span
                                            class="px-2 py-1 bg-orange-100 rounded-full">{{ $consultancy->category_name }}</span>
                                    </div>
                                    <div class="flex items-center mb-4 text-xs text-gray-500">
                                        <span class="mr-2">{{ $consultancy->media_author }}</span> | <span
                                            class="ml-2">{{ $consultancy->date }}</span>
                                    </div>
                                    <h3 class="mb-2 text-lg font-semibold text-gray-800">{{  \Illuminate\Support\Str::limit($consultancy->media_title, 45, '...') }}</h3>
                                    <p class="text-sm text-gray-600">{{  Str::limit($consultancy->media_description, 70, '...') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>

        {{-- <section id="blogs" class="container py-10 mx-auto mt-20 xl:px-0">
            <div class="px-4 mx-auto lg:px-8">
                <!-- Header -->
                <div class="flex items-center justify-between mb-8">
                    <h2 class="pb-1 text-3xl font-bold text-customOrangeDark">Our Latest Blog Posts</h2>

                </div>

                <div class="py-4">
                    <div class="swiper mySwiper1 pb-5">
                        <div class="swiper-wrapper">
                            @foreach ($data['blogs'] as $media)
                                <div class="swiper-slide">
                                    <div class="transition bg-white rounded-lg shadow hover:shadow-lg cursor-pointer">



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
                                            <h3 class="mb-2 text-lg font-semibold text-gray-800">{{ \Illuminate\Support\Str::limit($media->media_title, 45, '...') }}
                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                {{ \Illuminate\Support\Str::limit($media->media_description, 70, '...') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </section> --}}
    </div>
    <button data-modal-target="details-Modal" data-modal-toggle="details-Modal"></button>

    <x-modal id="details-Modal">
        <x-slot name="title">Details</x-slot>
        <x-slot name="modal_width">max-w-7xl</x-slot>
        <x-slot name="body">
            <div class="flex gap-6 lg:flex-row flex-col  ">
                <div class="flex justify-center" id="mediaOutput">
                    <img id="mediaImg" class="w-[500px] h-full" src="{{ asset('assets/default-logo-squere.png') }}"
                        alt="no img">
                </div>
                <div class="w-full">
                    <div class="flex justify-between w-full">
                        <h2 class="text-lg text-gray-800 font-semibold w-full" id="mediaAuthor"></h2>
                        <h2 class="text-lg text-gray-500 text-right w-full whitespace-nowrap" id="mediaDate"></h2>
                    </div>
                    <div class="mt-5">
                        <button class="text-customOrangeDark bg-orange-100 px-4 py-2 rounded-full font-semibold"
                            id="categoryName"></button>
                    </div>
                    <h2 class="text-xl font-semibold mt-4" id="mediaTitle"></h2>
                    <p class="mt-6 text-gray-500 text-sm" id="mediaDescription"></p>
                </div>
            </div>
        </x-slot>
    </x-modal>
@endsection

@section('js')
    <script>
        $(document).ready(function() {


            function detailFun() {

                $('.detailBtn').click(function() {
                    $('#details-Modal').removeClass("hidden").addClass('flex');
                    $('#mediaOutput').text('');

                    let mediaDetails = $(this);
                    $('#mediaTitle').text(mediaDetails.attr('mediaTitle'));
                    $('#mediaAuthor').text(mediaDetails.attr('mediaAuthor'));
                    $('#categoryName').text(mediaDetails.attr('mediaCategory'));
                    $('#mediaDate').text(mediaDetails.attr('mediaDate'));
                    $('#mediaDescription').text(mediaDetails.attr('mediaDescription'));

                    // $('#mediaImg').attr('src', mediaDetails.attr('mediaImage'));

                    let mediaUrl = $(this).attr('mediaImage');


                    let mediaContent;
                    if (mediaUrl && /\.(jpg|jpeg|png|gif|svg)$/i.test(mediaUrl)) {
                        mediaContent =
                            `<img class="w-[500px] h-full" id="dImage"  src="${mediaUrl}" alt="Media Image">`;
                    } else if (mediaUrl && /\.(mp4|webm|ogg)$/i.test(mediaUrl)) { // Check if it's a video
                        mediaContent =
                            `<video class="w-[500px] h-full" controls id="dImage" src="${mediaUrl}"></video>`;
                    } else {
                        mediaContent =
                            `<img id="mediaImg" class="w-[500px] h-full" src="{{ asset('assets/default-logo-squere.png') }}" alt="no img">`;
                    }

                    $('#mediaOutput').append(mediaContent)



                });
            }
            detailFun()
            $('.tabBtn').click(function() {

                detailFun()

            })
        })
    </script>
@endsection
