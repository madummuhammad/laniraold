<?php 
include '../config/conn.php';

if(isset($_POST['submit'])){
    $id = $_POST["id"];
    $id = mysqli_real_escape_string($conn, $id);
    $qty = $_POST['qty'];
    $size = $_POST['size'];
    $harga = $_POST['harga'];
    $type_product = $_POST['type_product'];

    // Ambil diskon dari tabel products berdasarkan ID produk
    $diskon_query = "SELECT diskon_produk FROM products WHERE id = '$id'";
    $diskon_result = mysqli_query($conn, $diskon_query);
    $diskon_row = mysqli_fetch_assoc($diskon_result);
    $diskon = $diskon_row['diskon_produk'];

    $diskon_persen = $diskon / 100; 
    $harga_produk = $harga; 
    $harga_diskon = $harga_produk * $diskon_persen; 
    $harga_count = $harga_produk - $harga_diskon; 

    echo "Harga asli: " . $harga_produk . "<br>";
    echo "Diskon: " . ($diskon_persen * 100) . "%<br>";
    echo "Harga setelah diskon: " . $harga_count;


    $check_query = "SELECT * FROM product_sizes WHERE product_id='$id' AND size='$size'";
    $check_result = mysqli_query($conn, $check_query);
    $row = mysqli_fetch_assoc($check_result);
    $stok_db = $row['stok'];
    $size_id = $row['id'];

    if ($qty > $stok_db) {
        echo "<script>alert('Maaf, stok tidak mencukupi');</script>";
        echo "<script>location='../index.php';</script>";
        exit();
    }

    $sql = "SELECT * FROM products WHERE id ='".$id."'";
    $query = mysqli_query($conn, $sql);
    $hasil = mysqli_fetch_assoc($query);

    if(isset($_SESSION["cart"])) {
        $found = false;
        foreach($_SESSION["cart"] as &$cart) {
            if($cart['id_produk'] == $id && $cart['size'] == $size) {
                $cart['jumlah'] += $qty;
                $found = true;
                break;
            }
        }

        if(!$found) {
            $_SESSION["cart"][] = [
                "id_produk" => $id,
                "photo" => "admin-master/fotoproduk/".$hasil['photo'],
                "harga" => $harga_count,
                "jumlah" => $qty,
                "size" => $size,
                "size_id" => $size_id,
                "type_product"=>$type_product
            ];
        }
    } else {
        $_SESSION["cart"][] = [
            "id_produk" => $id,
            "photo" => "admin-master/fotoproduk/".$hasil['photo'],
            "harga" => $harga_count,
            "jumlah" => $qty,
            "size" => $size,
            "size_id" => $size_id,
            "type_product"=>$type_product
        ];
    }

    echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
    echo "<script>location.href = '../shop-detail.php?id=$id';</script>";
}
?>
