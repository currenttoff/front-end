<?php
global $alertMessage;
//session_start();

//if user not logged in
/*
if(!$_SESSION['loggedInUser'])
{
    header("Location : index.php");
}
*/

//connect to database
include('includes/connection.php');

//query and Result
$query = "SELECT * FROM orders";
$result = mysqli_query($conn,$query);

//check for query string
if(isset($_GET['alert']))
{
    //new orders added
    if($_GET['alert']=="success")
    {
        $alertMessage = '<div class="alert alert-success">New CLIENT ADDED <a class="close" data-dismiss="alert">&times;</a></div>';

    }
    elseif($_GET['alert']=='updatesuccess')
    {
        $alertMessage = '<div class="alert alert-success">CLIENT UPDATED <a class="close" data-dismiss="alert">&times;</a></div>';
    }
    elseif($_GET['alert']=='deleted')
    {
        $alertMessage = '<div class="alert alert-success">CLIENT DELETED <a class="close" data-dismiss="alert">&times;</a></div>';
    }
}

//close the mysql connection
mysqli_close($conn);


include('includes/header.php');
?>

<h1>Client Address Book</h1>

<?php echo $alertMessage; ?>

<table class="table table-striped table-bordered">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Item NUmber</th>
        <th>Quantity</th>
        <th>Date</th>
        <th>order id</th>
        <th>Edit</th>
    </tr>

    <?php
        if(mysqli_num_rows($result)>0)
        {
            //we have data 
            //output adata
            while($row = mysqli_fetch_assoc($result))
            {
                echo " <tr> ";

                echo "<td>".$row['name']."</td><td>".$row['email']."</td><td>".$row['item_num']."</td><td>".$row['qty']."</td><td>".$row['date']."</td><td>".$row['order_id']."</td>";

                echo '<td> <a href="edit.php?order_id=' .$row['order_id']. ' "type="button" class="btn btn-primary btn-sm"> <span class="glyphicon glyphicon-edit">  </span> </a> </td>';
                


                echo " </tr> ";
            }


        }
        else
        {
            echo '<div class="alert alert-warning">you have no orders </div>';

        }

mysqli_close($conn);        
    ?>
    
    

    <tr>
        <td colspan="7"><div class="text-center"><a href="http://localhost/MySQL/myproject3/pizza/add.php" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add Order</a></div></td>
    </tr>
</table>

<?php
include('includes/footer.php');
?>