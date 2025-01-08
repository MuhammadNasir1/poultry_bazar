@extends('pos.layout')
@section('title')
    Shops
@endsection
@section('content')


    <div class="w-full pt-10 min-h-[88vh] gradient-border  rounded-xl">
        <div class="flex justify-between px-5">
            <h1 class="text-3xl font-bold ">shops</h1>
        
        </div>
        @php
            $headers = ['Sr.' , 'Logo', 'Shop Name', 'Shop Owner', 'Phone No', 'Address' ,'Status'];
        @endphp

        <x-table :headers="$headers">
            <x-slot name="tablebody">
                @foreach ($companies as $company )
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><img class="h-20 w-20 rounded-full object-cover" src="{{$company->company_logo ?? url(asset('assets/default-logo-1.png'))}}" alt=""></td>
                        <td>{{$company->company_name}}</td>
                        <td>{{$company->company_owner}}</td>
                        <td>{{$company->company_phone}}</td>
                        <td>{{$company->company_address}}</td>
                        <td><button class="font-semibold">{!!$company->company_status = 1 ? "<span class='text-green-800'>Active</span>"  : "<span class='text-red-600'>Pending</span>"   !!}</button></td>
                    </tr>
                @endforeach

            </x-slot>
        </x-table>


    
     
    </div>
@endsection
@section('js')
   <script>
 

        function updateDatafun() {
         
        }



        // Listen for the custom form submission response event
        $(document).on("formSubmissionResponse", function(event, response, Alert, SuccessAlert, WarningAlert) {
            // console.log(response);
            if (response.success) {

                $('.modalCloseBtn').click();
            } else {}
        });
    </script>
@endsection
