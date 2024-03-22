<? require($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/header.php")?>

<div class="container py-3" style="width: 100vw; margin: 0 auto; padding: 20px; border: 1px solid #e1ebfa; border-radius: 10px; box-shadow: 0 0 10px 0 #e1ebfa; margin-top: 50px; margin-bottom: 50px;">
    <div class="container">
        <div class="pb-3 text-center">
            <h1 class="">Manager User</h1>
        </div>
    </div>
    <div class="container row g-3">    
        <h4 class="mb-3" style="width: auto;">
            <span>List user</span>
        </h4>
        <div class="col-md-auto sign-up">
            <form action="/manager/user" method="GET" class="row g-3 d-flex justify-content-between flex-fill">
                <div class="col-auto">
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id" name="id" placeholder="ID...">
                    </div>
                </div>
                <div class="col-auto">
                    <div class="col-sm-10">
                        <input type="text" class="form-control w-200" id="username" name="username" placeholder="Username...">
                    </div>
                </div>
                <div class="col-auto">
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email...">
                    </div>
                </div>
                <div class="col-auto">
                    <button class="btn btn-success" name="search" type="submit">Search</button>
                </div>
            </form>
        </div>

        <div class="col-md-auto">
            <table class="table table-bordered nav">
                <tr class="">
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Date of birth</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>            
                    <th scope="col">Level</th>
                    <th scope="col">Actions</th>
                </tr>
                <?php $count = 0; 
                if(!is_array($users)){
                    $users = [$users];
                }

                foreach ($users as $user): 
                    if ($user->getLevel() > 1):
                        $count++;
                        if ($count > 10):
                            break;
                        endif;?>
                    <tr>
                        <td><?= $count?></td>
                        <td><?= $user->getId() ?></td>
                        <td><?= $user->getUsername() ?></td>
                        <td><?= $user->getFirstName()?></td>
                        <td><?= $user->getLastName()?></td>
                        <td><?= $user->getDateOfBirth()?></td>
                        <td><?= $user->getEmail() ?></td>
                        <td><?= $user->getGender()?></td>
                        <td><?= $user->getLevel() ?></td>
                        <td>
                            <!-- btn: Set Contribute, Unset Contribute and Is Ban -->
                            <?php if ($user->getLevel() == 3): ?>
                                <form class="d-inline-block" action="/manager/user" method="POST">
                                    <input type="hidden" name="id" value="<?= $user->getId() ?>">
                                    <input type="hidden" name="level" value="2">
                                    <button class="btn btn-success" style="width: 170px" type="submit">Set Contributor</button>
                                </form>
                            <?php elseif ($user->getLevel() == 2): ?>
                                <form class="d-inline-block" action="/manager/user" method="POST">
                                    <input type="hidden" name="id" value="<?= $user->getId() ?>">
                                    <input type="hidden" name="level" value="3">
                                    <button class="btn btn-warning" style="width: 170px" type="submit">Unset Contributor</button>
                                </form>
                            <?php else: ?>
                                <button class="d-inline-block btn btn-outline-danger" style="width: 170px" disabled>Is Ban</button>
                            <?php endif; ?>
                            
                            <!-- btn: Edit user -->

                            <a href="/manager/user/update?id=<?= $user->getId() ?>" class="btn btn-secondary d-inline-block" role="button">Edit</a>
                            <!-- btn: Ban and Unban -->
                            <?php if ($user->getLevel() != 4): ?>
                                <form class="d-inline-block" action="/manager/user" method="POST">
                                    <input type="hidden" name="id" value="<?= $user->getId() ?>">
                                    <input type="hidden" name="level" value="4">
                                    <button class="btn btn-danger" style="width: 100px" type="submit">Ban</button>
                                </form>  
                            <?php elseif ($user->getLevel() == 4): ?>
                                <form class="d-inline-block" action="/manager/user" method="POST">
                                    <input type="hidden" name="id" value="<?= $user->getId() ?>">
                                    <input type="hidden" name="level" value="3">
                                    <button class="btn btn-info" style="width: 100px" type="submit">Unban</button>
                                </form>
                            <?php endif;?>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="col-md-auto sign-up">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span>Add new user</span>
            </h4>
            <form id="sign-up-form" action="/manager/user/add" method="POST" class="row g-3">
                <div class="col-auto">
                    <label for="username" class="col-sm-auto col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control w-200" id="username" name="username">
                    </div>
                </div>
                <div class="col-auto">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="col-auto">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-success" name="update" type="submit">Add</button>
                </div>
            </form>
        </div>
        <div class="d-md-flex justify-content-end py-3">
            <a href="/manager" class="btn btn-secondary me-md-2" tabindex="-1" role="button">Back</a>
        </div>
    </div>
</div>

<? require($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/footer.php")?>  
<script src="/Public/js/validate-signup.js"></script>