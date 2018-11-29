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
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
/**
* 
*/
class MemberController extends Controller
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
		return view('mytest');//调用默认模板也一样 只需填写 . 前面的名称
		echo '/'.$id;
		// return route('memberinfo');
		// echo route('memberinfo');
		phpinfo();
	}

	//***********************************************************
	//*控制器调用模型 orm
	//***********************************************************
	public function orm_model(Request $req,$id='')
	{
		$validate=$this->validate($req, [
            'uid' => 'bail|nullable|integer',
            'month' => 'bail|nullable|date',
        ]);
		// dd($validate);
		// return Auth::guard('admin');



		$all= ModelMember::all(); //查询所有记录
		return json_encode($all);

		// $list=Video::where('members_id', $id)
        //        ->orderBy('id', 'desc')
        //        ->take(10)   //数量限制
        //        ->get();

		// $find= ModelMember::find(6); //	根据主键查找
		// $findOrFail= ModelMember::findOrFail(6); //	根据主键查找
		// $get= ModelMember::where('id','<',6)->get(); //查询所有记录

		// $first= ModelMember::where('id','>','2')
		// 		->orderBy('id','desc')
		// 		->first(); //查询大于2的数据 1条

		
		// echo "<pre>"; 
		// $get= ModelMember::chunk(3,function($member){
		// 	// var_dump($member);
		// });


		// // 聚合函数
		// $count=ModelMember::count();	
	 // 	$max=ModelMember::max('addtime');	//最大
	 // 	$min=ModelMember::min('addtime');	//最小
	 // 	$avg=ModelMember::avg('addtime');	//平均	
	 // 	$sum=ModelMember::sum('addtime');	//总和

	 // 	// 也可以加选择条件************************************
	 // 	// $max=ModelMember::where('id','<',6)->max('id');	//id小于6的最大id
	 // 	// $min=ModelMember::where('id','<',6)->min('id');	//d小于6的最小id

	 // 	echo "count：".$count.'<br>';
	 // 	echo "max：".$max.'<br>';
	 // 	echo "min：".$min.'<br>';
	 // 	echo "avg：".$avg.'<br>';
	 // 	echo "sum：".$sum.'<br>';

		// var_dump($findOrFail);
		// var_dump($findOrFail);
		// dd($first);
		// phpinfo();
	}

	//***********************************************************
	//*控制器调用模型	orm插入数据
	//***********************************************************
	public function orm_insert(Request $request,$name='',$id=0)
	{
		//$name=$request->name; dd($request->id); //接收数据

		$time=time(); $number=rand('1',99);
		//通过模型插入数据 (如果先查询再save() 则为更新 ) $member = ModelMember::find(1); 替换$member = new ModelMember(); 
		// $member = new ModelMember();
		// $member->name = '新增'.$number;
		// $member->other = '新内容'.$number;
		// $member->addtime = $time; //var_dump($member);
		// $result=$member->save();
		// var_dump($result);

		//模型的Create方法赋值数据 
		$data[]=['name'=>'1batch'.$number,'other'=>'1batch_comtent'.$number];
		$data[]=['name'=>'2batch'.$number,'other'=>'2batch_comtent'.$number];
		// 'id'=>1880, 即使这里写了id，因为是 受保护的，调用下面的create，也不会插入成功
		// $result	=	ModelMember::create(['name'=>'2batch'.$number,'other'=>'2batch_comtent'.$number]);

		//批量插入数据 $data 是可以是二维数组
		$result=ModelMember::insert($data);

		dd($result);
		var_dump($result);
	}

	//***********************************************************
	//*控制器调用模型	orm更新
	//***********************************************************
	public function orm_update($id=7)
	{
		// dd($id);
		//通过模型更新数据
		// $member = ModelMember::get($id);
		// $member->other = '模型更新';
		// $result=$member->save();
		// var_dump($result);

		//查询构造器更新
		$result=ModelMember::where('id','>',$id)->update(['other'=>'orm查询构造器更新']);
		var_dump($result);	

	}





	//***********************************************************
	//*DB facade实现curd查询数据 
	//***********************************************************
	public function insert_data($value='')
	{
		$time=time(); $number=rand('1',99);
		$insert=DB::insert('insert into table_member (name,other,addtime) values (?,?,?)', ['Dayle'.$number, 'content'.$number,$time]);
		dd($insert);

		// 插入多条
		// $data[]=['name'=>'re', 'other'=>'cghfhg'];
		// $data[]=['name'=>'rtr', 'other'=>'ghju']; 
		// $result=DB::table('table_member')->insert($data); dd($result);

		// 插入并获取主键
		// DB::table('table_member')->insertGetId(['name'=>'fds','other'=>'trffd']);
	}

	//***********************************************************
	//*DB facade实现curd查询数据 
	//***********************************************************
	public function select_data($value='')
	{
		$select=DB::select('select * from table_member where id = :id', ['id' => 1]);
		// print_r($select);
		dd($select);
		var_dump($select);
	}	 
	

	//***********************************************************
	//*DB查询构造器修改数据 
	//***********************************************************
	 public function update_data($id='')
	 {
	 	$time=time();   $number=rand(10000,99999); 
	 	$update=DB::table('table_member')
	 			// ->where('id',1)           //可用
	 			->whereIn("id", array(1,2))  //可用
	 			// ->where(['id'=>['in',[1,2]]])//无法使用
	 			->update(['other'=>$number,'updatetime'=>$time]);	
	 	dd($update);
	 }

	//***********************************************************
	//*DB facade实现curd删除数据 
	//***********************************************************
	 public function delete_data($id='')
	 {
	 	//使用 CURD 删除
	 	$delet=DB::delete('delete from table_member where id=?',[5]);	//[1] 可换成[$id] 
	 	dd($delet);
	 	//DB::table()->where()->delete(); //用构造器更方便 不用处理数据安全

	 }





	//***********************************************************
	//*DB查询构造器 聚合函数
	//***********************************************************
	 public function DB_table($id='')
	 {
	 	$count=DB::table('table_member')->count();	
	 	$max=DB::table('table_member')->max('addtime');	//最大
	 	$min=DB::table('table_member')->min('addtime');	//最小
	 	$avg=DB::table('table_member')->avg('addtime');	//平均	
	 	$sum=DB::table('table_member')->sum('addtime');	//总和
	 	echo "count：".$count.'<br>';
	 	echo "max：".$max.'<br>';
	 	echo "min：".$min.'<br>';
	 	echo "avg：".$avg.'<br>';
	 	echo "sum：".$sum.'<br>';
	 	// dd($sum);
	 }





	//***********************************************************
	//* DB查询构造器查询数据  并模板循环遍历
	//*
	//***********************************************************
	public function query_data(){
		$users = DB::table('table_member')->get();
		// dd($users); //dd打印会终止后面的代码
        return view('membertest/viwv_ariable', ['users' => $users]);
	}


	//———————————————————————————————————————
	//|Software: 上传文件
	//|	需引入下面几个文件
	//|	use Illuminate\Http\Request;
	//|	use Storage;
	//|	use App\Http\Requests;
	//|=======================================
	public function uploadvideo(Request $request)
    {

        // $video = $request->file('video'); echo $video->getClientsize();
        //写入wenjian
        $request1= file_get_contents("php://input");
        $name='get_data.txt';  //fopen($name,'r');
        $folder='./../public/log/';	
        // $s=$this->logs($title.'_'.$request1,$name,$folder);

		$addrs='./../public/video/'.date('YmdHis').'/';
		$filename='video';//文件传参名		Auth::id()
		$new_name=(string)'234'.$filename.time();
		$result=$this->uplode_file($filename, $new_name, $addrs);	dd($result);
		

		// 文件是否上传成功
        if ($file->isValid()) {

            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $type = $file->getClientMimeType();     // image/jpeg
            $size = $file->getClientsize();
            // 上传文件
            $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
            // 使用我们新建的uploads本地存储空间（目录）
            $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
            var_dump($bool);

        }


    }

    //———————————————————————————————————————
    //|Software: 
    //|	
    //|=======================================
    public    function logs($data, $name, $folder)
    {
        if (!file_exists($folder)&&$folder!='') {
            mkdir(iconv("UTF-8", "GBK", $folder), 0700, true);
        }
        $file = $folder . $name;
        $b = '时间：' . date('Y-m-d H:i:s', time()) . "\n";
        $b .= '地址：' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "\n";
        $b .= '原始：' . file_get_contents("php://input") . "\n";
        $b .= '数组：' . var_export($_POST, true) . "\n";
        $b .= '---------------------------------------------------------------' . "\n\n\n\n";
        $b .= $data . "\n\n\n\n";
        $b .= '+======================================';
        $fp=@fopen($file,"a+");
        $s=@fputs($fp,$b);
        @fclose($fp);
        // $a = file_get_contents($file);
        // $s=file_put_contents($file, $b . $a);
        return $s;
    }

    //———————————————————————————————————————
	//|Software: 
	//|M 1048576
	//|=======================================
	public function uplode_file($filename, $new_name, $addrs)
	{
		// $file = Input::file("video"); 
		// dd($file ->getFileName());
		dd($_FILES["video"]["size"]);
		$request->file('video');
	    if ($_FILES[$filename]['size'] > 1024777216) responses(0,"上传文件过大！"); // 小于 200 kb
	    if ($_FILES[$filename]['name']) {
	        // 允许上传的图片后缀
	        $allowedExts = array("mp4", "3gp", "ogg", "flv", "rmvb", "avi");
	        $temp = explode(".", $_FILES[$filename]["name"]);
	        $extension = end($temp);     // 获取文件后缀名
	        // dump($_FILES[$filename]["type"]);  dump($extension);
	        if ((($_FILES[$filename]["type"] == "video/mpeg")
	        		|| ($_FILES[$filename]["type"] == "video/mpg")
	        		|| ($_FILES[$filename]["type"] == "video/flv")
	        		|| ($_FILES[$filename]["type"] == "video/mp4")
	        		|| ($_FILES[$filename]["type"] == "video/3gp")
	                || ($_FILES[$filename]["type"] == "video/ogg")
	                || ($_FILES[$filename]["type"] == "video/rmvb")
	                || ($_FILES[$filename]["type"] == "video/avi"))
	            && in_array($extension, $allowedExts)) {
	            if ($_FILES[$filename]["error"] > 0) responses(0,"错误：: " . $_FILES[$filename]["error"]);

	            // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
	            // $addrs='../style/app/images/idcard/';
	            if (!is_dir($addrs)) mkdir($addrs, 0777, true);

	            $stored_path = $addrs . $new_name . '.' . $extension;
	            if (file_exists($stored_path)) unlink($stored_path);
	            // $respons->responseError($_FILES[$filename]["name"] . " 文件已经存在。 ");
	            if (move_uploaded_file($_FILES[$filename]['tmp_name'], $stored_path)) {
	                $result = ['stored_path' => $stored_path,
	                    'all_name' => $new_name . '.' . $extension
	                ];
	                return $result;
	            }
	            return false;
	        }
	        return false;
	        
	    }
	    return false;
	}




}

?>