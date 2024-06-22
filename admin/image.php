<?php
if(isset($_POST['btn-submit'])){
    if(isset($_FILES['image'])){ //tồn ại input type=file / hoặc có thuộc tính enctype trong form
        if(!empty($_FILES['image']['name'])){ //nếu đã nhaapk file lên ô input type=file thì mới xử lý uploat
            $name = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $error =$_FILES['image']['error'];
            $size =$_FILES['image']['size'];
            if($error > 0){
                die("Qúa trình uploat bị lỗi");
            }else{
                move_uploaded_file($tmp_name,"./images/".$name);
                echo "Uploat file thành công";
            }
    // echo "<pre>";
    // print_r($_FILES);
    }
  }
}


?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uploat Images</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
            <label class="input-group-text" for="image-id">Upload</label>
            <input type="file" class="form-control" name="image" id="image-id">
        </div>
        <div class="col-auto">
            <button type="submit" name="btn-submit" class="btn btn-primary mb-3">Submit</button>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>