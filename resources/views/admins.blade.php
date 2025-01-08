@extends('layouts.layout')
@section('title')
Admins
@endsection
@section('content')
    <div class="w-full pt-10 min-h-[88vh] gradient-border  rounded-lg">
        <div>
            <h1 class="text-3xl font-bold ps-5">Admins</h1>
        </div>
        @php
            $headers = ['Sr.', 'Image', 'Name', 'Email', 'Phone Number', 'User Role'];
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
                      
                      
                    </tr>
                @endforeach

            </x-slot>
        </x-table>
    </div>

  
@endsection
