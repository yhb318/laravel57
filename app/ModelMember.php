<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

/**
* 模型类名和文件名要一致
*/
class ModelMember extends Model
{
	protected	$table='table_member';
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

	public static function getmodel(){
		return 'test model';
	}

	/**
	* 获取关联 一对一
	*/
    public  function bank()
    {
        return $this->hasOne('App\MemberMank', 'member_id', 'id'); //id为本模型（table_member）表id  'member_id', 'id'
    }

    //———————————————————————————————————————
	//|Software: 调取 一对多 
	//|	
	//|=======================================
	public function Many($value='')
	{
		return $this->hasMany('App\MemberMank', 'member_id', 'id');
	}

}

?>