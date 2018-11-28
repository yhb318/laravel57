<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

/**
* 模型类名和文件名要一致
*/
class MemberMank extends Model
{
	protected	$table='table_member_bank';
	protected	$primaryKey='id';

	//自动维护时间戳
	public 		$timestamps=false;

	//允许批量赋值的字段
	protected	$fillable = ['name','other','addtime','updatetime','deltime'];

	//指定不允许批量赋值的字段
	// protected	$guarded = ['id'];

	
	function __construct()
	{
		# code...
	}

	public static function ce(){
		return 'test model';
	}


	//———————————————————————————————————————
	//|Software: 调取 相对的关联 一对一  一对多的相对关联
	//|	
	//|=======================================
	public function belong_member($value='')
	{
		return $this->belongsTo('App\ModelMember', 'member_id', 'id');
	}


}

?>