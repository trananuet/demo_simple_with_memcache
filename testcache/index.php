<?php
// Định nghĩa thông tin kết nối
define('MEMCACHED_HOST', '127.0.0.1');
define('MEMCACHED_PORT', '11211');
 
// Khỏi tạo kết nối memcache
$memcache = new Memcache;
$cacheAvailable = $memcache->connect(MEMCACHED_HOST, MEMCACHED_PORT);
$con=mysqli_connect("localhost","root","","db_memcache");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
// Khởi tạo biến $product = null
// $product = null;
 
// // Đầu tiên,kiểm tra dữ liệu có tồn tại trong cache của chúng ta hay không ?
// // Kiểm tra biến $cacheAvailable đã được khởi tạo có thành công không (true), ngược lại là (false) 
// $starttime = microtime(true);
// if ($cacheAvailable == true)
// {
//     //Sử dụng key để lấy value là thông tin của product
//     $key = 'product_' . '1';
//     //Lấy thông tin product thông qua key
//     $product = $memcache->get($key);
//     //var_dump( $product);die;
    
// }
// $endtime = microtime(true);
// $duration = $endtime - $starttime;
// print($duration);

// Nếu biến product bằng null thì lúc này chúng ta mới lấy dữ liệu từ db
// if (!$product)
// {
    //Đọc dữ liệu từ db
    $starttime = microtime(true);
    $sql = "SELECT id, name, des, pri FROM products WHERE id = " . '1';
    $queryResource = mysqli_query($con, $sql);
    $product = mysqli_fetch_assoc($queryResource);
    mysqli_close($con);
    $endtime = microtime(true);
    $duration = $endtime - $starttime;
    print($duration);
    // var_dump($product);die;
// }



?>