<?php
// Define functions to fetch content based on permission ID

// Function 1
function function1($conn) {
    // Initialize output variable
    $output = '';

    // SQL query to fetch all attendance records
    $sql = "SELECT * FROM attendance";

    // Execute the query
    $result = $conn->query($sql);

    // Check if records are found
    if ($result && $result->num_rows > 0) {
        // Start building the table HTML
        $output .= '  
        <table border="1">
                        <thead>
                            <tr>
                                <th>Course ID  </th>
                                <th>Student ID  </th>
                                <th>Date  </th>
                                <th>Status  </th>
                                <!-- Add more table headers as needed -->
                            </tr>
                        </thead>
                        <tbody>
                        </div>';

        // Fetch data and append rows to the table
        while ($row = $result->fetch_assoc()) {
            $output .= '
            <tr>
                            <td>' . $row['course_id'] . '</td>
                            <td>' . $row['student_id'] . '</td>
                            <td>' . $row['date'] . '</td>
                            <td>' . $row['status'] . '</td>
                            <!-- Add more table cells as needed -->
                        </tr>
                        ';
        }

        // Close the table
        $output .= '</tbody></table>';
    } else {
        // No records found
        $output .= '<p>No attendance records found.</p>';
    }

    // Return the HTML output
    return $output;
}

// Function 2
function function2($conn) {



    $sql = "SELECT Grades.grade, Students.name,Grades.student_id
            FROM Grades
            INNER JOIN Students ON Grades.student_id = Students.student_id";    
            $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table border="1">';
        echo '<tr>
        <th>Student ID</th>
        <th>Student Name</th>
        <th>Grade</th></tr>';
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["student_id"] . '</td>';
            echo '<td>' . $row["name"] . '</td>';
            echo '<td>' . $row["grade"] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "0 results";
    }
}

function function3($conn) {
    $output = ''; // Initialize an empty string to store HTML

    // Check if the form for adding, editing, or deleting a course is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        if ($_POST['action'] == 'add') {
            // Add new course
            $course_name = $_POST['course_name'];
            $faculty_id = $_POST['faculty_id'];

            $sql = "INSERT INTO Courses (course_name, faculty_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $course_name, $faculty_id);
            if ($stmt->execute()) {
                $output .= '<div>New course added successfully.</div>';
            } else {
                $output .= '<div>Error adding course: ' . $stmt->error . '</div>';
            }
        } elseif ($_POST['action'] == 'edit') {
            // Edit existing course
            $course_id = $_POST['course_id'];
            $course_name = $_POST['course_name_' . $course_id];
            $faculty_id = $_POST['faculty_id_' . $course_id];

            $sql = "UPDATE Courses SET course_name = ?, faculty_id = ? WHERE course_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sii", $course_name, $faculty_id, $course_id);
            if ($stmt->execute()) {
                $output .= '<div>Course updated successfully.</div>';
            } else {
                $output .= '<div>Error updating course: ' . $stmt->error . '</div>';
            }
        } elseif ($_POST['action'] == 'delete') {
            // Delete course
            $course_id = $_POST['course_id'];

            $sql = "DELETE FROM Courses WHERE course_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $course_id);
            if ($stmt->execute()) {
                $output .= '<div>Course deleted successfully.</div>';
            } else {
                $output .= '<div>Error deleting course: ' . $stmt->error . '</div>';
            }
        }
    }

    // Display form for adding a course
    $output .= '<form action="" method="POST">';
    $output .= '<input type="hidden" name="action" value="add">';
    $output .= '<input type="text" name="course_name" placeholder="Course Name">';
    $output .= '<input type="text" name="faculty_id" placeholder="Faculty ID">';
    $output .= '<button type="submit" name="submit">Add Course</button>';
    $output .= '</form>';

    // Fetch courses from the database
    $sql = "SELECT course_id, course_name, faculty_id FROM Courses";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $output .= '<table>';
        $output .= '<tr><th>Course ID</th><th>Course Name</th><th>Faculty ID</th><th>Actions</th></tr>';
        while ($row = $result->fetch_assoc()) {
            $output .= '<form action="" method="POST">';
            $output .= '<input type="hidden" name="action" value="edit">';
            $output .= '<input type="hidden" name="course_id" value="' . $row['course_id'] . '">';
            $output .= '<tr>';
            $output .= '<td>' . $row['course_id'] . '</td>';
            $output .= '<td><input type="text" name="course_name_' . $row['course_id'] . '" value="' . $row['course_name'] . '"></td>';
            $output .= '<td><input type="text" name="faculty_id_' . $row['course_id'] . '" value="' . $row['faculty_id'] . '"></td>';
            $output .= '<td><button type="submit" name="submit">Update</button></td>';
            $output .= '</tr>';
            $output .= '</form>';
            $output .= '<form action="" method="POST">';
            $output .= '<input type="hidden" name="action" value="delete">';
            $output .= '<input type="hidden" name="course_id" value="' . $row['course_id'] . '">';
            $output .= '<tr>';
            $output .= '<td colspan="3"></td>'; // Empty column for alignment
            $output .= '<td><button type="submit" name="submit">Remove</button></td>';
            $output .= '</tr>';
            $output .= '</form>';
        }
        $output .= '</table>';
    } else {
        $output .= 'No courses found.';
    }

    return $output; // Return the HTML string
}



