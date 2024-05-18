<?php

session_start();

// Include the queries file
include 'queries.php';
include 'connection.php';


// Check if permission ID is set in the request
if (isset($_GET['permission_id'])) {
    $permissionId = $_GET['permission_id'];

    

    // Call the appropriate function from queries.php based on the permission ID
    switch ($permissionId) {
        case '1':
            // Call function 1
            $result = function1($conn);
            break;
        case '2':
            // Call function 2
            $result = function2($conn);
            break;
        case '3':
                // Call function 2
                $result = function3($conn);
                break;
        case '4':
            // Call function 1
            $result = function4($conn);
            break;
        case '5':
            // Call function 2
            $result = function5();
            break;
        case '6':
                // Call function 2
                $result = function6($conn);
                break;
        case '7':
            // Call function 1
            $result = function7($conn,$_SESSION['username']);
            break;
        case '8':
            // Call function 2
            $result = function8($conn,$_SESSION['username']);
            break;
        case '9':
                // Call function 2
                $result = function9($conn,$_SESSION['username']);
                break;

        case '11':
            // Call function 1
            $result = function11($conn,$_SESSION['username']);
            break;
        case '10':
 
        case '12':
                // Call function 2
                $result = function12($conn,$_SESSION['username']);
                break;
        case '13':
            // Call function 1
            $result = function13($conn,$_SESSION['username']);
            break;
        case '14':
            // Call function 2
            $result = function14($conn,$_SESSION['username']);
            break;
        case '15':
                // Call function 2
                $result = function15($conn,$_SESSION['username']);
                break;

        default:
            $result = 'No function defined for permission ID: ' . $permissionId;
            break;
    }

    // Output the result
    echo $result;
} else {
    echo 'Permission ID is missing.';
}
?>
