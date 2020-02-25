<?php require_once 'db.php'; 
if (isset($_SESSION['email'])){
    $userLoggedIn = $_SESSION['email'];
    $user_details_query = mysqli_query($conn, "SELECT * FROM student_register WHERE email = '$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
}
if (!isset($_SESSION['email'])) { 
    $_SESSION['msg'] = "You have to log in first"; 
    header('location: index.php'); 
}  
?>
<?php require_once 'header.php' ?>
    <div id="particles-js"></div>
    <div class="container-fluid header">
        <nav class="db f3 dt-l w-100 border-box pa3 ph5-l">
            <div class="db dtc-l w-50-l tc tr-l">
                <a class="db dtc-l v-mid f3 mid-gray link dim w-100 w-25-l tc tl-l mb2 mb0-l link-head" href="#"
                    title="Home">
                    La Casa De Papel Hostel
                </a>
            </div>
            <div class="db dtc-l v-mid  w-50-l tc tr-l">
                <a class="link dim dark-gray f3 dib mr3 mr4-l" href="#" title="User"><?php echo $user['name']; ?> </a>
                <a class="link dim dark-gray f3 dib mr3 mr4-l" href="logout.php" title="Log Out">Log Out</a>
            </div>
        </nav>
    </div>
    <?php require_once 'sidebar.php' ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 shadow-5">
    <h3 class="text-center">Hostel Details</h3>
    <?php
                $sql = "SELECT *  FROM hostel_booking WHERE email = '$userLoggedIn'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                           
                while($row = $result->fetch_assoc()) {  
                       
            ?>
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Student ID</th>
                <th scope="col">StudentName</th>
                <th scope="col">Email</th>
                <th scope="col">Room Number</th>
                <th scope="col">Duration in Months</th>
                <th scope="col">Fees Per Months</th>
                <th scope="col">Total Fees</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Gender</th>
                <th scope="col">Course</th>
                <th scope="col">Room Type</th>
            </tr>
        </thead>
        <tbody>
           
            <tr>
           
                <th scope="row"><?php echo $row["student_id"]; ?></th>
                <td><?php echo $row["student_name"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["room_number"]; ?></td>
                <td><?php echo $row["duration"]; ?></td>
                <td><?php echo $row["feespermonth"]; ?></td>
                <td><?php echo $row["fees"]; ?></td>
                <td><?php echo $row["phonenumber"]; ?></td>
                <td><?php echo $row["gender"]; ?></td>
                <td><?php echo $row["course"]; ?></td>
                <td><?php echo $row["room_type"]; ?></td>
                <?php     }
                   } else {
                       echo "No Details Available";
                   }
                   ?>
            </tr>
            <tr>

        </tbody>
    </table>
    
 </main>
                </div>
                </div>
                <?php require_once 'footer.php' ?>