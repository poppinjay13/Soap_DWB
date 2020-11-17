<?php

if (isset($_POST['name'])) {
    require('dbcredentials.php');

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO users (name, email, phone, address)
    VALUES (?,?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->bind_param("ssss", $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address']);

    if ($stmt->execute()) {
        $last_id = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>100446 - Soap | Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="back"></div>
    <div class="registration-form">
        <header>
            <h1>Register a Student</h1>
            <p>Fill in all the required information</p>
        </header>
        <form name="dataForm" method="POST">

            <?php
            if (isset($last_id)) { ?>
                <div class="input-section name-section">
                    <input class="name" type="text" name="name" placeholder="Enter their full names" />
                    <div class="animated-button"><span class="icon-paper-plane"><i class="fa fa-user"></i></span><span class="next-button name"><i class="fa fa-arrow-up"></i></span></div>
                </div>
                <div class="input-section email-section folded">
                    <input class="email" type="email" name="email" placeholder="Enter their email address" />
                    <div class="animated-button"><span class="icon-paper-plane"><i class="fa fa-envelope-o"></i></span><span class="next-button email"><i class="fa fa-arrow-up"></i></span></div>
                </div>
                <div class="input-section phone-section folded">
                    <input class="phone" type="phone" name="phone" placeholder="Enter their phone number" />
                    <div class="animated-button"><span class="icon-paper-plane"><i class="fa fa-mobile"></i></span><span class="next-button phone"><i class="fa fa-arrow-up"></i></span></div>
                </div>
                <div class="input-section address-section folded">
                    <input class="address" type="text" name="address" placeholder="Enter their address" />
                    <div class="animated-button"><span class="icon-repeat-lock"><i class="fa fa-map-marker"></i></span><span class="next-button address"><i class="fa fa-paper-plane"></i></span></div>
                </div>
                <div class="success">
                    <p>New Student ID : <?php echo $last_id ?></p>
                </div>
            <?php
            } else { ?>
                <div class="input-section name-section">
                    <input class="name" type="text" name="name" placeholder="Enter your full names" />
                    <div class="animated-button"><span class="icon-paper-plane"><i class="fa fa-user"></i></span><span class="next-button name"><i class="fa fa-arrow-up"></i></span></div>
                </div>
                <div class="input-section email-section folded">
                    <input class="email" type="email" name="email" placeholder="Enter your email address" />
                    <div class="animated-button"><span class="icon-paper-plane"><i class="fa fa-envelope-o"></i></span><span class="next-button email"><i class="fa fa-arrow-up"></i></span></div>
                </div>
                <div class="input-section phone-section folded">
                    <input class="phone" type="phone" name="phone" placeholder="Enter your phone number" />
                    <div class="animated-button"><span class="icon-paper-plane"><i class="fa fa-mobile"></i></span><span class="next-button phone"><i class="fa fa-arrow-up"></i></span></div>
                </div>
                <div class="input-section address-section folded">
                    <input class="address" type="text" name="address" placeholder="Enter your address" />
                    <div class="animated-button"><span class="icon-repeat-lock"><i class="fa fa-map-marker"></i></span><span class="next-button address"><i class="fa fa-paper-plane"></i></span></div>
                </div>
                <div class="success">
                    <p>New Student Created</p>
                </div>
            <?php } ?>
        </form>
        <footer class="footer">
            <center>
                <p>
                    <a href="search.php">Search For a Student </a>
                </p>
                <br><br><br><br>
                <p>A project by 100446 - <a href="https://poppinjay13.github.io/">Ian Odundo</a></p>
            </center>
        </footer>
    </div>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <?php
    if (!isset($last_id)) { ?>
        <script src="./script.js"></script>
    <?php } else { ?>
        <script>
            $('.success').css("marginTop", 0);

            $('.success').click(
                function() {
                    $('.success').css("marginTop", -75);
                    var script = document.createElement("script");
                    script.type = "text/javascript";
                    script.src = 'script.js';
                    script.onload = function() {
                        console.log("Script loaded");
                    };
                    document.body.appendChild(script);
                }
            );
        </script>
    <?php } ?>

</body>

</html>