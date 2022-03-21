<?php

session_start();
include('includes/functions.php');
global $loginError;
//Check whether form is submitted
if(isset($_POST['login']))
{
    //create variables
    //wrap data with validate function
    $formEmail = validateFormData($_POST['email']);
    $formPass = validateFormData($_POST['password']);

    //connect to Database
    include('includes/connection.php');

    //create query
    $query = "SELECT username,password FROM customers WHERE email='$formEmail'";

    //store result
    $result =mysqli_query($conn,$query);

    //verify if result is returned 
    if(mysqli_num_rows($result)>0)
    {
        //store baisc user data 
        while($row=mysqli_fetch_assoc($result))
        {
            $name = $row['name'];
            $hashedPass =$row['password'];
        }
        //verify password
        if(password_verify($formPass,$hashedPass))
        {
            //correct login details
            //store session data
            $_SESSION['loggedInUser']=$name;

            header("Location: clients.php");
        }
        else
        {
            $loginError="<div class='alert alert-danger'> Wrong Username or Password   </div>";
            
        }

    }
    else
    {
        $loginError="<div class='alert alert-danger'>Username does not exist <a class='close' data-dismiss='alert'> &times; </a></div>";
    }
    

  //close connection
mysqli_close($conn);
}
  



include('includes/header.php');

//$password=password_hash("abc123",PASSWORD_DEFAULT);
//echo $password;




?>

<h1>PIZZA MANIA</h1>
<p class="lead">Log in to your account.</p>

<?php echo $loginError;  ?>

<form class="form-inline" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);   ?>" method="post">
    <div class="form-group">
        <label for="login-email" class="sr-only">Email</label>
        <input type="text" class="form-control" id="login-email" placeholder="email" name="email" >
    </div>
    <div class="form-group">
        <label for="login-password" class="sr-only">Password</label>
        <input type="password" class="form-control" id="login-password" placeholder="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="login">Login</button>
</form>

<?php
include('includes/footer.php');
?>