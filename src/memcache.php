<?php
$memcache = new Memcache;
//2 tham số, tên host của bạn : localhost , port : 11211
$memcache->connect('localhost', 11211) or die ("Could not connect");

$version = $memcache->getVersion();
echo "Server's version: ".$version."<br/>\n";

$tmp_object = new stdClass;
$tmp_object->str_attr = 'test';
$tmp_object->int_attr = 123;

$memcache->set('key', $tmp_object, false, 10) or 
die ("Không thể lưu trữ data vào memcache");
echo "Dữ liệu của bạn đã được lưu trữ vào memcache thành công và sẽ hết hạn trong vòng 10 giây
<br/>\n";

$get_result = $memcache->get('key');
echo "Dữ liệu trong cache của bạn là:<br/>\n";

var_dump($get_result);
?>