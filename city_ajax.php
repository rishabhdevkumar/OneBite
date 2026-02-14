<?php
    include("config.php");
    $state_id = $_POST['state'];
    $city = "SELECT * FROM `city` WHERE id = '".$state_id."'";
    $run = mysqli_query($connect, $city);

    echo '<select class="form-control input_height4" id="sel2" name="City">
        <option value="">Select City</option>';
        while($fetch_city = mysqli_fetch_array($run))
            {
                echo '<option value='.$fetch_city['id'].'>
                '.$fetch_city['city_name'].'</option>';
            }
        echo '</select>';
?>