<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MailDelivery;
use App\Http\Controllers\InitConsts;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class HistoryMailDelivery extends Component
{
    use WithPagination;
    public $sort_key_p = '',$asc_desc_p="",$serch_key_p="";
	public $kensakukey="";
    public static $key="";
    
    public function delete_mail_history($id){
        $MailDelivery = MailDelivery::find($id);
        $MailDelivery->delete();
    }
    
    public function searchClear(){
		$this->serch_key_p="";
		$this->kensakukey="";
		session(['serchKeyMail' => '']);
	}

    public function search(){
		$this->serch_key_p=$this->kensakukey;
		session(['serchKeyMail' => $this->kensakukey]);
	}
    
    public function sort($sort_key){
		$sort_key_array=array();
		$sort_key_array=explode("-", $sort_key);
		session(['sort_key_mail' =>$sort_key_array[0]]);
		session(['asc_desc_mail' =>$sort_key_array[1]]);
	}
    public function render()
    {
        if(!isset($sort_key_p) and session('sort_key_mail')==null){
            session(['sort_key_mail' =>'']);
        }
        $this->sort_key_p=session('sort_key_mail');
        if(!isset($asc_desc_p) and session('asc_desc')==null){
            session(['asc_desc' =>'ASC']);
        }
        $this->asc_desc_p=session('asc_desc_mail');

        $mailDeliveiedQuery = MailDelivery::query();
        $from_place="";$target_day="";$backdayly=false;

        if(session('serchKeyMail')==""){
            session(['serchKeyMail' => $this->serch_key_p]);
        }

        self::$key="%".session('serchKey_mail')."%";
        $mailDeliveiedQuery =$mailDeliveiedQuery->where('date_delivered','like',self::$key)
                    ->orwhere('subject','like',self::$key)
                    ->orwhere('body','like',self::$key);

        $targetSortKey="";
        if(session('sort_key_mail')<>""){
            $targetSortKey=session('sort_key_mail');
        }else{
            $targetSortKey=$this->sort_key_p;
        }

        if($this->sort_key_p<>''){
            if($this->asc_desc_p=="ASC"){
                $mailDeliveiedQuery =$mailDeliveiedQuery->orderBy($this->sort_key_p, 'asc');
            }else{
                $mailDeliveiedQuery =$mailDeliveiedQuery->orderBy($this->sort_key_p, 'desc');
            }
        }else{
            $mailDeliveiedQuery =$mailDeliveiedQuery->orderBy("date_delivered", 'desc');
        }

        if(session('target_page_for_pager_mail')!==null){
            $targetPage=session('target_page_for_pager_mail');
            session(['target_page_for_pager_mail'=>null]);
        }else{
            $targetPage=null;
        }
        
        if(self::$key=="%%"){$targetPage=null;}

        $mailDeliveied=$mailDeliveiedQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',$targetPage);
        return view('livewire.history-mail-delivery',compact("mailDeliveied"));
    }
}