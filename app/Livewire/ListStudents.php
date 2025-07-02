<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Http\Controllers\InitConsts;
use App\Http\Controllers\OtherFunc;
use Illuminate\Support\Collection;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ListStudents extends Component
{
    use WithPagination;
    public $sort_key_p = '',$asc_desc_p="",$serch_key_p="",$targetPage=null;
	public $kensakukey="";
    public static $key="";
    public $Unregistered_flg=false;
    public $Retiree_flg=false;
    public $orderColumn = "serial_student";
    public $sortOrder = "asc";
    public $StudentQuery="";

    public function registered(){
        if(session('registered_flg')=="checked"){
            session(['registered_flg' => ""]);
        }else{
            session(['registered_flg' => "checked"]);
        }
    }
    
    public function unregistered(){
        if(session('unregistered_flg')=="checked"){
            session(['unregistered_flg' => ""]);
        }else{
            session(['unregistered_flg' => "checked"]);
        }
    }

    public function withdrawn(){
        if(session('withdrawn_flg')=="checked"){
            session(['withdrawn_flg' => ""]);
        }else{
            session(['withdrawn_flg' => "checked"]);
        }
    }

    public function graduation(){
        if(session('graduation_flg')=="checked"){
            session(['graduation_flg' => ""]);
        }else{
            session(['graduation_flg' => "checked"]);
        }
    }

    public function searchClear(){
		$this->serch_key_p="";
		$this->kensakukey="";
        $this->orderColumn = "serial_student";
        $this->sortOrder = "asc";
        $this->targetPage=null;
        $this->Unregistered_flg=false;
        $this->Retiree_flg=false;
        $this->serch_key_p="";
		$this->kensakukey="";
		session(['serchKey' => '']);
    }

    public function search_from_top_menu(Request $request){
		$this->serch_key_p=$request->input('user_serial');
        session(['serchKey_stud' => $request->input('user_serial')]);
        $_SESSION['serchKey_stud']=$request->input('user_serial');
	}

    public function search(){
        $this->targetPage=1;
        $this->serch_key_p=$this->kensakukey;
		session(['serchKey' => $this->kensakukey]);
	}

    public function sort($sort_key){
        $sort_key_array=array();
		$sort_key_array=explode("-", $sort_key);
		session(['sort_key' =>$sort_key_array[0]]);
		session(['asc_desc' =>$sort_key_array[1]]);
	}

    public function render(){
        if(isset($_SERVER['HTTP_REFERER'])){
            OtherFunc::set_access_history($_SERVER['HTTP_REFERER']);
        }

        if(!isset($sort_key_p) and session('sort_key')==null){
            session(['sort_key' =>'']);
        }
        $this->sort_key_p=session('sort_key');
    
        if(!isset($asc_desc_p) and session('asc_desc')==null){
            session(['asc_desc' =>'ASC']);
        }
        $this->asc_desc_p=session('asc_desc');

        $StudentQuery = Student::query();

        $status_array=array();
        
        log::alert('registered_flg 2='.session('registered_flg'));
        log::alert('withdrawn_flg 2='.session('withdrawn_flg'));
        log::alert('graduation_flg 2='.session('graduation_flg'));
        log::alert('unregistered_flg 2='.session('unregistered_flg'));

        if(session('registered_flg')<>"checked"){
            $StudentQuery=$StudentQuery->where('status','<>','在籍');
        }
        if(session('withdrawn_flg')<>"checked"){
            $StudentQuery=$StudentQuery->where('status','<>','退会');
        }
        if(session('graduation_flg')<>"checked"){
            $StudentQuery=$StudentQuery->where('status','<>','卒業');
        }
        if(session('unregistered_flg')<>"checked"){
            $StudentQuery=$StudentQuery->where('status','<>','');
        }
        /*else{
            $StudentQuery=$StudentQuery->orwhereNull('status');
        }*/
        
        /*
        if(session('registered_flg')=="checked" && session('unregistered_flg')=="" && session('withdrawn_flg')==""){
            $users = $StudentQuery->where('name_sei','<>',null)
                    ->where('name_sei','<>',"")
                    ->Where(function($query) {
                        $query->where('grade','=',null)
                                ->orwhere('grade','<>','退会');
                    });
        }else if(session('registered_flg')=="checked" && session('unregistered_flg')=="" && session('withdrawn_flg')=="checked"){
            $StudentQuery =$StudentQuery->where('grade','=',"退会")
                ->orWhere(function($query) {
                    $query->where('name_sei','<>',"")
                    ->orwhere('name_sei','<>',null);
                });
        }else if(session('registered_flg')=="checked" && session('unregistered_flg')=="checked" && session('withdrawn_flg')==""){
            $StudentQuery =$StudentQuery->where('grade','<>','退会')
                ->orwhere('grade','=',null);
        }else if(session('registered_flg')=="" && session('unregistered_flg')=="checked" && session('withdrawn_flg')=="checked"){
            $StudentQuery =$StudentQuery->where('grade','=','退会')
                ->orwhere('name_sei','=',"")
                ->orwhere('name_sei','=',null);
        }else if(session('registered_flg')=="" && session('unregistered_flg')=="" && session('withdrawn_flg')=="checked"){
            $StudentQuery =$StudentQuery->where('grade','=','退会');
        }else if(session('registered_flg')=="" && session('unregistered_flg')=="checked" && session('withdrawn_flg')==""){
            $StudentQuery =$StudentQuery->whereNull('name_sei')
                ->orwhere('name_sei','=',"");
        }
        */
        if($this->kensakukey<>""){
            self::$key="%".$this->kensakukey."%";
            $StudentQuery =$StudentQuery->where(function($query) {
            $query->where('serial_student','like',self::$key)
                ->orwhere('name_sei','like',self::$key)
                ->orwhere('name_mei','like',self::$key)
                ->orwhere('name_sei_kana','like',self::$key)
                ->orwhere('name_mei_kana','like',self::$key)
                ->orwhere('grade','like',self::$key)
                ->orwhere('phone','like',self::$key)
                ->orwhere('course','like',self::$key)
                ->orwhere('email','like',self::$key);
            });
        }
        /*
            $StudentQuery =$StudentQuery->where('serial_student','like',self::$key)
                ->orwhere('name_sei','like',self::$key)
                ->orwhere('name_mei','like',self::$key)
                ->orwhere('name_sei_kana','like',self::$key)
                ->orwhere('name_mei_kana','like',self::$key)
                ->orwhere('grade','like',self::$key)
                ->orwhere('phone','like',self::$key)
                ->orwhere('course','like',self::$key);
        }
                */
        $targetSortKey="";
        if(session('sort_key')<>""){
            $targetSortKey=session('sort_key');
        }else{
            $targetSortKey=$this->sort_key_p;
        }

        if($this->sort_key_p=='time_in' | $this->sort_key_p=='time_out'){
            $this->sort_key_p='serial_student';
        }
        if($this->sort_key_p<>''){
            if($this->sort_key_p=="name_sei"){
                if($this->asc_desc_p=="ASC"){
                    $StudentQuery =$StudentQuery->orderBy('name_sei', 'asc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei', 'asc');
                }else{
                    $StudentQuery =$StudentQuery->orderBy('name_sei', 'desc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei', 'desc');
                }
            }else if($this->sort_key_p=="name_sei_kana"){
                if($this->asc_desc_p=="ASC"){
                    $StudentQuery =$StudentQuery->orderBy('name_sei_kana', 'asc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei_kana', 'asc');
                }else{
                    $StudentQuery =$StudentQuery->orderBy('name_sei_kana', 'desc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei_kana', 'desc');
                }
            }else{
                if($this->asc_desc_p=="ASC"){
                    $StudentQuery =$StudentQuery->orderBy($this->sort_key_p, 'asc');
                }else{
                    $StudentQuery =$StudentQuery->orderBy($this->sort_key_p, 'desc');
                }
            }
        }
        /*
        log::alert('sort_key2='.session('sort_key2'));
        log::alert('asc_desc2='.session('asc_desc2'));
        //if(session('sort_key2')<>"" or empty(session('sort_key2'))){
        if(!empty(session('sort_key2'))){
            $StudentQuery =$StudentQuery->orderBy(session('sort_key2'), session('asc_desc2'));
        }
        */
        $REQUEST_array=explode("page=", $_SERVER['REQUEST_URI']);
        if(isset($REQUEST_array[1])){
            session(['page_history' => $REQUEST_array[1]]);
        }
        if(!str_contains($_SERVER['HTTP_REFERER'], "students/list")){
            $students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',session('page_history'));
        }else{
            $students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*']);
        }

        //session(['HTTP_REFERER' => $_SERVER['HTTP_REFERER']]);
        //$page_history=$REQUEST_array[1];
        return view('livewire.list-students',['students'=>$students,]);
    }

    public function search_stud(){
        if(isset($_SERVER['HTTP_REFERER'])){
            OtherFunc::set_access_history($_SERVER['HTTP_REFERER']);
        }
        $StudentQuery = Student::query();
        if(isset($_POST['btn_serial'])){
            $_SESSION['serchKey_stud']=$_POST['btn_serial'];
        }else if(!isset($_SESSION['serchKey_stud'])){
            $_SESSION['serchKey_stud']=$this->serch_key_p;
        }
        $targetSortKey="";
        if(isset($_SESSION['sortKey_stud'])){
            $StudentQuery =$StudentQuery->orderBy($_SESSION['sortKey_stud'], $_SESSION['asc_desc_stud']);
        }
        $this->students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',$this->targetPage);
        $this->targetPage=null;
    }
}