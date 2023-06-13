<?= $this->extend("layouts/layout2") ?>

<?= $this->section('auth'); ?>

    <div class="w-50 mx-auto my-5 shadow-lg rounded p-5 border">

    <?= form_open_multipart('login',['method' => 'post']) ?>
        <h1 class="pb-3">Login</h1>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="Title">
            <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <br>
        <input class="btn btn-outline-danger my-4" type="submit" value="Login">

        <p>Don't have an account? <a href="<?= base_url("register") ?>">Registration</a></p>

    </form>

    </div>

<?= $this->endSection(); ?>