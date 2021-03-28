<?php
if (isset($_POST['user'])) {
    /*require_once('lib/nusoap.php');
    $c = new nusoap_client('http://127.0.0.1/Soap%20Implementation/Web%20Portal/server.php');
    $user = $c->call(
        'getUser',
        array('userId' => $_POST['user'])
    );*/
    $userId = $_POST['user'];

    require('dbcredentials.php');
    $mysqli = new mysqli($servername, $username, $password, $database);
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user = array(
            'id' => intval($row['id']),
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'address' => $row['address'],
            'message' => "Succesfully retrieved the Student"
        );
    } else {
        $user = array(
            'id' => 0,
            'name' => "",
            'email' => "",
            'phone' => "",
            'address' => "",
            'message' => "No Student found with this ID"
        );
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>100446 - Soap | Search</title>
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
            <h1>Search for a Student</h1>
            <p>Please provide a registration ID</p>
        </header>
        <form name="searchForm" method="POST">

            <?php if (isset($user)) { ?>
                <div class="input-section search-section folded">
                    <input class="search" type="text" name="user" placeholder="Enter student ID" />
                    <div class="animated-button"><span class="icon-paper-plane"><i class="fa fa-user"></i></span><span class="next-button search"><i class="fa fa-search"></i></span></div>
                </div>
                <div class="success">
                    <p><?php echo $user['message'] ?></p>
                </div>
            <?php } else { ?>
                <div class="input-section search-section">
                    <input class="search" type="text" name="user" placeholder="Enter student ID" />
                    <div class="animated-button"><span class="icon-paper-plane"><i class="fa fa-user"></i></span><span class="next-button search"><i class="fa fa-search"></i></span></div>
                </div>
                <div class="success">
                    <p>Finding this student...</p>
                </div>
            <?php } ?>
        </form>
        <?php if (isset($user)) { ?>
            <table class="results">
                <thead>
                    <td>id</td>
                    <td>name</td>
                    <td>email</td>
                    <td>phone</td>
                    <td>address</td>
                </thead>
                <tbody>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['phone'] ?></td>
                    <td><?php echo $user['address'] ?></td>
                </tbody>
            </table>
        <?php } ?>
        <footer class="footer">
            <center>
                <p>
                    <a href="index.php">Register a Student </a>
                </p>
                <br><br><br><br>
                <p>A project by 100446 - <a href="https://poppinjay13.github.io/">Ian Odundo</a></p>
            </center>
        </footer>
    </div>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <?php if (!isset($user)) { ?>
        <script src="./script.js"></script>
    <?php } else { ?>
        <script>
            $('.success').css("marginTop", 0);
            $('.footer').css("marginTop", 50);
            $('.success').click(
                function() {
                    $('.success').css("marginTop", -75);
                    $('.search-section').removeClass("folded");
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