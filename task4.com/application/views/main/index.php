<div class="container">
    <div class="box">
        <h1 class="display-6 text-center">All profiles</h1>
        <br>
        <?php
        if (isset($data['error'])) { ?>
            <h2 style="text-align: center; color: red"><?php echo $data['error'] ?></h2>
        <?php } else { ?>
            <div class="buttonRight">
                <a href="/user/create">
                    <button type="button" class="btn btn-primary" name="createNew">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                             class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Add new user
                    </button>
                </a>
            </div>
            <br>
            <?php
            if (!empty($data['users'])) {
                ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($data['users'] as $key => $user) {
                        ?>
                        <tr>
                            <th scope="row"><?= $key + 1 ?></th>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?php echo $data['genders'][$user['gender']]; ?></td>
                            <td><?php echo $data['statuses'][$user['status']]; ?></td>
                            <td><a href="/user/edit/<?= $user['id'] ?>" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                         class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd"
                                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                    Edit</a>
                                <a href="/user/delete/<?= $user['id'] ?>" class="btn btn-outline-danger"
                                   onclick="return confirm('Are you sure you want to delete this user?');">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                         class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                    Remove</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php
            } else {
                echo '<hr>';
                echo '<h2 style="text-align: center">No users!</h2>';
                echo '<hr>';
            }
            ?>
        <?php } ?>
    </div>


    <?php if (isset($data['page'])) { ?>
        <div class="pagesMain">

            <?php if ($data['page'] > 1) { ?>
                <a href="/<?= $data['page'] - 1 ?>" class="btn btn-dark" role="button" data-bs-toggle="button">Prev</a>
            <?php } elseif ($data['page'] = 1) { ?>
                <button disabled class="btn btn-dark">Prev</button>
            <?php } ?>

            <h3>Page <?= $data['page'] ?></h3>

            <?php if ($data['page'] < $data['maxpage']) { ?>
                <a href="/<?= $data['page'] + 1 ?>" class="btn btn-dark" role="button" data-bs-toggle="button">Next</a>
            <?php } else { ?>
                <button disabled class="btn btn-dark">Next</button>
            <?php } ?>

        </div>
    <?php } ?>
</div>
