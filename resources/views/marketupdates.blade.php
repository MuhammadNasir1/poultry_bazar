@extends('layouts.layout')
@section('title')
    Market Updates
@endsection
@section('content')
    @php
        $user = session('user_details');
        $privileges = json_decode($user['user_privileges'], true)['permissions'] ?? [];
        $userRole = session('user_details')['user_role'];
    @endphp
    <div class="w-full pt-10 min-h-[88vh] gradient-border  rounded-lg">
        <div class="flex justify-between px-5">
            <h1 class="text-3xl font-bold ">Markets Rates</h1>

            <form id="marketHistoryForm" url="../api/getMarketHistory" method="POST">
                <div class="flex gap-5 items-end mb-3">
                    <div class="w-full min-w-20">
                        <x-select name="marketId" id="market" label="Market">
                            <x-slot name="options">
                                <option disabled selected>Select Market</option>
                                @foreach ($markets as $data)
                                    <option value="{{ $data['market_id'] }}">{{ $data['market_name'] }}</option>
                                @endforeach

                            </x-slot>
                        </x-select>
                    </div>
                    <div class="w-full min-w-20">
                        <x-select name="filterBy" id="filterBy" label="Filter By">
                            <x-slot name="options">
                                <option disabled selected>Select Filter</option>
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                            </x-slot>
                        </x-select>
                    </div>
                    <div class=" w-full">
                        <button
                            class="px-3 py-3 whitespace-nowrap   font-semibold text-white rounded-lg shadow-md gradient-bg">Filter
                            Data</button>
                    </div>
                </div>
            </form>

            @if ($userRole === 'superadmin' || isset($privileges['MarketsUpdates']['add']))
                {{-- <div class="flex gap-5">
                    <button
                        class="px-3 py-2 font-light text-[#B6B4B4] border-2 border-gray-200 rounded-full shadow-sm ">Clear
                        All </button>
                    <button class="px-3 py-2 font-semibold text-white rounded-full shadow-md gradient-bg">Update All
                    </button>
                </div> --}}
            @endif
        </div>
        @php
            $headers = ['Sr.', 'Markets', 'Rates', 'DOC ', 'Action'];
            // $headers = ['Sr.', 'Markets', 'Rates', 'Open ', 'Close ', 'DOC ', 'Action'];
        @endphp
        <x-table :headers="$headers">
            <x-slot name="tablebody">
                @foreach ($marketUpdates as $market)
                    <tr>

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $market->market_name }}</td>
                        <td>
                            <input type="hidden" name="market_id" value="{{ $market->market_id }}">
                            <input class="w-20 h-10 text-black rounded-md border-1" type="text" name="market_rate"
                                placeholder="00.0" value="{{ $market->market_rate ?? 0 }}" pattern="^\d+(\.\d+)?$">
                        </td>
                        <input class="w-20 h-10 text-black rounded-md border-1" type="hidden" name="market_openrate"
                            placeholder="00.0" value="{{ $market->market_openrate ?? 0 }}" pattern="^\d+(\.\d+)?$">
                        <input class="w-20 h-10 text-black rounded-md border-1" type="hidden" name="market_closerate"
                            placeholder="00.0" value="{{ $market->market_closerate ?? 0 }}" pattern="^\d+(\.\d+)?$">
                        <td>
                            <input class="w-20 h-10 text-black rounded-md border-1" type="text" name="market_doc"
                                placeholder="00.0" value="{{ $market->market_doc ?? 0 }}" pattern="^\d+(\.\d+)?$">
                        </td>
                        <td>
                            <span class="flex  gap-4">
                                @if ($userRole === 'superadmin' || isset($privileges['MarketsUpdates']['delete']))
                                    <button type="button"
                                        class="px-5 clearBtn py-2 font-light text-[#B6B4B4] border-2 border-gray-[#B6B4B4] rounded-full shadow-sm">
                                        Clear
                                    </button>
                                @endif
                                @if ($userRole === 'superadmin' || isset($privileges['MarketsUpdates']['edit']))
                                    <button type="button"
                                        class="px-5 updateBtn py-1 text-[13px] font-semibold text-white rounded-full shadow-md gradient-bg">
                                        Update
                                    </button>
                                @endif
                            </span>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>
        <form id="postDataForm" url="../updateMarketRates" method="POST">
            @csrf
            <input type="hidden" name="market_id" id="marketId">
            <input type="hidden" name="market_rate" id="marketRate">
            <input type="hidden" name="market_openrate" id="marketOpenRate">
            <input type="hidden" name="market_closerate" id="marketCloseRate">
            <input type="hidden" name="market_doc" id="marketDoc">
        </form>


    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#marketHistoryForm").submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: $(this).attr("url"),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);

                        if (response.success && response.data.length > 0) {
                            const tableBody = $('#datatable tbody'); // Select the table body

                            // Clear existing rows
                            tableBody.empty();

                            // Loop through the new data and add rows
                            response.data.forEach(item => {
                                const newRow = `
                <tr>
                    <td>${item.market_history_id}</td>
                    <td>${item.market_name}</td>
                    <td>
                        <input type="hidden" name="market_id" value="${item.market_id}">
                        <input class="w-20 h-10 text-black rounded-md border-1" type="text" name="market_rate"
                            placeholder="00.0" value="${item.market_rate ?? 0}" pattern="^\d+(\.\d+)?$">
                    </td>
                    <input class="w-20 h-10 text-black rounded-md border-1" type="hidden" name="market_openrate"
                        placeholder="00.0" value="${item.market_openrate ?? 0}" pattern="^\d+(\.\d+)?$">
                    <input class="w-20 h-10 text-black rounded-md border-1" type="hidden" name="market_closerate"
                        placeholder="00.0" value="${item.market_closerate ?? 0}" pattern="^\d+(\.\d+)?$">
                    <td>
                        <input class="w-20 h-10 text-black rounded-md border-1" type="text" name="market_doc"
                            placeholder="00.0" value="${item.market_doc ?? 0}" pattern="^\d+(\.\d+)?$">
                    </td>
                    <td>
                        <span class="flex gap-4">
                           
                        </span>
                    </td>
                </tr>
            `;
                                tableBody.append(newRow); // Append the new row
                            });
                        }
                    }

                });
            });

        })

        function clearInputs(button) {
            const row = button.closest('tr');
            row.querySelectorAll('input[type="text"]').forEach(input => {
                input.value = '0';
            });
        }

        function updateDatafun() {
            $('.updateBtn').click(function() {
                const row = $(this).closest('tr');
                $('#marketId').val(row.find('input[name="market_id"]').val());
                $('#marketRate').val(row.find('input[name="market_rate"]').val());
                $('#marketOpenRate').val(row.find('input[name="market_openrate"]').val());
                $('#marketCloseRate').val(row.find('input[name="market_closerate"]').val());
                $('#marketDoc').val(row.find('input[name="market_doc"]').val());
                $('#postDataForm').submit();

            })
            $('.clearBtn').click(function() {
                let row = $(this).closest('tr');
                $('#marketId').val(row.find('input[name="market_id"]').val());
                $('#marketRate').val(0);
                $('#marketOpenRate').val(0);
                $('#marketCloseRate').val(0);
                $('#marketDoc').val(0);
                row.find('input[type="text"]').each(function() {
                    $(this).val('0');
                });
                $('#postDataForm').submit();

            })

        }
        updateDatafun();

        // Listen for the custom form submission response event
        $(document).on("formSubmissionResponse", function(event, response, Alert, SuccessAlert, WarningAlert) {
            if (response.success) {
                updateDatafun();
            } else {}

        });
    </script>
@endsection
