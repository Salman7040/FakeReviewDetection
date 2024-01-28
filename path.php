<?php 

if(isset($_POST["login"])){
    header("Location:../fakeDetection/login/index.php");
}
if(isset($_POST["singin"])){
    header("Location:../fakeDetection/login/signIn.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoRightPath</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        font-size: 62.5%;
    }

    html,
    body {
        font-family: Arial, Helvetica, sans-serif;
        width: 100%;
        height: 100%;
        background-image: url("../login/image.jpg");
        object-fit: cover;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;

    }

    input[type="submit"] {
        background:linear-gradient(to left,purple,plum,cornflowerblue);
        box-shadow: 2px 2px 8px gray, 2px 2px 8px gray;
        width: 22vw;        
        text-align: center;
        font-weight: 700;
        color: darkblue;
        text-shadow: 0 0 4px brown,0 0 4px brown;
        border: none;
        font-size: 28px;
        height: 5vw;
        margin: 40px 0 0 0;
    }

    form {
        
        
        padding: 0 0 0 1.3vmax;
        
        height: 40vh;
        width:25vw ;
       display: flex;
       flex-direction: column;
    }
</style>

<body>
        <form action="path.php" method="post">
            <input type="submit" value="LOGIN" name="login">
            <input type="submit" value="Sign In" name="singin">
        </form>
</body>

</html>