<?= $this->extend("layouts/layout2") ?>

<?= $this->section('auth'); ?>

    <div class="w-50 mx-auto my-5 shadow-lg rounded p-5 border">

    <?= form_open_multipart('register',['method' => 'post']) ?>
        <h1 class="pb-3">Register</h1>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="name" id="floatingInput" placeholder="Title">
            <label for="floatingInput">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="Title">
            <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <input type="file" name="image" id="">
        <br>
        <input class="btn btn-outline-danger my-4" type="submit" value="Register">
        <p>Do have an account? <a href="<?= base_url("login") ?>">Login</a></p>
    </form>

    </div>

<?= $this->endSection(); ?>