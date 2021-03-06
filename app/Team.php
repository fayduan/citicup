<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Mail;
use App\Member;
use App\Teacher;
use App\Univ;
use App\User;
use App\Report;
use App\Document;

class Team extends Model {

	//
	public $timestamps = false;

	protected $fillable = ['authen_id', 'name', 'univ_id', 'title', 'logo','addr'];
	//收件箱邮件
	public function inbox(){
		return $this->hasMany('App\Mail','to_id')->where('del_r','=','0')->orderBy('created_at', 'desc');
	}

	//发件箱邮件
	public function outbox(){
		return $this->hasMany('App\Mail','from_id')->where('del_s','=','0')->orderBy('created_at', 'desc');
	}

	//未读邮件数量
	public function unreadcount(){
		$recvmail = $this->inbox();
		return $recvmail->where('flag_read','=',false)->count();
	}

	public function members(){
		return $this->hasMany('App\Member');
	}

	public function teachers(){
		return $this->hasMany('App\Teacher');
	}

	public function univ(){
		return $this->belongsTo('App\Univ');
	}

	public function report(){
		return $this->hasOne('App\Report');
	}

	public function reportcount(){
		return Report::where('team_id','=',$this->id)->count();
	}

	public function documents(){
		return $this->hasMany('App\Document');
	}

	public function documentByType($type_id){
		return $this->hasMany('App\Document')->where('type_id','=',$type_id)->first();
	}

	/*
	return array
	[0~6] : type 1~7 state,1-submitted
	[7]	  : count for documents submitted.
	*/
	public function doccount(){
		$docs = Document::where('team_id','=',$this->id)->get();
		$arr = array(0,0,0,0,0,0,0,0,0);
		$arr[7]=$docs->count();
		foreach ($docs as $doc){
			if($doc->type_id<8){
				$arr[($doc->type_id)-1]=1;
			}else{
				$arr[8]=1;
			}
		}
		return $arr;
	}
}
