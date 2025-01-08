@extends('layouts.layout')
@section('title')
    Pending Media
@endsection
@section('content')
    <div class="w-full pt-10 min-h-[88vh] gradient-border rounded-lg">
        <div class="flex justify-between px-5">
            <div class="flex gap-5">
                <div>
                    <h1 class="text-3xl font-bold">Pending Media</h1>
                </div>

            </div>

        </div>
        <button data-modal-target='view-modal' data-modal-toggle='view-modal'></button>
        <div id="categoryTable" class="transition-opacity duration-500 ">
            @php
                $headers = [
                    'Sr.',
                    'Title',
                    'Description',
                    'Category',
                    'Date',
                    'Author',
                    'Status',
                    'Action',
                ];
            @endphp

            <x-table :headers="$headers">
                <x-slot name="tablebody">
                    @foreach ($media as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            {{-- <td class="whitespace-nowrap">{{ $data->added_username }}</td> --}}
                            {{-- <td>{{ $username =App\Models\User::select('name')->where('id' , $data->added_user_id)->first();  }}</td> --}}

                            <td class='text-xs xl:text-[15px]'>{{ $data->media_title }}</td>
                            <td class='text-xs xl:text-[15px] min-w-[280px]'>
                                {{ \Illuminate\Support\Str::limit($data->media_description, 60, '...') }}</td>
                            <td class='text-sm xl:text-[15px] whitespace-nowrap'>{{ $data->category_name }}</td>
                            <td class='text-sm xl:text-[15px] whitespace-nowrap'>{{ $data->date }} </td>
                            <td class='text-sm xl:text-[15px] whitespace-nowrap'>{{ $data->media_author }}</td>
                            <td class='text-sm xl:text-[15px] whitespace-nowrap'><button
                                    class="text-red-600 font-semibold">Pending</button></td>

                            <td>
                                <span class='flex gap-4'>

                                    <button mediaTitle="{{ $data->media_title }}" mediaAuthor="{{ $data->media_author }}"
                                        mediaCategory="{{ $data->category_name }}" mediaCategoryId={{ $data->category_id }}
                                        mediaDate="{{ $data->date }}" mediaDescription="{{ $data->media_description }}"
                                        mediaId="{{ $data->media_id }}"
                                        mediaImage="{{ $data->media_image ?? asset('assets/default-logo-req.png') }}"
                                        class="viewModalBtn">
                                        <svg width='37' height='36' viewBox='0 0 37 36' fill='none'
                                            xmlns='http://www.w3.org/2000/svg'>
                                            <path fill-rule='evenodd' clip-rule='evenodd'
                                                d='M28.0642 18.5C28.0642 18.126 27.8621 17.8812 27.4579 17.3896C25.9788 15.5938 22.7163 12.25 18.9288 12.25C15.1413 12.25 11.8788 15.5938 10.3996 17.3896C9.99542 17.8812 9.79333 18.126 9.79333 18.5C9.79333 18.874 9.99542 19.1187 10.3996 19.6104C11.8788 21.4062 15.1413 24.75 18.9288 24.75C22.7163 24.75 25.9788 21.4062 27.4579 19.6104C27.8621 19.1187 28.0642 18.874 28.0642 18.5ZM18.9288 21.625C19.7576 21.625 20.5524 21.2958 21.1385 20.7097C21.7245 20.1237 22.0538 19.3288 22.0538 18.5C22.0538 17.6712 21.7245 16.8763 21.1385 16.2903C20.5524 15.7042 19.7576 15.375 18.9288 15.375C18.0999 15.375 17.3051 15.7042 16.719 16.2903C16.133 16.8763 15.8038 17.6712 15.8038 18.5C15.8038 19.3288 16.133 20.1237 16.719 20.7097C17.3051 21.2958 18.0999 21.625 18.9288 21.625Z'
                                                fill='url(#paint0_linear_872_5570)' />
                                            <circle opacity='0.1' cx='18.4287' cy='18' r='18'
                                                fill='url(#paint1_linear_872_5570)' />
                                            <defs>
                                                <linearGradient id='paint0_linear_872_5570' x1='18.9288' y1='12.25'
                                                    x2='18.9288' y2='24.75' gradientUnits='userSpaceOnUse'>
                                                    <stop stop-color='#FCB376' />
                                                    <stop offset='1' stop-color='#FE8A29' />
                                                </linearGradient>
                                                <linearGradient id='paint1_linear_872_5570' x1='18.4287' y1='0'
                                                    x2='18.4287' y2='36' gradientUnits='userSpaceOnUse'>
                                                    <stop stop-color='#FCB376' />
                                                    <stop offset='1' stop-color='#FE8A29' />F
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </button>
                                    <button
                                        class="text-sm bg-green-800 text-white py-3 px-4 font-semibold rounded-xl approveMediaBtn whitespace-nowrap"
                                        Id="{{ $data->media_id }}">Approve Media</button>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
        </div>
        <x-modal id="view-modal">
            <x-slot name="title">Details </x-slot>
            <x-slot name="modal_width">max-w-4xl</x-slot>
            <x-slot name="body">
                <div class="p-6">
                    <div class="flex">
                        <!-- Image Placeholder -->

                        <div id="mediaOutput">

                        </div>


                        <!-- Text Details -->
                        <div class="ml-5">
                            <h3 class="text-xl font-semibold text-gray-800" id="dTitle"></h3>

                            <div class="grid grid-cols-2 mt-5 md:grid-cols-3 ">
                                <div class="min-w-10">
                                    <p class="text-[12.9px] lg:text-lg md:text-lg">Category:</p>
                                    <p class="mt-4 text-[12.9px] lg:text-lg md:text-lg">Author:</p>
                                    <p class="mt-4 text-[12.9px] lg:text-lg md:text-lg">Date:</p>
                                </div>
                                <div class="min-w-10 md:col-span-2 ">
                                    <p class=" text-[#323C47] text-[12.9px] lg:text-lg md:text-lg" id="dCategory"></p>
                                    <p class="mt-4 text-[#323C47] text-[12.9px] lg:text-lg md:text-lg" id="dAuthor"></p>
                                    <p class="mt-4 text-[#323C47] text-[12.9px] lg:text-lg md:text-lg" id="dDate"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <h4 class="text-lg font-semibold text-gray-800">Description:</h4>
                        <p class="mt-2 text-sm text-gray-600" id="dDescription"></p>
                    </div>
                </div>
            </x-slot>
        </x-modal>
    @endsection
    @section('js')
        <script>
            function viewData() {
                let table = $("#datatable").DataTable();
                $(".approveMediaBtn").click(function() {
                    let csrfToken = $('meta[name="csrf-token"]').attr("content");
                    let id = $(this).attr("Id");
                    let dynamicKey = "media_id";
                    let Data = {};
                    Data[dynamicKey] = id;
                    // Show SweetAlert  confirmation dialog
                    Swal.fire({
                        title: "Change status to approved",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "green",
                        cancelButtonColor: "gray",
                        confirmButtonText: "Yes, Change it!",

                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If confirmed, proceed with AJAX request to delete
                            $.ajax({
                                type: "POST",
                                url: "../approveMedia",
                                data: Data,
                                headers: {
                                    "X-CSRF-TOKEN": csrfToken,
                                },
                                beforeSend: function() {},
                                success: function(response) {
                                    table.destroy();
                                    let currentValue = parseInt($('#pendingMediaCount').text());
                                    let updatedValue = currentValue - 1;
                                    $('#pendingMediaCount').text(updatedValue);

                                    
                                    $("#tableBody").load(" #tableBody > *", function() {
                                        updateDatafun();
                                        $("#datatable").DataTable();
                                    });
                                    const alert = Swal.fire({
                                        title: "Status Changed!",
                                        text: response.message,
                                        icon: "success",
                                    });

                                    $(document).trigger("formSubmissionResponse", [
                                        response,
                                        alert,
                                    ]);
                                },
                                error: function(xhr) {
                                    $("#loading").hide();
                                    Swal.fire({
                                        title: "Error!",
                                        text: "There was an error in change  status.",
                                        icon: "error",
                                    });
                                },
                            });
                        }
                    });
                });


                $('.viewModalBtn').click(function() {
                    $('#mediaOutput').html('');
                    $('#view-modal').addClass('flex').removeClass('hidden');
                    $('#dTitle').text($(this).attr('mediaTitle'));
                    $('#dAuthor').text($(this).attr('mediaAuthor'));
                    $('#dCategory').text($(this).attr('mediaCategory'));
                    $('#dDate').text($(this).attr('mediaDate'));
                    $('#dDescription').text($(this).attr('mediaDescription'));
                    let mediaUrl = $(this).attr('mediaImage'); 
                    let mediaContent;
                    if (mediaUrl && /\.(jpg|jpeg|png|gif|svg)$/i.test(mediaUrl)) {
                         mediaContent = `<img class="w-40 h-40 bg-black object-contain" id="dImage"  src="${mediaUrl}" alt="Media Image">`;
                    } else if (mediaUrl && /\.(mp4|webm|ogg)$/i.test(mediaUrl)) { // Check if it's a video
                        mediaContent = `<video class="w-52 h-48 bg-black object-contain" controls id="dImage" src="${mediaUrl}"></video>`;
                    } else {
                        mediaContent = `<img class="w-40 h-40 bg-black object-contain" id="dImage" src="{{asset('assets/default-logo-req.png')}}" alt="Media Image">`;
                    }

                    $('#mediaOutput').append(mediaContent)
                });

            }
            viewData()

            function updateDatafun() {
                viewData();
                
            }
            updateDatafun();

            // Listen for the custom form submission response event
            $(document).on("formSubmissionResponse", function(event, response, Alert, SuccessAlert, WarningAlert) {
                // console.log(response);
                if (response.success) {

                    $('.modalCloseBtn').click();
                } else {}
            });
        </script>
    @endsection
