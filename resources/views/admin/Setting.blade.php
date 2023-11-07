{{-- <x-app-layout> --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    {{--  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>
    --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="flex items-center gap-4">
                        <x-primary-button onclick="location.href='{{route('menu')}}'" >メニューに戻る</x-primary-button>
                    </div>
                        <form method="post" action="{{ route('teachers.setting.update') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="JyukuName" value="塾名" />
                            <x-text-input id="JyukuName" name="JyukuName" type="text" class="mt-1 block w-full" value="{{$configration_array['JyukuName']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('JyukuName')" />
                        </div>
                        <div>
                            <x-input-label for="Grade" value="対応学年" />
                            <x-text-input id="Grade" name="Grade" type="text" class="mt-1 block w-full" value="{{$configration_array['Grade']}}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('Grade')" />
                        </div>
                        <div>
                            <x-input-label for="Course" value="コース" />
                            <x-text-input id="Course" name="Course" type="text" class="mt-1 block w-full" value="{{$configration_array['Course']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('Course')" />
                        </div>
                        <div>
                            <x-input-label for="Interval" value="入室→退出までの最短時間(分)" />
                            <x-text-input id="Interval" name="Interval" type="text" class="mt-1 block w-full" value="{{$configration_array['Interval']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('Interval')" />
                        </div>
                        <div>
                            <x-input-label for="DdisplayLineNumStudentsList" value="一覧表に表示させる行数" />
                            <x-text-input id="DdisplayLineNumStudentsList" name="DdisplayLineNumStudentsList" type="text" class="mt-1 block w-full" value="{{$configration_array['DdisplayLineNumStudentsList']}}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('DdisplayLineNumStudentsList')" />
                        </div>
                        @include('layouts.flash-message')
                        <div>
                            <span>[メール設定] テストメール送信先：<blockquote class="text-primary">{{ Auth::user()->email }}</blockquote></span>
                            塾名→[name-jyuku]  生徒氏名→[name-student]  保護者氏名→[name-protector] 時間→[time] フッター→[footer]
                            ※生徒氏名と保護者氏名はダミーデータで送信されます。
                            <x-input-label for="sbjIn" value="入室時の件名" />
                            <textarea id="sbjIn" name="sbjIn" rows="1" class="mt-1 block w-full" required autofocus >{{$configration_array['sbjIn']}}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('sbjIn')" />
                        </div>
                        <div>
                            <x-input-label for="MsgIn" value="入室時のメッセージ" />
                            <textarea id="MsgIn" name="MsgIn" rows="5" class="mt-1 block w-full" required autofocus >{{$configration_array['MsgIn']}}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('MsgIn')" />
                            {{--<a href="send_test_mail/MsgIn">テスト送信する</a>--}}
                            <x-primary-button name="SendMsgInBtn" value="SendMsgIn">テスト送信する</x-primary-button>
                            {{-- <button type="button" onclick='href="teachers/send_test_mail/MsgIn"'>テスト送信する</button> --}}
                            {{-- <x-primary-button onclick='href="teachers/send_test_mail/MsgIn"'>テスト送信する</x-primary-button> --}}
                            {{-- <x-primary-button onclick='href="{{ route('teachers.test_mail_MsgIn.send', ['type'=>'MsgIn']) }}"'>テスト送信する</x-primary-button> --}}
                        </div>
                        <div>
                            <x-input-label for="sbjOut" value="退出時の件名" />
                            <textarea id="sbjOut" name="sbjOut" rows="1" class="mt-1 block w-full"  required autofocus >{{$configration_array['sbjOut']}}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('sbjOut')" />
                        </div>
                        <div>
                            <x-input-label for="MsgOut" value="退出時のメッセージ" />
                            <textarea id="MsgOut" name="MsgOut" rows="5" class="mt-1 block w-full"  required autofocus >{{$configration_array['MsgOut']}}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('MsgOut')" />
                            <x-primary-button name="SendMsgOutBtn" value="SendMsgOut">テスト送信する</x-primary-button>
                        </div>
                        <div>
                            <x-input-label for="sbjTest" value="テストメールの件名" />
                            <textarea id="sbjTest" name="sbjTest" rows="1" class="mt-1 block w-full" >{{$configration_array['sbjTest']}}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('sbjTest')" />
                        </div>
                        <div>
                            <x-input-label for="MsgTest" value="テストメールの内容" />
                            <textarea id="MsgTest" name="MsgTest" rows="5" class="mt-1 block w-full" >{{$configration_array['MsgTest']}}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('MsgTest')" />
                                <x-primary-button name="SendMsgTestBtn" value="SendMsgTestBtn">テスト送信する</x-primary-button>
                        </div>
                        <div>
                            <x-input-label for="MsgFooter" value="メールフッター" />
                            <textarea id="MsgFooter" name="MsgFooter" rows="5" class="mt-1 block w-full"  required autofocus >{{$configration_array['MsgFooter']}}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('MsgFooter')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>登録する</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
{{-- </x-app-layout> --}}