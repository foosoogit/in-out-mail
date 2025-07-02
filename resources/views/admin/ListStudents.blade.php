<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>生徒一覧</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	{{--<link rel="stylesheet" href="css/style.css">--}}
	<link rel="stylesheet" href="{{ asset('css/default.css')  }}" >
	{{--<link rel="stylesheet" href="css/studentsList.css" >--}}
	{{--@vite('public/css/studentsList.css')--}}

	<style>
		/* table_responsive */
#table_responsive th, #table_responsive td {
    text-align: center;
    width: 20%;
    min-width: 130px;
    padding: 10px;
    height: 60px;
  }
  #table_responsive tr:nth-child(2n+1) {
    background: #e9faf9;
   }

   #table_responsive th {
    padding: 10px;
    background: #778ca3;
    border-right: solid 1px #778ca3;
    color: #ffffff;
   }

   #table_responsive th:last-child {
    border-right: none;
   }

   .#table_responsive td {
    padding: 10px;
    border-right: solid 1px #778ca3; 
   }

   .#table_responsive td:last-child {
    border-right: none;
   }
  
  /* tab */
  @media only screen and (max-width: 768px) {
    #table_responsive {
      display: block;
      overflow-x: scroll;
      white-space: nowrap;
    }
  }
	</style>
	@livewireStyles
</head>
<body>
  <p><livewire:list-students /></p>
	@livewireScripts
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> --}}
  <script  type="text/javascript" src="{{ asset('/js/list-students.js?20240624') }}"></script>
	</body>
</body>
</html>