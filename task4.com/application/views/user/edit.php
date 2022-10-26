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
            <label for="name" class="form-label">Name
                <input type="text"
                       class="form-control"
                       id="name"
                       name="name"
                       value="<?= $data['user']['name'] ?>"
                >
            </label>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email"
                   class="form-control"
                   id="email"
                   name="email"
                   value="<?= $data['user']['email'] ?>"
            >
        </div>

        <div class="mb-3">
            <label for="selectGender" class="form-label">Gender</label>
            <select id="selectGender" class="form-select" name="gender">
                <?php
                foreach ($data['genders'] as $key => $val) {
                    $selected = ($key == $data['user']['gender']) ? 'selected="selected"' : '';
                    echo '<option value="' . $key . '" ' . $selected . ' >' . $val . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="selectStatus" class="form-label">Status</label>
            <select id="selectStatus" class="form-select" name="status">
                <?php
                foreach ($data['statuses'] as $key => $val) {
                    $selected = ($key == $data['user']['status']) ? 'selected="selected"' : '';
                    echo '<option value="' . $key . '" ' . $selected . ' >' . $val . '</option>';
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

