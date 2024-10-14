<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/assets/images/favicon.png')}}">
    <title>{{$_s['site_title']}}</title>

    <!-- ============================================================== -->
    <!-- Plugins -->
    <!-- ============================================================== -->
    <link href="{{asset('admin/assets/node_modules/morrisjs/morris.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/node_modules/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/node_modules/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/assets/node_modules/select2/dist/css/select2.css')}}">
  
    <style>
        .menu-button:hover{
            color: #03a9f3;
        }

        .file_manager_parent .file_manager {
            width: 100%;
        }
        .select2-container .img-flag {
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin-right: 5px;
        }
       .file_manager_parent .select2-selection__rendered {
            display: flex;
            align-items: center;
            line-height: 36px!important;
        }

        .file_manager_parent .select2-selection--single{
            min-height: 38px;
            border: 1px solid #e9ecef!important;
            border-radius: 0px;
        }

        .tox-tinymce{
        width: 100%!important;
        }
    </style>    
    @yield('css')
  
</head>
<body class="skin-blue fixed-layout">
    
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">{{$_s['site_title']}}</p>
        </div>
    </div>

    <div id="main-wrapper">
        <header class="topbar">
            @include('admin.partials.topbar')       
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        @include('admin.partials.navbar')
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="page-wrapper">
            <div class="container-fluid">
              @yield('content')

                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Theme Settings <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme working">4</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme ">7</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme ">12</a></li>
                            </ul>
                      
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <footer class="footer">
            © 2024 {{$_s['site_title']}} Developed by <a href="https://www.azamsolutions.com/">
                azamsolutions.com</a>
        </footer>
    </div>

    <script src="{{asset('admin/assets/node_modules/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets/node_modules/select2/dist/js/select2.js')}}"></script>
    <script src="{{asset('admin/assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/assets/node_modules/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('admin/assets/node_modules/morrisjs/morris.min.js')}}"></script>
    <script src="{{asset('admin/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('admin/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{asset('admin/assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/waves.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom.js')}}"></script>
    <script src="{{asset('admin/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/tinymce.js')}}"></script>
    <script>
         let site_url = "{{URL::to('/')}}";
          $('.file_manager').select2({
            ajax: {
                url: "{{URL::to('admin/filemanager/search')}}",
                dataType: 'json',
            },
            templateResult: function (state) {  
                return $('<span><img src="' +site_url+'/'+state.id + '" class="img-flag" /> ' + state.text + '</span>');
            },
            templateSelection: function (state) {  
                return $('<span><img src="' +site_url+'/'+state.id + '" class="img-flag" /> ' + state.text + '</span>');
            },
        });
    </script>

    @include('admin.partials.alert')

    <!-- ============================================================== -->
    <!-- Pages JS -->
    <!-- ============================================================== -->
    @yield('js')
    
 </body>
</html>