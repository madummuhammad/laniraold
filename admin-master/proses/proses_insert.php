<?php 
// include "../../config/conn.php";

$item_name = $_POST['name_produk'];
$link_katalog = $_POST['link_katalog'];
$diskon_produk = $_POST['diskon_produk'];
$brand = $_POST['brand'];
$deskripsi_produk = $_POST['deskripsi_produk'];
$type_product = $_POST['type_product'];
$berat = $_POST['berat'];
$status = $_POST['status'];

$gambarproduk = $_FILES['img']['name'];
$lokasigambar = $_FILES['img']['tmp_name'];
$nama_gambar = date('YmdHis') . $gambarproduk;
move_uploaded_file($lokasigambar, "../fotoproduk/$nama_gambar");

$size = $_POST['size'];
$stok = $_POST['stok'];
$price = $_POST['price'];
$page = isset($_GET['page']) ? $_GET['page'] : 1;
// $sql = "INSERT INTO `products` 
// (
//     `name`,
//     `link_katalog`,
//     `diskon_produk`,
//     `brand_id`,
//     `deskripsi`,
//     `type_product`,
//     `berat`,
//     `photo`,
//     `status`
// ) 
// VALUES 
// (
//     '$item_name',
//     '$link_katalog',
//     '$diskon_produk',
//     '$brand',
//     '$deskripsi_produk',
//     '$type_product',
//     '$berat',
//     '$nama_gambar',
//     '$status'
// )";

// $query = mysqli_query($conn, $sql);
// $product_id = mysqli_insert_id($conn);

// $sql = "INSERT INTO `product_sizes` (product_id, size, stok, price) VALUES ";

// for ($i = 0; $i < count($size); $i++) {
//   $sql .= "('" . $product_id . "', '" . $size[$i] . "', " . $stok[$i] . ", " . $price[$i] . ")";
//   if ($i < count($size) - 1) {
//     $sql .= ", "; 
//   }
// }

// if (mysqli_query($conn, $sql)) {
//   echo "<script>alert('Input produk berhasil!');</script>";
//   echo "<script>location='../product.php';</script>";
// } else {
//   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// }

// mysqli_close($conn);

include "../function/Database.php";
// $servername = "localhost";
  // $username = "ykbgddrh_dnd";
  // $password = "fL1?084sl";
// $username = "root";
// $password = "";
// $dbname = "ykbgddrh_dnd";
$db = new Database("localhost", "root", "", "ykbgddrh_dnd");
$product=[
  'name'=>$item_name,
  'link_katalog'=>$link_katalog,
  'diskon_produk'=>$diskon_produk,
  'brand_id'=>$brand,
  'deskripsi'=>$deskripsi_produk,
  'type_product'=>$type_product,
  'berat'=>$berat,
  'photo'=>$nama_gambar,
  'status'=>$status
];

$product_id = $db->insert('products', $product);
if ($product_id !== false) {
  echo "<script>alert('Input produk berhasil!');</script>";
} else {
  echo "<script>alert('Input produk gagal!');</script>";
  echo "<script>location='../add_product.php?page=".$page."';</script>";
}
for ($i = 0; $i < count($size); $i++) {
  $product_size[$i]=[
    'product_id'=>$product_id,
    'size'=>$size[$i],
    'stok'=>$stok[$i],
    'price'=>$price[$i]
  ];
  $product_size_id=$db->insert('product_sizes',$product_size[$i]);
  if ($product_size_id !== false) {
    echo "<script>alert('Input produk size berhasil!');</script>";
    echo "<script>location='../product.php?page=".$page."';</script>";
  } else {
    echo "<script>alert('Input produk size gagal!');</script>";
    echo "<script>location='../add_product.php?page=".$page."';</script>";
  }
}
?>
