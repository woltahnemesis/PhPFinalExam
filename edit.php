<?php include 'includes/header.php' ?>

<?php 

    if(isset($_GET['desId'])){
        $id = $_GET['desId'];
    }
?>

<?php 

$sql = 'SELECT * FROM destinations WHERE destinationId = :id';
$cmd = $db->prepare($sql);
$cmd->bindParam(':id', $id, PDO::PARAM_INT);
$cmd->execute();

while($row = $cmd->fetch(PDO::FETCH_ASSOC)){
    
    $des_Id = $value['destinationId'];
    $des_name = $value['name'];
    $des_location = $value['location'];
    $des_desc = $value['description'];
    $des_photo = $value['photo'];

?>

<div class="col-sm-4">
    <form method="post" action="" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $des_name; ?>">
    </div>
    
    <div class="form-group">
        <label for="location">Location</label>
        <input type="text" name="location" class="form-control" value="<?php echo $des_location; ?>">
    </div>
    
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" rows="10" cols="50" class="form-control"></textarea>
    </div>
    
    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" name="description" class="form-control">
    </div>
    
    <div class="form-group">
        <input type="submit" name="submit" value="Submit" class="btn btn-outline-dark">
    </div>
    
</form>

</div>

<?php } ?>

<?php
    if(isset($_POST['submit'])){
        
        $des_name = $_POST['name'];
        $des_location = $_POST['location'];
        $des_desc = $_POST['description'];
        
        $file = $_FILES['photo'];
        
        $name = $file['name'];
        $size = $file['size'];
        $tmp_name = $file['tmp_name'];
        $type = mime_content_type($tmp_name);

        echo "<div>";
        echo "Name: $name<br />";
        echo "Size: $size<br />";
        echo "Temp Name: $tmp_name<br />";
        echo "Image Type: $type<br />";
        echo "</div>";

        if ($size < 1024000 && $type == 'image/jpeg') {
            session_start();
            $name = session_id() . '-' . $name;

            move_uploaded_file($tmp_name, "img/$name");
        } else {
            echo "Invalid file!";
            exit();
        }
    }
?>

<?php include 'includes/footer.php' ?>