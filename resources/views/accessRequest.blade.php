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
                            <span
                                class="inline-block px-2 py-1 text-xs font-semibold rounded-full cursor-pointer change-status"
                                data-id="{{ $data->access_id }}" data-status="{{ $data->access_status }}"
                                {{ $data->access_status == 1 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $data->access_status == 1 ? 'Approved' : 'Pending' }}
                            </span>
                        </td>

                    </tr>
                @endforeach
            </x-slot>
        </x-table>
    </div>
@endsection

@section('js')
    <script>
        $(document).on('click', '.change-status', function() {
            const requestId = $(this).data('id');
            const currentStatus = $(this).data('status');

            Swal.fire({
                title: 'Change Status',
                text: "Do you want to change the status of this request?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/changeAccessRequest', 
                        method: 'POST',
                        data: {
                            id: requestId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire('Updated!', response.message, 'success').then(() => {
                                location.reload(); 
                            });
                        },
                        error: function() {
                            Swal.fire('Error!', 'Failed to change status.', 'error');
                        }
                    });
                }
            });
        }); 
    </script>

@endsection
