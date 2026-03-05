<?php 

    session_start();
    require_once "config/db.php";


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

        <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Computer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="insert.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="modelname" class="col-form-label">Modal Name :</label>
                <input type="text" required class="form-control" name="modelname">
            </div>
            <div class="mb-3">
            <label for="computerType" class="col-form-label">Computer Type :</label>
            <select class="form-control" name="computer_type" id="computerType" required>
                <option value="">-- Select Type --</option>
                <option value="Laptop">Laptop</option>
                <option value="Desktop">Desktop</option>
                <option value="Mini PC">Mini PC</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="releaseDate" class="col-form-label">Release Date :</label>
            <input type="date" class="form-control" name="release_date" id="releaseDate" required>
        </div>
        <div class="mb-3">
                <label for="img" class="col-form-label">Image :</label>
                <input type="file" required class="form-control" id="imgInput" name="img">
                <img width="100%" id="previewImg" alt="">
            </div>
        <div class="mb-3">
            <label for="productUrl" class="col-form-label">Official Product :</label>
            <input type="url" class="form-control" id="productUrl" name="official_product" placeholder="https://example.com/product">
        </div>    
            
            
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </div>
        
            </form>
        </div>
        
        </div>
    </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>Product</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">Add Computer</button>
            </div>
        </div>
        <hr>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['success']; 
                    unset ($_SESSION['success']);
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger">
                <?php 
                    echo $_SESSION['error']; 
                    unset ($_SESSION['error']);
                ?>
            </div>
        <?php } ?>

        <!-- Product Data-->
         <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Model Name</th>
            <th scope="col">computer_type</th>
            <th scope="col">Release_date</th>
            <th scope="col">Img</th>
            <th scope="col">Official Product</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $stmt = $conn->query("SELECT * FROM computer");
                $stmt->execute();
                $computer = $stmt->fetchAll();
                
                if (!$computer) {
                    echo "<tr><td colspan='7' class='text-center'>No product found</td></tr>";
                } else {
                    foreach ($computer as $computer) {
  
                ?>
            <tr>
            <th scope="row"><?= $computer['computer_id'] ?></th>
            <td><?= $computer['model_name'] ?></td>
            <td><?= $computer['computer_type'] ?></td>
            <td><?= $computer['release_date'] ?></td>
            <td width="250px"><img width="100%" src="<?= $computer['image_url']; ?>" class="rounded" alt=""></td>
            <td><a href="<?= $computer['official_product'] ?>" target="_blank" class="btn btn-info btn-sm">View</a></td>

            <td>
                <a href="edit.php?id=<?= $computer['computer_id']; ?>" class="btn btn-warning">Edit</a>
                <a href="?delete=<?= $computer['computer_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
            </td>
        
            </tr>
            <?php }
                }
            ?>
        </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file);
            }
        }
    </script>

</body>
</html>