<?php
    include("config.php");
    $record = "SELECT * FROM user WHERE 1";
    $run = mysqli_query($connect, $record);
    if (!$run) {
        die("Database query failed: " . mysqli_error($connect)); 
    }

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>User Details</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/jquery.notifyBar.js"></script>
    <link rel="stylesheet" href="css/notifyBar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/jquery.configuration.js"></script>
    <script type="text/javascript" src="js/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="js/jquery.validationEngine-en.js"></script>
    <link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css">
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script src="ckeditor/_samples/sample.js" type="text/javascript"></script>

    <script>
        function show_data(us_id) {
            $.ajax({
                url: "user_get_data.php",
                type: "POST",
                data: { user_id: us_id },
                success: function (data) {
                    $("#editUserModal").html(data);
                    $("#editUserModal").modal("show");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                },
            });
        }

        function city_by_state(state_id) {
            $.ajax({
                url: "user_city_ajax.php",
                type: "POST",
                data: { state: state_id },
                success: function (data) {
                    $("#editUserModal").html(data);
                    $("#editUserModal").modal("show");
                },
                error: function (jqXHR, textstatus, errorThrown) {
                    console.log(textstatus, errorThrown);
                }
            });
        }

    function edit_user(id) {
    const formData = $("form").serialize() + "&id=" + id;

    $.ajax({
        url: "user_edit.php",
        type: "POST",
        data: formData,
        success: function (data) {

            // REMOVE exit() — it breaks JS

            if (data.trim() == "Email Already Exists") {
                alert("Email Already Exists");
            } else {
                $("#abc").html(data);
                $("#editUserModal").modal("hide");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
}



        function search_user() {
        let search_value = $("#search").val();
        $.ajax({
            url: "search.php",
            type: "POST",
            data: { search: search_value },
            success: function (data) {
                $("#search_result").html(data);
            },
            error: function (jqXHR, textstatus, errorThrown) {
            console.log(textstatus, errorThrown);
            }
        });
    }

    </script>
</head>

<body style="background: #f8f8f8">
    <div id="body-wrapper" style="background: #f8f8f8">
        <div id="sidebar">
            <div id="sidebar-wrapper">
                <?php require 'sidebar.php'; ?>
            </div>
        </div>
        <div id="main-content">
            <div class="content-box" style="box-shadow: 0px 0 12px 5px rgba(128, 122, 122, 0.29);">
                <div class="content-box-header">
                    <h3>User Details</h3>
                    <div class="clear"></div>
                </div>
                <div class="content-box-content">
                    <div class="tab-content" id="abc">
                        <form id="dashboard" method="POST" action="" enctype="multipart/form-data">
                            <div style="margin-bottom: 15px;">
                                <input type="text" id="search" name="search" placeholder="Search by name, and email..."
                                    style="padding: 8px; width: 300px; border: 1px solid #ccc; border-radius: 4px;">
                                <button type="button" name="search_btn" class="search_button" onclick="search_user()"
                                    style="padding: 8px 15px; border-radius: 4px;">
                                    Search
                                </button>
                            </div>
                            <table class="user_table">
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
                                </thead>
                                <tbody id="search_result">
                                    <?php
                                    $i = 1;
                                    while ($fetch_user = mysqli_fetch_array($run)) {
                                        $state_query = mysqli_query($connect, "SELECT state_name FROM state WHERE id = '" . mysqli_real_escape_string($connect, $fetch_user['state']) . "'");
                                        $state_name = $state_query && mysqli_num_rows($state_query) > 0 ? mysqli_fetch_assoc($state_query)['state_name'] : 'N/A';
                                        $city_query = mysqli_query($connect, "SELECT city_name FROM city WHERE id = '" . mysqli_real_escape_string($connect, $fetch_user['city']) . "'");
                                        $city_name = $city_query && mysqli_num_rows($city_query) > 0 ? mysqli_fetch_assoc($city_query)['city_name'] : 'N/A';
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <img src="/burgatory/profile_image/<?php echo $fetch_user['profile']; ?>"
                                                alt="Profile" class="profile_img">
                                        </td>
                                        <td>
                                            <?php echo $fetch_user['name'];?>
                                        </td>
                                        <td>
                                            <?php echo $fetch_user['email'];?>
                                        </td>
                                        <td>
                                            <?php echo $fetch_user['phone_no'];?>
                                        </td>
                                        <td>
                                            <?php echo $fetch_user['dob'];?>
                                        </td>
                                        <td>
                                            <?php echo $state_name;?>
                                        </td>
                                        <td>
                                            <?php echo $city_name; ?>
                                        </td>
                                        <td>
                                            <?php echo $fetch_user['zip_code'];?>
                                        </td>
                                        <td>
                                            <?php echo $fetch_user['address'];?>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" title="Edit User"
                                                onclick="show_data(<?php echo $fetch_user['id']?>);">
                                                <img src="images/edit_user.png" alt="Edit">
                                            </a>
                                            <a href="javascript:void(0)"
                                                onclick="return confirm('Are you sure you want to delete this user?')"
                                                title="Delete" class="deleteBtn"
                                                data-id="<?php echo $fetch_user['id'];?>">
                                                <img src="images/form_delete.png" alt="Delete">
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <!-- <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content card-style">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter new name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter new email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone No</label>
                            <input type="number" name="phone" class="form-control" placeholder="Enter new phone no" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">State</label>
                            <select class="form-control" id="state" name="state" required>
                                <option value="">Select State</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <select class="form-control" id="city" name="city" required>
                                <option value="">Select City</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea type="text" name="address" class="form-control" 
                             placeholder="Enter new address" style="resize: none" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pip Code</label>
                            <input type="number" name="zipcode" class="form-control" placeholder="Enter new pincode" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary me-2">Reset</button>
                            <button type="submit" name="update_user" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
    </div>

</body>

</html>

<style>
    .content-box {
        background: #f7f7f7;
        overflow: hidden;
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .content-box-header {
        background: #210b44;
        color: #fff;
    }

    .content-box-header h3 {
        margin: 0;
        font-size: 20px;
    }

    .modal-header .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
    .search_button {
        transition: background 0.4s ease;
        background: #210b44;  
        color: #fff;
        border: none;
    }

    .search_button:hover {
        background: green; 
        color: #000;   
        cursor: pointer;
    }

    .user_table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        border: 1px solid #cecece;
    }

    .user_table thead th {
        color: #333;
        border: 1px solid #cecece;
        background: #faf5f5;
        text-align: center;
    }

    .user_table td {
        color: #555;
        background: #fff;
        border: 1px solid #cecece;
        text-align: center;
        vertical-align: middle;
        padding: 8px;
    }

    .form-label {
        color: #000;
        font-weight: bold;
    }

    select.form-control {
        -webkit-appearance: auto;
    }

    .profile_img {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user_table tbody tr:nth-child(odd) td {
        background: #ffffff;
    }

    .user_table tbody tr:nth-child(even) td {
        background: #f9f9f9;
    }

    .card-style {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border: none;
    }

    .modal-header {
        background: #210b44;
        color: #fff;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .modal-body {
        background: #f8f8f8;
    }

    .btn-link {
        text-decoration: none;
    }

    .form-control {
        border-radius: 5px;
        border: 1px solid #cecece;
        padding: 8px;
    }

    .btn-primary,
    .btn-secondary {
        border-radius: 5px;
    }

    .notification {
        position: relative;
        cursor: pointer;
    }

    .notification img {
        width: 30px;
        height: 30px;
    }

    .badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
        margin: 4px 0px 0px 10px;
    }
</style>