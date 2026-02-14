<?php
    include("config.php");
    $id = $_SESSION['about_us_id'];
    $select = "SELECT * FROM `about_us` WHERE 1 ORDER BY id LIMIT 0,1";
    $run = mysqli_query($connect,$select);
    $fetch = mysqli_fetch_array($run);
    if($fetch['content']=='')
    {
        $content = $_POST['title'];
        $status = $_POST['status'];
        $new_image = ($_FILES['img']['name']);
        $insert="INSERT INTO `about_us`(content,image,status)VALUES('".$content."','".$new_image."','".$status."')";
        $run_abt=mysqli_query($connect,$insert);
          move_uploaded_file(($_FILES['img']['tmp_name']),'upload/'.$new_image);
           if($run_abt)
           {
            header("location:cont_about_us.php");
           }
           else
           {
            echo'<script> alert("INSERT ERROR")</script>';
           }

    }
    else
    {
        if(isset($_POST['submit']))
        {
            $content = $_POST['title'];
            $status = $_POST['status'];
            $new_image = ($_FILES['img']['name']);
            $path='upload/'.$fetch['image'].'';
            $update_image = "UPDATE about_us Set content='".$content."',image = '".$new_image."',status='".$status."'";
            $run_update = mysqli_query($connect,$update_image);
            if($run_update)
            {
            // header("location:dashboard.php");
            move_uploaded_file(($_FILES['img']['tmp_name']),'upload/'.$new_image);
            unlink($path);
            header("location:cont_about_us.php");
            }else
            {
            echo '<script>alert("Profile does not update")</script>';
            }

            }

        

        }

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Edit About us || Burgatory</title>

    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.notifyBar.js"></script>
    <link rel="stylesheet" href="css/notifyBar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/jquery.configuration.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.validationEngine.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.validationEngine-en.js"></script>
    <link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css">

    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script src="ckeditor/_samples/sample.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#dashboard").validationEngine()
        });
        function checkname(e) {
            if (document.getElementById("name").value.length == 0 && e.which == 32) {
                return false;
            }
        }
    </script>
</head>

<body style="background: #f8f8f8ff">
    <div id="body-wrapper" style="background: #f8f8f8ff">
        <div id="sidebar">
            <div id="sidebar-wrapper">
                <?php require 'sidebar.php'; ?>
            </div>
        </div>
        <div id="main-content">
            <div class="content-box" style="box-shadow: 0px 0 12px 5px rgba(128, 122, 122, 0.29);">
                <div class="content-box-header">
                    <h3>Burgatory About Us Content</h3>
                    <div class="clear"></div>
                </div>
                <div class="content-box-content">
                    <div class="tab-content">
                        <form id="dashboard" method="POST" action="" enctype="multipart/form-data">
                            <fieldset class="form-cards">
                                <div class="card">
                                    <label>
                                        English <span style="color:red;">*</span>
                                    </label>
                                    <textarea name="title" id="editor_kama1"
                                        class="largeInput"><?php echo $fetch['content'];?>
                                    </textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace('editor_kama1', {
                                            toolbar: [
                                                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                                                { name: 'links', items: ['Link'] },
                                                { name: 'insert', items: ['Image'] },
                                                { name: 'colors', items: ['TextColor', 'BGColor'] },
                                                { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                                            ],
                                            skin: 'kama',
                                            width: '100%',
                                            height: 250
                                        });
                                    </script>
                                </div>
                                <div style="clear:both"></div>
                                <div class="card" style="text-align:center;">
                                    <label>
                                        Menu Image <span style="color:red;">*</span>
                                    </label>
                                    <div class="image-preview">
                                        <img src="upload/<?php echo $fetch['image'];?>" alt="Image">
                                    </div>
                                    <input type="file" name="img" id="file1" class="text-input file1 validate[required]"
                                        onchange="chk_valid_img(this)" style="margin:10px 0;">
                                    <div style="margin:15px 0; text-align:left;">
                                        <label>Status <span style="color:red;">*</span></label><br>
                                        <label><input type="radio" name="status" value="Y" <?php
                                                if(($fetch['status']=="Y" )) {echo "checked" ;} ?>> Active</label>
                                        <label><input type="radio" name="status" value="N" <?php
                                                if(($fetch['status']=="N" )) {echo "checked" ;} ?>> Inactive</label>
                                    </div>
                                    <div style="margin-top:15px;">
                                        <button type="submit" class="button" id="save"  name="submit"
                                            style="padding:8px 16px; margin-right:10px;">Submit</button>
                                        <button type="reset" class="button"
                                            style="background:#ccc; color:#000; padding:8px 16px;">Cancel</button>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="clear"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</body>

</html>

<style>
    .form-cards {
        display: flex;
        gap: 20px;
        align-items: flex-start;
        flex-wrap: wrap;
        border: none;
        padding: 0;
        margin: 0;
    }

    .form-cards .card {
        flex: 1;
        min-width: 280px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 15px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .image-preview {
        margin: 10px auto;
        width: 150px;
        height: 150px;
        border: 1px solid #ccc;
        border-radius: 4px;
        overflow: hidden;
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media (max-width: 768px) {
        .form-cards {
            flex-direction: column;
        }

        .form-cards .card {
            width: 100%;
        }
    }
</style>