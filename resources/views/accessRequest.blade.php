@extends('layouts.layout')
@section('title', 'Access Request')

@section('content')
    <div class="w-full pt-10 min-h-[88vh] gradient-border  rounded-lg">
        <div class="flex justify-between px-5">
            <h1 class="text-3xl font-bold ">Access Requests</h1>
        </div>
        @php
            $headers = ['Sr.', 'User Name', 'User Email', 'User Phone', 'Access Module', 'Access Status'];

        @endphp

        <x-table :headers="$headers">
            <x-slot name="tablebody">
                @foreach ($access_requests as $data)
                    <tr>
                        <td class="text-xs">{{ $loop->iteration }}</td>
                        <td class="text-xs">{{ $data->user_name }}</td>
                        <td class="text-xs">{{ $data->user_email }}</td>
                        <td class="text-xs">{{ $data->user_phone }}</td>
                        <td class="text-xs">{{ $data->module->module_name }}</td>


                        <td class="text-xs">
                            <span data-modal-target="status-modal" data-modal-toggle="status-modal"
                                class="inline-block px-2 py-1 text-xs font-semibold rounded-full cursor-pointer change-status"
                                data-id="{{ $data->access_id }}" data-module="{{ $data->access_module }}"
                                data-user="{{ $data->user_id }}" data-status="{{ $data->access_status }}"
                                {{ $data->access_status == 1 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $data->access_status == 1 ? 'Approved' : 'Pending' }}
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
            {{-- <form id="postDataForm" url="../changeAccessRequest" method="post"> --}}
            <form  action="../changeAccessRequest" method="post">
                @csrf
                <input type="hidden" name="user_id" id="userId">
                <input type="hidden" name="module_id" id="moduleId">
                <input type="hidden" name="access_id" id="accessId">
                <input type="hidden" name="status" id="status">
                <div>
                    <x-select name="user_status" id="status" label="Select Status">
                        <x-slot name="options">
                            <option disabled selected>Select status</option>
                            <option value="1">Pending</option>
                            <option value="0">Approved</option>
                            <option value="2">Cancel</option>
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
        $(document).on('click', '.change-status', function() {
            $('#status-modal').addClass('flex').removeClass('hidden');
            $("#accessId").val($(this).data('id'));
            $("#moduleId").val($(this).data('module'));
            $("#userId").val($(this).data('user'));
            $("#status").val($(this).data('status'));



        });
    </script>

@endsection
