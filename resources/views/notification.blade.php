@extends('layouts.layout')
@section('title')
    Blogs
@endsection
@section('content')
    <div class="w-full pt-10 min-h-[88vh] gradient-border  rounded-lg">
        <div class="flex justify-between px-5">
            <h1 class="text-3xl font-bold ">Notifications</h1>
            @if (session('user_details')['user_role'] == 'superadmin')
                <button data-modal-target="blog-modal" data-modal-toggle="blog-modal"
                    class="px-3 py-2 font-semibold text-white rounded-full shadow-md gradient-bg">Add New + </button>
            @endif
        </div>
        @php
            $headers = [''];
        @endphp

        <x-table :headers="$headers">
            <x-slot name="tablebody">
                <tr>
                    <td>
                        @foreach ($notifications as $notification)
                            <div class="p-4 bg-gray-100 rounded shadow mb-5">
                                <h3 class="text-lg font-semibold text-gray-800 flex items-center">{{ $notification->notification_title }}   <Button class="{{$notification->notification_type == "important" ? "bg-red-600" : "bg-green-800"}} text-white font-semibold text-sm px-2 rounded-full ml-2">{{$notification->notification_type}}</Button></h3>
                                <p class="mt-1 text-sm text-gray-600">{{ $notification->notification_description }}</p>
                            
                            
                            </div>  
                        @endforeach
                    </td>
                </tr>
            </x-slot>
        </x-table>


        <x-modal id="blog-modal">
            <x-slot name="title">Add Notifications </x-slot>
            <x-slot name="modal_width">max-w-4xl</x-slot>
            <x-slot name="body">
                <form id="postDataForm" url="addNotification" method="post">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <x-input id="NotificationTitle" label="Notification Title" placeholder="Enter Title"
                            name='notification_title' type="text"></x-input>
                        <x-select name="notification_type" id="NotificationType" label="Notification Type">
                            <x-slot name="options">
                                <option disabled selected>Select Notification Type</option>
                                <option value="important">Important</option>
                            </x-slot>
                        </x-select>
                        <div class="col-span-2">
                            <x-textarea id="NotificationDescription" label="Notification Description"
                                placeholder="Enter Description" name='notification_description' type="text"></x-textarea>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-modal-button :title="'Add Notification '"></x-modal-button>
                    </div>

                </form>
            </x-slot>
        </x-modal>

    </div>
@endsection

@section('js')
    <script>
        function updateDatafun() {

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
