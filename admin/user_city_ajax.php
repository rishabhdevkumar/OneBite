<?php
    include("config.php");
    $state_id = $_POST['state'];
    $city = "SELECT * FROM `city` WHERE state_id = '".$state_id."'";
    $run = mysqli_query($connect, $city);


    $abc="SELECT * FROM state WHERE id='".$state_id."'";
    $run_abc=mysqli_query($connect,$abc);
    $fetch_abc=mysqli_fetch_array($run_abc);

    $select_rec = "SELECT * FROM `user` WHERE id = '".$_SESSION['abc']."'";
    $run_rec = mysqli_query($connect,$select_rec);
    $fetch_rec = mysqli_fetch_array($run_rec);
    $name = $fetch_rec['name'];
    $email = $fetch_rec['email'];
    $phone = $fetch_rec['phone_no'];
    $dob = $fetch_rec['dob'];
    $state_id = $fetch_rec['state']; 
    $city_id = $fetch_rec['city']; 
    $address = $fetch_rec['address'];
    $Zipcode = $fetch_rec['zip_code'];

    /*$select = "SELECT * FROM `user` WHERE 1";
    $run = mysqli_query($connect, $select);
    $fetch = mysqli_fetch_array($run){}*/

   echo '
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content card-style">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form method="POST" action="">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name1" class="form-control" value="'.$name.'" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email1" class="form-control" value="'.$email.'" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Phone No</label>
            <input type="number" name="phone1" class="form-control" value="'.$phone.'" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="dob1" class="form-control" value="'.$dob.'" required>
          </div>
          <div class="mb-3">
            <label class="form-label">State</label>
            <select class="form-control" id="state" name="state" required >
              <option value="">Select State</option>';
              $select_states = "SELECT * FROM `state` WHERE 1";
              $run_states = mysqli_query($connect, $select_states);
              while ($fetch_states = mysqli_fetch_array($run_states)) 
              {
                /*$S = ($state_id == $fetch_states['id']) ? 'selected' : '';*/
                if($fetch_abc['id']==$fetch_states['id'])
                {
                  $S="selected";
                }
                else
                {
                  $S="";
                }
                echo '<option value="'.$fetch_states['id'].'" '.$S.' onclick="city_by_state('.$fetch_states['id'].')">'.$fetch_states["state_name"].'</option>';
              }
              echo '
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">City</label>
            <select class="form-control" id="city" name="city1" required>
              <option value="">Select City</option>';
               while($fetch_city = mysqli_fetch_array($run))
            {
                echo '<option value='.$fetch_city['id'].'>
                '.$fetch_city['city_name'].'</option>';
            }
              echo '
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address1" class="form-control" value="'.$address.'" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Zip Code</label>
            <input type="number" name="zipcode1" class="form-control" value="'.$Zipcode.'" required>
          </div>
          <div class="d-flex justify-content-end">
            <button type="reset" class="btn btn-secondary me-2">Reset</button>
            <button type="submit" name="update_user1" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>';
?>
