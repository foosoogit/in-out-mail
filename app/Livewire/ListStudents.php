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
        //Log::info($obj);
        //Log::alert('registered_flg='.session('registered_flg'));
        //Log::alert('unregistered_flg='.session('unregistered_flg'));
        //Log::alert('withdrawn_flg='.session('withdrawn_flg'));
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

    public function searchClear(){
		$this->serch_key_p="";
		$this->kensakukey="";
        $this->orderColumn = "serial_student";
        $this->sortOrder = "asc";
        $this->targetPage=null;
        $this->Unregistered_flg=false;
        $this->Retiree_flg=false;
    }

    public function search_from_top_menu(Request $request){
		$this->serch_key_p=$request->input('user_serial');
        session(['serchKey_stud' => $request->input('user_serial')]);
        $_SESSION['serchKey_stud']=$request->input('user_serial');
	}

    public function search(){
        $this->targetPage=1;
	}
    /*    
    public function Unregistered(){
        $this->Unregistered_flg=true;
        $this->Retiree_flg=false;
        $this->targetPage=1;
        session(['Unregistered_flg' => true]);
        session(['Retiree_flg' => false]);
        //$_SESSION['Unregistered_flg']=true;
        //$_SESSION['Retiree_flg']=false;
	}
    */
    /*
    public function Retiree(){
        $this->Unregistered_flg=false;
        $this->Retiree_flg=true;
        $this->targetPage=1;
        session(['Unregistered_flg' => false]);
        session(['Retiree_flg' => true]);
        //$_SESSION['UnregisteredFlg']=false;
        //$_SESSION['Retiree_flg']=true;
	}
    */
    /*
    public function AllSerial(){
        $this->Unregistered_flg=false;
        $this->Retiree_flg=false;
        $this->targetPage=1;
        session(['Unregistered_flg' => false]);
        session(['Retiree_flg' => false]);
        //$_SESSION['UnregisteredFlg']=false;
        //$_SESSION['Retiree_flg']=true;
	}
    */
    public function sort($sort_key){
		$sort_key_array=array();
		$sort_key_array=explode("-", $sort_key);
        $this->sortOrder=$sort_key_array[1];
        $this->orderColumn=$sort_key_array[0];
	}

    public function render(){
        if(isset($_SERVER['HTTP_REFERER'])){
            OtherFunc::set_access_history($_SERVER['HTTP_REFERER']);
        }
        $StudentQuery = Student::query();
        Log::alert('registered_flg='.session('registered_flg'));
        Log::alert('unregistered_flg='.session('unregistered_flg'));
        Log::alert('withdrawn_flg='.session('withdrawn_flg'));
        //if($this->Unregistered_flg){;
        //if($_SESSION['Unregistered_flg']){
        if(session('registered_flg')=="checked" && session('unregistered_flg')=="" && session('withdrawn_flg')==""){
            $StudentQuery =$StudentQuery->where('name_sei','<>',"")
                ->where('grade','<>','退会');
            //$StudentQuery=$StudentQuery->orderby($this->orderColumn,$this->sortOrder);
        }else if(session('registered_flg')=="checked" && session('unregistered_flg')=="" && session('withdrawn_flg')=="checked"){
            $StudentQuery =$StudentQuery->where('name_sei','=',"");
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
        if($this->kensakukey<>""){
            self::$key="%".$this->kensakukey."%";
            $StudentQuery =$StudentQuery->where('serial_student','like',self::$key)
                ->orwhere('name_sei','like',self::$key)
                ->orwhere('name_mei','like',self::$key)
                ->orwhere('name_sei_kana','like',self::$key)
                ->orwhere('name_mei_kana','like',self::$key)
                ->orwhere('grade','like',self::$key)
                ->orwhere('phone','like',self::$key)
                ->orwhere('course','like',self::$key);
        }
        /*
        $StudentQuery =$StudentQuery->where('name_sei','<>',"")
            ->where('name_sei','<>',null)    
            ->where('grade','<>','退会');
        $StudentQuery=$StudentQuery->orderby($this->orderColumn,$this->sortOrder);
        */
        /*
        if($this->targetPage==1){
           $students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',1);
           $this->targetPage=null;
        }else{
            $students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*']);
        }
        */
        $students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*']);
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