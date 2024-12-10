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
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
	{{-- @livewireStyles --}}
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('/css/StandbyDisplayQR.css') }}" crossorigin="anonymous">
</head>
<body class="font-sans antialiased h1">
    <div>
       <div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="flex items-center gap-4">
                        <x-primary-button onclick="location.href='{{route('menu')}}'" >メニューに戻る</x-primary-button>
                    </div>
					<div class="flex items-center gap-4">
                        <x-primary-button onclick="test('test1')" >テスト</x-primary-button>
                    </div>
					<div class="row height:25rem" style="width: 20rem;">待ち受け画面</div>
                    <div class="row">
								{{--
								<div class="col">
									<div id="photo-area"  class="viewport">
										<img v-if="code.length" src="" alt="result" class="resultImg" />
									</div>
								</div>
								  
								<div class="col">
									<div id="interactive" class="viewport"></div>
								</div>
								
								<div class="col">
									<div id="container"></div>
									<p id="process"></p>
									<p id="result"></p>
								</div>
								--}}
						<div class="col">
							<div>
								<video id="video" autoplay></video>
								<div style="display:none">
									<canvas id="js-canvas"></canvas>
								</div>
							</div>
						</div>
								{{--
								<div class="col">
									<button type="button" class="btn btn-fab btn-round btn-info btc_scan" name="btc_scan"></button>
								</div>
								<div class="col">
									<div class="scan_area" style="height: 100vh;">
										<div id="photo-area" class="viewport"></div>
									</div>
								</div>
								
								<div class="col">
									<x-input-label for="name_sei" value="生徒番号の読み込み" />
									<x-text-input type="text" class="mt-1 block w-full" name="student_serial_txt" id="student_serial_txt"  style="ime-mode: disabled;" autofocus />
									<x-input-error class="mt-2" :messages="$errors->get('student_serial')" />
								</div>
								--}}
						<div class="col"> 
							<p id="RealtimeClockArea" class="display-1 lead"></p>
						</div>
								{{--
								<div class="col"> 
									<button id="startButton">Start Scan</button>
    								<button id="stopButton">Stop Scan</button>
    								<div id="scanResult"></div>
								</div>
								--}}
                    </div>
					<div class="alert alert-primary alert-dismissible fade show" id="name_fadeout_alert" style="display: none">
						<label id="seated_type" class="text-danger fs-4 display-4"></label>
					</div>
                </div>
            </div>
       	</div>
    </div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	{{--<script src="https://unpkg.com/@ericblade/quagga2@1.7.4/dist/quagga.min.js"></script>--}}
	<script src="https://cdn.jsdelivr.net/npm/jsqr@latest/dist/jsQR.min.js"></script>
	<script src="//cdn.jsdelivr.net/gh/mtaketani113/jquery-barcode@master/jquery-barcode.js"></script>
	<script src="{{ asset('/js/StandbyDisplayQR.js') }}"></script>
	<script>
		//alert('ログインしてください。');
		const video = document.getElementById('video');
		const canvas = document.querySelector('#js-canvas');
		const ctx = canvas.getContext('2d');
		//navigator.mediaDevices.getUserMedia({ video: true, audio: false,facingMode: { exact: "environment" } })
		navigator.mediaDevices.getUserMedia({ video: true, audio: false })
			.then(stream => video.srcObject = stream)
			.catch(err => alert(`${err.name} ${err.message}`));
		const checkImage = () => {
		  // 取得している動画をCanvasに描画
		ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
		  // Canvasからデータを取得
		const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
		  // jsQRに渡す
		const code = jsQR(imageData.data, canvas.width, canvas.height);
		  // 失敗したら再度実行
		if (code) {
			alert(code.data);
			setTimeout(() => { checkImage() }, 200);
		} else {
			setTimeout(() => { checkImage() }, 200);
		}
		}
		// QRコード読み取り実行
		let readQR = checkImage();
	</script>
	<script>
		function showClock(){
			var nowTime = new Date();
			var nowHour = set2fig( nowTime.getHours() );
			var nowMin  = set2fig( nowTime.getMinutes() );
			var nowSec  = set2fig( nowTime.getSeconds() );
			var msg = nowHour + ":" + nowMin + ":" + nowSec;
			document.getElementById("RealtimeClockArea").innerHTML = msg;
		}
	</script>
	<script>
		function test(bun){
			alert(bun);
		}
	</script>
	{{-- 
	<script>
		Quagga.init({
			inputStream: { type : 'LiveStream' },
			decoder: {
				readers: [{
					format: 'ean_reader',
					config: {}
				}]
			}
		}, (err) => {
			if(!err) {
				Quagga.start();
			}
		});
		Quagga.onDetected((result) => {
			var code = result.codeResult.code;
			// ここでAjaxを通して配送完了処理をする
			console.location("読み取り完了1")
		});
	</script>
	 --}}
	 {{--
	<script type="text/javascript">
		var audio_out= new Audio("time_out.mp3");
		var audio_in= new Audio("true.mp3");
		var audio_false= new Audio("false.mp3");
		//var audio;
		$(document).ready( function(){
			document.getElementById('student_serial_txt').focus();
		});
		$('#student_serial_txt').keypress(function(e) {
			if(e.which == 13) {
				document.getElementById("student_serial_txt").disabled=true;
				$.ajax({
					//url: 'send_mail',
					url: 'in_out_manage',
					type: 'post', // getかpostを指定(デフォルトは前者)
					dataType: 'text', // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる
					scriptCharset: 'utf-8',
					data: {"student_serial":$('#student_serial_txt').val()},
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				}).done(function (data) {
					const item_json = JSON.parse(data);
					if(item_json.seated_type=="false"){
						audio_false.play();
						//document.getElementById("seated_type").style.display="";
						document.getElementById("seated_type").innerText = item_json.name_sei + ' '+item_json.name_mei+'さんの退出時間が短すぎます。';
						$('#name_fadeout_alert').show();
					}else if(item_json.seated_type=="in"){
						audio_in.play();
						document.getElementById("seated_type").innerText =  item_json.name_sei + ' '+item_json.name_mei+'さんが入室しました。';
						send_mail(data);
					}else if(item_json.seated_type=="out"){
						audio_out.play();
						document.getElementById("seated_type").innerText =  item_json.name_sei + ' '+item_json.name_mei+'さんが退室しました。';
						send_mail(data);
					}else if(item_json.seated_type=="NoAddress"){
						audio_out.play();
						document.getElementById("seated_type").innerText =  item_json.name_sei + ' '+item_json.name_mei+'さんのメールアドレスが設定されていません。';
						$('#name_fadeout_alert').show();
						//send_mail(data);
					}else if(item_json.seated_type=="NoSerial"){
						audio_false.play();
						document.getElementById("seated_type").innerText = '登録データが見つかりません。';
						$('#name_fadeout_alert').show();
						//dispNone();
					}else{
						audio_false.play();
						document.getElementById("seated_type").innerText = 'エラー';
						$('#name_fadeout_alert').show();
						//dispNone();
					}
					document.getElementById('student_serial_txt').value="";
					document.getElementById('student_serial_txt').focus();
					data=null;
					window.setTimeout(dispNone, 1000);
				}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
					if(XMLHttpRequest.status==419){
						alert('ログインしてください。');
						location.href = 'show_standby_display';
					}
					/*
					alert(XMLHttpRequest.status);
					alert(textStatus);
					alert(errorThrown);	
					alert('エラー');
					*/
				});
			}else{
				//alert("TEST");
			}
		});

		function dispNone(){
			document.getElementById("name_fadeout_alert").style.display="none";
			document.getElementById("student_serial_txt").disabled=false;
			document.getElementById("student_serial_txt").focus();
		}

		function send_mail(item_json){
			$.ajax({
				url: 'send_mail_in_out',
				type: 'post', // getかpostを指定(デフォルトは前者)
				dataType: 'json', // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる
				scriptCharset: 'utf-8',
				data: {"item_json":item_json},
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			}).done(function (data) {
				const item_json = JSON.parse(data);
				console.log("flg"+data.flg);
				data=null;
			}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
				alert(XMLHttpRequest.status);
				alert(textStatus);
				alert(errorThrown);	
				alert('エラー2');
			});
			$('#name_fadeout_alert').show();		
		}
		function name_fadeOut(){
			//$('#name_fadeout_alert').fadeOut('100');
			$('#name_fadeout_alert').hide(1000);
			//$('div').fadeOut('fast');
		}
		setInterval('showClock()',1000);
		function set2fig(num) {
			// 桁数が1桁だったら先頭に0を加えて2桁に調整する
			var ret;
			if( num < 10 ) { ret = "0" + num; }
			else { ret = num; }
			return ret;
		}
		function showClock(){
			var nowTime = new Date();
			var nowHour = set2fig( nowTime.getHours() );
			var nowMin  = set2fig( nowTime.getMinutes() );
			var nowSec  = set2fig( nowTime.getSeconds() );
			var msg = nowHour + ":" + nowMin + ":" + nowSec;
			document.getElementById("RealtimeClockArea").innerHTML = msg;
		}
	</script>
	--}}
</body>
</html>