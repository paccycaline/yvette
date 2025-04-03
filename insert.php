<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    </title>Home page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>
    <div class="col-md-6">
        <form action="" method="post" class="form-control" col-md-6>
            <fieldset style="border:12px outset blue;height:400px;width:300px" col-md-4>
                <legend>REGISTRATION FORM</legend>
                <table>

                    <tr>
                        <td>FNAME:</td>
                        <td><input type="text" name="fname" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td>LNAME:</td>
                        <td><input type="text" name="lname" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td>PASSWORD:</td>
                        <td><input type="password" name="password" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td>Comfirm password:</td>
                        <td><input type="password" name="password_comfirmation" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <td><input type="number" maxlength="10" name="phone" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>EMAIL:</td>
                        <td><input type="email" name="email" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="submit" value="submit" class="btn btn-info">
                        <td><input type="reset" name="value" value="cancel" class="btn btn-danger">
                        </td>
                    </tr>
                </table>
        </form>
        </fieldset>
        <?php
        include "connect.php";
        if (isset($_POST['submit'])) {

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $password = $_POST['password'];
            $passwd_comfirmation = $_POST['password_comfirmation'];
            $email = $_POST['email'];
            if ($password == $passwd_comfirmation) {
                $insert = "INSERT INTO `yve`(`fname`, `lname`, `password`, `email`) VALUES ('$fname','$lname','$password','$email')";
                $check = mysqli_query($conn, $insert);
                if ($check == true) {
                    echo "<script>alert('Sucessfully inserted')</script>";
                }

            } else {
                echo "<script>alert('Please enter matching passwords')</script>";
            }

        }


        ?>
        <table class="table">
            <tr class="bg blue">
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Password</th>
                <th>Email Adress</th>
                <th colspan="2">Action</th>
            </tr>


            <?php
            $select = "SELECT * FROM `yve`";
            $checked = mysqli_query($conn, $select);
            while ($row = mysqli_fetch_array($checked)) {
                if ($row) {

                }

                ?>
                <tr>
                    <td>
                        <?php echo $row['id']; ?>
                    </td>
                    <td>
                        <?php echo $row['fname']; ?>
                    </td>
                    <td>
                        <?php echo $row['lname']; ?>
                    </td>
                    <td>
                        <?php echo $row['password']; ?>
                    </td>
                    <td>
                        <?php echo $row['email']; ?>
                    </td>
                    <td colspan="2">
                        <a href="delete.php?delete_db=<?php echo $row['id'] ?>"> <button class="btn btn-danger"
                                type="button">Delete</button></a>

                        <a href="edit.php?edit_id=<?php echo $row['id'] ?>"> <button class="btn btn-info"
                                type="button">Edit</button></a>
                    </td>
                </tr>
            <?php }
            ?>
        </table>

        <form class="form-control form-vertical" method="POST">
            <h1 class="h1">Login</h1>
            <div class="row"></div>
            <input type="email" name="email" class="form-control" required>
            <input type="password" name="password" class="form-control" required>
            <button class="btn btn-primary" type="submit" name="login">Login</button>
        </form>
        <?php
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            //checkn if the user exist
            $selectuser = mysqli_query($conn, "SELECT * FROM yve WHERE email = '$email'");
            if (!empty($selectuser)) {
                $founduser = mysqli_fetch_array($selectuser);
              
                if (!empty($founduser)) {
                    $selectuseragain = mysqli_query($conn, "SELECT * FROM yve WHERE email = '$email' AND password = '$password' ");
                    $foundusers= mysqli_fetch_array($selectuseragain);
                    if (!empty($foundusers)) {
                        $_SESSION['username']=$founduser['fname'];
                        $_SESSION['userid']=$founduser['id'];


                         echo "<script>alert('You are logged in')</script>";
                        



                    } else {
                        echo "<script>alert('Invalid Password')</script>";


                    }
                }

            } else {
                echo "<script>alert('Invalid credentials')</script>";
            }

        }

        ?>

        </form>

        <?php echo "Username"." ".@$_SESSION['userid']; 
        
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


</body>

</html>