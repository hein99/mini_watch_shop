<?php displayAdminPageHeader('Page Admins', 'admins') ?>

<main class="w-80" style="position: relative">
    <h1 class="pg-title">Page Admins</h1>

    <?php
    /**
     * ----------------------------------------------------------
     * Only id(1) admin can add, edit and delete other admin
     * and id(1) admin cannot be deleted by anyone include himself
     * ------------------------------------------------------------
     */
    if($_SESSION['admin']->getValue('id') == 1) :
    ?>
        <a href="<?php echo APP_URL ?>admin/admins/create" class="add-admin-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
            </svg>&nbsp;Admin
        </a>
    <?php endif; ?>
    <table class="admins-tb">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <?php
                /**
                 * ----------------------------------------------------------
                 * Only id(1) admin can add, edit and delete other admin
                 * and id(1) admin cannot be deleted by anyone include himself
                 * ------------------------------------------------------------
                 */
                if($_SESSION['admin']->getValue('id') == 1) :
                ?>
                <th>Action</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php foreach($data['admins'] as $admin) : ?>
            <tr>
                <td><?php echo $admin->getValueEncoded('name') ?></td>
                <td><?php echo $admin->getValueEncoded('email') ?></td>
                <td><?php echo $admin->getValueEncoded('phone') ?></td>
                <?php if($_SESSION['admin']->getValue('id') == 1) : ?>
                <td>
                    <a href="<?php echo APP_URL . 'admin/admins/edit/' . $admin->getValue('id') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>&nbsp;Edit
                    </a> 
                    <?php if($admin->getValue('id') != 1) : ?>
                        | <a href="<?php echo APP_URL . 'admin/admins/delete/' . $admin->getValue('id') ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg>&nbsp;Delete
                        </a>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php displayAdminPageFooter() ?>