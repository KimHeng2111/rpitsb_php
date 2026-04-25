<?php
    require 'connect_db.php';
    $error = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $catId = (int) ($_POST['catId'] ?? 0);
        $stmt = $pdo->prepare('SELECT * FROM tbl_category WHERE catID ='. $catId .' LIMIT 1');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($stmt->rowCount() == 0) {
            $error[] = 'Update Category ID : ' . $catId . ' Is Not FOUND!!!!!';
        }else{
            
            $catName = $_POST["catName"];
            $catOrder = (int) $_POST["catOrder"];
            $catNote = $_POST["catNote"];
            $url = $_POST["catImage"];
            $sql = 'UPDATE tbl_category 
            SET catName = :catName, 
                catOrder = :catOrder, 
                catNote = :catNote, 
                url = :url 
            WHERE catId = :catId';

            $stmt = $pdo->prepare($sql);

            // 4. Bind Values
            $stmt->bindValue(':catName', $catName, PDO::PARAM_STR);
            $stmt->bindValue(':catOrder', $catOrder, PDO::PARAM_INT);
            $stmt->bindValue(':catNote', $catNote, PDO::PARAM_STR);
            $stmt->bindValue(':url', $url, PDO::PARAM_STR);
            $stmt->bindValue(':catId', $catId, PDO::PARAM_INT);

            // 5. Execute
            if ($stmt->execute()) {
                header("Location: index.php?update=success");
                exit;
}
        }
    }
    else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $catId = (int) ($_GET['catId'] ?? 0);
        $stmt = $pdo->prepare('SELECT * FROM tbl_category WHERE catID ='. $catId .' LIMIT 1');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $catName = $result[0]['catName'];
        $catOrder = $result[0]['catOrder'];
        $catNote = $result[0]['catNote'];
        $url = $result[0]['url'];
        if($stmt->rowCount() == 0) {
            header("Location: index.php");
            exit; // Stop script execution after redirect
        }
        require 'header.php';
        echo <<<HTML
        <div class="container mt-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Edit Category: {$catName}</h5>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="catId" value="{$catId}">
                        <div class="row">
                            <div class="col-8">
                                <div class="row">
                                    <div >
                                        <div class="col-md-12 col-12 mb-3">
                                            <label for="catName" class="form-label fw-bold">Category Name</label>
                                            <input type="text" class="form-control" name="catName" value="{$catName}" required>
                                        </div>
                                        <div class="col-md-12 col-12 mb-3">
                                            <label class="form-label fw-bold">Display Order</label>
                                            <input type="number" class="form-control" name="catOrder" value="{$catOrder}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label fw-bold">Notes</label>
                                        <textarea class="form-control" name="catNote" rows="1">{$catNote}</textarea>
                                    </div>
                                
                                        
                                </div>

                            </div>
                            <div class="col-4 text-center">
                                <div class="row">
                                    <div class="mb-20">
                                        <label class="form-label d-block fw-bold">Current Image</label>
                                        <label for="catImage"><img src="{$currentImageUrl}" class="img-thumbnail mb-2" style="height: 150px; width: 150px; object-fit: cover;"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                            <label for="catImage" class="form-label fw-bold">Upload New Image (Optional)</label>
                                            <input type="file" class="form-control" id="catImage" name="catImage" accept="image/*">
                                        </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-5">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        HTML;
    }
    
    
?>

<div class="container mt-4">
    <?php if (!empty($error)): ?>
        <?php foreach ($error as $msg): ?>
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <div><?php echo $msg; ?></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require 'footer.php'; ?>