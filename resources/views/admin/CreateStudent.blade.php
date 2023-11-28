{{-- <x-app-layout> --}}
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/default.css')  }}" >
    <!-- Scripts -->
    <!--@vite(['resources/css/app.css', 'resources/js/app.js'])-->
</head>
<body class="font-sans antialiased">
    <!--<div class="py-12"style="font-size:x-large;">-->
    <div class="py-12" style="font-size: x-large;">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border">
                <div style="line-height: 2em">
                    <div class="container">
                        <p>
                        <div class="row">
                            <div class="col-auto">
                                <x-primary-button class="btn btn-primary" onclick="location.href='{{route('menu')}}'">メニュー</x-primary-button>
                            </div>
                            <div class="col-auto">
                                <x-primary-button class="btn btn-primary" onclick="location.href='{{route('Students.List')}}'" >生徒一覧</x-primary-button>
                            </div>
                        </div>
                        </p>
                        <div class="row">
                            <div class="col-auto">
                                <label for="serial_student" class="max-w-7xl font-large">生徒番号 </label>
                            </div>
                            <div class="col-auto">
                                <input id="serial_student" name="serial_student" type="text" class="form-control" value="{{$stud_inf->serial_student}}" readonly/>
                            </div>
                            <div class="col-auto">
                                <x-input-error class="mt-2" :messages="$errors->get('serial_student')" /> {!! $barcode !!}
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-4">
                                <x-input-label for="name_sei" value="姓" />
                                <input id="name_sei" name="name_sei" type="text" class="form-control" value="{{old('name_sei',optional($stud_inf)->name_sei)}}" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name_sei')" />
                            </div>
                            <div class="col-4">
                                <x-input-label for="name_mei" value="名" />
                                <input id="name_mei" name="name_mei" type="text" class="form-control" value="{{old('name_mei',optional($stud_inf)->name_mei)}}" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name_mei')" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <x-input-label for="name_sei_kana" value="せい" />
                                <input id="name_sei_kana" name="name_sei_kana" type="text" class="form-control" value="{{old('name_sei_kana',optional($stud_inf)->name_sei_kana)}}" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name_sei_kana')" />
                            </div>
                            <div class="col-4">
                                <x-input-label for="name_mei_kana" value="めい" />
                                <input id="name_mei_kana" name="name_mei_kana" type="text" class="form-control" value="{{old('name_mei_kana',optional($stud_inf)->name_mei_kana)}}" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name_mei_kana')" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                {!!$html_gender_ckbox!!}  
                            </div>
                            <div class="col-auto">
                                {!!$html_course_ckbox!!} 
                            </div>                   
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <x-input-label for="protector_array[0]" value="送信先宛名-1" class="control-label"/>
                                <input id="protector_array[0]" name="protector_array[0]" type="text" class="form-control" value="{{ old('protector_array[0]',$protector_array[0]) }}"/>
                            </div>
                            <div class="col-4">
                                <x-input-label for="email_array[0]" value="email-1" />
                                <input id="email_array[0]" name="email_array[0]" type="text" class="form-control" value="{{ old('email_array[0]',$email_array[0]) }}"/>
                                <x-input-error class="mt-2" :messages="$errors->get('email_array[0]')" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <x-input-label for="protector_array[1]" value="送信先宛名-2" class="control-label"/>
                                <input id="protector_array[1]" name="protector_array[1]" type="text" class="form-control" value="{{ old('protector_array[1]',$protector_array[1]) }}" class="form-control"/>
                            </div>
                            <div class="col-4">
                                <x-input-label for="email_array[1]" value="email-2" />
                                <input id="email_array[1]" name="email_array[1]" type="text" class="form-control" value="{{ old('email_array[1]',$email_array[1]) }}"/>
                                <x-input-error class="mt-2" :messages="$errors->get('email_array[1]')" />
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-4">
                                <x-input-label for="protector_array[2]" value="送信先宛名-3" class="control-label"/>
                                <input id="protector_array[2]" name="protector_array[2]" type="text" class="form-control" value="{{ old('protector_array[2]',$protector_array[2]) }}" class="form-control"/>
                            </div>
                            <div class="col-4">
                                <x-input-label for="email_array[2]" value="email-3" />
                                <input id="email_array[2]" name="email_array[2]" type="text" class="form-control" value="{{ old('email_array[2]',$email_array[2]) }}"/>
                                <x-input-error class="mt-2" :messages="$errors->get('email_array[2]')" />
                            </div>
                        </div>
                        <button  type="button" name="SendMsgToProtectorBtn" class="btn btn-success btn-xs" value="SendMsgToProtectorBtn" onclick="return save_manage('mail');">保護者へ着信確認テストメールを送信</button>
                        @if( session('flash.send') )
                            <div class="alert alert-send">{{ session('flash.send') }}</div>
                        @endif
                        <div class="row">
                            <div class="col-4">
                                <x-input-label for="phone" value="電話" />
                                <input id="phone" name="phone" type="text" class="form-control" value="{{old('phone',optional($stud_inf)->phone)}}" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>
                            <div class="col-4">
                                <x-input-label for="pass_for_protector" value="保護者確認用パスワード" />
                                <input id="pass_for_protector" name="pass_for_protector" type="text" class="form-control" value="{{old('pass_for_protector',optional($stud_inf)->pass_for_protector)}}" autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('pass_for_protector')" />
                            </div>
                        </div>
                        <div>
                            <x-input-label for="grade" value="学年" />
                            {!!$html_grade_slct!!}
                            <x-input-error class="mt-2" :messages="$errors->get('grade')" />
                        </div>
                        <div>
                            <x-input-label for="elementary" value="小学校名" />
                            <input id="elementary" name="elementary" type="text" class="form-control" value="{{old('elementary',optional($stud_inf)->elementary)}}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('elementary')" />
                        </div>
                        <div>
                            <x-input-label for="junior_high" value="中学校名" />
                            <input id="junior_high" name="junior_high" type="text" class="form-control" value="{{old('junior_high',optional($stud_inf)->junior_high)}}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('junior_high')" />
                        </div>
                        <div>
                            <x-input-label for="high_school" value="高校名" />
                            <input id="high_school" name="high_school" type="text" class="form-control" value="{{old('high_school',optional($stud_inf)->high_school)}}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('high_school')" />
                        </div>
                        <div>
                            <x-input-label for="note" value="メモ" />
                            <textarea id="note" name="note" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="3">{{ old('note',optional($stud_inf)->note) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('note')" />
                        </div>
                        @if (session('message'))
                            <div class="alert alert-danger">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="flex items-center gap-4">
                            @if( session('flash.modify') )
                                <div class="alert alert-modify">{{ session('flash.modify') }}</div>
                            @endif
                            <button type="button" class="btn btn-primary" onclick="save_manage('save');">登録する</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function gender_manage(obj){
                console.log("id="+obj.id);
                if(obj.checked==true){
                    if(document.getElementById('gender[1]').id==obj.id){
                        document.getElementById('gender[0]').checked=false;
                    }else{
                        document.getElementById('gender[1]').checked=false;
                    }
                }
            }
            function save_manage(type){
                console.log("type="+type);

                if(type=='mail'){
                    if(!window.confirm("送信しますか？")){
                        return false;
                    }
                }

                const email_array = [],protector_array = [],course_array=[],gender_array=[];
                var course=document.getElementsByName("course[]");
                for(i=0;i<course.length;i++){
                    if(course[i].checked){
                        console.log("course="+course[i].value);
                        course_array.push(course[i].value);
                    }
                }
                const courses=course_array.join(',');
                for(i=0;i<3;i++){
                    if(document.getElementById("email_array["+i+"]").value!=''){
                        email_array.push(document.getElementById("email_array["+i+"]").value);
                        protector_array.push(document.getElementById("protector_array["+i+"]").value);
                    }
                }
                    var gender="";
                    //var gender_array=document.getElementsByName("gender");
                    for(i=0;i<2;i++){
                        if(document.getElementById("gender["+i+"]").checked){
                            gender=document.getElementById("gender["+i+"]").value;
                            break;
                        }
                    }
                    const emails=email_array.join(',');
                    const protectors=protector_array.join(',');
                    $.ajax({
                        url: 'update_JQ',
                        type: 'post', // getかpostを指定(デフォルトは前者)
                        dataType: 'text', // 「json」を指定するとresponseがJSONとしてパースされたオブジェクトになる
                        scriptCharset: 'utf-8',
                        data: {
                            "serial_student":$('#serial_student').val(),
                            "email":emails,
                            "name_sei":$('#name_sei').val(),
                            "name_mei":$('#name_mei').val(),
                            "name_sei_kana":$('#name_sei_kana').val(),
                            "name_mei_kana":$('#name_mei_kana').val(),
                            "protector":protectors,
                            "pass_for_protector":$('#pass_for_protector').val(),
                            "gender":gender,
                            "phone":$('#phone').val(),
                            "grade":$('#grade').val(),
                            "elementary":$('#elementary').val(),
                            "junior_high":$('#junior_high').val(),
                            "high_school":$('#high_school').val(),
                            "note":$('#note').val(),
                            "course":courses,
                            "type":type
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }).done(function (data) {
                        alert(data);
                        data=null;
                    }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status);
                        alert(textStatus);
                        alert(errorThrown);	
                        alert('エラー');
                    });
                //}
            }
	    </script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>--}}
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>