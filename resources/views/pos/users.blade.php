@extends('pos.layout')
@section('title')
    Users
@endsection
@section('content')


    <div class="w-full pt-10 min-h-[88vh] gradient-border  rounded-xl">
        <div class="flex justify-between px-5">
            <h1 class="text-3xl font-bold ">Users</h1>
        
        </div>
        @php
            $headers = ['Sr.' , 'Image', 'Name', 'Email', 'Phone No' , 'Status'];
        @endphp

        <x-table :headers="$headers">
            <x-slot name="tablebody">
            @foreach ($users as $user )
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td> <img class="h-20 w-20 object-cover rounded-full" src="{{$user->user_image ?? asset('assets/default-logo-1.png')}}" alt="user"></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->user_phone}}</td>
                    <td><span class="text-green-700 font-semibold">Active</span> </td>
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
