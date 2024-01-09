<?php

$ekspedisi = $_POST['ekspedisi'];
$subdistrict = $_POST['subdistrict'];
$berat = $_POST['berat'];
$berat = ceil($berat);
// $berat = round($berat);
// $berat = 1;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "origin=409&originType=city&destination=$subdistrict&destinationType=subdistrict&weight=$berat&courier=$ekspedisi",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded",
    "key: 6a4b80b2e7d0648117dbd6f60cfd1ade"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // header('Content-type:Application/json');
  // echo $response;
  $array_response = json_decode($response, TRUE);
  // return 1;
  $paket = $array_response['rajaongkir']['results']['0']['costs'];

  echo "<option value=''>--Pilih paket--</option>";

  foreach($paket as $key => $tiap_paket){
    echo "<option paket='".$tiap_paket['service']."' ongkir='".$tiap_paket['cost']['0']['value']."' etd='".$tiap_paket['cost']['0']['etd']."'>";
    echo $tiap_paket['service']." ";
    echo "Rp.".number_format($tiap_paket['cost']['0']['value']).",- ";
    echo $tiap_paket['cost']['0']['etd']." Hari";
    echo "</option>";
  }
}

  // return $array_response = json_decode($response, TRUE);
  
  // $paket = $array_response['rajaongkir']['results']['0']['costs'];

  // echo "<option value=''>--Pilih paket--</option>";

  // foreach($paket as $key => $tiap_paket){
  //   echo "<option paket='".$tiap_paket['service']."' ongkir='".$tiap_paket['cost']['0']['value']."' etd='".$tiap_paket['cost']['0']['etd']."'>";
  //   echo $tiap_paket['service']." ";
  //   echo "Rp.".number_format($tiap_paket['cost']['0']['value']).",- ";
  //   echo $tiap_paket['cost']['0']['etd']." Hari";
  //   echo "</option>";
  // }

// }