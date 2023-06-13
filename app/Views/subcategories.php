<?= $this->extend("layouts/layout") ?>


<?= $this->section('content') ?>

<div class="categories_wrap my-4">
    <table class="table table-info table-striped">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Title</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
    <tbody>
        <?php foreach ($categories as $key => $row){ ?>
        <tr>
            <td><?= $key+1 ?></td>
            <td><?= $row['title'] ?></td>
            <td><img style="width: 80px; height: 80px" src="<?= $row['image'] ?>" alt=""></td>
            <td>
                <a class="btn btn-outline-primary" href="">Edit</a>
                <a class="btn btn-outline-success" href="">View</a>
                <a class="btn btn-outline-danger" href="<?= site_url('/deletesubcategories/'.$row['id']) ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <?= $pager->links() ?>
</div>








<?= $this->endSection() ?>