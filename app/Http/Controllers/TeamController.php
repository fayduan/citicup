<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use View;
use Session;
use Storage;
use Input;
use Image;
use Redirect;

use App\Team;
use App\Member;
use App\Teacher;


class TeamController extends Controller {

	public function index(){

		$team = Auth::user()->team;
		$count = $team->unreadcount();
		View::share('data',['count'=>$count,'name'=>$team->name]);
		$members = $team->members;
		$teachers = $team->teachers;

		return view('team',[
			"team"		=>$team,
			"members"	=>$members,
			"teachers"	=>$teachers,
			"univ"		=>$team->univ,
		]);
	}

	public function add(){
		$team = Auth::user()->team;
		$count = $team->unreadcount();
		$teacher_count = $team->teachers->count();
		View::share('data',['count'=>$count,'name'=>$team->name,'teacher_count'=>$teacher_count]);
		return view('addmember');
	}

	public function update(Request $request){
		
		$this->validate($request, [
	        'univ_sel' => 'required|numeric',
	        'team_title' => 'required|string',
	        'team_name' => 'required|string',
	        'upload' => 'mimes:jpeg,bmp,png'
    	]);

		$team = Auth::user()->team;
		$count = $team->unreadcount();
		$old_name = $team->name;

		$team->univ_id = Input::get('univ_sel');
		$team->title = Input::get('team_title');
		$team->name = Input::get('team_name');
		
		if(Input::hasFile('upload'))
		{
			$logopath =date("YmdHis").rand(100, 999).".jpg";
			Storage::delete('logos/'.$team->logo);
			$file = Input::file('upload');
			$path = $file->move(storage_path().'/app/logos',$logopath);
	  		Image::make($path)->resize(200, 200)->save($path);
			$team->logo = $logopath;

		}

		if($team->save()){
			View::share('data',['count'=>$count,'name'=>$team->name]);
			return Redirect::to('/team');
		}else{
			View::share('data',['count'=>$count,'name'=>$old_name]);
			return Redirect::to('/team')->withErrors('修改失败！');
		}

		
	}
	public function __construct()
    {
        $this->middleware('teamstate');
    }

	
}
