@extends('layouts.layout')
@section('title')
    Subcription
@endsection
@section('content')
    @php

        $user = session('user_details');
        $privileges = json_decode($user['user_privileges'], true)['permissions'] ?? [];
        $userRole = session('user_details')['user_role'];

    @endphp
    <div class="w-full pt-10 min-h-[88vh] gradient-border  rounded-lg">
        <div class="flex justify-between px-5">
            <h1 class="text-3xl font-bold ">Subcription Plans</h1>
            @if ($userRole === 'superadmin' || isset($privileges['Subscription']['add']))
                <button id="addModalBtn" data-modal-target="subscription-modal" data-modal-toggle="subscription-modal"
                    class="px-4 py-3 font-semibold text-white rounded-full shadow-md gradient-bg">Add Subcription </button>
            @endif
        </div>
        @php
            $headers = ['Sr.', 'Name', 'Price', 'Description', 'Action'];
            $body = '';
        @endphp

        <x-table :headers="$headers" :body="$body">
            <x-slot name="tablebody">

                <tr>

                    <td>1</td>
                    <td>Basic</td>
                    <td>20$</td>
                    <td>Lorem ipsum dolor sit</td>
                    <td>
                        <span class='flex gap-4'>

                            @if ($userRole === 'superadmin' || isset($privileges['Subscription']['edit']))
                                <button class="updateDataBtn">
                                    <svg width='36' height='36' viewBox='0 0 36 36' fill='none'
                                        xmlns='http://www.w3.org/2000/svg'>
                                        <circle opacity='0.1' cx='18' cy='18' r='18' fill='#233A85' />
                                        <path fill-rule='evenodd' clip-rule='evenodd'
                                            d='M16.1637 23.6188L22.3141 15.665C22.6484 15.2361 22.7673 14.7402 22.6558 14.2353C22.5593 13.7763 22.277 13.3399 21.8536 13.0088L20.8211 12.1886C19.9223 11.4737 18.8081 11.549 18.1693 12.3692L17.4784 13.2654C17.3893 13.3775 17.4116 13.543 17.523 13.6333C17.523 13.6333 19.2686 15.0329 19.3058 15.063C19.4246 15.1759 19.5137 15.3264 19.536 15.507C19.5732 15.8607 19.328 16.1918 18.9641 16.2369C18.7932 16.2595 18.6298 16.2068 18.511 16.109L16.6762 14.6492C16.5871 14.5822 16.4534 14.5965 16.3791 14.6868L12.0188 20.3304C11.7365 20.6841 11.64 21.1431 11.7365 21.5871L12.2936 24.0025C12.3233 24.1304 12.4348 24.2207 12.5685 24.2207L15.0197 24.1906C15.4654 24.1831 15.8814 23.9799 16.1637 23.6188ZM19.5958 22.8672H23.5929C23.9829 22.8672 24.3 23.1885 24.3 23.5835C24.3 23.9794 23.9829 24.2999 23.5929 24.2999H19.5958C19.2059 24.2999 18.8887 23.9794 18.8887 23.5835C18.8887 23.1885 19.2059 22.8672 19.5958 22.8672Z'
                                            fill='#233A85' />
                                    </svg>
                                </button>
                            @endif
                            @if ($userRole === 'superadmin' || isset($privileges['Subscription']['delete']))
                                <button class="deleteDataBtn" delId="">
                                    <svg width='36' height='36' viewBox='0 0 36 36' fill='none'
                                        xmlns='http://www.w3.org/2000/svg'>
                                        <circle opacity='0.1' cx='18' cy='18' r='18' fill='#DF6F79' />
                                        <path fill-rule='evenodd' clip-rule='evenodd'
                                            d='M23.4905 13.7423C23.7356 13.7423 23.9396 13.9458 23.9396 14.2047V14.4441C23.9396 14.6967 23.7356 14.9065 23.4905 14.9065H13.0493C12.8036 14.9065 12.5996 14.6967 12.5996 14.4441V14.2047C12.5996 13.9458 12.8036 13.7423 13.0493 13.7423H14.8862C15.2594 13.7423 15.5841 13.4771 15.6681 13.1028L15.7642 12.6732C15.9137 12.0879 16.4058 11.6992 16.9688 11.6992H19.5704C20.1273 11.6992 20.6249 12.0879 20.7688 12.6423L20.8718 13.1022C20.9551 13.4771 21.2798 13.7423 21.6536 13.7423H23.4905ZM22.557 22.4932C22.7487 20.7059 23.0845 16.4598 23.0845 16.4169C23.0968 16.2871 23.0545 16.1643 22.9705 16.0654C22.8805 15.9728 22.7665 15.918 22.6409 15.918H13.9025C13.7762 15.918 13.6562 15.9728 13.5728 16.0654C13.4883 16.1643 13.4466 16.2871 13.4527 16.4169C13.4539 16.4248 13.4659 16.5744 13.4861 16.8244C13.5755 17.9353 13.8248 21.0292 13.9858 22.4932C14.0998 23.5718 14.8074 24.2496 15.8325 24.2742C16.6235 24.2925 17.4384 24.2988 18.2717 24.2988C19.0566 24.2988 19.8537 24.2925 20.6692 24.2742C21.7298 24.2559 22.4369 23.59 22.557 22.4932Z'
                                            fill='#D11A2A' />
                                    </svg>
                                </button>
                            @endif

                        </span>
                    </td>
                </tr>

            </x-slot>
        </x-table>

        <x-modal id="subscription-modal">
            <x-slot name="title">Add Subcription</x-slot>
            <x-slot name="modal_width">max-w-2xl</x-slot>
            <x-slot name="body">
                <form id="postDataForm" url="saveCities" method="post">
                    @csrf
                    <input type="hidden" class="text" id="updateId" name="city_id">
                    <div class="grid grid-cols-2 gap-4">
                        <x-input id="" label="Name" placeholder="Enter Subcription Name" name=''
                            type="text"></x-input>
                        <x-input id="" label="Price" placeholder="Enter Subcription Price" name=''
                            type="text"></x-input>
                        <div class="col-span-2">
                            <x-textarea id="" label="Description" placeholder="Enter Subcription Description"
                                name='' type="text"></x-textarea>
                        </div>
                        <div class="col-span-2" id="planOutput">

                            <div class="flex gap-2 w-full  items-end">
                                <x-input id="" label="Plan Options" placeholder="Enter Plan Options" name=''
                                    type="text"></x-input>
                                <button type="button"
                                    class="h-[40px] font-bold w-[40px] gradient-bg text-white  rounded-md text-2xl"
                                    id="addPlanBtn">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-modal-button :title="'Add City'"></x-modal-button>
                    </div>
                </form>
            </x-slot>
        </x-modal>
    </div>
