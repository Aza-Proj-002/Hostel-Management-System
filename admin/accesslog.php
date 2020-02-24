<?php
require_once '../db.php';

if (isset($_SESSION['username'])){
    $adminLoggedIn = $_SESSION['username'];
    $admin_details_query = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$adminLoggedIn'");
    $admin = mysqli_fetch_array($admin_details_query);
}

if (!isset($_SESSION['username'])) { 
    $_SESSION['msg'] = "You have to log in first"; 
    header('location: index.php'); 
} 
?>
<?php require_once 'header.php'; ?>
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
            <a class="link dim dark-gray f3 dib mr3 mr4-l" href="#"><?php echo $admin['name']; ?> </a>

            <a class="link dim dark-gray f3 dib mr3 mr4-l" href="logout.php" title="Log Out">Log Out</a>
        </div>
    </nav>
</div>
<?php require_once 'sidebar.php'; ?>
<div class="col-md-9">
<table class="table table-dark">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Student Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">IP Address</th>
            <th scope="col">Browser</th>
            <th scope="col">Login Time</th>
            <th scope="col">City</th>
            <th scope="col">Country</th>
        </tr>
    </thead>
    <tbody>
        <?php $sql = "SELECT * FROM adminlog";
                        $query = $conn->query($sql);
                        while($row = $query->fetch_assoc()){ ?>
        <tr>
            <th scope="row"><?php echo $row['student_id'] ?></th>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['ipaddress'] ?></td>
            <td><?php echo $row['browser'] ?></td>
            <td><?php echo $row['logintime'] ?></td>
            <td><?php echo $row['city'] ?></td>
            <td><?php echo $row['country'] ?></td>
        </tr>
        <?php } ?>
    </tbody>

</table>
</div>
                        </div>
                        </div>
<?php require_once 'footer.php'; ?>