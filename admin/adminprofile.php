<?php
require_once '../db.php';

if (isset($_SESSION['username'])){
    $adminLoggedIn = $_SESSION['username'];
    $admin_details_query = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$adminLoggedIn'");
    $admin = mysqli_fetch_array($admin_details_query);
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

<h3 class="text-center">Admin Details</h3>
<?php 
                
                $sql = "SELECT *  FROM admin WHERE username = '$adminLoggedIn'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    
                    while($row = $result->fetch_assoc()) {  
                        
                        ?>

<form class="needs-validation" novalidate>
    <div class="form-row">
        <input type="hidden" class="form-control" name="id" value="<?php echo $row['admin_id']; ?>">
        <div class="col-md-4 mb-3">
            <label for="validationCustom01">Name</label>
            <input type="text" class="form-control" value="<?php echo $row['name']; ?>" disabled>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationCustom02">Email</label>
            <input type="email" class="form-control" value="<?php echo $row['email']; ?>" disabled>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationCustomUsername">Username</label>
            <input type="text" class="form-control" value="<?php echo $row['username']; ?>" disabled>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="validationCustom03">Phone</label>
            <input type="text" class="form-control" value="<?php echo $row['phone']; ?>" disabled>

        </div>
        <div class="col-md-4 mb-3">
            <label for="validationCustom04">Gender</label>
            <input type="text" class="form-control" value="<?php echo $row['gender']; ?>" disabled>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationCustom05">Designation</label>
            <input type="text" class="form-control" value="<?php echo $row['designation']; ?>" disabled>

        </div>
    </div>
</form>
<?php     }
                    } else {
                        echo "Something went wrong";
                    }
                    ?>
<h3 class="text-center" style="margin-top: 2rem;">Change Password</h3>
<?php
                    if(isset($_POST['updatePassword'])) {

                        $old_password = strip_tags($_POST['old_password']);
                        $new_password_1 = strip_tags($_POST['new_password_1']);
                        $new_password_2 = strip_tags($_POST['new_password_2']);
                    
                        $password_query = mysqli_query($conn, "SELECT password FROM admin WHERE username='$adminLoggedIn'");
                        $row = mysqli_fetch_array($password_query);
                        $db_password = $row['password'];
                    
                        if($old_password == $db_password) {
                    
                            if($new_password_1 == $new_password_2) {
                    
                    
                                if(strlen($new_password_1) <= 6) {
                                    $_SESSION['error'] = "Sorry, your password must be greater than 6 characters";
                                }	
                                else {
                                    $new_password = $new_password_1;
                                    $password_query = mysqli_query($conn, "UPDATE admin SET password='$new_password' WHERE username='$adminLoggedIn'");
                                    $_SESSION['pass_success'] = "Password has been changed!";
                                }
                    
                    
                            }
                            else {
                                $_SESSION['error'] = "Your two new passwords need to match";
                            }
                    
                        }
                        else {
                            $_SESSION['error'] = "The old password is incorrect!";
                        }
                    
                    }

                    ?>
<form action="adminprofile.php" method="post">
    <div class="col-sm-12">
        <div class="row d-flex justify-content-center">
            <?php
                        if(isset($_SESSION['error'])){
                            echo
                            "
                            <div class='alert alert-danger text-center'>
                                ".$_SESSION['error']."
                            </div>
                            "; 
                            unset($_SESSION['error']);
                        }
                        if(isset($_SESSION['pass_success'])){
                            echo
                            "
                            <div class='alert alert-success text-center'>
                                ".$_SESSION['pass_success']."
                            </div>
                            "; 
                            unset($_SESSION['pass_success']);
                        }
			            ?>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputPassword1"> Old Password</label>
                    <input type="password" name="old_password" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputPassword1"> New Password</label>
                    <input type="password" name="new_password_1" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirm New Password</label>
                    <input type="password" name="new_password_2" class="form-control">
                </div>
            </div>
        </div>

        <button class="btn btn-primary btn-lg btn-block" name="updatePassword" type="submit">Update
            Password</button> <br>

</form>
</div>
</div>
                    </div>
                    </div>

<?php require_once 'footer.php'; ?>