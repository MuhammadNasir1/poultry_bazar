@extends('layouts.layout')
@section('title')
    Operators
@endsection
@section('content')
    <style>
        .active-tab {
            color: #FE8D2F;
            border-color: #FE8D2F;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <div class="container p-6 mx-auto">
        <div class="p-8 bg-white rounded-lg shadow-md" id="main-container">
            <!-- Profile Header -->
            <div class="flex items-center">
                <div class="w-24 h-24 bg-gray-200 rounded-full">
                    <img class="w-24 h-24 rounded-full" src="{{ $user['user_image'] ?? asset('assets/default-logo-1.png') }}" alt="Profile Picture">
                </div>
                <div class="ml-6">
                    <h2 class="text-2xl font-semibold">{{ $user['name'] }}</h2>
                    <p class="text-gray-500">{{ $user['user_role'] }}</p>
                </div>
            </div>

            <!-- Tabs -->


            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                    data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 hover:text-[#FE8D2F] rounded-t-lg active-tab"
                            id="profile-tab" data-tabs-target="#profile" type="button" role="tab"
                            aria-controls="profile" aria-selected="true">Overview</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-[#FE8D2F] hover:border-gray-300 dark:hover:text-gray-300"
                            id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                            aria-controls="dashboard" aria-selected="false">Edit Profile</button>
                    </li>
                    {{-- <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-[#FE8D2F] hover:border-gray-300 dark:hover:text-gray-300"
                            id="settings-tab" data-tabs-target="#settings" type="button" role="tab"
                            aria-controls="settings" aria-selected="false">Settings</button>
                    </li> --}}
                    <li role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-[#FE8D2F] hover:border-gray-300 dark:hover:text-gray-300"
                            id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab"
                            aria-controls="contacts" aria-selected="false">Changes Password</button>
                    </li>
                </ul>
            </div>
            <div id="default-tab-content">
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel"
                    aria-labelledby="profile-tab">
                    {{-- <div class="mt-6">
                        <h3 class="text-lg font-semibold">About</h3>
                        <p class="mt-2 text-gray-500">
                            Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non
                            est unde
                            veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit.
                        </p>
                    </div> --}}

                    <!-- Profile Details -->
                    <div class="mt-2">
                        <h3 class="text-lg font-semibold">Profile Details</h3>
                        <div class="mt-4 space-y-2">
                            <div class="flex">
                                <span class="w-32 font-semibold text-gray-600">Full Name:</span>
                                <span>{{ $user['name'] }}</span>

                            </div>
                            <div class="flex">
                                <span class="w-32 font-semibold text-gray-600">Email:</span>
                                <span>{{ $user['email'] }}</< /span>
                            </div>
                            <div class="flex">
                                <span class="w-32 font-semibold text-gray-600">Phone:</span>
                                <span>{{ $user['user_phone'] }}</< /span>
                            </div>
                            <div class="flex">
                                <span class="w-32 font-semibold text-gray-600">Address:</span>
                                <span>{{ $user['address'] }}</< /span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel"
                    aria-labelledby="dashboard-tab">
                    <div class="pt-3 tab-pane fade profile-edit" id="profile-edit">
                        <!-- Profile Edit Form -->
                        <form id="settingForm" url="updateUserDetails" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex items-center mb-3">
                                <label for="profileImage" class="w-1/4 text-gray-700">Profile Image</label>
                                <div class="flex-col w-3/4 ">
                                    {{-- <img src="{{ asset('assets/profile-img square.jpg') }}" alt="Profile"
                                        class="object-contain w-32 h-28 ">
                                    <div class="pl-4 mt-3 ">
                                        <div class="h-10 w-50">
                                            <a href="#"
                                                class="px-3 py-1.5  bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600"
                                                title="Upload new profile image">
                                                <label for="pimage">
                                                    <i class=" fa-solid fa-upload">
                                                    </i>
                                                </label>
                                            </a>
                                        </div>
                                        <input type="file" id="pimage" hidden>
                                    </div> --}}
                                    <div class="lg:w-1/2">
                                        <x-file-uploader name="user_image" id="userImage" />
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center mb-4">
                                <label for="fullName" class="w-1/4 text-gray-700">Full Name</label>
                                <div class="w-3/4">
                                    <input name="name" type="text"
                                        class="w-full border-gray-300 rounded form-input focus:outline-none focus:border-customOrangeDark"
                                        id="fullName" value="{{ $user['name'] }}">
                                </div>
                            </div>
                            <div class="flex items-center mb-4">
                                <label for="email" class="w-1/4 text-gray-700">Email</label>
                                <div class="w-3/4">
                                    <input name="email" type="text"
                                        class="w-full border-gray-300 rounded form-input focus:outline-none focus:border-customOrangeDark"
                                        id="email" value="{{ $user['email'] }}">
                                </div>
                            </div>
                            <div class="flex items-center mb-4">
                                <label for="phone" class="w-1/4 text-gray-700">Phone</label>
                                <div class="w-3/4">
                                    <input name="phone" type="text"
                                        class="w-full border-gray-300 rounded form-input focus:outline-none focus:border-customOrangeDark"
                                        id="phone" value="{{ $user['user_phone'] }}">
                                </div>
                            </div>
                            <div class="flex items-start mb-4">
                                <label for="address" class="w-1/4 text-gray-700">Address</label>
                                <div class="w-3/4">
                                    <textarea name="address"
                                        class="w-full h-24 border-gray-300 rounded form-textarea focus:outline-none focus:border-customOrangeDark"
                                        id="address">{{ $user['address'] }}</textarea>
                                </div>
                            </div>

                            <!-- Repeat the following structure for each form group, adjusting the `for` attribute and placeholder content as needed -->








                            <!-- Additional fields... -->

                            <div class="flex justify-center">
                                <div class="mt-4 w-60">
                                    <x-modal-button :title="'Save Changes'"></x-modal-button>
                                </div>
                            </div>
                        </form>
                        <!-- End Profile Edit Form -->
                    </div>

                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel"
                    aria-labelledby="settings-tab">
                    <div class="pt-3 tab-pane fade" id="profile-settings">
                        <!-- Settings Form -->
                        <form>
                            <div class="flex flex-col mb-3 md:flex-row">
                                <label for="fullName"
                                    class="mb-2 font-bold text-center text-gray-700 md:w-1/3 lg:w-1/4 md:mb-0">Email
                                    Notifications</label>
                                <div class="md:w-2/3 lg:w-3/4">
                                    <div class="flex items-center mb-2">
                                        <input
                                            class="w-4 h-4 text-[#FE8D2F] bg-gray-100 border-gray-300 rounded form-check-input focus:ring-[#FE8D2F]"
                                            type="checkbox" id="changesMade" checked>
                                        <label class="ml-2 text-gray-700" for="changesMade">Changes made to your
                                            account</label>
                                    </div>
                                    <div class="flex items-center mb-2">
                                        <input
                                            class="w-4 h-4 text-[#FE8D2F] bg-gray-100 border-gray-300 rounded form-check-input focus:ring-[#FE8D2F]"
                                            type="checkbox" id="newProducts" checked>
                                        <label class="ml-2 text-gray-700" for="newProducts">Information on new products
                                            and services</label>
                                    </div>
                                    <div class="flex items-center mb-2">
                                        <input
                                            class="w-4 h-4 text-[#FE8D2F] bg-gray-100 border-gray-300 rounded form-check-input focus:ring-[#FE8D2F]"
                                            type="checkbox" id="proOffers">
                                        <label class="ml-2 text-gray-700" for="proOffers">Marketing and promo
                                            offers</label>
                                    </div>
                                    <div class="flex items-center mb-2">
                                        <input
                                            class="w-4 h-4 text-gray-400 bg-gray-100 border-gray-300 rounded form-check-input focus:ring-gray-500"
                                            type="checkbox" id="securityNotify" checked disabled>
                                        <label class="ml-2 text-gray-500" for="securityNotify">Security alerts</label>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-center">
                                <div class="mt-4 w-60">
                                    {{-- <x-modal-button :title="'Save Changes'"></x-modal-button> --}}
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel"
                    aria-labelledby="contacts-tab">
                    <div class="pt-3 tab-pane fade" id="profile-change-password">
                        <!-- Change Password Form -->
                        <form id="passwordForm" url="updateUserPassword" method="POST">
                            @csrf
                            {{-- <form id="passwordForm" url="updateUserPassword" method="POST"> --}}
                            <div class="flex flex-col mb-3 md:flex-row">
                                <label for="currentPassword"
                                    class="mb-2 font-medium text-gray-700 md:w-1/3 lg:w-1/4 md:mb-0">Current
                                    Password</label>
                                <div class="md:w-2/3 lg:w-3/4 relative">
                                    <input name="old_password" type="password" id="currentPassword"
                                        class="w-full p-2 border border-gray-300 rounded focus:outline-none  focus:border-customOrangeDark"
                                        placeholder="Enter old password">
                                        <span class="absolute inset-y-0 flex items-center cursor-pointer right-4 top-1/2 -translate-y-1/2">
                                            <i class="fa-solid fa-eye-slash text-customGrayColorDark"></i>
                                        </span>
                                </div>
                            </div>

                            <div class="flex flex-col mb-3 md:flex-row">
                                <label for="newPassword"
                                    class="mb-2 font-medium text-gray-700 md:w-1/3 lg:w-1/4 md:mb-0">New Password</label>
                                <div class="md:w-2/3 lg:w-3/4 relative">
                                    <input name="new_password" type="password" id="newPassword"
                                        class="w-full p-2 border border-gray-300 rounded focus:outline-none  focus:border-customOrangeDark"
                                        placeholder="Enter new password">
                                        <span class="absolute inset-y-0 flex items-center cursor-pointer right-4 top-1/2 -translate-y-1/2">
                                            <i class="fa-solid fa-eye-slash text-customGrayColorDark"></i>
                                        </span>
                                </div>
                            </div>

                            <div class="flex flex-col mb-3 md:flex-row">
                                <label for="renewPassword"
                                    class="mb-2 font-medium text-gray-700 md:w-1/3 lg:w-1/4 md:mb-0">Re-enter New
                                    Password</label>
                                <div class="md:w-2/3 lg:w-3/4 relative">
                                    <input name="new_password_confirmation" type="password" id="renewPassword"
                                        class="w-full p-2 border border-gray-300 rounded focus:outline-none  focus:border-customOrangeDark"
                                        placeholder="Re-enter new  password">
                                        <span class="absolute inset-y-0 flex items-center cursor-pointer right-4 top-1/2 -translate-y-1/2">
                                            <i class="fa-solid fa-eye-slash text-customGrayColorDark"></i>
                                        </span>
                                </div>
                            </div>

                            <div class="flex justify-center">
                                <div class="mt-4 w-60">
                                    <button
                                        class="w-full px-3 py-2 font-semibold text-white rounded-full shadow-md gradient-bg"
                                        id="SsubmitBtn">
                                        <div id="SbtnSpinner" class="hidden">
                                            <svg aria-hidden="true"
                                                class="w-6 h-6 mx-auto text-center text-gray-200 animate-spin fill-customOrangeLight"
                                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill" />
                                            </svg>
                                        </div>
                                        <div id="SbtnText">
                                            Update Password
                                        </div>
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabs = document.querySelectorAll("#default-tab button");

            tabs.forEach(tab => {
                tab.addEventListener("click", function() {
                    // Remove the active class from all tabs
                    tabs.forEach(t => t.classList.remove("active-tab"));

                    // Add the active class to the clicked tab
                    this.classList.add("active-tab");
                });
            });
        });
    </script>
@endsection


@section('js')
    <script>
        $(document).ready(function () {
    // Toggle password visibility
    $('.fa-eye-slash').on('click', function () {
        let $icon = $(this); 
        let $input = $icon.closest('div').find('input'); 
        if ($input.attr('type') === 'password') {
            $input.attr('type', 'text');
            $icon.removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            $input.attr('type', 'password');
            $icon.removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });
});
        let userImageExists = {{ isset($user['user_image']) ? 'true' : 'false' }};
        let userImage = {!! isset($user['user_image']) ? json_encode($user['user_image']) : 'null' !!};
        let fileImg = $('#settingForm .file-preview');

        if (userImageExists) {
            fileImg.removeClass('hidden').attr('src', userImage);
        } else {
            fileImg.addClass('hidden');
        }
        $("#settingForm, #passwordForm").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: $(this).attr("url"),
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $("#btnSpinner , #SbtnSpinner").removeClass("hidden");
                    $("#btnText , #SbtnText").addClass("hidden");
                    $("#submitBtn , #submitBtn").attr("disabled", true);
                },
                success: function(response) {
                    $("#btnSpinner , #SbtnSpinner").addClass("hidden");
                    $("#btnText , #SbtnText").removeClass("hidden");
                    $("#submitBtn , #submitBtn").attr("disabled", false);
                    window.location.href = 'setting';
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Success",
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                    });

                },

                error: function(jqXHR) {
                    let response = JSON.parse(jqXHR.responseText);
                    $("#btnSpinner , #SbtnSpinner").addClass("hidden");
                    $("#btnText , #SbtnText").removeClass("hidden");
                    $("#submitBtn , #submitBtn").attr("disabled", false);
                    Swal.fire({
                        position: "center",
                        icon: "warning",
                        title: "Error",
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                    });

                },
            });
        });
    </script>
@endsection
