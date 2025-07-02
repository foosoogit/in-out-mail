<div>
    <div class="py-12"> 
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h6">
            <div class="row justify-content-start m-4">
                <div class="col-auto">
			        <input class="form-check-input" style="transform:scale(1.5);" type="checkbox" name="status" id="registered" value="在籍" wire:click="registered()" {{ session('registered_flg') }}>
			        <label class="form-check-label" for="registered">在籍</label>
                </div>
                <div class="col-auto">
			        <input class="form-check-input" style="transform:scale(1.5);" type="checkbox" name="status" id="graduation" value="卒業" wire:click="graduation()"  {{ session('graduation_flg') }}>
			        <label class="form-check-label" for="graduation">卒業</label>
                </div>
                <div class="col-auto">
			        <input class="form-check-input" style="transform:scale(1.5);" type="checkbox" name="status" id="withdrawn" value="退会" wire:click="withdrawn()"  {{ session('withdrawn_flg') }}>
			        <label class="form-check-label" for="withdrawn">退会</label>
                </div>
            </div>
            <div class="pb-0 row justify-content-start align-middle h6">
                <div class="col-auto">
                   <x-text-input id="kensakukey_txt" name="kensakukey_txt" type="text" class="mt-1 block w-full" :value="old('kensakukey','optional(target_key)')" required autofocus wire:model.defer="kensakukey"/>
               </div>
                   {{--  <a wire:click="search()" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索</a>--}}
               <div class="col-auto">
                   <button type="button" name="SerchBtn" id="SerchBtn" wire:click="search()" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索</button>
               </div>
               <div class="col-auto">
                   <button type="button" name="SerchBtn" id="SerchBtn" wire:click="searchClear()" onclick="document.getElementById('kensakukey_txt').value=''" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索解除</button></div>
                   {{--<a href="{{ route('student.create') }}" >新規登録</a> --}}
               </div>
               <div>
                    <button type="button" onclick="cboxAll(true)" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">全選択</button>
                    <button type="button" onclick="cboxAll(false)" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">全解除</button>
                    <div>
                        <table class="table table-sm" width="auto">
                            <thead>
                                <tr>
                                    <th class="th-min" scope="col" style="width: 40%">
                                        氏名<br class="d-none d-sm-block">
                                        <div>
                                            <button type="button" class="btn-orderby-border" wire:click="sort('name_sei-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}"  width="15px"/></button>
                                            <button type="button" class="btn-orderby-border" wire:click="sort('name_sei-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}"  width="15px"/></button>
                                        </div>
                                    </th>
                                    <th class="th-min" scope="col" style="width: 20%">
                                        学年<br class="d-none d-sm-block"><button type="button" class="btn-orderby-border" wire:click="sort('grade-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}"  width="15px" /></button>
                                        <button type="button" class="btn-orderby-border" wire:click="sort('grade-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button>
                                    </th>
                                    <th class="th-min" scope="col" style="width: 20%">
                                        コース<br class="d-none d-sm-block"><button type="button" class="btn-orderby-border" wire:click="sort('course-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}"  width="15px" /></button>
                                        <button type="button" class="btn-orderby-border" wire:click="sort('course-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}"  width="15px"/></button>
                                    </th>
                                    <th class="th-min" scope="col" style="width: 20%">
                                        在籍状態<br class="d-none d-sm-block"><button type="button" class="btn-orderby-border" wire:click="sort('status-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}"  width="15px" /></button>
                                        <button type="button" class="btn-orderby-border" wire:click="sort('status-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}"  width="15px"/></button>
                                    </th>
                                {{-- <th>メールアドレス<br><button type="button" class="btn-orderby-border" wire:click="sort('email-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                                        <button type="button" class="btn-orderby-border" wire:click="sort('email-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button></th>
                                    --}}

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td><div class="form-check" scope="col" style="width: 40%"><input class="form-check-input" type="checkbox" value="{{ $student->serial_student}}" name='target_student_cb' id="target_student_cb_{{ $student->serial_student}}">
                                            <label class="form-check-label" for="target_student_cb_{{ $student->serial_student}}">{{ $student->name_sei }} {{ $student->name_mei }}</label></div></td>
                                        <td scope="col" style="width: 20%">{{ $student->grade }}</td>
                                        <td scope="col" style="width: 20%">{{ $student->course }}</td>
                                        <td class="font-small">{{ $student->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
               </div>
              {{$students->appends(request()->query())->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>
    <script>
       function cboxAll(obj) {
           let el = document.getElementsByName("target_student_cb");
           for(i=0;i<el.length;i++){
               console.log(el[i].checked);
               el[i].checked=obj;
           }
       }
    </script>
</div>