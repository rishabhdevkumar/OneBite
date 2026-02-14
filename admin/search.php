<?php
    include "config.php";
    $search = isset($_POST['search']) ? mysqli_real_escape_string($connect, $_POST['search']) : '';

    $query = "SELECT * FROM user WHERE 
        id = '$search'
        OR name LIKE '%$search%'
        OR email LIKE '%$search%'
        OR phone_no LIKE '%$search%'
    ";
    $run = mysqli_query($connect, $query);
    $i = 1;

    if (mysqli_num_rows($run) > 0) {
        while ($fetch_user = mysqli_fetch_assoc($run)) {
            $state_query = mysqli_query($connect, "SELECT state_name FROM state 
            WHERE id = '" . mysqli_real_escape_string($connect, $fetch_user['state']) . "'
        ");
        $state_name = ($state_query && mysqli_num_rows($state_query) > 0)
            ? mysqli_fetch_assoc($state_query)['state_name'] : 'N/A';

        $city_query = mysqli_query($connect, "
            SELECT city_name FROM city 
            WHERE id = '" . mysqli_real_escape_string($connect, $fetch_user['city']) . "'
        ");
        $city_name = ($city_query && mysqli_num_rows($city_query) > 0)
            ? mysqli_fetch_assoc($city_query)['city_name']
            : 'N/A';

        echo '
        <tr>
            <td>'.$i.'</td>
            <td><img src="/burgatory/profile_image/'.$fetch_user['profile'].'" class="profile_img" alt="Profile"></td>
            <td>'.$fetch_user['name'].'</td>
            <td>'.$fetch_user['email'].'</td>
            <td>'.$fetch_user['phone_no'].'</td>
            <td>'.$fetch_user['dob'].'</td>
            <td>'.$state_name.'</td>
            <td>'.$city_name.'</td>
            <td>'.$fetch_user['zip_code'].'</td>
            <td>'.$fetch_user['address'].'</td>

            <td>
                <a href="javascript:void(0)" onclick="show_data('.$fetch_user['id'].');" title="Edit User">
                    <img src="images/edit_user.png" alt="Edit">
                </a>

                <a href="javascript:void(0)" class="deleteBtn"
                   onclick="return confirm(\'Are you sure you want to delete this user?\')"
                   data-id="'.$fetch_user['id'].'" title="Delete">
                    <img src="images/form_delete.png" alt="Delete">
                </a>
            </td>
        </tr>';
        $i++;
    }

} else {

    echo '<tr><td colspan="11" style="text-align:center; color:red;">No Record Found</td></tr>';

}
?>