// Function to retrieve and display all faculty members with their associated courses
function function4($conn) {
    // Check if form is submitted for adding or deleting a row
   
    
    // Fetch all faculty members along with their associated courses
    $sql = "SELECT f.user_id, u.name AS faculty_name, c.course_id, c.course_name 
            FROM Faculty f 
            JOIN Users u ON f.user_id = u.id
            LEFT JOIN Courses c ON f.faculty_id = c.faculty_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display form for adding a new row
        echo '<form method="POST">';
        echo 'User ID: <input type="text" name="user_id">';
        echo 'Course ID: <input type="text" name="course_id">';
        echo '<button type="submit" name="add">Add Row</button>';
        echo '</form>';

        // Display table for existing rows
        echo '<table>';
        echo '<tr><th>User ID</th><th>Faculty Name</th><th>Course ID</th><th>Course Name</th><th>Actions</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['user_id'] . '</td>';
            echo '<td>' . $row['faculty_name'] . '</td>';
            echo '<td>' . $row['course_id'] . '</td>';
            echo '<td>' . $row['course_name'] . '</td>';
            echo '<td>';
            echo '<form method="POST">';
            echo '<input type="hidden" name="user_id" value="' . $row['user_id'] . '">';
            echo '<input type="hidden" name="course_id" value="' . $row['course_id'] . '">';
            echo '<button type="submit" name="delete">Delete</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the action is to add a row
            if (isset($_POST['add'])) {
                $user_id = $_POST['user_id'];
                $course_id = $_POST['course_id'];
                
                // Insert new row into Faculty table
                $insert_sql = "INSERT INTO Faculty (user_id, faculty_id) VALUES (?, ?)";
                $insert_stmt = $conn->prepare($insert_sql);
                $insert_stmt->bind_param("ii", $user_id, $course_id);
                if ($insert_stmt->execute()) {
                    echo '<div>New row added successfully.</div>';
                } else {
                    echo '<div>Error adding row: ' . $insert_stmt->error . '</div>';
                }
            } elseif (isset($_POST['delete'])) { // Check if the action is to delete a row
                $user_id = $_POST['user_id'];
                $course_id = $_POST['course_id'];
                
                // Delete row from Faculty table
                $delete_sql = "DELETE FROM Faculty WHERE user_id = ? AND faculty_id = ?";
                $delete_stmt = $conn->prepare($delete_sql);
                $delete_stmt->bind_param("ii", $user_id, $course_id);
                if ($delete_stmt->execute()) {
                    echo '<div>Row deleted successfully.</div>';
                } else {
                    echo '<div>Error deleting row: ' . $delete_stmt->error . '</div>';
                }
            }
        }
    } else {
        echo 'No faculty members found.';
    }
}




function function5() {
    // Perform queries or operations to fetch content for permission ID 2
    return '<p>Content for permission ID 2</p>';
}

// Function to retrieve and display all users with their roles and profile pictures
function function6($conn) {
    // Fetch all users from the database
    $sql = "SELECT id, name AS username, password, role, profile_pic FROM Users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Profile Pic</th><th>User ID</th><th>Username</th><th>Password</th><th>Role</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td><img src="' . $row['profile_pic'] . '" class="profile_image" alt="Profile Picture"></td>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $row['password'] . '</td>';
            echo '<td>' . $row['role'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No users found.';
    }
}


function function7($conn, $username) {
    // Fetch the faculty ID of the user
    $sqlFacultyId = "SELECT faculty_id FROM Faculty WHERE user_id = (SELECT id FROM Users WHERE id = ?)";
    $stmtFacultyId = $conn->prepare($sqlFacultyId);
    $stmtFacultyId->bind_param("s", $username);
    $stmtFacultyId->execute();
    $resultFacultyId = $stmtFacultyId->get_result();

    if ($resultFacultyId->num_rows > 0) {
        // Fetch all attendance records linked with the faculty ID
        $rowFacultyId = $resultFacultyId->fetch_assoc();
        $facultyId = $rowFacultyId['faculty_id'];

        $sql = "SELECT * FROM Attendance WHERE course_id IN (SELECT course_id FROM Courses WHERE faculty_id = ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $facultyId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>Attendance ID</th><th>Date</th><th>Student ID</th><th>Status</th><th>Action</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['attendance_id'] . '</td>';
                echo '<td>' . $row['date'] . '</td>';
                echo '<td>' . $row['student_id'] . '</td>';
                echo '<td>' . $row['status'] . '</td>';
                echo '<td><button onclick="changeStatus(' . $row['attendance_id'] . ', \'' . $row['status'] . '\')">Change Status</button></td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No attendance records found for the courses linked with the faculty ID.';
        }
    } else {
        echo 'Faculty member with the provided username not found.';
    }
}




