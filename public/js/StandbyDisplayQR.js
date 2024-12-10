/*
function register_btc_scan() {
	$('.btc_scan').on('click', (event) => {
		console.log("btc_scan");
	  $('.scan_area').show()
	  startScanner()
	  scrollTo(0, 0)
	})
	const startScanner = () => {
	  Quagga.init(
		{
		  inputStream: {
			numOfWorkers: 0,
			frequency: 1,
			name: 'Live',
			type: 'LiveStream',
			target: document.querySelector('#photo-area'),
			constraints: {
			  decodeBarCodeRate: 3,
			  successTimeout: 500,
			  codeRepetition: false,
			  tryVertical: true,
			  frameRate: 15,
			  facingMode: 'environment',
			},
		  },
		  decoder: {
			readers: ['ean_reader'],
		  },
		},
		function (err) {
		  if (err) {
			console.log(err)
			return
		  }
		  console.log('Initialization finished. Ready to start')
		  Quagga.start()
		  _scannerIsRunning = true
		}
	  )
	  Quagga.onProcessed(_onProcessed)
	  Quagga.onDetected(_onDetected)
	}
  }
  // スキャン中
  function _onProcessed(result) {
	var drawingCtx = Quagga.canvas.ctx.overlay,
	  drawingCanvas = Quagga.canvas.dom.overlay
	if (result) {
	  if (result.boxes) {
		drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute('width')), parseInt(drawingCanvas.getAttribute('height')))
		result.boxes
		  .filter(function (box) {
			return box !== result.box
		  })
		  .forEach(function (box) {
			Quagga.ImageDebug.drawPath(
			  box,
			  {
				x: 0,
				y: 1,
			  },
			  drawingCtx,
			  {
				color: 'green',
				lineWidth: 2,
			  }
			)
		  })
	  }
	  if (result.box) {
		Quagga.ImageDebug.drawPath(
		  result.box,
		  {
			x: 0,
			y: 1,
		  },
		  drawingCtx,
		  {
			color: '#00F',
			lineWidth: 2,
		  }
		)
	  }
	  if (result.codeResult && result.codeResult.code) {
		Quagga.ImageDebug.drawPath(
		  result.line,
		  {
			x: 'x',
			y: 'y',
		  },
		  drawingCtx,
		  {
			color: 'red',
			lineWidth: 3,
		  }
		)
	  }
	}
  }
  
  function _getMedian(arr) {
	arr.sort((a, b) => a - b)
	const half = Math.floor(arr.length / 2)
	if (arr.length % 2 === 1)
	  // Odd length
	  return arr[half]
	return (arr[half - 1] + arr[half]) / 2.0
  }
  
  let codes = []
  
  // 検知した
  function _onDetected(result) {
	// １つでもエラー率0.16以上があれば除外
	let is_err = false
	$.each(result.codeResult.decodedCodes, function (id, error) {
	  if (error.error != undefined) {
		if (parseFloat(error.error) > 0.16) {
		  is_err = true
		}
	  }
	})
	if (is_err) return
  
	// エラー率のmedianが0.05以上なら除外
	const errors = result.codeResult.decodedCodes.filter((_) => _.error !== undefined).map((_) => _.error)
	const median = _getMedian(errors)
	if (median > 0.05) {
	  return
	}
  
	// ３連続同じ数値だった場合のみ採用する
	codes.push(result.codeResult.code)
	if (codes.length < 3) return
	let is_same_all = false
	if (codes.every((v) => v === codes[0])) {
	  is_same_all = true
	}
	if (!is_same_all) {
	  codes.shift()
	  return
	}
  
	alert(result.codeResult.code)
	$('.scan_area').hide()
	Quagga.stop()
	Quagga.offProcessed(_onProcessed)
	Quagga.offDetected(_onDetected)
  }
*/
/*
window.onload =function(){
	console.log("Start!!");
	Quagga.init({
		inputStream: {
			name: "Live",
			type: "LiveStream",
			target: document.querySelector('#photo-area'),
			constraints: {
				decodeBarCodeRate: 3,
				successTimeout: 500,
				codeRepetition: true,
				tryVertical: true,
				frameRate: 15,
				width: 640,
				height: 480,
				facingMode: "environment"
			},
		},
		decoder: {
			readers: [
				"ean_reader"
			]
		},
	}, function (err) {
		if (err) {
			console.log(err);
			return;
		}
		console.log("Initialization finished. Ready to start");
		Quagga.start();
		_scannerIsRunning = true;
	});
	Quagga.onProcessed(function (result) {
		console.log("onProcessed() method is called.");
		var drawingCtx = Quagga.canvas.ctx.overlay,
		drawingCanvas = Quagga.canvas.dom.overlay;
		if (result) {
			if (result.boxes) {
				drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
				result.boxes.filter(function (box) {
					return box !== result.box;
				}).forEach(function (box) {
					Quagga.ImageDebug.drawPath(box, {
						x: 0,
						y: 1
					}, drawingCtx, {
						color: "green",
						lineWidth: 2
					});
				});
			}
			if (result.box) {
				Quagga.ImageDebug.drawPath(result.box, {
					x: 0,
					y: 1
				}, drawingCtx, {
					color: "#00F",
					lineWidth: 2
				});
			}
			if (result.codeResult && result.codeResult.code) {
				Quagga.ImageDebug.drawPath(result.line, {
					x: 'x',
					y: 'y'
				}, drawingCtx, {
					color: 'red',
					lineWidth: 3
				});
			}
		}
	});
	//barcode read call back
	Quagga.onDetected(function (result) {
		console.log("onDetected() method is called.");
		console.log("Detected barcode:", result.codeResult.code);
		// スキャン結果を取得
		var scannedCode = result.codeResult.code;
		// スキャン結果をHTML要素に表示
		// $("#id_jancd").text(scannedCode);
		document.getElementById("id_jancd").value = scannedCode;
		// スキャン結果をHTML要素に表示
		$("#scanResult").text("Detected barcode: " + scannedCode);
		// バーコードが検出されたらスキャンを停止する
		Quagga.stop();
	});
  };

$("#stopButton").click(()=>{
	console.log("Stop!!");
	Quagga.stop();
});
*/
/*
window.onload = function(){
	console.log("Start!!");
	Quagga.init({
		inputStream: {
			type: "LiveStream",
			target: document.querySelector('#container')
		},
		constraints: {
			facingMode: "environment",
		},
		decoder: {
			readers: [ "ean_reader" ]
		} 
	}, 
	function(err) {
		if (err) {
			console.log(err);
			return;
		}
		console.log("Initialization finished. Ready to start");
		Quagga.start();
		_scannerIsRunning = true;
	});

	Quagga.onProcessed(function(result){
		console.log("読み取り完了3")
		var ctx = Quagga.canvas.ctx.overlay;
		var canvas = Quagga.canvas.dom.overlay;
		ctx.clearRect(0, 0, parseInt(canvas.width), parseInt(canvas.height));
		if (result) {
			if (result.box) {
				console.log(JSON.stringify(result.box));
				Quagga.ImageDebug.drawPath(result.box, {x: 0, y: 1}, ctx, {color: 'blue', lineWidth: 2});
			}
		}
	});

	Quagga.onDetected(function(result){
		console.log("読み取り完了2")
		document.querySelector('#result').textContent = result.codeResult.code;
	});      
};
*/
/*
function ShowSendingTo(mail_serial){
	$.ajax({
		url: 'ajax_get_mail_sending_to',
		type: 'post',
		dataType: 'text',
		scriptCharset: 'utf-8',
		frequency: 10,
		cache: false,
		async : false,
		data: {'mail_serial': mail_serial},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		   }
	}).done(function (data) {
		window.confirm("送信先(〇:成功/×:失敗)：\n"+data);
		//alert("送信先：\n"+data);
	}) .fail(function (XMLHttpRequest, textStatus, errorThrown) {
		//alert(XMLHttpRequest.status);
		//alert(textStatus);
		//alert(errorThrown);	
		alert('検索できませんでした。');
	});
}
*/