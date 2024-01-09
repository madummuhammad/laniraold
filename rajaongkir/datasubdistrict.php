<?php

$city = $_POST['id_city'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=".$city,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
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
  // echo $response;
  // Menjadikan array dari json
  $array_response = json_decode($response, TRUE);
  $data_distrik = $array_response['rajaongkir']['results'];

  // echo "<pre>";
  // print_r($data_distrik);
  // echo "</pre>";

  // return 1;

  echo "<option value=''>--Pilih kecamatan--</option>";

  foreach($data_distrik as $key => $tiap_distrik){
    echo "<option value='".$tiap_distrik['subdistrict_id']."'>".$tiap_distrik['subdistrict_name']."</option>";
  }
}