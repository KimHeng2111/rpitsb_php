<?php
    require 'connect_db.php';
    require 'helper/uploadImage.php';
// Outputs something like: a1b2c3d4_2026-04-25.png
    $error = []; // Initialize outside to avoid 'undefined' notice

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $catName = $_POST['catName'] ?? '';
        $catNote = $_POST['catNote'] ?? '';
        $catOrder = $_POST['catOrder'] ?? '';
        $images = $_FILES["url"];   
        $image_path = __DIR__ . "/images/" . generateRandomNameWithDate($images["name"]);
        // Validation
        if (empty($catName)){
            $error[] = 'Category Name is required';
        } else {
            $stmt = $pdo->prepare("SELECT catName FROM tbl_category WHERE catName = ? LIMIT 1");
            $stmt->execute([$catName]);
            if($stmt->rowCount() > 0 ){
                $error[] = "Category Name: <strong>$catName</strong> already exists.";
            }
        }

        if (empty($catOrder)){
            $error[] = 'Category Order is Required';
        }

        // Processing
        if(empty($error)){
            // SECURE: Using placeholders to prevent SQL Injection
            $sql = "INSERT INTO tbl_category (catName, catNote, catOrder, imageUrl) VALUES (?, ?, ?, ?)";
            $pdo->prepare($sql)->execute([$catName, $catNote, $catOrder, basename($image_path)]);
            //move_uploaded_file($images["tmp_name"], "uploads/" . $images["name"]);
            move_uploaded_file($images["tmp_name"], $image_path);
            header("Location: index.php?created=success");
            exit; // Stop script execution after redirect
        }
    }
    
    require 'header.php';
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