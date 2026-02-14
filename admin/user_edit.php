<?php
    include("config.php");
    $name = $_POST['name1'];
$email = $_POST['email1'];
$phone = $_POST['phone1'];
$dob = $_POST['dob1'];
$state = $_POST['state']; 
$city = $_POST['city1']; 
$address = $_POST['address1'];
$Zipcode = $_POST['zipcode1'];
$id = $_POST['id'];


    $check_email = "SELECT * FROM `user` WHERE email='".$email."'AND id!='".$id."'";
    $run_email = mysqli_query($connect, $check_email);
    $num_row_check = mysqli_num_rows($run_email);
    if($num_row_check > 0)
    {
        echo 'Email Already Exists';
    }
    else
    {
       $update_user = "UPDATE `user` SET 
    name='".$name."', 
    email='".$email."', 
    phone_no='".$phone."',
    dob='".$dob."', 
    state='".$state."', 
    city='".$city."', 
    address='".$address."', 
    Zip_code='".$Zipcode."'
    WHERE id = '".$id."'";

$run = mysqli_query($connect, $update_user);

if ($run) {

    $select = "SELECT * FROM `user`";
    $run_select = mysqli_query($connect, $select);

    echo '<table class="user_table">
            <thead>
               <tr>
                  <th class="user_detail">Sl No</th>
                  <th class="user_detail">Profile</th>
                  <th class="user_detail">Name</th>
                  <th class="user_detail">Email</th>
                  <th class="user_detail">Phone No</th>
                  <th class="user_detail">Dob</th>
                  <th class="user_detail">State</th>
                  <th class="user_detail">City</th>
                  <th class="user_detail">Pincode</th>
                  <th class="user_detail">Address</th>
                  <th class="user_detail">Action</th>
                </tr>
            </thead>';

    $i = 1;

    while($fetch_rec = mysqli_fetch_array($run_select))
    {
        $id = $fetch_rec['id'];

        $select_state = "SELECT * FROM `state` WHERE id = '".$fetch_rec['state']."'";
        $run_state = mysqli_query($connect, $select_state);
        $fetch_state = mysqli_fetch_array($run_state);

        $select_city = "SELECT * FROM `city` WHERE id = '".$fetch_rec['city']."'";
        $run_city = mysqli_query($connect, $select_city);
        $fetch_city = mysqli_fetch_array($run_city);

        echo '<tr id="row_'.$id.'">
                <td>'.$i++.'</td>

                <td><img src="/burgatory/profile_image/'.$fetch_rec['profile'].'" class="user_profile_img"></td>

                <td>'.$fetch_rec['name'].'</td>
                <td>'.$fetch_rec['email'].'</td>
                <td>'.$fetch_rec['phone_no'].'</td>
                <td>'.$fetch_rec['dob'].'</td>
                <td>'.$fetch_state['state_name'].'</td>
                <td>'.$fetch_city['city_name'].'</td>
                <td>'.$fetch_rec['zip_code'].'</td>
                <td>'.$fetch_rec['address'].'</td>

                <td>
                    <a href="javascript:void(0)" title="Edit User" onclick="show_data('.$id.');">
                        <img src="images/edit_user.png" alt="Edit">
                    </a>
                    <a href="javascript:void(0)" title="Delete" 
                        onclick="return confirm(\'Are you sure you want to delete this user?\')" 
                        class="deleteBtn" data-id="'.$id.'">
                        <img src="images/form_delete.png" alt="Delete">
                    </a>
                </td>
            </tr>';
    }

    echo '</table>';

} else {
    echo 'error';
}

    }
?>

<style>
    .user_profile_img {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>