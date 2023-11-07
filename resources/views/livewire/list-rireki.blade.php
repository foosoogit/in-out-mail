<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="pb-4 row justify-content-center align-middle">
        <div class="col-auto">
        {{--<a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">メニューに戻る</a>--}}
        <button type="button" name="ToMenuBtn" id="ToMenuBtn" onclick="location.href='{{route('menu')}}'" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">メニューに戻る</button></div>    
        <div class="col-auto"><button type="button" name="CreateBtn" id="CreateBtn" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700" onclick="location.href='{{route('Students.Create')}}'" >新規登録</button></div>
            <div class="col-auto"><x-text-input id="kensakukey_txt" name="kensakukey_txt" type="text" class="mt-1 block w-full" :value="old('kensakukey','optional(target_key)')" required autofocus wire:model.defer="kensakukey"/></div>
            {{--  <a wire:click="search()" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索</a>--}}
            <div class="col-auto"><button type="button" name="SerchBtn" id="SerchBtn" wire:click="search()" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索</button></div>
            <div class="col-auto">日付検索： <input name="target_day" id="target_day" type="date" wire:change="search_day(document.getElementById('target_day').value)" value="{{$target_day}}"/></div>
            <div class="col-auto"><button type="button" name="SerchBtn" id="SerchBtn" wire:click="searchClear()" onclick="document.getElementById('kensakukey_txt').value=''" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索解除</button></div>
            {{--<a href="{{ route('student.create') }}" >新規登録</a> --}}
        </div>
        <table id="table_responsive">
            <tr>
                <th>生徒番号<br><button type="button" class="btn-orderby-border" wire:click="sort('student_serial-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                    <button type="button" class="btn-orderby-border" wire:click="sort('student_serial-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                <th>氏名<br><button type="button" class="btn-orderby-border" wire:click="sort('student_name-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                    <button type="button" class="btn-orderby-border" wire:click="sort('student_name-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                <th>入室時間<br><button type="button" class="btn-orderby-border" wire:click="sort('time_in-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                    <button type="button" class="btn-orderby-border" wire:click="sort('time_in-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                <th>退室時間<br><button type="button" class="btn-orderby-border" wire:click="sort('time_out-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                    <button type="button" class="btn-orderby-border" wire:click="sort('time_out-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                <th>コース</th>
                <th>入退出履歴</th>
            </tr>
            @foreach ($histories as $history)
                <tr>
                    <td><form action="{{route('ShowInputStudent.Modify')}}" method="POST">@csrf<input name="StudentSerial_Btn" type="submit" value="{{ $history->student_serial}}"></form>
                    </td>
                    <td>{{ $history->student_name }}</td>
                    <td>{{ $history->time_in }}</td>
                    <td>{{ $history->time_out }}</td>
                    <td>{{ $history->course }}</td>
                    <td>
                        {{--<form action="{{route('showRireki')}}" method="POST">--}}
                        <button type="button" name="SerchBtn" id="SerchBtn" wire:click="search_from_rireki('{{$history->student_serial}}')" >個人履歴</button>
                        {{--<form action="{{route('admin.showRireki')}}" method="POST">
                        <form action="ShowRireki" method="POST">
                            @csrf<input name="ShowRireki_Btn" type="submit" value="履歴">
                            <input type="hidden" id="studserial" name="studserial" value="{{$history->student_serial}}">
                        </form>
                        --}}
                    </td>
                </tr>
            @endforeach
        </table>
        {{$histories->appends(request()->query())->links('pagination::bootstrap-4')}}
    </div>
</div>