<!doctype html>
<html lang="en">

<head>
    <title>{{config('app.name')}}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Krad was here" name="description" />
    <meta content="KradWasHere" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

    <link rel="shortcut icon" href="{{asset('assets/images/icon.png')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}" />
</head>

    <body data-topbar="dark" data-keep-enlarged="true" class="vertical-collpsed">
        <div id="app"> 
            <div id="layout-wrapper">
                @include('layouts.employee.header')

                    <div class="account-pages pt-sm-4 ml-5 mr-5 mb-5" style="margin-top: 50px;">
                        <div class="d-xl-flex">
                            <div class="w-100">
                                <div class="d-md-flex">

                                    <div class="chat-leftsidebar">
                                        @include('layouts.employee.sidebar')
                                    </div>

                                    <div class="w-100 mt-lg-4" style="margin-bottom: -50px;">
                                        @yield('content')
                                    </div>
                        
                                    <div class="chat-leftsidebar" id="eside">
                                        <employee-side :birthdays="{{ json_encode($birthdays) }}" :schedules="{{ json_encode($schedules) }}"></employee-side>
                                    </div>

                                    @include('layouts.employee.modals')

                                </div>
                            </div>
                        </div>
                    </div>
                    
                        <!-- @yield('content') -->
            </div>

            <div class="rightbar-overlay"></div>
        </div>

        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('js/frontend.js')}}"></script>
       <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet' defer> 
        
    </body>
</html>
