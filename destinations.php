<?php include 'includes/header.php' ?>

<?php 

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
?>

<div class="destinationBox">

    <h3>Travel Info</h3>
    
    <table class="table table-hover table-light">
        
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Description</th>
                <th>Photo</th>
            </tr>
        </thead>
        <tbody>
            
            <?php 
            
            $sql = 'SELECT * FROM destinations WHERE regionId = :id';
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            
            $destination = $cmd->fetchAll();
            
            foreach($destination as $value){
                
                $des_name = $value['name'];
                $des_location = $value['location'];
                $des_desc = $value['description'];
                $des_photo = $value['photo'];
                $des_Id = $value['destinationId'];
                
                echo "<tr>";
                echo "<td>".$des_name."</td>";
                echo "<td>".$des_location."</td>";
                echo "<td>".$des_desc."</td>";
                echo "<td><img src='img/$des_photo' width='100px'></td>";
                echo "<td><a href='edit.php?desId=$des_Id'>Edit</a></td>";
                echo "</tr>";
            }
            
            ?>

        </tbody>
    
    </table>
    
</div>

<?php include 'includes/footer.php' ?>