function function8($conn, $username) {
    $sqlFacultyId = "SELECT faculty_id FROM Faculty WHERE user_id = (SELECT id FROM Users WHERE id = ?)";
    $stmtFacultyId = $conn->prepare($sqlFacultyId);
    $stmtFacultyId->bind_param("s", $username);
    $stmtFacultyId->execute();
    $resultFacultyId = $stmtFacultyId->get_result();

    if ($resultFacultyId->num_rows > 0) {
        // Fetch all attendance records linked with the faculty ID
        $rowFacultyId = $resultFacultyId->fetch_assoc();
        $facultyId = $rowFacultyId['faculty_id'];

        $sql = "SELECT * FROM Attendance WHERE course_id IN (SELECT course_id FROM Courses WHERE faculty_id = ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $facultyId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>Attendance ID</th><th>Date</th><th>Student ID</th><th>Status</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['attendance_id'] . '</td>';
                echo '<td>' . $row['date'] . '</td>';
                echo '<td>' . $row['student_id'] . '</td>';
                echo '<td>' . $row['status'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No attendance records found for the courses linked with the faculty ID.';
        }
    } else {
        echo 'Faculty member with the provided username not found.';
    }
}

function function9($conn, $username) {
    // Retrieve the faculty ID associated with the provided username
    $sqlFacultyId = "SELECT faculty_id FROM Faculty WHERE user_id = (SELECT id FROM Users WHERE id = ?)";
    $stmtFacultyId = $conn->prepare($sqlFacultyId);
    $stmtFacultyId->bind_param("s", $username);
    $stmtFacultyId->execute();
    $resultFacultyId = $stmtFacultyId->get_result();

    if ($resultFacultyId->num_rows > 0) {
        // Fetch the faculty ID
        $rowFacultyId = $resultFacultyId->fetch_assoc();
        $facultyId = $rowFacultyId['faculty_id'];

        // Retrieve all students enrolled in courses taught by the faculty member
        $sql = "SELECT DISTINCT s.student_id, s.name
                FROM Students s
                JOIN Courses c ON s.course_ids = c.course_id
                WHERE c.faculty_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $facultyId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Display the list of students
            echo '<table>';
            echo '<tr><th>Student ID</th><th>Student Name</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['student_id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No students enrolled in courses taught by the faculty member.';
        }
    } else {
        echo 'Faculty member with the provided username not found.';
    }
}



function function11($conn, $username) {
    // Retrieve the faculty ID associated with the provided username
    $sqlFacultyId = "SELECT faculty_id FROM Faculty WHERE user_id = ?";
    $stmtFacultyId = $conn->prepare($sqlFacultyId);
    $stmtFacultyId->bind_param("s", $username);
    $stmtFacultyId->execute();
    $resultFacultyId = $stmtFacultyId->get_result();

    if ($resultFacultyId->num_rows > 0) {
        // Fetch the faculty ID
        $rowFacultyId = $resultFacultyId->fetch_assoc();
        $facultyId = $rowFacultyId['faculty_id'];

        // Retrieve all students and their grades for courses taught by the faculty member
        $sql = "SELECT s.student_id, s.name, g.grade 
                FROM Students s
                JOIN Grades g ON s.student_id = g.student_id
                JOIN Courses c ON g.course_id = c.course_id
                WHERE c.faculty_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $facultyId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Display the list of students and their grades
            echo '<table>';
            echo '<tr><th>Student ID</th><th>Student Name</th><th>Grade</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['student_id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['grade'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No grades found for the courses taught by the faculty member.';
        }
    } else {
        echo 'Faculty member with the provided username not found.';
    }
}





