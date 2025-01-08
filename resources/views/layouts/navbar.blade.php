    <nav
        class="fixed w-full max-w-[1920px] p-4 px-10 bg-gradient-to-b from-customOrangeLight to-customOrangeDark z-[150] ">

        <div class="flex items-center justify-between mx-auto">
            <div class="flex items-center h-full">
                <img class="h-[60%]" src="{{ asset('assets/icons/Logonewsvg.svg') }}" alt="Logo">
            </div>
            <div class="flex items-center space-x-4">
                {{-- <div class="relative">
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                        class="flex items-center px-3 py-2 space-x-1 text-white bg-transparent border rounded-full">
                        <img src="{{ asset('assets/Rectangle 1887.png') }}" alt="USA flag"
                            class="w-5 h-5 rounded-full" />
                        <span>USA</span>

                        <div id="dropdown"
                            class="z-10 hidden text-left bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownDefaultButton">
                                <li>

                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pakistan</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">India</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">England</a>
                                </li>
                            </ul>
                        </div>

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                </div> --}}
                {{-- <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
                    class="relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400"
                    type="button">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                    <span
                        class="absolute flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-500 rounded-full -top-1 -right-1">
                       0
                    </span>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownNotification"
                    class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700"
                    aria-labelledby="dropdownNotificationButton">
                    <div
                        class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                        Notifications
                    </div>
                    <h2 class="text-center font-semibold text-xl py-10">No Notifications Yet</h2>
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="flex-shrink-0">
                                <img class="rounded-full w-11 h-11" src="{{ asset('assets/profile-img.jpg') }}"
                                    alt="Jese image">
                                <div
                                    class="absolute flex items-center justify-center w-5 h-5 -mt-5 bg-blue-600 border border-white rounded-full ms-6 dark:border-gray-800">
                                    <svg class="w-2 h-2 text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                        <path
                                            d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
                                        <path
                                            d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="w-full ps-3">
                                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">New message from <span
                                        class="font-semibold text-gray-900 dark:text-white">Jese Leos</span>: "Hey,
                                    what's up? All set for the presentation?"</div>
                                <div class="text-xs text-blue-600 dark:text-blue-500">a few moments ago</div>
                            </div>
                        </a>



                    </div>
                    <a href="../notification"
                        class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                        <div class="inline-flex items-center ">
                            <svg class="w-4 h-4 text-gray-500 me-2 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                <path
                                    d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                            </svg>
                            View all
                        </div>
                    </a>
                </div> --}}

                <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar"
                    class="flex items-center space-x-2">
                    <div class="text-right ">
                        <div class="text-sm font-semibold text-white">{{ session('user_details')['name'] }}</div>
                        <div class="text-[10px] text-white">{{ session('user_details')['user_role'] }}</div>
                    </div>
                    <img class="h-[50px] w-[50px] rounded-full object-cover border border-white" src="{{ isset(session('user_details')['user_image']) ? url(session('user_details')['user_image']) : asset('assets/profille img.png') }}" alt="profile">
                </button>
                <div id="dropdownAvatar"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                        <div>{{ session('user_details')['name'] }}</div>
                        <div class="text-xs font-medium truncate">{{ session('user_details')['email'] }}</div>
                    </div>
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownUserAvatarButton">
                        <li>
                            <a href="../dashboard"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <a href="../setting"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                        </li>
                    </ul>
                    <div class="py-2">
                        <a href="../Logout"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                            out</a>
                    </div>
                </div>

            </div>
        </div>
    </nav>
