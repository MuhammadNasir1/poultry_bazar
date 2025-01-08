<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Poultry Bazar</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/DataTables-1.13.8/css/jquery.dataTables.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/default-logo-1.png') }}" type="image/x-icon">
</head>

<body>

    <div class="relative w-full h-full">
        <div>
            <div>
                <div class="absolute z-10 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    <div style="box-shadow: 0px 0px 179px 300px #FCB276A0;"></div>
                </div>
            </div>
            <div id="mainContent"
                class="flex flex-col-reverse  items-center justify-center h-[100vh] mx-[10px]  xl:mx-auto z-40 relative ">
                <div id="loginDiv"
                    class="max-w-[480px] my-2 p-12 animate-slideout px-8 flex flex-col justify-center pt-10 items-center h-full xl:h-auto w-full rounded-2xl transition-all duration-700 ease-in-out"
                    style="box-shadow: 0px 0px 8px 0px #00000026; background:rgba(255, 255, 255, 0.389)">
                    <div class="w-full">
                        <div>
                            <h1 class="text-customBlackColor font-bold text-[44px] text-center">Reset Password</h1>
                        </div>
                        <form id="postDataForm" method="POST" url="../resetPassword">
                            @csrf
                            <input type="hidden" name="user_id" id="" value="{{isset($_GET['key']) ? $_GET['key'] : null}}">
                            <div class="mt-20">
                                <div class="relative mt-5">
                                    <label for="password" class="block text-sm">Enter New Password</label>
                                    <div class="relative mt-1">
                                        <input type="password" id="password"
                                            class="w-full pr-12 bg-white border border-customGrayColorDark rounded-2xl placeholder:text-customGrayColorDark placeholder:text-sm focus:border-customOrangeDark focus:outline-none"
                                            placeholder="Enter Here" name="password">
                                        <span class="absolute inset-y-0 flex items-center cursor-pointer right-4 togglePassword">
                                            <i class="fa-solid fa-eye-slash text-customGrayColorDark"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="relative mt-5">
                                    <label for="password_confirmation" class="block text-sm">Re-Enter New Password</label>
                                    <div class="relative mt-1">
                                        <input type="password" id="password_confirmation"
                                            class="w-full pr-12 bg-white border border-customGrayColorDark rounded-2xl placeholder:text-customGrayColorDark placeholder:text-sm focus:border-customOrangeDark focus:outline-none"
                                            placeholder="Enter Here" name="password_confirmation">
                                        <span class="absolute inset-y-0 flex items-center cursor-pointer right-4 togglePassword">
                                            <i class="fa-solid fa-eye-slash text-customGrayColorDark"></i>
                                        </span>
                                    </div>
                                </div>


                              <div class="mt-6">
                                <x-modal-button :title="'Reset'"></x-modal-button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    
    <script src="{{ asset('javascript/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('javascript/script.js') }}"></script>
<script>
     $(document).ready(function () {
        // Toggle password visibility
        $('.togglePassword').on('click', function () {
            const input = $(this).siblings('input');
            const icon = $(this).find('i');

            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                input.attr('type', 'password'); 
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });
    });
     $(document).on("formSubmissionResponse", function(event, response, Alert, SuccessAlert, WarningAlert) {
            if (response.success) {
                window.location.href  = "../login";
            } else {}
        });
</script>
</body>

</html>
