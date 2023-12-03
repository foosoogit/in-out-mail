
@extends('layouts.mail_form_master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                {!! $show_deliverid_history_html !!}
            </div>
            <div class="col">
                <div class="row">
                <div class="col-4">
                    {{--<div class="flex items-center gap-4">--}}
                        <x-primary-button onclick="location.href='{{route('menu')}}'" >メニューに戻る</x-primary-button>
                    {{--</div>--}}
                </div>
                <div class="col-5">
                    <x-primary-button name="CreateBtn" id="CreateBtn" onclick="clear_mail();" >新規作成</x-primary-button>
                </div>
                </div>
                <form method="post" action="{{ route('teachers.execute_mail_delivery') }}" >@csrf
                    <x-input-label for="subject" value="件名" />
                    <x-text-input id="subject" name="subject" type="text" class="mt-1 block w-full" :value="old('subject')" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('subject')" />
                    <x-input-label for="body" value="本文" />
                    <textarea id="body" name="body" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="15"></textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('body')" />
                    <div class="flex items-center gap-4">
                        {{--<x-primary-button onclick="setStudentSerial();">送信する</x-primary-button>--}}
                        <x-primary-button onclick="kakunin();">送信する</x-primary-button>
                    </div>
                    保護者→[name-protector] 生徒氏名→[name-student] 送信時間→[time] 塾名→[name-jyuku] フッター→[footer]
                    <input type="hidden" name="student_serial_hdn" id="student_serial_hdn">
                </form>
            </div>
            <div class="col">
                {!! $show_list_students_html !!}
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript">
    function kakunin(){
        if(window.confirm('送信します。よろしいですか？')){
            setStudentSerial();
        }
    }

    function clear_mail(){
        if(window.confirm('メール内容をクリアします。よろしいですか？')){
            document.getElementById('subject').value="";
            document.getElementById('body').value="";
        }
    }
</script>