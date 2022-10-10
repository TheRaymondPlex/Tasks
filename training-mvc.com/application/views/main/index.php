<h1 style="text-align: center">Viewing all created profiles page</h1>
<div class="container">
    <div class="box">
        <h1 class="display-6 text-center">All profiles</h1>
        <br>
        <div class="ButtonRight">
            <a href="/user/create">
                <button type="button" class="btn btn-primary" name="createNew">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    Add new user
                </button>
            </a>
        </div>
        <br>
        <?php
        if (!empty($users)) {
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
                $i = 0;
                foreach ($users as $user) {
                    $i++;
                    ?>
                    <tr>
                        <th scope="row"><?=$i?></th>
                        <td><?=$user['name']?></td>
                        <td><?=$user['email']?></td>
                        <td><?php if ($user['gender'] == 'Male') { echo 'Male'; } else { echo 'Female'; }?></td>
                        <td><?php if ($user['status'] == 'Active') { echo 'Active'; } else { echo 'Inactive'; }?></td>
                        <td><a href="/user/edit?email=<?=$user['email']?>" class="btn btn-outline-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                                Edit</a>
                            <a href="/user/delete?email=<?=$user['email']?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this user?');">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
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
            echo '<h1 style="text-align: center">No users!</h1>';
            echo '<hr>';
        }
        ?>
    </div>
</div>

<!--debug-->
<?php //foreach ($users as $user): ?>
<!--    <h3>--><?php //echo $user['email']; ?><!--</h3>-->
<!--    <p>--><?php //echo $user['name']; ?><!--</p>-->
<!--    <p>--><?php //echo $user['gender']; ?><!--</p>-->
<!--    <p>--><?php //echo $user['status']; ?><!--</p>-->
<!--    <hr>-->
<?php //endforeach;?>
