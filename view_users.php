<?php
$page_title = "view costumers";

$page = isset($_GET['page']) ? ($_GET['page']) : 1;
$records_per_page = 10;
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>E-Life</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        

        <!-- ***** Navbar Area ***** -->
        <div class="alazea-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="alazeaNav">

                        <!-- Nav Brand -->
                        <a href="index.php" class="nav-brand"><img src="img/logo.png" style="width: 100px;"></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Navbar Start -->
                            <div class="classynav font-cursive">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    
                                    <li><a href="logout.php">Log Out</a></li>
                                </ul>
                            </div>
                            <!-- Navbar End -->
                        </div>
                    </nav>

                    <!-- Search Form -->
                    <div class="search-form">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type keywords &amp; press enter...">
                            <button type="submit" class="d-none"></button>
                        </form>
                        <!-- Close Icon -->
                        <div class="closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php
// include database and object files
include_once 'config/database.php';
include_once 'object/user.php';
// instantiate database and objects
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$stmt = $user->readAll($from_record_num, $records_per_page);
$num = $user->countAll();
if($num>0){
    
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>First name</th>";
            echo "<th>Last name</th>";
            echo "<th>Email</th>";
            echo "<th>Phone Number</th>";
        echo "</tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            if ($access_level!='Admin')
            {
                echo "<tr>";
                    echo "<td>{$firstname}</td>";
                    echo "<td>{$lastname}</td>"; 
                    echo "<td>{$email}</td>";
                    echo "<td>{$phone}</td>";
                echo "</tr>";
            }
            else{

            }
 
        }
    echo "</table>";

$page_url = "view_user.php?";
 
// count all products in the database to calculate total pages
$t_rows = $user->countAll();
 
// paging buttons here
include_once 'paging.php';
}
 
// tell the user there are no user
else{
    echo "<div class='alert alert-info'>No user found.</div>";
}
include_once 'layout_footer.php'; 
?>
</body>
</html>



