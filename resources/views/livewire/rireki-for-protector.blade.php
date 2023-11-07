<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="pb-4 row justify-content-center align-middle">
            <div class="col-auto">
                {{-- 
                    <h3><in put name="target_date" id="target_date" type="date" onchange="getTargetdata(this);" value="{{$today}}"/></h3>
                    <button type="button" name="SerchBtn" id="SerchBtn" wire:click="search()" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索</button></div>
                    <div class="col-auto"><button type="button" name="SerchBtn" id="SerchBtn" wire:click="searchClear()" onclick="document.getElementById('kensakukey_txt').value=''" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索解除</button></div>
                    --}}
                    {{--<a href="{{ route('student.create') }}" >新規登録</a> --}}
                @auth
                    <div class="row">
                        <div class="col"><p class="lh-lg">
                            <x-primary-button class='btn btn-primary btn-sm rounded' onclick="history.back()">保護者ログインに戻る(管理者のみ表示されてます。)</x-primary-button>
                        </p></div>
                    </div>
                @endauth
                <div class="row lh-lg">
                    <div class="col"><p class="lh-lg">
                    入退出履歴 生徒指名：{{ session('target_stud_inf_array')->name_sei }}{{ session('target_stud_inf_array')->name_mei }}様
                    </p></div>
                </div>
                <div class="row lh-lg">
                    <p class="lh-lg">
                    <div class="col">
                        <label>日付検索： </label>
                    </div>
                    <div class="col">
                        <input name="target_day" id="target_day" type="date" wire:change="search_day(document.getElementById('target_day').value)" value="{{$target_day}}"/>
                    </div>
                        <div class="col">
                        <x-primary-button wire:click="search_day('')" class='btn btn-primary btn-sm rounded'>検索解除</x-primary-button>
                    </div>
                    </p>
                </div>
                <div class="row">
                    <div class="col">
                        <table id="table_responsive">
                            <tr>
                                <th>日付&nbsp;<button type="button" class="btn-orderby-border" wire:click="sort_day('target_date-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                                    <button type="button" class="btn-orderby-border" wire:click="sort_day('target_date-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button>
                                <th>入室時間</th>
                                <th>退室時間</th>
                            </tr>
                            @foreach ($histories as $history)
                                <tr>
                                    <td>{{ $history->target_date }}{{ $history->Week }}</td>
                                    <td>{{ $history->OnlyTimeIn }}</td>
                                    <td>{{ $history->OnlyTimeOut }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                {{$histories->appends(request()->query())->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>
</div>