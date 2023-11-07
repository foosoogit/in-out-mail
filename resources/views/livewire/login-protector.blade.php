<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="flex items-center gap-4">
                        {{ env('MAIL_FROM_NAME') }} 保護者様用入退出履歴チェック
                        @auth
                        <x-primary-button class='btn btn-primary btn-sm' onclick="history.back()">メニューに戻る(管理者のみ表示されてます。)</x-primary-button>
                        @endauth
                    </div>
                        <div>
                            ログイン
                            <x-input-label for="email_protector" value="メールアドレス" />
                            <x-text-input type="text" class="mt-1 block w-full" name="email_protector" id="email_protector" autofocus />
                            <x-input-label for="pass_for_protector" value="パスワード" />
                            <x-text-input type="password" class="mt-1 block w-full" name="pass_for_protector" id="pass_for_protector" value="{{ $pass }}" autofocus />
                            {{--<x-text-input type="text" class="mt-1 block w-full" wire:keydown.enter.model="student_serial" autofocus />--}}
                            {{-- {{$seated_msg}}{{$student_serial}} --}}
                            <x-input-error class="mt-2" :messages="$errors->get('student_serial')" />
                            <div class="flex items-center gap-4">
                                <x-primary-button wire:click="search_student(document.getElementById('email_protector').value,document.getElementById('pass_for_protector').value)" >履歴確認ページへ</x-primary-button>
                                {{ $login_msg }}
                            </div>
                        </div>
                    {{--</form>--}}
                </div>
            </div>
        </div>
    </div>
</div>
