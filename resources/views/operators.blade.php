@extends('layouts.layout')
@section('title')
    Operators
@endsection
@section('content')
    <div class="w-full pt-10 min-h-[88vh] gradient-border  rounded-lg">
        <div>
            <h1 class="text-3xl font-bold ps-5">Operators</h1>
        </div>
        @php
            $headers = ['Sr.', 'Image', 'Name', 'Email', 'Phone Number', 'User Role' , 'status', 'Action'];
        @endphp

        <x-table :headers="$headers">
            <x-slot name="tablebody">
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img class="h-20 w-20 rounded-full bg-customOrangeDark object-cover  gradient-border"
                                src="{{$user->user_image ?? asset('assets/default-logo-1.png') }}"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->user_phone }}</td>
                        <td>{{ $user->user_role }}</td>
                        <td><button class="changeStatusBtn" data-modal-target="status-modal" data-modal-toggle="status-modal"
                                userId="{{ $user->id }}"
                                status="{{ $user->user_status }}">{!! $user->user_status == 1
                                    ? "<span class='text-blue-500'>Active</span>"
                                    : "<span class='text-red-600'>In-Active</span>" !!}</button>
                        </td>
                        <td>
                            <span class='flex justify-center'>
                                <a href="../priveleges/{{ $user->id }}">
                                    <button>
                                        <img src="{{ asset('assets/icons/edit icon.png') }}" alt=''>
                                    </button>
                                </a>
                            </span>
                        </td>
                    </tr>
                @endforeach

            </x-slot>
        </x-table>
    </div>
    
    <x-modal id="status-modal">
        <x-slot name="title">Change Status</x-slot>
        <x-slot name="modal_width">max-w-xl</x-slot>
        <x-slot name="body">
            <form id="postDataForm" url="updateUserStatus" method="post">
                @csrf
                <input type="hidden" class="text" id="userId" name="user_id">
                <div>
                    <x-select name="user_status" id="status" label="Select Status">
                        <x-slot name="options">
                            <option disabled selected>Select status</option>
                            <option value="1">Active</option>
                            <option value="0">In-Active</option>
                        </x-slot>

                    </x-select>
                </div>
                <div class="mt-4">
                    <x-modal-button title="Change"></x-modal-button>
                </div>
            </form>
        </x-slot>
    </x-modal>
@endsection
@section('js')
    <script>
        function changeStatusFun() {

            $('.changeStatusBtn').click(function() {
                console.log('buttonclick')
                $('#userId').val($(this).attr('userId'));
                $('#status').val($(this).attr('status')).trigger('change');

                $('#status-modal').addClass('flex').removeClass('hidden');
            })
        }
        changeStatusFun()

        function updateDatafun() {
            changeStatusFun()

        }
        updateDatafun();
        $(document).on("formSubmissionResponse", function(event, response, Alert, SuccessAlert, WarningAlert) {
            // console.log(response);

            if (response.success) {
                $('.modalCloseBtn').click();
            } else {}
        });
    </script>
@endsection
