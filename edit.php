<?php
session_start(); 
?>
<html>

<head>
    <title>Update info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


</head>

<body>
    <div class="col-md-4">
        <form method="POST" class="form-control">
        <div class="p-3 mb-2 bg-primary text-white shadow-lg p-3 mb-5 bg-body-primary rounded">ADMIN PANEL</div>

            <?php
            include("connect.php");
            $id = $_GET['edit_id'];
            $selectedits = mysqli_query($conn, "SELECT * FROM yve where id='$id'");
            while ($row = mysqli_fetch_array($selectedits)) {
                $name = $row['fname'] . " " . $row['lname'];
                $fname = $row['fname'];
                $lname = $row['lname'];
                $password = $row['password'];
                $email = $row['email'];
                $phone = $row['phone'];
                $id = $row['id'];
            }

            ?>


            <p>First Name:</p><BR>
            <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>" required>

            <p>Last name:</p><BR>
            <input type="text" name="lname" class="form-control" value=" <?php echo $lname; ?>" required>
            <p>Password:</p><BR>
            <input type="text" name="password" class="form-control" value="<?php echo $password; ?>" required>


            <p>Email:</p><BR>
            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
            <p>DOne by:</p>
            <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['username']; ?>" required>



            <button class="btn btn-info" type="submit" name="save">Save</button>
            <button class="btn btn-danger" type="reset">Cancel</button>
        </form>


        <?php
        if (isset($_POST['save'])) {

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $update = mysqli_query($conn, "UPDATE yve SET fname='$fname', lname='$lname', password='$password' WHERE id = '$id'");
            if ($update) {
                echo "<script>alert('Data saved');</script> ";
                echo "<script>window.location.href='insert.php';</script>";


            } else {
                echo $conn->error;

                // echo "<script>alert('oops failed to save')</script>";
        
            }
        }








        ?>











    </div>












    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>