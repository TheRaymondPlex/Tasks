<div class="container">
    <form action="/user/update" method="post">
        <h1 class="display-6 text-center">Editing user</h1>
        <hr>
        <?php if (isset($_SESSION['error'])) {?>
            <div class="alert alert-danger" role="alert">
                <?=$_SESSION['error']?>
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
                   value="<?=$user['name']?>"
            >
        </div>

        <div class="mb-3">
            <label for="InputName" class="form-label">Email</label>
            <input type="email"
                   class="form-control"
                   id="email"
                   name="email"
                   value="<?=$user['email']?>"
            >
        </div>


        <div class="mb-3">
            <label for="Select" class="form-label">Gender</label>
            <select id="selectGender" class="form-select" name="gender">
                <option value="male" <?php if ($user['gender'] == 'male') { echo ' selected="selected"'; }?>>Male</option>
                <option value="female" <?php if ($user['gender'] == 'female') { echo ' selected="selected"'; }?>>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="Select" class="form-label">Status</label>
            <select id="selectStatus" class="form-select" name="status">
                <option value="active" <?php if ($user['status'] == 'active') { echo ' selected="selected"'; }?>>Active</option>
                <option value="inactive" <?php if ($user['status'] == 'inactive') { echo ' selected="selected"'; }?>>Inactive</option>
            </select>
        </div>

        <input type="text" name="id" value="<?=$user['id']?>" hidden>

        <div class="buttonsMain">
            <a href="/" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

    </form>
</div>

