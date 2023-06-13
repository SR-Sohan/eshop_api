<?= $this->extend("layouts/layout") ?>


<?= $this->section('content') ?>



<div class="w-50 mx-auto my-5 p-5 bg-white shadow-lg rounded">
<?= form_open_multipart('add-subcategories',['method' => 'post']) ?>
        <h1 class="pb-3">Add SubCategory</h1>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="title" id="floatingInput" placeholder="Title">
            <label for="floatingInput">Title</label>
        </div>
        <div class="form-floating mb-3">
         <select class="form-select" name="cat_id" id="">
            <option selected>Select Category</option>
            <?php foreach($data as $row){ ?>
                <option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>

                <?php } ?>
         </select>
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="description" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Description</label>
        </div>
        <input type="file" name="image" id="">
        <br>
        <input class="btn btn-outline-danger my-4" type="submit" value="Add SubCategory">
    </form>
</div>








<?= $this->endSection() ?>