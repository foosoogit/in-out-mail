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
    //public $students="";

    public $orderColumn = "serial_student";
    public $sortOrder = "asc";
    //public $serchColumn = "";
    public $StudentQuery="";

    public function searchClear(){
		$this->serch_key_p="";
		$this->kensakukey="";
        $this->orderColumn = "serial_student";
        $this->sortOrder = "asc";
        $this->targetPage=null;
        $this->Unregistered_flg=false;
        $this->Retiree_flg=false;
        //unset($_SESSION['serchKey_stud']);
        //unset($_SESSION['sortKey_stud']);

        //$_SESSION['serchKey_stud']="";
        //$_SESSION['sortKey_stud']="";
		//session(['serchKey' => '']);
        //session(['sort_key2' => '']);
	}

    public function search_from_top_menu(Request $request){
		$this->serch_key_p=$request->input('user_serial');
		//session(['serchKey' => $request->input('user_serial')]);
        $_SESSION['serchKey_stud']=$request->input('user_serial');
	}

    public function search(){
        $this->targetPage=1;
		//$this->serch_key_p=$this->kensakukey;
        //$_SESSION['serchKey_stud']=$this->kensakukey;
		//session(['serchKey' => $this->kensakukey]);
	}
    
    public function Unregistered(){
        $this->Unregistered_flg=true;
        $this->Retiree_flg=false;
        $this->targetPage=1;
	}

    public function Retiree(){
        $this->Unregistered_flg=false;
        $this->Retiree_flg=true;
        $this->targetPage=1;
	}

    public function sort($sort_key){
		$sort_key_array=array();
		$sort_key_array=explode("-", $sort_key);
        
        //$_SESSION['sortKey_stud']=$sort_key_array[0];
        //$_SESSION['asc_desc_stud']=$sort_key_array[1];

        $this->sortOrder=$sort_key_array[1];
        $this->orderColumn=$sort_key_array[0];
		//session(['sort_key_stud' =>$sort_key_array[0]]);
		//session(['asc_desc_stud' =>$sort_key_array[1]]);
        //Log::alert("sort_key=".session('sort_key'));
        //Log::alert("asc_desc=".session('asc_desc'));
	}
    /*
    public function updated(){
        $this->resetPage();
   }
   */
   /*
    public function updatedType()
    {
        $this->search_stud();
    }
    */
    public function render()
    {
        //$this->search_stud();
        //$StudentQuery = Student::query();

        //$StudentQuery = Student::orderby($_SESSION['sortKey_stud'],$_SESSION['asc_desc_stud'])->select('*');
        //$StudentQuery = Student::orderby($this->orderColumn,$this->sortOrder)->select('*');
        //$this->$students = Student::orderby($this->orderColumn,$this->sortOrder)->select('*');
        //$this->StudentQuery = Student::orderby($this->orderColumn,$this->sortOrder)->select('*');

        if(isset($_SERVER['HTTP_REFERER'])){
            OtherFunc::set_access_history($_SERVER['HTTP_REFERER']);
        }
        /*
        if(!isset($sort_key_p) and session('sort_key')==null){
            session(['sort_key' =>'']);
        }
        $this->sort_key_p=session('sort_key');
    
        if(!isset($asc_desc_p) and session('asc_desc')==null){
            session(['asc_desc' =>'ASC']);
        }
        $this->asc_desc_p=session('asc_desc');
        */
        $StudentQuery = Student::query();
        //$from_place="";$target_day="";$backdayly=false;
        

        /*
        if(isset($_POST['btn_serial'])){
            $this->serch_key_p=$_POST['btn_serial'];
            //session(['serchKey' => $_POST['btn_serial']]);
        }
        */
        /*   
        }else if(session('serchKey')==""){
            session(['serchKey' => $this->serch_key_p]);
        }
        */
        //self::$key="%".session('serchKey')."%";
        log::alert("kensakukey=".$this->kensakukey);
        if($this->Unregistered_flg){
            $StudentQuery =$StudentQuery->where('name_sei','=',"")
                ->orwhere('name_sei','=',null);
            $StudentQuery=$StudentQuery->orderby($this->orderColumn,$this->sortOrder);
        }else if($this->Retiree_flg){
            $StudentQuery =$StudentQuery->where('grade','=','退会');
            $StudentQuery=$StudentQuery->orderby($this->orderColumn,$this->sortOrder);
        }else{
            if($this->kensakukey<>""){
                //self::$key="%".$this->serch_key_p."%";
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
            $StudentQuery =$StudentQuery->where('name_sei','<>',"")
                ->where('name_sei','<>',null)    
                ->where('grade','<>','退会');
            $StudentQuery=$StudentQuery->orderby($this->orderColumn,$this->sortOrder);
        }

        //$targetSortKey="";
        /*
        if(isset($_SESSION['sortKey_stud'])){
            $targetSortKey=$_SESSION['sortKey_stud'];
        }else{
            $targetSortKey=$this->sort_key_p;
        }
        */
        /*
        if(isset($_SESSION['sortKey_stud'])){
            $targetSortKey=$_SESSION['sortKey_stud'];
        }else{
            $targetSortKey=$this->sort_key_p;
        }
        */
        
        /*
        if($this->sort_key_p=='time_in' | $this->sort_key_p=='time_out'){
            $this->sort_key_p='serial_student';
        }
        */
        /*
        if($this->orderColumn=='time_in' | $this->orderColumn=='time_out'){
            $this->sort_key_p='serial_student';
        }
        */
        
        //$StudentQuery =$StudentQuery->orderBy('name_sei', 'asc');
        /*
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
        */
        /*
        if(session('sort_key2')<>""){
            $StudentQuery =$StudentQuery->orderBy(session('sort_key2'), session('asc_desc2'));
        }
        */

        /*
        if(session('target_page_for_pager')!==null){
            //$targetPage=session('target_page_for_pager');
            session(['target_page_for_pager'=>null]);
            $targetPage=1;
        }else{
            $targetPage=null;
        }

        if(self::$key=="%%"){$targetPage=null;}
        */
        //$targetPage=1;
        //dd($StudentQuery->toSql(), $StudentQuery->getBindings());
        //dd($StudentQuery->dump());
        //print "sort_key=".session('sort_key');
		//print "asc_desc=".session('asc_desc');
        //$StudentQuery =$StudentQuery->orderBy('serial_student', 'asc');
        //$students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',$targetPage);

        //if(self::$key=="%%"){$targetPage=null;}
        //$targetPage=null;
        //$students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',$targetPage);
        //$StudentQuery=
        if($this->targetPage==1){
           $students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',1);
           $this->targetPage=null;
        }else{
            $students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*']);
        }
        //$students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*']);
        
        //$students = $students->paginate(10);
        //$students=Student::paginate(initConsts::DdisplayLineNumStudentsList());
        //return view('livewire.list-students',compact("students"));
        //return view('livewire.list-students', ['students' => $StudentQuery->paginate(10),]);

        return view('livewire.list-students',['students'=>$students,]);
    }

    public function search_stud()
    {
        //try {
        if(isset($_SERVER['HTTP_REFERER'])){
            OtherFunc::set_access_history($_SERVER['HTTP_REFERER']);
        }
        /*
        if(!isset($sort_key_p) and session('sort_key')==null){
            session(['sort_key' =>'']);
        }
        */
        //$this->sort_key_p=session('sort_key');
    
        /*
        if(!isset($asc_desc_p) and session('asc_desc')==null){
            session(['asc_desc' =>'ASC']);
        }
        */
        //$this->asc_desc_p=session('asc_desc');
    
        $StudentQuery = Student::query();
        //$from_place="";
        if(isset($_POST['btn_serial'])){
            //session(['serchKey' => $_POST['btn_serial']]);
            $_SESSION['serchKey_stud']=$_POST['btn_serial'];
        //}else if(session('serchKey')==""){
        }else if(!isset($_SESSION['serchKey_stud'])){
            $_SESSION['serchKey_stud']=$this->serch_key_p;
            //session(['serchKey' => $this->serch_key_p]);
        }
        //Log::alert("serch_key_p=".$this->serch_key_p);
        
        
        /*
        if(session('serchKey')<>""){
            self::$key="%".session('serchKey')."%";
            //self::$key="%".session($this->serch_key_p)."%";
            $StudentQuery =$StudentQuery->where('serial_student','like',self::$key)
                ->orwhere('name_sei','like',self::$key)
                ->orwhere('name_mei','like',self::$key)
                ->orwhere('name_sei_kana','like',self::$key)
                ->orwhere('name_mei_kana','like',self::$key)
                ->orwhere('grade','like',self::$key)
                ->orwhere('phone','like',self::$key)
                ->orwhere('course','like',self::$key)
                ->orwhere('email','like',self::$key);
        }
        */


        $targetSortKey="";
        //if(session('sort_key')<>""){
        if(isset($_SESSION['sortKey_stud'])){
            //$_SESSION['sort_key']
            //$StudentQuery =$StudentQuery->orderBy(session('sort_key'), session('asc_desc'));
            $StudentQuery =$StudentQuery->orderBy($_SESSION['sortKey_stud'], $_SESSION['asc_desc_stud']);
            //$targetSortKey=session('sort_key');
        }


        /*
        if(session('sort_key')<>""){
            $StudentQuery =$StudentQuery->orderBy(session('sort_key'), session('asc_desc'));
            //$targetSortKey=session('sort_key');
        }
        */

        /*
        else{
            $targetSortKey=$this->sort_key_p;
        }
        */
        /*
        if($this->sort_key_p=='time_in' | $this->sort_key_p=='time_out'){
            $this->sort_key_p='serial_student';
        }
        */
        /*
        if($targetSortKey<>''){
            if($targetSortKey=="name_sei"){
                if($this->asc_desc_p=="ASC"){
                    $StudentQuery =$StudentQuery->orderBy('name_sei', 'asc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei', 'asc');
                }else{
                    $StudentQuery =$StudentQuery->orderBy('name_sei', 'desc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei', 'desc');
                }
            }else if($targetSortKey=="name_sei_kana"){
                if($this->asc_desc_p=="ASC"){
                    $StudentQuery =$StudentQuery->orderBy('name_sei_kana', 'asc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei_kana', 'asc');
                }else{
                    $StudentQuery =$StudentQuery->orderBy('name_sei_kana', 'desc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei_kana', 'desc');
                }
            }else{
                if(session('asc_desc')=="ASC"){
                    $StudentQuery =$StudentQuery->orderBy($targetSortKey, 'asc');
                }else{
                    $StudentQuery =$StudentQuery->orderBy($targetSortKey, 'desc');
                }
            }
        }
        */
        /*
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
        */

        //$this->students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',$targetPage);
        /*
        if(session('target_page_for_pager')!==null){
            //$targetPage=session('target_page_for_pager');
            session(['target_page_for_pager'=>null]);
            $targetPage=1;
        }else{
            $targetPage=null;
        }
        */
        /*
        if(self::$key=="%%"){
            $targetPage=null;
        }else{
            $targetPage=1;
        }
        */
        //session(['serchKey' => ""]);
        //Log::alert("serchKey=".session('serchKey'));
        /*
        if(session('serchKey')!==""){
            $targetPage=1;
        }
        */
        //$this->dispatchBrowserEvent('scroll-top');
        //Log::alert("Query=".$StudentQuery);
        //$this->students=Student::paginate();
        

        
        $this->students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',$this->targetPage);
        //} catch (QueryException $e) {
            //Log::alert("QueryException=".$e);
        //    return redirect('Students.List'); 
        //}
        
        //$this->students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*']);
        //$this->students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),$targetPage);
        //$this->students=$StudentQuery->paginate();
        $this->targetPage=null;
    }
}