<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>入退出メニュー</title>
	{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
	{{--<link rel="stylesheet" href="css/style.css">--}}
	{{-- <link rel="stylesheet" href="{{ asset('/css/menu_2.css')  }}" > --}}
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body class="font-sans antialiased" style="font-size: x-large;">
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        {{-- <div class="max-w-xl"> --}}
          <blockquote class="blockquote text-center text-primary">Jyuku-in-out-mail {{ $MAIL_FROM_NAME }} メニュー</blockquote>
          <div class="table-responsive">
            <table style="line-height: 200%;" class="table table-striped">
              {{--  <table class="table">--}}
              <thead>
                <tr>
                  <th scope="col" style="width: 10%">#</th>
                  <th scope="col" style="width: 30%">メニュー</th>
                  <th scope="col" style="width: 60%">説明</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row" class="display-1">1</th>
                  <td ><a href="{{ route('teachers.show_standby_display') }}">待ち受け画面</a></td>
                  <td>コードリーダーで読み込みます。</td>
                </tr>
                <tr>
                  <th scope="row" class="display-1">2</th>
                  <td ><a href="{{ route('teachers.show_standby_display_QR') }}">待ち受け画面(QR)</a></td>
                  <td>スマホで直接QRコードを読み込みます。</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td><a href="{{ route('admin.showRireki') }}">入退出履歴</a></td>
                  <td>各生徒の入退出履歴を確認できます。</td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td><a href="{{ route('teachers.show_delivery_email.get') }}">メール配信</a></td>
                  <td>保護者に一斉メールを配信できます。（配信先選択可能）</td>
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td><a href="{{ route('Students.List.get') }}">生徒一覧（修正・退会）</a></td>
                  <td>生徒一覧、修正、退会処理できます。</td>
                </tr>
                <tr>
                  <th scope="row">6</th>
                  <td><a href="{{ route('Students.Create') }}">新規生徒登録</a></td>
                  <td>新規生徒登録</td>
                </tr>
                <tr>
                  <th scope="row">7</th>
                  <td><a href="{{ route('protector.login') }}">保護者用入退出確認ページ</a></td>
                  <td>保護者が生徒の入退出履歴を確認できるページです。https://jyuku-in-out-mail.net/login_protector</td>
                </tr>
                <tr>
                  <th scope="row">8</th>
                  <td><a href="{{ route('teachers.index') }}">講師登録・追加・削除</a></td>
                  <td>講師の登録・追加・削除</td>
                </tr>
                <tr>
                  <th scope="row">9</th>
                  <td><a href="{{ route('teachers.show_setting') }}">環境設定</a></td>
                  <td>塾名/対応学年/コース/入室→退出までの最短時間/一覧表に表示させる行数/テストメール送信/入退室時メッセージ</td>
                </tr>
                <tr>
                  <th scope="row">10</th>
                  <td><a href="{{ route('teachers.show_email_account_setup') }}">メールアカウントのセットアップ</a></td>
                  <td>メールアカウントをセットアップします。</td>
                </tr>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-70">
                  <th scope="row">11</th>
                  <td>
                    <form action="{{ route('logout') }}" method="post">@csrf
                      <input type="submit" value="ログアウト">
                    </form>
                    {{-- <a href="{{ route('logout') }}">ログアウト</a> --}}
                  </td>
                  <td>ログアウト</td>
                </tr>
              </tbody>
            </table>
          </div>
        {{-- </div> --}}
      </div>
    </div>
  </div>
  {{-- 
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarEexample">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">タイトル</a>
      </div>
      
      <div class="collapse navbar-collapse" id="navbarEexample">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">メニューＡ</a></li>
          <li><a href="#">メニューＢ</a></li>
          <li><a href="#">メニューＣ</a></li>
        </ul>
      </div>
    </div>
  </nav>
   --}}
  {{-- 
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Bootstrapサンプル</a>
      </div>
    </div>
  </nav>
  <div class="container">
    <!-- ここからが追加した部分 -->
    <div class="panel panel-default">
      <div class="panel-heading">パネルの見出し</div>
      <div class="panel-body">
        <p>パネルの本文</p>
      </div>
    </div>
    <!-- ここまで -->
  </div>
 --}}
{{-- 
<div id="container">
	<div id="main">
		<ul class="sidenav">
			<li><a href="{{ route('teachers.show_standby_display') }}">待ち受け画面</a></li>
			<li><a href="{{ route('admin.showRireki') }}">入退出履歴</a></li>
			<li><a href="{{ route('teachers.show_delivery_email') }}">メール配信</a></li>
			<li><a href="{{ route('Students.List') }}">生徒一覧（新規登録・追加・削除）</a></li>
			<li><a href="{{ route('Students.Create') }}">新規生徒登録</a></li>
			<li><a href="{{ route('teachers.index') }}">講師登録・追加・削除</a></li>
			<li><a href="{{ route('teachers.show_setting') }}">環境設定</a></li>
			<li><a href="{{ route('teachers.show_email_account_setup') }}">メールアカウントのセットアップ</a></li>
		</ul>
		<form action="{{ route('logout') }}" method="post">
			@csrf
			<input type="submit" value="ログアウト">
		  </form>
	</div>
</div>
 --}}
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> --}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>