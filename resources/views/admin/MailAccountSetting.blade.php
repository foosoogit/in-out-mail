{{-- <x-app-layout> --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache"> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    {{-- 
    <style>
        .alert {
            position: sticky;
            /*position: relative;*/
            /*top:110px;*/
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
        .alert-msg {
            position: fixed;
            top: 9%;
            width: 100%;
            color: #1d643b;
            background-color: #d7f3e3;
            border-color: #c7eed8;
            transform: translateY(-50%);
            text-align: left;
            z-index: 99;
        }
    </style>
     --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- <link href="/css/app.css" rel="stylesheet"> --}}
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased">
    <code class="code-multiline"><!-- jQuery読み込み -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <!-- Propper.js読み込み -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <!-- BootstrapのJavascript読み込み -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        </code>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="flex items-center gap-4">
                        <x-primary-button onclick="location.href='{{route('menu')}}'" >メニューに戻る</x-primary-button>
                    </div>
                        <form method="post" action="{{ route('teachers.email_account.update') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="MAIL_USERNAME" value="ユーザー名" />
                            <x-text-input id="MAIL_USERNAME" name="MAIL_USERNAME" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_USERNAME']}}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_USERNAME')" />
                        </div>
                        <div>
                            <x-input-label for="MAIL_FROM_ADDRESS" value="メールアドレス" />
                            <x-text-input id="MAIL_FROM_ADDRESS" name="MAIL_FROM_ADDRESS" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_FROM_ADDRESS']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_FROM_ADDRESS')" />
                        </div>
                        <div>
                            <x-input-label for="MAIL_FROM_NAME" value="差出人名" />
                            <x-text-input id="MAIL_FROM_NAME" name="MAIL_FROM_NAME" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_FROM_NAME']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_FROM_NAME')" />
                        </div>
                        <div>
                            <x-input-label for="MAIL_PASSWORD" value="パスワード" />
                            <x-text-input id="MAIL_PASSWORD" name="MAIL_PASSWORD" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_PASSWORD']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_PASSWORD')" />
                        </div>
                        <div>
                            <x-input-label for="MAIL_MAILER" value="通信プロトコル" />
                            <x-text-input id="MAIL_MAILER" name="MAIL_MAILER" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_MAILER']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_MAILER')" />
                        </div>
                        <div>
                            <x-input-label for="MAIL_HOST" value="サーバー名" />
                            <x-text-input id="MAIL_HOST" name="MAIL_HOST" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_HOST']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_HOST')" />
                        </div>
                        <div>
                            <x-input-label for="MAIL_ENCRYPTION" value="接続の保護" />
                            <x-text-input id="MAIL_ENCRYPTION" name="MAIL_ENCRYPTION" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_ENCRYPTION']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_ENCRYPTION')" />
                        </div>
                        <div>
                            <x-input-label for="MAIL_PORT" value="ポート番号" />
                            <x-text-input id="MAIL_PORT" name="MAIL_PORT" type="text" class="mt-1 block w-full" value="{{$env_array['MAIL_PORT']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('MAIL_PORT=')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button data-bs-toggle="modal" data-bs-target="#exampleModal">登録する</x-primary-button> 
                            {{--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">登録する</button>--}}
                            {{--
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <strong>登録しました。</strong>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              --}}
                                @if( session('flash') )
                                <div class="alert alert-msg">{{ session('flash') }}</div>
                                {{--<div class="flash_message bg-success text-center py-3 my-0">{{ session('flash') }}</div>--}}
                          @endif
                          @include('layouts.flash-message')
                          <!-- Modal -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="/js/app.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
{{-- </x-app-layout> --}}