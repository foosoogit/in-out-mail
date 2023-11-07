<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\Student;

class LoginProtector extends Component
{
    public $login_msg = '',$pass='';

    public function search_student($email_protector,$pass_for_protector){
		session(['target_stud_serial_for_protector'=>'']);
        //Log::alert('email_protector='.$email_protector);
        //Log::alert('pass_for_protector='.$pass_for_protector);
        $serch_std_sql=Student::where('pass_for_protector','=',$pass_for_protector)
            ->where('email','like','%'.$email_protector.'%');
        //Log::alert('count='.$serch_std_sql->count());
        if($serch_std_sql->count()>0){
            $serch_std_inf_array=$serch_std_sql->first();
            session(['target_stud_inf_array'=>$serch_std_inf_array]);
            Log::alert('target_stud_inf_array='.session('target_stud_inf_array'));
            return redirect('show_rireki_for_protector');
        }else{
            $this->pass='';
            $this->login_msg="登録されていません。";
        }
        //$this->serch_key_p=$request->input('user_serial');
		//session(['serchKey' => $request->input('user_serial')]);
	}

    public function render()
    {
        return view('livewire.login-protector');
    }
}