@endsection

@section('js')
    <script>
        $('#addPlanBtn').click(function() {
            let input = `<div class="flex gap-2 w-full  items-end mt-2">
                                <x-input id="" label="Plan Options" placeholder="Enter Plan Options" name=''
                                    type="text"></x-input>
                                <button type="button"
                                    class="h-[40px] font-bold w-[40px] bg-red-600  rounded-md flex justify-center items-center removeInput " id="addPlanBtn"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></button>
                            </div>`


            $('#planOutput').append(input);



        })
        $('#planOutput').on('click', '.removeInput', function() {
            $(this).closest('div').remove(); // Removes the parent container of the clicked button
        });

        function updateDatafun() {

            $('.updateDataBtn').click(function() {
                $('#subscription-modal').removeClass("hidden");
                $('#subscription-modal').addClass('flex');
                $('#cityName').val($(this).attr('cityName'));
                $('#cityProvince').val($(this).attr('cityProvince'));
                $('#updateId').val($(this).attr('cityId'));

                $('#subscription-modal #modalTitle').text("Update Subcription");
                $('#subscription-modal #submitBtn').text("Update");

            });
        }
        updateDatafun();
        $('#addModalBtn').click(function() {
            $('#postDataForm')[0].reset();
            $('#subscription-modal #modalTitle').text("Add Subcription");
            $('#subscription-modal #submitBtn').text("Add");

        })
        // Listen for the custom form submission response event
        $(document).on("formSubmissionResponse", function(event, response, Alert, SuccessAlert, WarningAlert) {
            // console.log(response);

            if (response.success) {
                updateDatafun();
                $('.modalCloseBtn').click();
            } else {}
        });
    </script>
@endsection
