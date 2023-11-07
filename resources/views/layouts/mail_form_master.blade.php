<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased container-fluid">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    {{--  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>
    --}}
    {{-- <div class="container" style="margin-top: 40px;"> --}}
        @yield('content')
    {{--</div>--}}
    <!-- /.container -->
    <script>
        function setStudentSerial(){
            var student_serial_hdn=document.getElementById('student_serial_hdn').value;
            //var iframeElem = document.getElementById('StudList_if');
            //var iframeElem = document.getElementById('StudList_if');
            var iframeElem = document.getElementsByTagName('iframe');
            var iframeDocument = iframeElem[1].contentDocument || iframeElem[1].contentWindow.document;
            var stud_serial=iframeDocument.getElementsByName('target_student_cb');
            //console.log("stud_serial="+stud_serial);
            var stud_serial_array= [];
            //console.log("length="+stud_serial.length);
            for(let i = 0; i < stud_serial.length; i++){ // ④
                if(stud_serial.item(i).checked){ // ⑤
                    //console.log("stud_serial_value="+stud_serial.item(i).value);
                    stud_serial_array.push(stud_serial.item(i).value); // ⑥
                }
            }
            stud_serial_all=stud_serial_array.join(",");
            //console.log("stud_serial_all="+stud_serial_all);
            document.getElementById('student_serial_hdn').value=stud_serial_all;
        }
    </script>
</body>
</html>