function function12($conn, $username) {
    // Retrieve the student ID associated with the provided username
    $sqlStudentId = "SELECT student_id FROM students WHERE user_id = ?";
    $stmtStudentId = $conn->prepare($sqlStudentId);
    $stmtStudentId->bind_param("s", $username);
    $stmtStudentId->execute();
    $resultStudentId = $stmtStudentId->get_result();

    if ($resultStudentId->num_rows > 0) {
        // Fetch the student ID
        $rowStudentId = $resultStudentId->fetch_assoc();
        $studentId = $rowStudentId['student_id'];

        // Retrieve all attendance records of the student along with course ID
        $sql = "SELECT a.*, c.course_id 
                FROM Attendance a
                JOIN Courses c ON a.course_id = c.course_id
                WHERE a.student_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Display the attendance records
            echo '<table>';
            echo '<tr><th>Attendance ID</th><th>Date</th><th>Status</th><th>Course ID</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['attendance_id'] . '</td>';
                echo '<td>' . $row['date'] . '</td>';
                echo '<td>' . $row['status'] . '</td>';
                echo '<td>' . $row['course_id'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No attendance records found for the student.';
        }
    } else {
        echo 'Student with the provided username not found.';
    }
}


function function13($conn, $username) {
    // Retrieve the student ID associated with the provided username
    $sqlStudentId = "SELECT student_id FROM students WHERE user_id = ?";
    $stmtStudentId = $conn->prepare($sqlStudentId);
    $stmtStudentId->bind_param("s", $username);
    $stmtStudentId->execute();
    $resultStudentId = $stmtStudentId->get_result();

    if ($resultStudentId->num_rows > 0) {
        // Fetch the student ID
        $rowStudentId = $resultStudentId->fetch_assoc();
        $studentId = $rowStudentId['student_id'];

        // Retrieve all grades of the student
        $sql = "SELECT c.course_id, c.course_name, g.grade 
                FROM Courses c
                JOIN Grades g ON c.course_id = g.course_id
                WHERE g.student_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Display the list of courses and grades
            echo '<table>';
            echo '<tr><th>Course ID</th><th>Course Name</th><th>Grade</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['course_id'] . '</td>';
                echo '<td>' . $row['course_name'] . '</td>';
                echo '<td>' . $row['grade'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No grades found for the student.';
        }
    } else {
        echo 'Student with the provided username not found.';
    }
}


function function14($conn, $username) {
    // Retrieve student information
    $sql = "SELECT id, name, password, profile_pic
            FROM users 
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Display student information
        echo '<div class="student-info">';
        echo '<h2>Student Information</h2>';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="student">';
            echo '<div class="profile-pic"><img src="' . $row['profile_pic'] . '" alt="Profile Picture"></div>';
            echo '<div class="details">';
            echo '<p><strong>Student ID:</strong> ' . $row['id'] . '</p>';
            echo '<p><strong>Name:</strong> ' . $row['name'] . '</p>';
            echo '<p><strong>password:</strong> ' . $row['password'] . '</p>';
            echo '</div>'; // End of .details
            echo '</div>'; // End of .student
        }
        echo '</div>'; // End of .student-info
    } else {
        echo 'Student with the provided username not found.';
    }
}


function function15($conn, $username) {
    // Retrieve student ID
    $sqlStudentId = "SELECT student_id FROM Students WHERE user_id = ?";
    $stmtStudentId = $conn->prepare($sqlStudentId);
    $stmtStudentId->bind_param("s", $username);
    $stmtStudentId->execute();
    $resultStudentId = $stmtStudentId->get_result();

    if ($resultStudentId->num_rows > 0) {
        $rowStudentId = $resultStudentId->fetch_assoc();
        $studentId = $rowStudentId['student_id'];

        // Retrieve courses the student is enrolled in
        $sql = "SELECT c.course_id, c.course_name 
                FROM Courses c
                INNER JOIN Students s ON c.course_id = s.course_ids
                WHERE s.student_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Display the courses
            echo '<div class="courses">';
            echo '<h2>Courses Enrolled</h2>';
            echo '<ul>';
            while ($row = $result->fetch_assoc()) {
                echo '<li>' . $row['course_name'] . '</li>';
            }
            echo '</ul>';
            echo '</div>';
        } else {
            echo 'No courses enrolled by the student.';
        }
    } else {
        echo 'Student with the provided username not found.';
    }
}



?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add click event listener to all status buttons
        var statusButtons = document.querySelectorAll('.status-btn');
        statusButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Get the attendance ID and new status from the button's data attributes
                var attendanceId = this.getAttribute('data-attendance-id');
                var newStatus = this.getAttribute('data-new-status');

                // AJAX request to update the status
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Success response from the server
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                // Update the button's text and data attributes
                                button.textContent = newStatus;
                                button.setAttribute('data-new-status', response.newStatus);
                                // Optionally, update any other UI elements
                                // ...
                            } else {
                                // Display error message if the update failed
                                console.error('Failed to update status:', response.message);
                            }
                        } else {
                            // Display error message if AJAX request failed
                            console.error('Error updating status:', xhr.statusText);
                        }
                    }
                };
                xhr.open('POST', 'update_status.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('attendance_id=' + attendanceId + '&status=' + newStatus);
            });
        });
    });
</script>

