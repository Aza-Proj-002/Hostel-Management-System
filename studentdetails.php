<?php 
require_once 'db.php'; 
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
    <div class="col-sm-12">
        <h3 class="text-center">User Details</h3>
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
				if(isset($_SESSION['updated'])){
					echo
					"
					<div class='alert alert-success text-center'>
						".$_SESSION['updated']."
					</div>
					";
					unset($_SESSION['updated']);
				}
			?>

        </div>

        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">Student Id</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Course</th>
                </tr>
            </thead>
            <?php
						
                        $sql = "SELECT * FROM student_register WHERE email = '$userLoggedIn'";
                        $query = $conn->query($sql);
                        while($row = $query->fetch_assoc()){ ?>
            <tbody>
                <tr>
                    <th scope="row"><?php echo $row["student_id"]; ?></th>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["phonenumber"]; ?></td>
                    <td><?php echo $row["gender"]; ?></td>
                    <td><?php echo $row["course"]; ?></td>
                </tr>
            </tbody>

        </table>
        <a href='#update<?php echo $row['student_id']; ?>' class='btn btn-primary btn-lg ' data-toggle='modal'><i
                class='fas fa-edit' style='padding-right: .3rem'></i> Edit</a>


        <?php
                include('updateUserModal.php');
                    }
               

                ?>
        <br><br>
        <h3 class="text-center">Change Password</h3>
        <?php
                if(isset($_POST['update_password'])) {

                    $old_password = strip_tags($_POST['old_password']);
                    $new_password_1 = strip_tags($_POST['new_password_1']);
                    $new_password_2 = strip_tags($_POST['new_password_2']);
                
                    $password_query = mysqli_query($conn, "SELECT password FROM student_register WHERE email='$userLoggedIn'");
                    $row = mysqli_fetch_array($password_query);
                    $db_password = $row['password'];
                
                    if(md5($old_password) == $db_password) {
                
                        if($new_password_1 == $new_password_2) {
                
                
                            if(strlen($new_password_1) <= 6) {
                                $_SESSION['error'] = "Sorry, your password must be greater than 6 characters";
                            }	
                            else {
                                $new_password_md5 = md5($new_password_1);
                                $password_query = mysqli_query($conn, "UPDATE student_register SET password='$new_password_md5' WHERE email='$userLoggedIn'");
                                $_SESSION['pass_success'] = "Password has been changed!";
                            }
                
                
                        }
                        else {
                            $_SESSION['error'] = "Your two new passwords need to match!";
                        }
                
                    }
                    else {
                        $_SESSION['error'] = "The old password is incorrect! ";
                    }
                
                }

            ?>
        <form action="studentdetails.php" method="post">
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
                        <input type="password" class="form-control" name="old_password">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1"> New Password</label>
                        <input type="password" class="form-control" name="new_password_1">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm New Password</label>
                        <input type="password" class="form-control" name="new_password_2">
                    </div>
                </div>
            </div>

            <button class="btn btn-primary btn-lg btn-block" type="submit" name="update_password">Update
                Password</button> <br>


        </form>
    </div>
    </div>
    </main>

</div>
</div>
<?php require_once 'footer.php' ?>