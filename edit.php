<?php session_start(); ?>

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
    
    $des_Id = $row['destinationId'];
    $des_name = $row['name'];
    $des_location = $row['location'];
    $des_desc = $row['description'];
    $des_photo = $row['photo'];
    $region_id = $row['regionId'];

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
        <textarea name="description" rows="10" cols="50" class="form-control"><?php echo $des_desc; ?></textarea>
    </div>
    
    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" name="photo" class="form-control">
        <?php 
        if($des_photo){
            echo "<img src='img/$des_photo' width='150px' >";
        }
        ?>

    </div>

    <div class="form-group">
        <select name="region">
            <?php 
                    
            $sql = 'SELECT * FROM regions';
            $cmd = $db->prepare($sql);
            $cmd->execute();

            //Using while loop to loop all region name in navigation bar
            while($row = $cmd->fetch(PDO::FETCH_ASSOC)){
                $regionId = $row['regionId'];
                $regionName = $row['name'];
                    
            ?>
            <option value="<?php echo $regionId; ?>"><?php echo $regionName;?></option>
            <?php } ?>
        </select>
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
            $name = session_id() . '-' . $name;

            move_uploaded_file($tmp_name, "img/$name");
        } else {
            echo "Invalid file!";
            exit();
        }
        
        $sql = 'UPDATE destinatiions SET ';
        $sql .= '';
    }
?>

<?php include 'includes/footer.php' ?>