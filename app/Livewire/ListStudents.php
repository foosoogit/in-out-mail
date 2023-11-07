<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Http\Controllers\InitConsts;
use App\Http\Controllers\OtherFunc;
use Illuminate\Support\Collection;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ListStudents extends Component
{
    use WithPagination;
    public $sort_key_p = '',$asc_desc_p="",$serch_key_p="",$targetPage=null;
	public $kensakukey="";
    public static $key="";
    protected $students;

    public function searchClear(){
		$this->serch_key_p="";
		$this->kensakukey="";
		session(['serchKey' => '']);
        session(['sort_key2' => '']);
	}

    public function search_from_top_menu(Request $request){
		$this->serch_key_p=$request->input('user_serial');
		session(['serchKey' => $request->input('user_serial')]);
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
        //print "sort_key1=".session('sort_key');
	}

    public function updatedType()
    {
        $this->search_stud();
    }

    public function render()
    {
        $this->search_stud();
        return view('livewire.list-students',['students'=>$this->students]);
    }

    public function search_stud()
    {
        try {
        if(isset($_SERVER['HTTP_REFERER'])){
            OtherFunc::set_access_history($_SERVER['HTTP_REFERER']);
        }
        $StudentQuery = Student::query();
        $from_place="";
    
        if(isset($_POST['btn_serial'])){
            session(['serchKey' => $_POST['btn_serial']]);
          
        }else if(session('serchKey')==""){
            session(['serchKey' => $this->serch_key_p]);
        }
        Log::alert("serch_key_p=".$this->serch_key_p);
        
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
        $this->students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',$this->targetPage);
        } catch (QueryException $e) {
            //Log::alert("QueryException=".$e);
            return redirect('Students.List'); 
        }
        $this->targetPage=null;
    }
}
