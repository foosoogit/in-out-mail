<?php

namespace App\Livewire;

use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;
use App\Http\Controllers\InitConsts;
use App\Models\InOutHistory;
use Livewire\Component;

class RirekiForProtector extends Component
{
    public $msg;
    use WithPagination;
    public $sort_key_p = '',$asc_desc_p="",$serch_key_p="",$targetPage=null,$target_day="",$sort_type="";
	public $kensakukey="";
    public static $key="";
    protected $histories;

    public function render()
    {
        $this->search_stud();
        return view('livewire.rireki-for-protector',['histories'=>$this->histories,'target_day'=>'']);
    }

    public function sort_day($target){
        $sort_array=explode("-", $target);
        $this->sort_type=$sort_array[1];
    }
    public function search_day($target){
        $this->target_day=$target;
    }
    public function search_stud()
    {
        try {
        $HistoriesQuery = InOutHistory::query();
        $HistoriesQuery =$HistoriesQuery->where('student_serial','=',session('target_stud_inf_array')->serial_student);
        if($this->target_day<>""){
            $HistoriesQuery = $HistoriesQuery->where('target_date','=',$this->target_day);
        }else{
            $this->target_day="";
        }
        if($this->sort_type<>""){
            $HistoriesQuery = $HistoriesQuery->orderBy('time_in',$this->sort_type); 
        }else{
            $HistoriesQuery = $HistoriesQuery->orderBy('time_in','desc');
        }
        $this->histories=$HistoriesQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',$this->targetPage);
        } catch (QueryException $e) {
            //Log::alert("QueryException=".$e);
            //return redirect('Students.List'); 
        }
        
        $this->targetPage=null;
    }
}