<?php
function seoUrl($data){
    return $data;
}


function responses($code, $msg, $data = ''){
    // return json_encode(array('code'=>$code,'msg'=>$msg,'data'=>$data));
    exit(json_encode(array('code'=>$code,'msg'=>$msg,'data'=>$data))); 
}

function dumps($data='')
{
	if(is_array($data)){
		foreach ($data as $key => $value) {
			echo "'".$key."'"."=>".$value."\n";
		}
	}elseif (is_object($data)) {
		foreach ($data as $key => $value) {
			echo "`".$key."`"."=>".$data->$key."\n";
		}
	}
	// print_r($data);
	// echo $data;
}