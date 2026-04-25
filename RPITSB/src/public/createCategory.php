<?php
    require 'connect_db.php';
    $error = []; // Initialize outside to avoid 'undefined' notice

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $catName = $_POST['catName'] ?? '';
        $catNote = $_POST['catNote'] ?? '';
        $catOrder = $_POST['catOrder'] ?? '';
        $images = $_FILES["url"];
        var_dump($images);
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
            $sql = "INSERT INTO tbl_category (catName, catNote, catOrder) VALUES (?, ?, ?)";
            $pdo->prepare($sql)->execute([$catName, $catNote, $catOrder]);
            
            header("Location: index.php");
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