<div class="container">
    <form action="/user/create" method="post">
        <h1 class="display-6 text-center">Create new profile</h1>
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
                   value=""
                   placeholder="Enter your first and last name">
        </div>

        <div class="mb-3">
            <label for="InputName" class="form-label">Email</label>
            <input type="email"
                   class="form-control"
                   id="email"
                   name="email"
                   value=""
                   placeholder="Enter your Email">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>


        <div class="mb-3">
            <label for="Select" class="form-label">Gender</label>
            <select id="selectGender" class="form-select" name="selectGender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="Select" class="form-label">Status</label>
            <select id="selectStatus" class="form-select" name="selectStatus">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <div class="buttonsMain">
            <button type="submit" class="btn btn-primary" name="create">Create</button>
        </div>

    </form>
    <br>
    <a href="/" class="btn btn-secondary">View All</a>
</div>