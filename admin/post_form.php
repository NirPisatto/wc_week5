<?php

    require_once '../models/Post.php';
    // require_once '../admin/post_data.php';

    // if (session_status() === PHP_SESSION_NONE) {
    //     session_start();
    // }



    // Start PHP session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['auth'])) {
        header("Location: ../index.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        var_dump($_POST);



        $title = !isset($_POST["title"]) ? $_POST["title"] : 'na';
        $content = !isset($_POST["content"]) ? $_POST["content"] : 'na';

        var_dump($_FILES);

        if (($_FILES['image']['name']!="")){
            $target_dir = "../uploads/";
            $file = $_FILES['image']['name'];
            $path = pathinfo($file);
            $filename = strval(time()).$path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['image']['tmp_name'];
            $path_filename_ext = $target_dir.$filename.".".$ext;

            if (file_exists($path_filename_ext)) {
                echo "Sorry, file already exists.";
            }else{
                move_uploaded_file($temp_name,$path_filename_ext);
                echo "Congratulations! File Uploaded Successfully.";
            }
        }



        $new_post = new Post(count($_SESSION['posts']) + 1, $title , $content, $path_filename_ext);


        var_dump($new_post);


        array_push($_SESSION['posts'],$new_post);

        header("Location: ../admin/posts.php");

    }
?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Clean Blog - Login</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Main Content-->
        <main class="mb-4 mt-5">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <h2>Start Your Session</h2>
                        <div class="my-5">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-floating">
                                    <input class="form-control" name="title" type="text" placeholder="Enter your title..." required />
                                    <label for="title">Title</label>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" name="content" type="text" placeholder="Enter password..." required />
                                    <label for="content">Content</label>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" name="image" type="file" required />
                                </div>
                                <br />
                               
                                <button class="btn btn-primary text-uppercase" type="submit">Sign In</button>

                                <a href="../admin/posts.php" class="btn btn-primary text-uppercase">Back</a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>

