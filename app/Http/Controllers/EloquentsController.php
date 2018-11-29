<?php
namespace  App\Http\Controllers;

header('content-type:application:json;charset=utf8');
header('Access-Control-Allow-Origin:*');//允许所有来源访问
header('Access-Control-Allow-Methods:GET,POST');
header('Access-Control-Allow-Headers:x-requested-with,content-type,authorization');//header 传输authorization token 必须加


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;


use DB;
use App\ModelMember; //使用模型 App\ModelMember 模型位置及名字
use App\MemberMank;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
/**
* 
*/
class EloquentsController extends Controller
{
	 // use Manage;
	
	function __construct()
	{
		# code...
	}

	public function store(Request $request)
    {
    	$validate=$this->validate($request, [
            'uid' => 'bail|nullable|integer',
            'month' => 'bail|nullable|date'
        ]);
        // 验证并存储博客文章...
    }

	//***********************************************************
	//*控制器调用模型
	//***********************************************************
	public function info1($id='')
	{
		echo ModelMember::getmodel(); echo "<br>";
		return view('membertest/mytest',['name'=>'小余','profession'=>'PHP,android']);//调用默认模板也一样 只需填写 . 前面的名称
		//调用默认模板也一样 只需填写 . 前面的名称
	}


	//———————————————————————————————————————
	//|Software: 调取 hasOne
	//|	
	//|=======================================
	public function get_bank($value='')
	{
		$modol=ModelMember::getmodel();
		$modol=new ModelMember();
		//->toArray();  //select(["other", "member_id", "type"])
		$list=ModelMember::get();
		$list=ModelMember::find(1);
		
		// dd($list->bank()->orderBy('id','desc')->first()->toArray());//取对应关联里的多条
		dd($list->bank()->orderBy('id','desc')->first()->toArray());//取对应关联里的最近1条
		foreach ($list as $key => $value) {
			$e=$value->bank()->get(); 
			break;
			// dd($value->bank()->get());
		}
		// var_dump($e[0]->name);
		// dd($e[0]->name);
		// dumps($e[0]->id);
		foreach ($e as $key => $value) {
			dd($value);
			// dd($value->name);
		}
		// dd($e[0]->original);//->->name
		// dd($list);
	}

	//———————————————————————————————————————
	//|Software: 调取 相对的关联 
	//|	
	//|=======================================
	public function belongsTo_($value='')
	{
		$list=MemberMank::find(1);
		$list=MemberMank::get();
		// $list=ModelMember::find(1); 
		// echo $list[0]->belong_member()->get()->toArray()[0]['other'];
		dd($list[0]->belong_member()->get()->toArray()[0]);
		
	}

	//———————————————————————————————————————
	//|Software: 调取 一对多
	//|	一篇博客文章拥有多条评论 
	//|=======================================
	public function hasMany_($value='')
	{
		$list=ModelMember::get(); //echo "sum：";//	echo等用前端魔板时才能用 debugbar调试工具
		$data=$list[0]->Many()->orderBy('id','desc')->get()->toArray();  //取对应多条关系  按倒叙  [ ->first() 取第一条 ]
		// return $list;//自己返回对象 则在前端接收为json数组
		dd($data);
	}





}

?>