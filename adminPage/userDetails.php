<?php
include("config.php");

$sql = "select * FROM login";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "name: " . $row["userName"]. "  email: " . $row["email"]. " password: " . $row["password"]. " rating: " . $row["rating"]. " OTP: " . $row["OTP"]. "Status: " . $row["Status"]."<br>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>userDetails</title>
</head>
<body>
    
</body>
</html>