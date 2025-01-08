@extends('layouts.layout')
@section('title')
    Queries
@endsection
@section('content')
    @php
        $user = session('user_details');
        $privileges = json_decode($user['user_privileges'], true)['permissions'] ?? [];
        $userRole = session('user_details')['user_role'];
    @endphp
    <div class="w-full pt-10 min-h-[88vh] gradient-border  rounded-lg">
        <div class="flex justify-between px-5">
            <h1 class="text-3xl font-bold ">Queries</h1>
        </div>
        @php
            $headers = ['Sr.', 'Profile', 'User', 'Subject ', 'Message', 'Date', 'Status', 'Action'];

        @endphp

        <x-table :headers="$headers">
            <x-slot name="tablebody">
                @foreach ($queries as $query)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img class="h-20 w-20 object-cover rounded-full"
                                src="{{ $query->user->user_image ?? asset('assets/default-logo-1.png') }}" alt='user Image'>
                        </td>
                        <td class='text-xs xl:text-[15px]'>{{ $query->user->name }}</td>
                        <td class='text-xs xl:text-[15px] '>{{ $query->query_subject }}</td>
                        <td class='text-xs xl:text-[15px]'>{{ \Str::limit($query->query_message, 60, '...') }}</td>
                        <td class='text-sm xl:text-[15px]'>{{ $query->created_at->format('M, d, y') }}</td>
                        <td class='text-sm xl:text-[15px]'><span class='{{ $query->query_status == "pending" ? "text-red-700"  : "text-blue-600"}}'>{{ $query->query_status }}</span>
                        </td>

                        <td>
                            <span class='flex gap-4'>
                                @if ($userRole === 'superadmin' || isset($privileges['Queries']['edit']))
                                    <button class="updateDataBtn" data-modal-target='view-modal'
                                        data-modal-toggle='view-modal' updateId="{{ $query->query_id }}"
                                        userName="{{ $query->user->name }}" userEmail="{{ $query->user->email }}"
                                        userImage="{{ $query->user->user_image ?? asset('assets/default-logo-1.png') }}"
                                        querySubject="{{ $query->query_subject }}"
                                        queryMessage="{{ $query->query_message }}" Status="{{ $query->query_status }}"
                                        Response="{{ $query->query_response }}">
                                        <svg width='36' height='36' viewBox='0 0 36 36' fill='none'
                                            xmlns='http://www.w3.org/2000/svg'>
                                            <circle opacity='0.1' cx='18' cy='18' r='18' fill='#233A85' />
                                            <path fill-rule='evenodd' clip-rule='evenodd'
                                                d='M16.1637 23.6188L22.3141 15.665C22.6484 15.2361 22.7673 14.7402 22.6558 14.2353C22.5593 13.7763 22.277 13.3399 21.8536 13.0088L20.8211 12.1886C19.9223 11.4737 18.8081 11.549 18.1693 12.3692L17.4784 13.2654C17.3893 13.3775 17.4116 13.543 17.523 13.6333C17.523 13.6333 19.2686 15.0329 19.3058 15.063C19.4246 15.1759 19.5137 15.3264 19.536 15.507C19.5732 15.8607 19.328 16.1918 18.9641 16.2369C18.7932 16.2595 18.6298 16.2068 18.511 16.109L16.6762 14.6492C16.5871 14.5822 16.4534 14.5965 16.3791 14.6868L12.0188 20.3304C11.7365 20.6841 11.64 21.1431 11.7365 21.5871L12.2936 24.0025C12.3233 24.1304 12.4348 24.2207 12.5685 24.2207L15.0197 24.1906C15.4654 24.1831 15.8814 23.9799 16.1637 23.6188ZM19.5958 22.8672H23.5929C23.9829 22.8672 24.3 23.1885 24.3 23.5835C24.3 23.9794 23.9829 24.2999 23.5929 24.2999H19.5958C19.2059 24.2999 18.8887 23.9794 18.8887 23.5835C18.8887 23.1885 19.2059 22.8672 19.5958 22.8672Z'
                                                fill='#233A85' />
                                        </svg>
                                    </button>
                                @endif
                            </span>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>


        <x-modal id="view-modal">
            <x-slot name="title">Details </x-slot>
            <x-slot name="modal_width">max-w-4xl</x-slot>
            <x-slot name="body">
                <form id="postDataForm" method="POST" url="../answerQuery">
                    @csrf
                    <div class="p-6 pt-1">
                        <div class="flex">
                            <div><img id="userImage" class="object-cover w-36 h-36 rounded-full  "
                                    src="{{ asset('assets/Surface 3 rounded.png') }}" alt="user Image"></div>
                            <!-- Text Details -->
                            <div class="mt-8 ml-5">
                                <h3 class="text-xl font-semibold text-gray-800" id="userName">User Name</h3>
                                <p id="userEmail">user@gmail.com</p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <h4 class="text-lg font-semibold text-gray-800">Subject: <span class="font-medium"
                                    id="querySubject"></span></h4>
                            <h4 class="text-lg font-semibold text-gray-800">Message:</h4>
                            <p class="mt-1 text-sm text-gray-600" id="queryMessage">

                            </p>
                        </div>
                        <input type="hidden" name="query_id" id="updateId">
                        <div class="mt-4 mb-4">
                            <x-select id="Status" name="query_status" label="Query status">
                                <x-slot name="options">
                                    <option disabled selected>Select Status</option>
                                    <option value="pending">pending</option>
                                    <option value="resolved">Resolved</option>
                                </x-slot>
                            </x-select>
                        </div>

                        <div class="mb-4">
                            <x-textarea type="text" id="Response" name="query_response" label="Query Response"
                                placeholder="Enter Query Response"></x-textarea>
                        </div>
                        <div class="mt-5">
                            <x-modal-button title="Update"></x-modal-button>
                        </div>
                    </div>
                </form>
            </x-slot>
        </x-modal>
    </div>
@endsection
@section('js')
    <script>
        function updateDatafun() {
            $('.updateDataBtn').click(function() {
                $('#view-modal').removeClass("hidden").addClass('flex');

                $('#updateId').val($(this).attr('updateid'));
                $('#userImage').attr('src', ($(this).attr('userImage')));
                $('#userName').text($(this).attr('userName'));
                $('#userEmail').text($(this).attr('userEmail'));
                $('#querySubject').text($(this).attr('querySubject'));
                $('#queryMessage').text($(this).attr('queryMessage'));
                $('#Status').val($(this).attr('Status')).trigger('change');
                $('#Response').val($(this).attr('Response'));


            });
        }
        updateDatafun();
        // Listen for the custom form submission response event
        $(document).on("formSubmissionResponse", function(event, response, Alert, SuccessAlert, WarningAlert) {
            // console.log(response);
            if (response.success) {

                $('.modalCloseBtn').click();
            } else {}
        });
    </script>
@endsection
