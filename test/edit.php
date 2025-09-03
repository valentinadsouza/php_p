<?php
include "db.php";
if(!isset($_SESSION["id"])){
    header("Location:login.php");
}
if(isset($_GET["id"])){
    $id=$_GET["id"];
    $user_id=$_SESSION["id"];
    $result=$conn->prepare("select * from blogs where id=? and user_id=?");
    $result->bind_param("ii",$id,$user_id);
    $result->execute();
    $blogs=$result->get_result()->fetch_assoc();
}
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $title=$_POST["title"];
    $content=$_POST["content"];
    $image_name=$blogs["image"];
    if(!empty($_FILES["image"]["name"])){
        $image_name=$_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"],"uploads/$image_name");
    }
    $sql=$conn->prepare("update blogs set title=?, content=?, image=? where id=? ");
    $sql->bind_param("sssi", $title,$content,$image_name,$id);
    if ($sql->execute()) {
        header("Location:dashboard.php");
    }
}
?>


<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div
                class="container"
            >
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label"></label>
                        <input
                            type="hidden"
                            class="form-control"
                            name="id"
                            id=""
                            aria-describedby="helpId"
                            placeholder=""
                            value="<?php echo $blogs["id"];?>"
                        />
                    </div>
                    
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            id=""
                            aria-describedby="helpId"
                            placeholder=""
                            value="<?php echo $blogs["title"];?>"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Content</label>
                        <textarea class="form-control" name="content" id="" rows="3" ><?php echo $blogs["content"];?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Current Image</label>
                        <img
                        src="uploads/<?= $blogs["image"];?>"
                        class="img-fluid"
                        alt="" width="200px"
                    />
                        <input
                            type="file"
                            class="form-control"
                            name="image"
                            id=""
                            placeholder=""
                            aria-describedby="fileHelpId"
                        />
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Submit
                    </button>
                    
                    
                </form>
            </div>
            

        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
