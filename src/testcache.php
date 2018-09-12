<?php
// Định nghĩa thông tin kết nối
define('MEMCACHED_HOST', '127.0.0.1');
define('MEMCACHED_PORT', '11211');
$id = '1';
$name = 'a';
$description = 'b';
$price = '2';


// Khỏi tạo kết nối memcache
$memcache = new Memcache;
$cacheAvailable = $memcache->connect(MEMCACHED_HOST, MEMCACHED_PORT);

$con=mysqli_connect("localhost","root","","db_memcache");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$querySuccess = mysqli_query($con,"INSERT INTO products (id, name, des, pri) VALUES ($id, '$name', '$description', $price)");

mysqli_close($con);
// $querySuccess = mysql_query($sql, $db);
 
//Nếu như insert thành công, lưu dữ liệu như $name, $description, $price vào memcache
if ($querySuccess === true)
{
    // Tạo key cho memcache
    // Sử dụng string 'product_' cộng với $id để làm key dùng cho việc truy xuất sau này (ví dụ key là "product_12")
    $key = 'product_' . $id;
 
    // Lưu trữ thông tin sản phẩm vào 1 mảng
    $product = array('id' => $id, 'name' => $name, 'description' => $description, 'price' => $price);
 
    // Thực thi việc lưu mảng dữ liệu đó vào memcache bằng biến $memcache
    $memcache->set($key, $product);
}


?>