<?= $this->extend("layouts/layout") ?>


<?= $this->section('content') ?>



<div class="w-50 mx-auto my-5 p-5 bg-white shadow-lg rounded">
<?= form_open_multipart('add-products',['method' => 'post']) ?>
        <h1 class="pb-3">Add Products</h1>
        <div class="form-floating mb-3">
         <select class="form-select" name="cat_id" id="">
            <option selected>Select Category</option>
            <?php foreach($cat as $row){ ?>
                <option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>

                <?php } ?>
         </select>
        </div>
        <div class="form-floating mb-3">
         <select class="form-select" name="subcat_id" id="">
            <option selected>Select SubCategory</option>
            <?php foreach($subcat as $row){ ?>
                <option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>

                <?php } ?>
         </select>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="title" id="floatingInput" placeholder="Title">
            <label for="floatingInput">Title</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" name="price" id="floatingInput" placeholder="Title">
            <label for="floatingInput">Price</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" name="quantity" id="floatingInput" placeholder="Title">
            <label for="floatingInput">Quantity</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="description" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Description</label>
        </div>
        <input type="file" name="image" id="">
        <br>
        <input class="btn btn-outline-danger my-4" type="submit" value="Add Product">
    </form>
</div>








<?= $this->endSection() ?>