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

class MailDelivery extends Component
{
    use WithPagination;
    public $sort_key_p = '',$asc_desc_p="",$serch_key_p="";
	public $kensakukey="";
    public static $key="";

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
		$this->serch_key_p=$this->kensakukey;
		session(['serchKey' => $this->kensakukey]);
	}

    public function sort($sort_key){
		$sort_key_array=array();
		$sort_key_array=explode("-", $sort_key);
		session(['sort_key' =>$sort_key_array[0]]);
		session(['asc_desc' =>$sort_key_array[1]]);
        Log::alert('sort_key='.session('sort_key'));
	}
    public function render()
    {
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
        $StudentQuery =$StudentQuery->where('name_sei','<>','');
        $from_place="";$target_day="";$backdayly=false;
    
        if(isset($_POST['btn_serial'])){
            session(['serchKey' => $_POST['btn_serial']]);
            
        }else if(session('serchKey')==""){
            session(['serchKey' => $this->serch_key_p]);
        }
        self::$key="%".session('serchKey')."%";
        $StudentQuery =$StudentQuery->where('serial_student','like',self::$key)
                    ->orwhere('name_sei','like',self::$key)
                    ->orwhere('name_mei','like',self::$key)
                    ->orwhere('name_sei_kana','like',self::$key)
                    ->orwhere('name_mei_kana','like',self::$key)
                    ->orwhere('grade','like',self::$key)
                    ->orwhere('phone','like',self::$key)
                    ->orwhere('course','like',self::$key)
                    ->orwhere('email','like',self::$key);
    
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
        if(session('sort_key2')<>""){
            $StudentQuery =$StudentQuery->orderBy(session('sort_key2'), session('asc_desc2'));
        }

        if(session('target_page_for_pager')!==null){
            $targetPage=session('target_page_for_pager');
            session(['target_page_for_pager'=>null]);
        }else{
            $targetPage=null;
        }
        if(self::$key=="%%"){$targetPage=null;}
        $students=$StudentQuery->paginate(200);
        return view('livewire.mail-delivery',compact("students"));
    }
}
