<?php
	include("config.php");
    session_start();  
    if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
    {
        header("Location: index.php");
    }
	$id = base64_decode($_GET['profile_id']);
	$change_image = "SELECT * FROM user WHERE id = '".$id."'";
	$run = mysqli_query($connect,$change_image);
	$fetch_image = mysqli_fetch_array($run);
	if(isset($_POST['submit']))
	{
		$new_image = ($_FILES['image']['name']);
        $path='profile_image/'.$fetch_image['profile'].'';
		$update_image = "UPDATE user Set profile = '".$new_image."' WHERE id = '".$id."'";
		echo $run_update = mysqli_query($connect,$update_image);
        unlink($path);
		if($run_update)
		{
			move_uploaded_file(($_FILES['image']['tmp_name']),'profile_image/'.$new_image);
			header("location:my_account.php");
		}else
		{
			echo '<script>alert("Profile does not update")</script>';
		}

	}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Pprofile</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #4facfe, #00f2fe);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      background: #fff;
      padding: 20px;
      margin-top: -5%;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 600px;
    }

    .profile-img {
      text-align: center;
      margin-bottom: 20px;
    }

    .profile-img img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #4facfe;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .label {
      font-size: 18px;
      font-weight: 700;
      margin-bottom: 20px;
      color: #000;
    }

    .form-control {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-sizing: border-box;
    }

    button {
      width: 100%;
      padding: 10px;
      background: #4facfe;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      color: #000;
      background: #00f2fe;
    }

    @media (max-width: 480px) {
      .container {
        margin: 5px;
        margin-top: -50%;
        padding: 15px;
      }

      .profile-img img {
        width: 120px;
        height: 120px;
      }
    }
  </style>
  <script>
    function chk_valid_img(input) {
      if (input.files && input.files[0]) {
        const file = input.files[0];
        const ext = file.name.split('.').pop().toLowerCase();
        const validExt = ['jpg', 'jpeg', 'bmp', 'png'];

        if (validExt.includes(ext)) {
          const reader = new FileReader();
          reader.onload = function (e) {
            const img = document.getElementById('blah');
            img.style.display = "block";
            img.src = e.target.result;
          }
          reader.readAsDataURL(file);
        } else {
          alert('Invalid file format. Please select JPG, JPEG, BMP or PNG');
          input.value = '';
          document.getElementById('blah').style.display = "none";
        }
      }
    }
  </script>
</head>

<body>
  <div class="container">
    <div class="profile-img">
      <img src="profile_image/<?php echo $fetch_image['profile']?>" alt="Profile Image">
    </div>

    <form method="POST" action="" enctype="multipart/form-data">
      <div class="form-group">
        <label class="label">Select Image</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="chk_valid_img(this)">
      </div>
      <div class="form-group">
        <button type="submit" name="submit" value="submit">Upload Profile</button>
      </div>
    </form>

    <p style="float:left;width:100%;">
      <img id="blah" src="#" alt="Preview" width="100%" height="200" style="display:none;" />
    </p>
  </div>
</body>

</html>