
<div class="container mt-4">
    <div class="row">
    <div class="col-8">
        <h2 class="text-primary">Category List</h2>
    </div>
    <div class="col-4 text-end">
        <!-- <a href="" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Add Category</a> -->
         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
    <i class="bi bi-plus-circle"></i> Add Category
</button>
    </div>
</div>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Note</th>
                <th>Order</th>
                <th style="width: 200px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['catId']) ?></td>
                    <td><?= htmlspecialchars($item['catName']) ?></td>
                    <td><?= htmlspecialchars($item['catNote']) ?></td>
                    <td><?= htmlspecialchars($item['catOrder']) ?></td>
                    <td>
                        <a href="update.php?catId=<?=htmlspecialchars($item['catId'])  ?>" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i> Edit</a>
                        <a href="" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</a>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
    <i class="bi bi-plus-circle"></i> Add Category
</button> -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Create New Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="createCategory.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="mb-3">
            <label for="cat_name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="cat_name" name="catName" placeholder="e.g. Electronics">
          </div>
          
          <div class="mb-3">
            <label for="cat_note" class="form-label">Note</label>
            <textarea class="form-control" id="cat_note" name="catNote" rows="2" placeholder="Describe the category..."></textarea>
          </div>
          
          <div class="mb-3">
            <label for="cat_order" class="form-label">Display Order</label>
            <input type="number" class="form-control" id="cat_order" name="catOrder" value="1">
          </div>
          <div class="mb-3">
            <label for="url" class="form-label">Images</label>
            <input type="file" class="form-control" id="url" name="url" value="1">
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Category</button>
        </div>
      </form>

    </div>
  </div>
</div>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCategory">Edit Category</button>