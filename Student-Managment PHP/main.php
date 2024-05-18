<?php
// Start or resume a session
session_start();

// Check if user is logged in and has a valid session
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Include the database connection file
include 'connection.php';


// Function to check if the session is expired
function isSessionExpired() {
    $session_expiration = 300; // 5 minutes in seconds
    $current_time = time();
    if (isset($_SESSION['last_activity']) && ($current_time - $_SESSION['last_activity']) > $session_expiration) {
        // Session expired, destroy the session and return true
        session_unset();
        session_destroy();
        return true;
    } else {
        // Update last activity time
        $_SESSION['last_activity'] = $current_time;
        return false;
    }
}

// Check if the session is expired
    // Check if the user is logged in
    if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
        // Redirect to the login page if not logged in
        header("Location: login.php");
        exit();
    }

// Retrieve user's role from session
$user_role = $_SESSION['role'];
$user_profile_pic = $_SESSION['profile_pic'];



?>
<!DOCTYPE html>
<html>
  <head>
    <title>DashBoard</title>
<style>
                body{
        margin:0px;
        padding:0px;
        font-family:"Roboto",sans-serif;
        }

        header{
        position:fixed;
        background:#22242A;
        padding:20px;
        width:100%;
        height:30px;
        }

        .left_area h3{
        color:#fff;
        margin:0;
        text-transform:uppercase;
        font-size:22px;
        font-weight:900;
        }

        .left_area span{
        color:#1DC4E7;
        }

        .logout_btn{
        padding:5px;
        background:#19B3D3;
        text-decoration:none;
        float:right;
        margin-top:-30px;
        margin-right:40px;
        border-radius:2px;
        font-size:15px;
        font-weight:600;
        color:#fff;
        transition:0.5s;
        transition-property:background;
        }

        .logout_btn:hover{
        background:#0D9DBB;
        }

        .profile-div{
        text-align:center;
        }

        .sidebar{
        background:#2F323A;
        margin-top:70px;
        padding-top:30px;
        position:fixed;
        left:0;
        width:250px;
        height:100%;
        transition:0.5s;
        transition-property:left;
        }

        .sidebar .profile_image{
        width:100px;
        height:100px;
        border-radius:50px;
        margin-bottom:10px;
        }

        .sidebar h4{
        color:#ccc;
        margin-top:0;
        margin-bottom:20px;
        }

        .sidebar a{
        color:#fff;
        display:block;
        width:100%;
        line-height:60px;
        text-decoration:none;
        padding-left:40px;
        box-sizing:border-box;
        transition:0.5s;
        transition-property:background;
        }

        .sidebar a:hover{
        background:#19B3D3;
        }

        .sidebar i{
        padding-right:10px;
        }

        label #sidebar_btn{
        z-index:1;
        color:#fff;
        position:fixed;
        cursor:pointer;
        left:300px;
        font-size:20px;
        margin:5px 0px;
        transition:0.5s;
        transition-property:color;
        }

        label #sidebar_btn:hover{
        color:#19B3D3;
        }

        #check:checked ~ .sidebar{
        left:-190px;
        }

        #check:checked ~ .sidebar a span{
        display:none;
        }

        #check:checked ~.sidebar a{
        font-size:20px;
        margin-left:170px;
        width:80px;
        }

        .content{
        margin-left:250px;
        padding: 100px;
        height:100px;
        transition:0.5s;
        }

        #check:checked ~ .content{
        margin-left:60px;
        }

        #check{
        display:none;
        }

        .profile_image {
    width: 30px;
    height: 30px;
    border-radius: 50%;
        }
        .student-info {
            font-family: Arial, sans-serif;
            margin-top: 20px;
        }

        .student {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-pic img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .details {
            flex: 1;
        }

        .details p {
            margin: 5px 0;
        }

        .details p strong {
            font-weight: bold;
        }
        .courses {
            margin-top: 20px;
        }

        .courses h2 {
            font-family: Arial, sans-serif;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .courses ul {
            list-style-type: none;
            padding: 0;
        }

        .courses li {
            margin-bottom: 5px;
        }

        .courses li:before {
            content: "•";
            margin-right: 5px;
        }
                
        h1{
        font-size: 30px;
        color: #fff;
        text-transform: uppercase;
        font-weight: 300;
        text-align: center;
        margin-bottom: 15px;
        }
        table{
        width:100%;
        table-layout: fixed;
        }
        .tbl-header{
        background-color: rgba(255,255,255,0.3);
        }
        .tbl-content{
        height:300px;
        overflow-x:auto;
        margin-top: 0px;
        border: 1px solid rgba(255,255,255,0.3);
        }
        th{
        padding: 20px 15px;
        text-align: left;
        font-weight: 500;
        font-size: 12px;
        color: #fff;
        text-transform: uppercase;
        }
        td{
        padding: 15px;
        text-align: left;
        vertical-align:middle;
        font-weight: 300;
        font-size: 12px;
        color: #fff;
        border-bottom: solid 1px rgba(255,255,255,0.1);
        }


        /* demo styles */

        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
        body{
        background: -webkit-linear-gradient(left, #25c481, #25b7c4);
        background: linear-gradient(to right, #25c481, #25b7c4);
        font-family: 'Roboto', sans-serif;
        }
        section{
        margin: 50px;
        }


        /* follow me template */
        .made-with-love {
        margin-top: 40px;
        padding: 10px;
        clear: left;
        text-align: center;
        font-size: 10px;
        font-family: arial;
        color: #fff;
        }
        .made-with-love i {
        font-style: normal;
        color: #F50057;
        font-size: 14px;
        position: relative;
        top: 2px;
        }
        .made-with-love a {
        color: #fff;
        text-decoration: none;
        }
        .made-with-love a:hover {
        text-decoration: underline;
        }


        /* for custom scrollbar for webkit browser*/

        ::-webkit-scrollbar {
            width: 6px;
        } 
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        } 
        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
        }

</style>
    </head>
    <body>
    <input type="checkbox" id="check"/>
    <header>
      <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
      </label>
      <div class="left_area">
        <h3><?php echo ucfirst($user_role); ?>  <span>Dashboard</span></h3>
      </div>
      <div class="right_area">
        <a href="logout.php" class="logout_btn">Logout</a>
      </div>
    </header>




    <div class="sidebar">
        <div class="profile-div">
            <?php echo '<img src="' . $_SESSION['profile_pic'] . '" class="profile_image" alt="Profile Picture"/>'; ?>
            <h4><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?></h4>
        </div>

        <div class="permissions-menu">
            <ul>
                <?php
                // Fetch user permissions from the database based on the user's role
                if (!empty($_SESSION['role'])) {
                    $sql = "SELECT permission_id, description FROM Permissions WHERE role = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('s', $_SESSION['role']);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Display permissions as buttons
                    while ($row = $result->fetch_assoc()) {
                        echo '<a href="#" class="permission-link" data-permission-id="' . $row['permission_id'] . '"><i class="fas fa-th"></i><span>' . $row['description'] . '</span><a>';
                    }
                }
                ?>
            </ul>
        </div>
    </div>


    <div class="content">
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all permission links
            var permissionLinks = document.querySelectorAll('.permission-link');

            // Add click event listener to each permission link
            permissionLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default link behavior

                    // Get permission ID from data attribute
                    var permissionId = this.getAttribute('data-permission-id');

                    // AJAX call to fetch content dynamically
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                // Update content div with fetched data
                                document.querySelector('.content').innerHTML = xhr.responseText;
                            } else {
                                console.error('Error fetching content:', xhr.statusText);
                            }
                        }
                    };
                    xhr.open('GET', 'content.php?permission_id=' + permissionId, true);
                    xhr.send();
                });
            });
        });

    </script>

</body>

</html>
