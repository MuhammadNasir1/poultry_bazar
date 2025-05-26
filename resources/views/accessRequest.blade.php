@extends('layouts.layout')
@section('title', 'Access Request')

@section('content')
    <div class="w-full pt-10 min-h-[88vh] gradient-border  rounded-lg">
        <div class="flex justify-between px-5">
            <h1 class="text-3xl font-bold ">Access Requests</h1>
        </div>
        @php
            $headers = [
                'Sr.',
                'User Name',
                'User Email',
                'User Phone',
                'Expires',
                'Access Module',
                'Request Date',
                'Access Status',
            ];

        @endphp

        <x-table :headers="$headers">
            <x-slot name="tablebody">
                @foreach ($access_requests as $data)
                    <tr>
                        <td class="text-xs">{{ $loop->iteration }}</td>
                        <td class="text-xs">{{ $data->user_name }}</td>
                        <td class="text-xs">{{ $data->user_email }}</td>
                        <td class="text-xs">{{ $data->user_phone }}</td>
                        <td class="text-xs"><span class="font-semibold text-red-700">{{ $data->days_left ?? 0 }}</span> Days
                            Left</td>
                        <td class="text-xs">{{ $data->module->module_name }}</td>
                        <td class="text-xs">{{ $data->created_at->format('M d, Y') }}</td>


                            
                        <td class="text-xs">
                            @php
                                $status = (int) $data->access_status;
                                $statusClasses = [
                                    0 => 'bg-yellow-100 text-yellow-800',
                                    1 => 'bg-green-100 text-green-800',
                                    2 => 'bg-red-100 text-red-800',
                                ];
                                $statusLabels = [
                                    0 => 'Pending',
                                    1 => 'Approved',
                                    2 => 'Canceled',
                                ];
                            @endphp

                            <span data-modal-target="status-modal" data-modal-toggle="status-modal"
                                class="inline-block px-2 py-1 text-xs font-semibold rounded-full cursor-pointer change-status {{ $statusClasses[$status] }}"
                                data-id="{{ $data->access_id }}" data-module="{{ $data->access_module }}"
                                data-user="{{ $data->user_id }}">
                                {{ $statusLabels[$status] }}
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
            <form id="postDataForm" url="../changeAccessRequest" method="post">
                {{-- <form  action="../changeAccessRequest" method="post"> --}}
                @csrf
                <input type="hidden" name="user_id" id="userId">
                <input type="hidden" name="module_id" id="moduleId">
                <input type="hidden" name="access_id" id="accessId">
                <input type="hidden" name="status" id="status">
                <div>
                    <x-select name="status" id="statusDropdown" label="Select Status">
                        <x-slot name="options">
                            <option disabled selected>Select status</option>
                            <option value="0">Pending</option>
                            <option value="1">Approved</option>
                            <option value="2">Cancel</option>
                        </x-slot>
                    </x-select>
                </div>

                <div id="durationSection" class="mt-4 hidden">
                    <div class="flex gap-6">
                        <div class="flex items-center me-4">
                            <input id="one-month" type="radio" value="1" name="duration"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-2 focus:ring-blue-500 ring-offset-0">
                            <label for="one-month" class="ms-2 text-sm font-medium text-gray-900">1 Month</label>
                        </div>
                        <div class="flex items-center me-4">
                            <input id="three-month" type="radio" value="3" name="duration"
                                class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-2 focus:ring-green-500 ring-offset-0">
                            <label for="three-month" class="ms-2 text-sm font-medium text-gray-900">3 Months</label>
                        </div>
                    </div>
                    <div class="flex gap-4 mt-4">
                        <x-input name="access_start_date" id="startDate" label="Start Date" type="date"
                            placeholder="Today" class="mt-4" />
                        <x-input name="access_end_date" id="endDate" label="End Date" type="date" placeholder="Today"
                            class="mt-4" />
                    </div>
                </div>



                <div class="mt-4">
                    <x-modal-button title="Apply Changes"></x-modal-button>
                </div>
            </form>
        </x-slot>
    </x-modal>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('#statusDropdown').on('change', function() {
                console.log('Status changed');

                const selectedStatus = $(this).val();

                if (selectedStatus === "1") {
                    $('#durationSection').removeClass('hidden');
                    $('#startDate').attr('required', true);
                    $('#endDate').attr('required', true);
                } else {
                    $('#durationSection').addClass('hidden');

                    // Clear radio selection
                    $('input[name="duration"]').prop('checked', false);

                    // Clear date fields
                    $('#startDate').val('');
                    $('#endDate').val('');

                    // Remove required attribute to avoid validation errors
                    $('#startDate').removeAttr('required');
                    $('#endDate').removeAttr('required');
                }

            });

            $('input[name="duration"]').on('change', function() {
                const duration = $(this).val();

                const today = new Date();
                const endDate = new Date(today);
                endDate.setMonth(endDate.getMonth() + parseInt(duration));

                const formatDate = (date) => {
                    const yyyy = date.getFullYear();
                    const mm = String(date.getMonth() + 1).padStart(2, '0');
                    const dd = String(date.getDate()).padStart(2, '0');
                    return `${yyyy}-${mm}-${dd}`;
                };

                $('#startDate').val(formatDate(today));
                $('#endDate').val(formatDate(endDate));
            });
        });
        $(document).on('click', '.change-status', function() {
            $('#status-modal').addClass('flex').removeClass('hidden');
            $("#accessId").val($(this).data('id'));
            $("#moduleId").val($(this).data('module'));
            $("#userId").val($(this).data('user'));



        });

        function updateDatafun() {}

        $(document).on("formSubmissionResponse", function(event, response, Alert, SuccessAlert, WarningAlert) {
            if (response.success) {
                $('.modalCloseBtn').click();
            } else {}
        });
    </script>

@endsection
