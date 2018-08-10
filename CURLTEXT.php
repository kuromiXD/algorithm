<?php
function login_post($url,$post){
	$curl=curl_init();
	curl_setopt($curl,CURLOPT_URL,$url);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,0);
	curl_setopt($curl,CURLOPT_HEADER,1);
	curl_setopt($curl,CURLOPT_POST,1);
	curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($post));
	curl_exec($curl);
	curl_close($curl);
}

function get_content($url){
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,0);
	curl_setopt($curl,CURLOPT_HEADER,0);
	$rs=curl_exec($ch);
	curl_close($ch);
	return $rs;
}

$post=array(
	'username'=>'admin',
	'password'=>'lhy'
);
$url1="http://localhost/blog/php/viewer/login.php";
$url2="http://localhost/blog/php/admin/manage.php";
login_post($url1,$post);
$content=get_content($url2);
file_put_contents('sava.txt',$content);
?> 

