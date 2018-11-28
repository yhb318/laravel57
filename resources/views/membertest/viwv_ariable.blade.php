@foreach($users as $key=>$valus)
	<p style="color:#f22f18;">key: {{$key}} </p> 
    <p> {{$valus->name}} </p> 
    <p> {{$valus->addtime}} </p><br>
@endforeach
foreach取数组对象里的值时 只能 $valus->name
