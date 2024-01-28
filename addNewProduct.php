<?php 
if(isset($_POST['create'])){

    $myfile = fopen("a1.txt", "w");
    
        echo "file create successfull.";
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddNew Product</title>
</head>
<body>
    


<form action="addNewProduct.php" method="POST">

<input type="submit" value="Create" name="create" >
</form>
</body>
</html>