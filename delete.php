<?php
include "connect.php";
if(isset($_GET['delete_db'])){
    $id=$_GET['delete_db'];
    $delete="DELETE FROM `yve` WHERE `id`='$id'";
    $checkbox = mysqli_query($conn,$delete);{
        ?>
        <script>
    window . location.  href = "insert.php";
</script>

<?php
    }
}
?>
