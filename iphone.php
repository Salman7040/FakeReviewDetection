<?php
include("config.php");
include("login/IPAddress.php");
session_start();


// page reload counting

if ($_SESSION['pageviews'] >= 2) {
    unset($_SESSION['pageviews']);
    unset($_SESSION['repeatedReview']);
} else if ($_SESSION['pageviews'] == 1) {
    $inc = $_SESSION['pageviews'] = ($_SESSION['pageviews']) ? $_SESSION['pageviews'] + 1 : 1;
    
}


if (isset($_POST["submit"]) && isset($_POST["ratingPoint"]) && isset($_POST['feadback'])) {
    unset($_SESSION['repeatedReview']);
    $ipAddress = get_ip();
    $ins = "SELECT * FROM userip where 	iphoneIP='$ipAddress' ";
    $result = mysqli_query($conn, $ins);
    $res = mysqli_fetch_assoc($result);
    if (!isset($res)) {
        $query = "INSERT INTO  userip (iphoneIP) VALUES('$ipAddress')";
        $data = mysqli_query($conn, $query);

        session_start();
        $_SESSION['ratingPoint'] = $_POST["ratingPoint"];
        $_SESSION['feadback'] = $_POST["feadback"];
        header("Location:path.php");
    } else {
        //onload count
        $inc = $_SESSION['pageviews'] = ($_SESSION['pageviews']) ? $_SESSION['pageviews'] + 1 : 1;
        $_SESSION['repeatedReview'] = "repeatedReview";
        header("Location:iphone.php");
    }

}

if ($_SESSION['repeatedReview'] == "repeatedReview") {
    echo "<script>alert('Repeated FeadBack Not Allowed..')</script>";
}


if ($_SESSION['GiveReview'] == "GiveReview") {

    //========= rating logic ============
    $point = $_SESSION['ratingPoint'];
    $query = "INSERT INTO  ratingpoints (rating) VALUES ('$point')";
    $data = mysqli_query($conn, $query);

    //========= user Giveable rating logic ============

    $userEmail = $_SESSION['userEmail'];
    $query = "UPDATE login SET rating='$point' WHERE email='$userEmail'";
    $data = mysqli_query($conn, $query);

    //========= feadback logic ============
    $fedbackValue = strip_tags($_SESSION['feadback']);
    $query = "insert into  feadback (iphone) VALUES ('$fedbackValue')";
    $data = mysqli_query($conn, $query);
    unset($_SESSION['feadback']);
    unset($_SESSION['ratingPoint']);
    unset($_SESSION['GiveReview']);
    header("Location:iphone.php");
}



$show = "select * from ratingpoints";
$data = mysqli_query($conn, $show);
$myRatingData = [];
if ($data) {
    $i = 0;
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            $myRatingData[$i] = $row['rating'];
            $i++;
        }
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iphone</title>
    <link rel="stylesheet" href="iphone.css?v=3">
</head>

