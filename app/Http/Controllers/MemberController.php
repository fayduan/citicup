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
use App\Univ;
use App\Member;

class MemberController extends Controller {

	public function edit($id){
		$team = Auth::user()->team;
		$count = $team->unreadcount();
		$member = Member::find($id);

		if($member->leader){
			return redirect('/team')->withErrors('队长信息暂不可修改。');
		}
		if($member->team_id!=$team->id){
			return redirect('/team')->withErrors('只能修改自己团队成员信息。');
		}

		View::share('data',['count'=>$count,'name'=>$team->name]);
		return view('member.edit')->withMember($member);
	}

	public function store(Request $request){
		if (Member::where('id_num',Input::get('id_num'))->count()>0) {
			return redirect()->back()->withInput()->withErrors('身份证号已被注册，若有疑问，请联系主办方。');
		}

		$this->validate($request, [
			'name' => 'required|string|max:10',
			'sex' => 'required|boolean',
			'school'=>'required|string',
			'college' => 'required|string|max:20',
			'major' => 'required|string|max:20',
			'id_num' => 'required|string|max:18|unique:members',
			'stu_num' => 'required|string|max:15',
			'degree' => 'required|numeric',
			'year_entry' => 'required|numeric',
			'email' => 'required|email',
		]);

		$univ = Univ::where(['name' => Input::get('school')])->first();
		if(empty($univ)){
			$univ = Univ::create([
				'name' => Input::get('school'),
				'area_id' => 99,
				]);
		}

		$member = new Member;
		$member->name=Input::get('name');
		$member->sex=Input::get('sex');
		$member->univ_id=$univ->id;
		$member->college=Input::get('college');
		$member->major=Input::get('major');
		$member->stu_num=Input::get('stu_num');
		$member->id_num=Input::get('id_num');
		$member->degree=Input::get('degree');
		$member->year_entry=Input::get('year_entry');
		$member->email=Input::get('email');
		$member->team_id=Auth::user()->team->id;
		$member->leader=0;
		if ($member->save()) {
			return Redirect::to('/team');
		} else {
			return redirect()->back()->withErrors('添加失败，请稍后重试。')->withInput();
		}

	}

	public function update(Request $request,$id){
		$member = Member::find($id);
		$team = Auth::user()->team;
		if($member->leader){
			return redirect('/team')->withErrors('队长信息暂不可修改。');
		}
		if($member->team_id!=$team->id){
			return redirect('/team')->withErrors('只能修改自己团队成员信息。');
		}

		$team = Auth::user()->team;
		$count = $team->unreadcount();
		View::share('data',['count'=>$count,'name'=>$team->name]);
		
		$this->validate($request, [
			'name' => 'required|string|max:10',
			'sex' => 'required|boolean',
			'school'=>'required|string',
			'college' => 'required|string|max:20',
			'major' => 'required|string|max:20',
			'id_num' => 'required|string|max:18',
			'stu_num' => 'required|string|max:15',
			'degree' => 'required|numeric',
			'year_entry' => 'required|numeric',
			'email' => 'required|email',
		]);

		$univ = Univ::where(['name' => Input::get('school')])->first();
		if(empty($univ)){
			$univ = Univ::create([
				'name' => Input::get('school'),
				'area_id' => 99,
				]);
		}
		$member->name=Input::get('name');
		$member->sex=Input::get('sex');
		$member->univ_id=$univ->id;
		$member->college=Input::get('college');
		$member->major=Input::get('major');
		$member->stu_num=Input::get('stu_num');
		$member->id_num=Input::get('id_num');
		$member->degree=Input::get('degree');
		$member->year_entry=Input::get('year_entry');
		$member->email=Input::get('email');
		if ($member->save()) {
			return Redirect::to('/team');
		} else {
			return redirect()->back()->withErrors('修改失败，请稍后重试。')->withInput();
		}

	}

	public function destroy($id)
	{
		$team = Auth::user()->team;
		$member = Member::find($id);

		if($member->leader){
			return redirect('/team')->withErrors('队长不可删除。');
		}
		if($member->team_id!=$team->id){
			return redirect('/team')->withErrors('只能修改自己团队成员信息。');
		}
		$member->delete();

		return Redirect::to('/team');
	}
	
	public function __construct()
    {
        $this->middleware('teamstate');
    }
}
