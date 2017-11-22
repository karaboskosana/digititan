
<?php
    require "init.php";

    $fullName = mysqli_real_escape_string($con,$_POST['name_surname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $selectProgramme = mysqli_real_escape_string($con,$_POST['selectProgramme']);
    $registerType = mysqli_real_escape_string($con,$_POST['registerType']);
    $neatestTown = mysqli_real_escape_string($con,$_POST['neatestTown']);

    $query = "INSERT INTO registration (fullName,email,phone,programme,type,city)
                        VALUES ('$fullName','$email','$phone','$selectProgramme','$registerType','$neatestTown')";

    if (mysqli_query($con,$query)){
        echo "Recorded added successfully...";

    }else{
        echo "An error occcured while saving";
    }
?>
