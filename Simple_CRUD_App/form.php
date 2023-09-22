        <?php //$user and $error must be define 
        ?>
        <!-- enctype="multipart/form-data" make file send to global $_FILES and not in the POST method -->
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="input-text <?= $error['name'] ? 'is-invalid' : "" ?>" name="name" value="<?= $user['name'] ?>">
                <div><?= $error['name'] ?></div>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" class="input-text <?= $error['username'] ? 'is-invalid' : "" ?>" name="username" value="<?= $user["username"] ?>">
                <div><?= $error['username'] ?></div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" class="input-text <?= $error['email'] ? 'is-invalid' : "" ?>" name="email" value="<?= $user["email"] ?>">
                <div><?= $error['email'] ?></div>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" class="input-text <?= $error['phone'] ? 'is-invalid' : "" ?>" name="phone" value="<?= $user["phone"] ?>">
                <div><?= $error['phone'] ?></div>
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" id="website" class="input-text" name="website" value="<?= $user["website"] ?>">
            </div>
            <div class="form-group">
                <label for="image">image</label>
                <input type="file" id="image" name="image" class="input-file">
            </div>
            <input type="submit" class="button">
        </form>