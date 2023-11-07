<div>
    <div class="py-12"> 
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h6">
           <div class="pb-4 row justify-content-center align-middle h6">
               <div class="col-auto">
                   <x-text-input id="kensakukey_txt" name="kensakukey_txt" type="text" class="mt-1 block w-full" :value="old('kensakukey','optional(target_key)')" required autofocus wire:model.defer="kensakukey"/>
               </div>
               <div class="col-auto">
                   <button type="button" name="SerchBtn" id="SerchBtn" wire:click="search()" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索</button>
               </div>
               <div class="col-auto">
                   <button type="button" name="SerchBtn" id="SerchBtn" wire:click="searchClear()" onclick="document.getElementById('kensakukey_txt').value=''" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">検索解除</button></div>
               </div>
               <div class="table ml-3">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>配信日<br><button type="button" class="btn-orderby-border" wire:click="sort('date_delivered-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                                    <button type="button" class="btn-orderby-border" wire:click="sort('date_delivered-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button>
                                    </th>
                                <th>件名<br><button type="button" class="btn-orderby-border" wire:click="sort('subject-ASC')"><img src="{{ asset('images/sort_A_Z.png') }}" width="15px" /></button>
                                <button type="button" class="btn-orderby-border" wire:click="sort('subject-Desc')"><img src="{{ asset('images/sort_Z_A.png') }}" width="15px" /></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($mailDeliveied as $Deliveied)
                            <tr>
                                <td>{{ $Deliveied->date_delivered }}</td>
                                <td>
                                    <a href="javascript:setDeriveredMailToBody('{{ $Deliveied->subject }}','{{ $Deliveied->body }}','{{ $Deliveied->student_name }}');">{{ $Deliveied->subject }}</a>
                                    <input type="hidden" id="mail_body" name="mail_body" value="{{ $Deliveied->body }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
               </div>
              {{$mailDeliveied->appends(request()->query())->links('pagination::bootstrap-4')}}
           </div>
           <x-input-label for="send_student" value="配信者" />
              <textarea id="send_student_tara" name="send_student_tara"></textarea>
       </div>
    </div>
    <script>
    function setDeriveredMailToBody(sbj,body,stut_name){
        var parentWin=window.parent;
        parentWin.document.getElementById('subject').value=sbj;
        parentWin.document.getElementById('body').value=body;

        var send_student_tara=document.getElementById('send_student_tara');
        send_student_tara.value=stut_name.replace(/,/g, '\n');
    }
</script>
</div>