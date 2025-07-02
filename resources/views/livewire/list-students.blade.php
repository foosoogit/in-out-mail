<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="pb-4 row justify-content-center align-middle">
                <div class="col-auto">
                    <button type="button" name="ToMenuBtn" id="ToMenuBtn" onclick="location.href='{{route('menu')}}'" class="btn btn-primary btn-sm">メニューに戻る</button>
                </div>
                <div class="col-auto form-check form-check-inline">
                    <input type="checkbox" name="registered_cbx" id="registered_cbx" wire:click="registered()" class="form-check-input" {{session('registered_flg')}}>
                    <label class="form-check-label" for="registered_cbx">&nbsp;在籍者</label>
                </div>
                <div class="col-auto form-check form-check-inline">
                    <input type="checkbox" name="graduation_cbx" id="graduation_cbx" wire:click="graduation()" class="form-check-input" {{session('graduation_flg')}}>
                    <label class="form-check-label" for="graduation_cbx">&nbsp;卒業</label>
                </div>
                <div class="col-auto form-check form-check-inline">
                    <input type="checkbox" name="withdrawn_cbx" id="withdrawn_cbx" wire:click="withdrawn()" class="form-check-input" {{session('withdrawn_flg')}}>
                    <label class="form-check-label" for="withdrawn_cbx">&nbsp;退会</label>
                </div>
                <div class="col-auto form-check form-check-inline">
                    <input type="checkbox" name="unregistered_cbx" id="unregistered_cbx" wire:click="unregistered()" class="form-check-input" {{session('unregistered_flg')}}>
                    <label class="form-check-label" for="unregistered_cbx">&nbsp;未登録生徒番号</label>
                </div>
                <div class="col-auto">
                    <x-text-input id="kensakukey_txt" name="kensakukey_txt" type="text" class="mt-1 block w-full" :value="old('kensakukey','optional(target_key)')" required autofocus wire:model.defer="kensakukey"/>
                </div>
                <div class="col-auto">
                    <button type="button" name="SerchBtn" id="SerchBtn" wire:click="search()" class="btn btn-primary btn-sm">検索</button>
                </div>
                <div class="col-auto">
                    <button type="button" name="SerchClearBtn" id="SerchClearBtn" wire:click="searchClear()" onclick="document.getElementById('kensakukey_txt').value=''" class="btn btn-primary btn-sm">検索解除</button>
                </div>
            </div>
            <div>
            <table id="table_responsive">
                <tr>
                    <th>編集<br><button type="button" class="btn-orderby-border" wire:click="sort('serial_student-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('serial_student-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button>
                    </th>
                    <th>氏名<br>
                        <button type="button" class="btn-orderby-border" wire:click="sort('name_sei-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('name_sei-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button>
                    </th>
                    <th>しめい<br><button type="button" class="btn-orderby-border" wire:click="sort('name_sei_kana-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('name_sei_kana-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button>
                    </th>
                    <th>学年<br><button type="button" class="btn-orderby-border" wire:click="sort('grade-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('grade-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button>
                    </th>
                    <th>コース<br><button type="button" class="btn-orderby-border" wire:click="sort('course-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('course-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                    <th>メールアドレス<br><button type="button" class="btn-orderby-border" wire:click="sort('email-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                        <button type="button" class="btn-orderby-border" wire:click="sort('email-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button>
                    </th>
                    <th>電話</th>
                    <th>メモ</th>
                    <th>入退出履歴</th>
                    <th>在籍状態</th>
                </tr>
                @foreach($students as $student)
                <tr>
                    <td>
                        <form action="{{route('ShowInputStudent.Modify')}}" method="POST">@csrf<input name="StudentSerial_Btn" type="submit" value="{{ $student->serial_student}}"></form>
                    </td>
                    <td>{{ $student->name_sei }} {{ $student->name_mei }}</td>
                    <td>{{ $student->name_sei_kana }} {{ $student->name_mei_kana }}</td>
                    <td>{{ $student->grade }}</td>
                    <td>{{ $student->course }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->note }}</td>
                    <td>
                        <form action="{{route('admin.showRireki')}}" method="POST">@csrf
                            <input name="ShowRireki_Btn" type="submit" value="入退出履歴">
                            @if($student->email=="")
                                <input type="hidden" id="studserial" name="studserial" value="{{$student->student_serial}}" disabled>    
                            @else
                                <input type="hidden" id="studserial" name="studserial" value="{{$student->student_serial}}">
                            @endif
                        </form>
                    </td>
                    <td>
                        {{--<form method="post" action="{{ route('student.ajax_change_status', $student->id) }}">@csrf--}}
                            <div class="row">
                                <div class="form-check col-sm">
                                    @if ($student->status=='在籍')
                                        <input class="form-check-input" type="radio" name="status_{{ $student->serial_student}}" id="enrollment_{{ $student->serial_student}}" value="在籍" onclick="change_status('{{ $student->serial_student}}',this);" checked>
                                    @else
                                        <input class="form-check-input" type="radio" name="status_{{ $student->serial_student}}" id="enrollment_{{ $student->serial_student}}" value="在籍" onclick="change_status('{{ $student->serial_student}}',this);">
                                    @endif
                                    <label class="form-check-label" for="enrollment_{{ $student->serial_student}}">在籍</label>
                                </div>
                                <div class="form-check col-sm">
                                    @if ($student->status=='卒業')
                                        <input class="form-check-input" type="radio" name="status_{{ $student->serial_student}}" id="graduation_{{ $student->serial_student}}" value="卒業" onclick="change_status('{{ $student->serial_student}}',this);" checked>
                                    @else
                                        <input class="form-check-input" type="radio" name="status_{{ $student->serial_student}}" id="graduation_{{ $student->serial_student}}" value="卒業" onclick="change_status('{{ $student->serial_student}}',this);">
                                    @endif
                                    <label class="form-check-label" for="graduation_{{ $student->serial_student}}">卒業</label>
                                </div>
                                <div class="form-check col-sm">
                                    @if ($student->status=='退会')
                                        <input class="form-check-input" type="radio" name="status_{{ $student->serial_student}}" id="withdrawal_{{ $student->serial_student}}" value="退会" onclick="change_status('{{ $student->serial_student}}',this);" checked>
                                    @else
                                        <input class="form-check-input" type="radio" name="status_{{ $student->serial_student}}" id="withdrawal_{{ $student->serial_student}}" value="退会" onclick="change_status('{{ $student->serial_student}}',this);">
                                    @endif
                                    <label class="form-check-label" for="withdrawal_{{ $student->serial_student}}">退会</label>
                                </div>
                            </div>
                        {{--</form>--}}
                    </td>
                    {{-- 
                    <td>
                        <form method="post" action="{{ route('student.delete', $student->id) }}">@csrf
                            @method('DELETE')
                            @if($student->status=="退会")
                                <input type="submit" onClick="return clickDelete('{{ $student->name_sei }} {{ $student->name_mei }}')" class="delete-link underline text-sm text-gray-600 hover:text-gray-900 rounded-md" value="退会" disabled>    
                            @else
                                <input type="submit" onClick="return clickDelete('{{ $student->name_sei }} {{ $student->name_mei }}')" class="delete-link underline text-sm text-gray-600 hover:text-gray-900 rounded-md" value="退会">
                            @endif
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{ route('student.delete', $student->id) }}">@csrf
                            @method('DELETE')
                            @if($student->status=="卒業")
                                <input type="submit" onClick="return clickDelete('{{ $student->name_sei }} {{ $student->name_mei }}')" class="delete-link underline text-sm text-gray-600 hover:text-gray-900 rounded-md" value="卒業" disabled>    
                            @else
                                <input type="submit" onClick="return clickDelete('{{ $student->name_sei }} {{ $student->name_mei }}')" class="delete-link underline text-sm text-gray-600 hover:text-gray-900 rounded-md" value="卒業">
                            @endif
                        </form>
                    </td>
                     --}}
                </tr>
                @endforeach
            </table>
        </div>
        {{ $students->links('pagination::bootstrap-4') }}
        {{--{{$students->appends(request()->query())->links('pagination::bootstrap-4')}}--}}
    </div>
</div>