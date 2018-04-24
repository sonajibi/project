

<main class="main-content" id="MainContent" role="main">
    <div class="page-width">
        <div class="grid">
            <div class="grid__item medium-up--one-half medium-up--push-one-quarter">
                <h1 class="text-center">Profile</h1>
                <form id="signup" name="signup" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>dashboard/update_profile">
                    <table width="500" class="cart">
                        <tr>
                            <td>Name</td>
                            <td>
                                <input name="name" type="text" value="<?= $userInfo->name; ?>" id="name" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                             <?= $userInfo->email; ?>
                            </td>
                        </tr>
                        <?php if ($userInfo->id_proof != '') { ?>
                            <tr>
                                <td>View Id Proof</td>
                                <td><a href="<?php echo base_url(); ?>uploads/<?= $userInfo->id_proof; ?>" target="_blank">View</a></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td>Id Proof</td>
                            <td>
                                <input type="hidden" name="oldIdProof" value="<?= $userInfo->id_proof; ?>">
                                <input name="file" type="file" value="" id="file" />
                            </td>
                        </tr>
                        <tr>
                            <td>Account Status</td>
                            <td><?= $userInfo->status; ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="Submit" value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</main>