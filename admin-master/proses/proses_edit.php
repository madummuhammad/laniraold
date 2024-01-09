<?php
include "../../config/conn.php";

$id = $_POST['id'];
$name = $_POST['name_produk'];
$link_katalog = $_POST['link_katalog'];
$diskon_produk = $_POST['diskon_produk'];
$brand = $_POST['brand'];
$deskripsi = $_POST['deskripsi_produk'];
$type_product = $_POST['type_product'];
$berat = $_POST['berat'];
$status = $_POST['status'];
$gambar_produk = $_POST['old_img'];
$page = isset($_GET['page']) ? $_GET['page'] : 1;
if(!empty($_FILES['img']['name'])){
    $lokasi_gambar_produk = $_FILES['img']['tmp_name'];
    $nama_gambar_produk = date('YmdHis').$_FILES['img']['name'];
    move_uploaded_file($lokasi_gambar_produk, "../fotoproduk/$nama_gambar_produk");

    if(!empty($gambar_produk)){
        unlink("../fotoproduk/$gambar_produk");
    }

    $gambar_produk = $nama_gambar_produk;
}

$sql = "UPDATE products SET name='$name', link_katalog='$link_katalog', diskon_produk='$diskon_produk', brand_id='$brand', deskripsi='$deskripsi', type_product='$type_product', berat='$berat', photo='$gambar_produk', status='$status' WHERE id='$id'";

if(mysqli_query($conn, $sql)){
    $size = $_POST['size'];
    $stok = $_POST['stok'];
    $price = $_POST['price'];

    for($i=0; $i<count($size); $i++){
        $size_i = mysqli_real_escape_string($conn, $size[$i]);
        $stok_i = mysqli_real_escape_string($conn, $stok[$i]);
        $price_i = mysqli_real_escape_string($conn, $price[$i]);

        $check_query = "SELECT * FROM product_sizes WHERE product_id='$id' AND size='$size_i'";
        $check_result = mysqli_query($conn, $check_query);

        if(mysqli_num_rows($check_result) > 0){
            $update_query = "UPDATE product_sizes SET stok='$stok_i', price='$price_i' WHERE product_id='$id' AND size='$size_i'";
            mysqli_query($conn, $update_query);
        }else{
            $insert_query = "INSERT INTO product_sizes (product_id, size, stok, price) VALUES ('$id', '$size_i', '$stok_i', '$price_i')";
            mysqli_query($conn, $insert_query);
        }
    }

    echo "<script>alert('Update produk berhasil!');</script>";
    echo "<script>location='../product.php?page=$page';</script>";
    exit();
}else{
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
