<?php
$conn = mysqli_connect("localhost", "root", "", "survei_air");

$nama = $_POST["nama"];
$NIK = $_POST["no_ktp"];
$email = $_POST["email"];
$berasa = $_POST["berasa"];
$berwarna = $_POST["berwarna"];
$berbau = $_POST["berbau"];
$sumber = $_POST["sumber"];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

if ($NIK == 0) {
  echo "<script>alert('NIK tidak boleh kosong!');</script>";
} else {
  $checkNIKQuery = "SELECT * FROM user WHERE NIK='$NIK'";
  $checkNIKResult = mysqli_query($conn, $checkNIKQuery);
  if(mysqli_num_rows($checkNIKResult) > 0){
    echo "<script>alert('NIK sudah ada dan tidak boleh sama!');</script>";
  } else {
    $insertQuery = "INSERT INTO user (NIK, nama, email, berasa, berbau, berwarna, Sair, lat, lng) VALUES ('$NIK', '$nama', '$email', '$berasa', '$berbau', '$berwarna', '$sumber', '$lat', '$lng')";
    $result = mysqli_query($conn, $insertQuery);
    mysqli_close($conn);
    header("Location: index.html");
  }
}

?>
