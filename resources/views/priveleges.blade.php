 @extends('layouts.layout')
 @section('title')
     Priveleges
 @endsection

 @section('content')
     <div class="w-full min-h-[88vh] gradient-border space-x-2  rounded-lg">
         <div class="mx-4 mt-8">
             <div class="flex items-center gap-2 ">
                 <img class="h-[50px] w-[50px]" src="{{ isset($user->user_image) ? url($user->user_image) : asset('assets/default-logo-1.png') }}" alt="">
                 <div class="">
                     <div class="text-sm font-semibold text-black">{{$user->name}}</div>
                     <div class="text-[10px] text-black">{{$user->user_role}}</div>
                 </div>
             </div>
             <div class="flex w-full h-full mx-auto mt-2">
                 <div
                     class="relative z-10 grid grid-cols-2 gap-4 mb-8 text-center lg:grid-cols-4 lg:gap-2 xl:gap-6 xl:grid-cols-4">
                     <!-- Market Box 1 -->
                     <div class="relative">
                         <input type="checkbox" name="market" id="market1" class="sr-only peer" checked>
                         <label for="market1"
                             class="block h-full p-4 transition-all bg-white border-2 border-gray-200 shadow-lg cursor-pointer rounded-tl-xl peer-checked:bg-orange-100 peer-checked:border-orange-300">
                             <img src="{{ asset('assets/icons/market update.png') }}" alt="Market icon">
                             <h3 class="text-xl font-semibold text-customGrayColorDark">Total Markets</h3>
                         </label>
                         <div
                             class="absolute w-6 h-6 transition-all border-2 border-gray-300 rounded-full top-4 right-4 peer-checked:border-customOrangeDark peer-checked:bg-customOrangeDark">
                         </div>
                     </div>

                 </div>
             </div>
         </div>
         <form url="../addPrivileges" id="postDataForm" method="post">
             @csrf
             <input type="hidden" name="userId" value="{{ $user_id }}">
             <input type="hidden" name="userPrivileges" value="{{ $privileges }}" id="permissionOutput">
             <div class="flex justify-end mx-4">
                 <div class="min-w-[150px]">
                     <x-modal-button title="Update All"></x-modal-button>
                 </div>

             </div>
         </form>

         @php
             $headers = ['Sr.', 'Image', 'Name', ''];
         @endphp

         <x-table :headers="$headers">
             <x-slot name='tablebody'>

                 <tr>
                     <td>2</td>
                     <td>
                         <div class="bg-gray-400 h-12 w-12 flex justify-center items-center rounded-full"><img
                                 class="h-6 w-6 " src="{{ asset('assets/icons/priveleges-icon/Dashboard.png') }}"
                                 alt='Dashboard'>
                         </div>
                     </td>
                     <td>City</td>
                     <td class='flex justify-center w-full'>
                         <div class='flex gap-4 permission-group'>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['City']['view']"
                                     class='permission-checkbox view-checkbox w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>View</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['City']['edit']"
                                     class='permission-checkbox edit-checkbox w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>Edit</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['City']['delete']"
                                     class='permission-checkbox delete-checkbox w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Delete</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['City']['add']"
                                     class='permission-checkbox add-checkbox w-5 h-5 bg-gray-100 border-gray-300 rounded text-customOrangeDark focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Add</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['City']['full_access']"
                                     class='full-access-checkbox w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Full Access</label>
                             </div>
                         </div>
                     </td>

                 </tr>
                 <tr>
                     <td>3</td>
                     <td>
                         <div class="bg-gray-400 h-12 w-12 flex justify-center items-center rounded-full"><img
                                 class="h-6 w-6 " src="{{ asset('assets/icons/priveleges-icon/Dashboard.png') }}"
                                 alt='Dashboard'>
                         </div>
                     </td>
                     <td>Operators</td>
                     <td class='flex justify-center w-full'>
                         <div class='flex gap-4 permission-group'>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Operators']['view']"
                                     class='permission-checkbox view-checkbox w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>View</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Operators']['edit']"
                                     class='permission-checkbox edit-checkbox w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>Edit</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Operators']['delete']"
                                     class='permission-checkbox delete-checkbox w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Delete</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Operators']['add']"
                                     class='permission-checkbox add-checkbox w-5 h-5 bg-gray-100 border-gray-300 rounded text-customOrangeDark focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Add</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Operators']['full_access']"
                                     class='full-access-checkbox w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Full Access</label>
                             </div>
                         </div>
                     </td>

                 </tr>
                 <tr>
                     <td>4</td>
                     <td>
                         <div class="bg-gray-400 h-12 w-12 flex justify-center items-center rounded-full"><img
                                 class="h-6 w-6 " src="{{ asset('assets/icons/priveleges-icon/Dashboard.png') }}"
                                 alt='Dashboard'>
                         </div>
                     </td>
                     <td>Subscription</td>
                     <td class='flex justify-center w-full'>
                         <div class='flex gap-4 permission-group'>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Subscription']['view']"
                                     class='permission-checkbox view-checkbox w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>View</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Subscription']['edit']"
                                     class='permission-checkbox edit-checkbox w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>Edit</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Subscription']['delete']"
                                     class='permission-checkbox delete-checkbox w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Delete</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Subscription']['add']"
                                     class='permission-checkbox add-checkbox w-5 h-5 bg-gray-100 border-gray-300 rounded text-customOrangeDark focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Add</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Subscription']['full_access']"
                                     class='full-access-checkbox w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Full Access</label>
                             </div>
                         </div>
                     </td>

                 </tr>
                 <tr>
                     <td>5</td>
                     <td>
                         <div class="bg-gray-400 h-12 w-12 flex justify-center items-center rounded-full"><img
                                 class="h-6 w-6 " src="{{ asset('assets/icons/priveleges-icon/market.png') }}"
                                 alt='Markets'>
                         </div>
                     </td>
                     <td>Markets</td>
                     <td class='flex justify-center w-full'>
                         <div class='flex gap-4 permission-group'>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Markets']['view']"
                                     class='permission-checkbox view-checkbox w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>View</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Markets']['edit']"
                                     class='permission-checkbox edit-checkbox w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>Edit</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Markets']['delete']"
                                     class='permission-checkbox delete-checkbox w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Delete</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Markets']['add']"
                                     class='permission-checkbox add-checkbox w-5 h-5 bg-gray-100 border-gray-300 rounded text-customOrangeDark focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Add</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Markets']['full_access']"
                                     class='full-access-checkbox w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Full Access</label>
                             </div>
                         </div>
                     </td>

                 </tr>
                 <tr>
                     <td>6</td>
                     <td>
                         <div class="bg-gray-400 h-12 w-12 flex justify-center items-center rounded-full"><img
                                 class="h-6 w-6 " src="{{ asset('assets/icons/priveleges-icon/market-update.png') }}"
                                 alt='Market Updates'>
                         </div>
                     </td>
                     <td>Market Updates</td>
                     <td class='flex justify-center w-full'>
                         <div class='flex gap-4 permission-group'>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['MarketsUpdates']['view']"
                                     class='permission-checkbox view-checkbox w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>View</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['MarketsUpdates']['edit']"
                                     class='permission-checkbox edit-checkbox w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>Edit</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['MarketsUpdates']['delete']"
                                     class='permission-checkbox delete-checkbox w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Delete</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['MarketsUpdates']['add']"
                                     class='permission-checkbox add-checkbox w-5 h-5 bg-gray-100 border-gray-300 rounded text-customOrangeDark focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Add</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['MarketsUpdates']['full_access']"
                                     class='full-access-checkbox w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Full Access</label>
                             </div>
                         </div>
                     </td>
                 </tr>
                 <tr>
                     <td>7</td>
                     <td>
                         <div class="bg-gray-400 h-12 w-12 flex justify-center items-center rounded-full"><img
                                 class="h-6 w-6 " src="{{ asset('assets/icons/priveleges-icon/blog.png') }}"
                                 alt='Blogs'>
                         </div>
                     </td>
                     <td>Blogs</td>
                     <td class='flex justify-center w-full'>
                         <div class='flex gap-4 permission-group'>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Blogs']['view']"
                                     class='permission-checkbox view-checkbox w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>View</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Blogs']['edit']"
                                     class='permission-checkbox edit-checkbox w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>Edit</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Blogs']['delete']"
                                     class='permission-checkbox delete-checkbox w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Delete</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Blogs']['add']"
                                     class='permission-checkbox add-checkbox w-5 h-5 bg-gray-100 border-gray-300 rounded text-customOrangeDark focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Add</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Blogs']['full_access']"
                                     class='full-access-checkbox w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Full Access</label>
                             </div>
                         </div>
                     </td>
                 </tr>
                 <tr>
                     <td>8</td>
                     <td>
                         <div class="bg-gray-400 h-12 w-12 flex justify-center items-center rounded-full"><img
                                 class="h-6 w-6 " src="{{ asset('assets/icons/priveleges-icon/Diseases.png') }}"
                                 alt='Diseases'>
                         </div>
                     </td>
                     <td>Diseases</td>
                     <td class='flex justify-center w-full'>
                         <div class='flex gap-4 permission-group'>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Diseases']['view']"
                                     class='permission-checkbox view-checkbox w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>View</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Diseases']['edit']"
                                     class='permission-checkbox edit-checkbox w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>Edit</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Diseases']['delete']"
                                     class='permission-checkbox delete-checkbox w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Delete</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Diseases']['add']"
                                     class='permission-checkbox add-checkbox w-5 h-5 bg-gray-100 border-gray-300 rounded text-customOrangeDark focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Add</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Diseases']['full_access']"
                                     class='full-access-checkbox w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Full Access</label>
                             </div>
                         </div>
                     </td>
                 </tr>
                 <tr>
                     <td>9</td>
                     <td>
                         <div class="bg-gray-400 h-12 w-12 flex justify-center items-center rounded-full"><img
                                 class="h-6 w-6 " src="{{ asset('assets/icons/priveleges-icon/video.png') }}"
                                 alt='Consultancy'>
                         </div>
                     </td>
                     <td>Consultancy videos</td>
                     <td class='flex justify-center w-full'>
                         <div class='flex gap-4 permission-group'>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Consultancy']['view']"
                                     class='permission-checkbox view-checkbox w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>View</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Consultancy']['edit']"
                                     class='permission-checkbox edit-checkbox w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>Edit</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Consultancy']['delete']"
                                     class='permission-checkbox delete-checkbox w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Delete</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Consultancy']['add']"
                                     class='permission-checkbox add-checkbox w-5 h-5 bg-gray-100 border-gray-300 rounded text-customOrangeDark focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Add</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['MarkeConsultancyts']['full_access']"
                                     class='full-access-checkbox w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Full Access</label>
                             </div>
                         </div>
                     </td>
                 </tr>
                 <tr>
                     <td>10</td>
                     <td>
                         <div class="bg-gray-400 h-12 w-12 flex justify-center items-center rounded-full"><img
                                 class="h-6 w-6 " src="{{ asset('assets/icons/priveleges-icon/category.png') }}"
                                 alt='Categories'>
                         </div>
                     </td>
                     <td>Categories</td>
                     <td class='flex justify-center w-full'>
                         <div class='flex gap-4 permission-group'>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Categories']['view']"
                                     class='permission-checkbox view-checkbox w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>View</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Categories']['edit']"
                                     class='permission-checkbox edit-checkbox w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>Edit</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Categories']['delete']"
                                     class='permission-checkbox delete-checkbox w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Delete</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Categories']['add']"
                                     class='permission-checkbox add-checkbox w-5 h-5 bg-gray-100 border-gray-300 rounded text-customOrangeDark focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Add</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Categories']['full_access']"
                                     class='full-access-checkbox w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Full Access</label>
                             </div>
                         </div>
                     </td>
                 </tr>
                 <tr>
                     <td>11</td>
                     <td>
                         <div class="bg-gray-400 h-12 w-12 flex justify-center items-center rounded-full"><img
                                 class="h-6 w-6 " src="{{ asset('assets/icons/priveleges-icon/query.png') }}"
                                 alt='Queries'>
                         </div>
                     </td>
                     <td>Queries</td>
                     <td class='flex justify-center w-full'>
                         <div class='flex gap-4 permission-group'>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Queries']['view']"
                                     class='permission-checkbox view-checkbox w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>View</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Queries']['edit']"
                                     class='permission-checkbox edit-checkbox w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium ms-2 text-gray-900'>Edit</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Queries']['delete']"
                                     class='permission-checkbox delete-checkbox w-5 h-5 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Delete</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Queries']['add']"
                                     class='permission-checkbox add-checkbox w-5 h-5 bg-gray-100 border-gray-300 rounded text-customOrangeDark focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Add</label>
                             </div>
                             <div class='flex items-center me-4'>
                                 <input type='checkbox' name="permissions['Queries']['full_access']"
                                     class='full-access-checkbox w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring customOrangeDark'>
                                 <label class='text-sm font-medium text-gray-900 ms-2'>Full Access</label>
                             </div>
                         </div>
                     </td>
                 </tr>
             </x-slot>
         </x-table>
     </div>
 @endsection

 @section('js')
     <script>
         $(document).on("formSubmissionResponse", function(event, response, Alert, SuccessAlert, WarningAlert) {

             location.reload();
             if (response.success) {} else {}
         });
         $(document).ready(function() {

             let permissionsInputData = $('#permissionOutput').val();
             if (permissionsInputData) {

                 let permissionsData = JSON.parse(permissionsInputData);
                 const permissions = permissionsData.permissions;


                 $.each(permissions, function(mainGroup, subPermissions) {
                     $.each(subPermissions, function(permissionType, status) {
                         if (status === "on") {
                             const checkboxName = `permissions['${mainGroup}']['${permissionType}']`;
                             $(`input[name="${checkboxName}"]`).prop('checked', true);
                         }
                     });
                 });
             }

             $('.full-access-checkbox').on('change', function() {
                 $(this).closest('.permission-group').find('.permission-checkbox').prop('checked', $(this)
                     .prop('checked'));
             });

             $('tr input[type="checkbox"]').on('change', getAllPermissions);

             ;

             function getAllPermissions() {
                 const permissions = {};

                 // Loop through each row (tr) with checkboxes
                 document.querySelectorAll('tr').forEach(row => {
                     // Find all permission groups within the row
                     row.querySelectorAll('.permission-group').forEach(group => {
                         const firstCheckbox = group.querySelector("input");

                         // Ensure we have a valid permission group name
                         if (firstCheckbox && firstCheckbox.name.includes("[")) {
                             const [mainGroup, subGroup] = firstCheckbox.name.match(
                                 /(\w+)\['(\w+)'\]/).slice(1,
                                 3);

                             // Initialize main and sub-groups if they don't exist
                             if (!permissions[mainGroup]) {
                                 permissions[mainGroup] = {};
                             }
                             if (!permissions[mainGroup][subGroup]) {
                                 permissions[mainGroup][subGroup] = {};
                             }

                             // Loop through each checkbox within the group
                             group.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                                 if (checkbox.checked) {
                                     const permissionType = checkbox.name.split("['").pop()
                                         .replace("']",
                                             "");
                                     permissions[mainGroup][subGroup][permissionType] = "on";
                                 }
                             });

                             // Remove the sub-group if no permissions are checked
                             if (Object.keys(permissions[mainGroup][subGroup]).length === 0) {
                                 delete permissions[mainGroup][subGroup];
                             }
                         }
                     });
                 });

                 //  console.log(JSON.stringify(permissions));
                 document.getElementById('permissionOutput').value = JSON.stringify(permissions);
             }

             function updateDatafun() {

             }
             updateDatafun();
         })
     </script>
 @endsection
