<div class="container">
    <form action="/user/update" method="post">
        <h1 class="display-6 text-center">Editing user</h1>
        <hr>
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?= $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION["error"]);
        } ?>
        <br>
        <div class="mb-3">
            <label for="InputName" class="form-label">Name</label>
            <input type="name"
                   class="form-control"
                   id="name"
                   name="name"
                   value="<?= $data['user']['name'] ?>"
            >
        </div>

        <div class="mb-3">
            <label for="InputName" class="form-label">Email</label>
            <input type="email"
                   class="form-control"
                   id="email"
                   name="email"
                   value="<?= $data['user']['email'] ?>"
            >
        </div>


        <div class="mb-3">
            <label for="Select" class="form-label">Gender</label>
            <select id="selectGender" class="form-select" name="gender">
                <?php
                foreach ($data['genders'] as $gender) {
                    echo "<option value=\"$gender\"";
                    if ($data['user']['gender'] === $gender) {
                        echo 'selected ="selected">';
                    } else {
                        echo '>';
                    }
                    echo ucfirst($gender) . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="Select" class="form-label">Status</label>
            <select id="selectStatus" class="form-select" name="status">
                <?php
                foreach ($data['statuses'] as $status) {
                    echo "<option value=\"$status\"";
                    if ($data['user']['status'] === $status) {
                        echo 'selected ="selected">';
                    } else {
                        echo '>';
                    }
                    echo ucfirst($status) . '</option>';
                }
                ?>
            </select>
        </div>

        <input type="text" name="id" value="<?= $data['user']['id'] ?>" hidden>

        <div class="buttonsMain">
            <a href="/" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

    </form>
</div>