<body>
    <div id="con">
        <div id="fullCon">
            <button onclick="left()"> &lt;&lt;&lt; </button>
            <div id="imageSlider">
                <img src="./iphone/iphone1.png" alt="iphone">
            </div>
            <button onclick="right()"> &gt;&gt;&gt; </button>
        </div>

        <div class="rev">

            <div class="rating-container">
                <div class="star" onclick="colorChange(0)">&#9733;</div>
                <div class="star" onclick="colorChange(1)">&#9733;</div>
                <div class="star" onclick="colorChange(2)">&#9733;</div>
                <div class="star" onclick="colorChange(3)">&#9733;</div>
                <div class="star" onclick="colorChange(4)">&#9733;</div>
            </div>
            <div id="graphCon">
                <h1>Global Ratings : <span id="totalUser">0</span> </h1>
                <div id="column-reverse">
                    <div class="ratingShow">
                        <div class="starRating">1 star</div>
                        <div class="con-graph"></div>
                        <div class="percent"> 0%</div>
                    </div>

                    <div class="ratingShow">
                        <div class="starRating">2 star</div>
                        <div class="con-graph"></div>
                        <div class="percent"> 0%</div>
                    </div>

                    <div class="ratingShow">
                        <div class="starRating">3 star</div>
                        <div class="con-graph"></div>
                        <div class="percent"> 0%</div>
                    </div>

                    <div class="ratingShow">
                        <div class="starRating">4 star</div>
                        <div class="con-graph"></div>
                        <div class="percent"> 0%</div>
                    </div>

                    <div class="ratingShow">
                        <div class="starRating">5 star</div>
                        <div class="con-graph"></div>
                        <div class="percent"> 0%</div>
                    </div>

                </div>
            </div>

            <!--========== graph end==========-->
            <form action="iphone.php" method="post">
                <input type="hidden" name="ratingPoint" id="hid">
                <textarea name="feadback" id="feadback" cols="25" rows="4"
                    placeholder="Write Your Feadback Here.."></textarea><br>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>

    </div>

    <div id="productDetails">

    </div>
    <!-- user feadback -->
    <div id="userfeadbacks">


    </div>

</body>

<script>
    var strRating = <?php echo json_encode($myRatingData); ?>; 
</script>
<script src="jsFile/starRating.js?v=3"></script>
<script src="jsFile/ratingGraph.js?v=4"></script>

<!-- ================ for the image slider ========-->
<script>
    let getImage = document.getElementById("imageSlider")

    let i = 1
    function right() {
        i++
        if (i >= 8)
            i = 1
        getImage.innerHTML = "<img src='./iphone/iphone" + i + ".png' alt='iphone'>"
    }
    function left() {
        i--
        if (i < 1)
            i = 7
        getImage.innerHTML = "<img src='./iphone/iphone" + i + ".png' alt='iphone'>"

    }


    //======= feadback logic ==========
    let feadbacks = document.getElementById("userfeadbacks");

    function createFeadbackElement() {
        //======= creating content ========
        let content = document.createElement("div")
        content.className = "content"


        //======= creating userName ========
        let userName = document.createElement("div")
        userName.className = "userName"

        let h1 = document.createElement("h1")
        h1.innerText = "UserName Not Founded"
        userName.appendChild(h1)
        content.appendChild(userName)



        // =======creating userRating ========
        let userRating = document.createElement("div")
        userRating.className = "userRating"

        let h2 = document.createElement("h2")
        h2.innerText = "Rating Not Founded"
        userRating.appendChild(h2)
        content.appendChild(userRating)


        // =======creating userFeadback Text========
        let userText = document.createElement("div")
        userText.className = "userText"

        let p = document.createElement("p")

        userText.appendChild(p)
        content.appendChild(userText)

        feadbacks.appendChild(content)

    }



    let userName = document.getElementsByClassName("userName")
    let userRating = document.getElementsByClassName("userRating")
    let userText = document.getElementsByClassName("userText")

</script>
<?php


$show = "select * from feadback";
$data = mysqli_query($conn, $show);

if ($data) {
    $i = 0;
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            $txtValue = $row['iphone'];
            echo "<script>createFeadbackElement()</script>";
            echo "<script>userText[$i].querySelector('p').innerText= '$txtValue'</script>";
            $i++;
        }
    }
}
$show = "select * from login";
$data = mysqli_query($conn, $show);

if ($data) {
    $i = 0;
    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_assoc($data)) {
            $userName = $row['userName'];
            $ratingValue = $row['rating'];
            echo "<script>userName[$i].querySelector('h1').innerText= '$userName'</script>";
            echo "<script>userRating[$i].querySelector('h2').innerText= '$ratingValue'+' Star'</script>";
            // echo"<script>alert('$ratingValue')</script>";
            $i++;
        }
    }
}



?>
<script>

</script>

</html>