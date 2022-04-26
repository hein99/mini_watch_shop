<?php displayAdminPageHeader('Page Admins', 'admins') ?>

<main>
    <h1>Page Admins</h1>
    <?php
    /**
     * ----------------------------------------------------------
     * Only id(1) admin can add, edit and delete other admin
     * and id(1) admin cannot be deleted by anyone include himself
     * ------------------------------------------------------------
     */
    if($_SESSION['admin']->getValue('id') == 1) :
    ?>
    <a href="<?php echo APP_URL ?>admin/admins/create">Add Admin</a>
    <?php endif; ?>
    <table>
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
                    <a href="<?php echo APP_URL . 'admin/admins/edit/' . $admin->getValue('id') ?>">Edit</a> 
                    <?php if($admin->getValue('id') != 1) : ?>
                       | <a href="<?php echo APP_URL . 'admin/admins/delete/' . $admin->getValue('id') ?>">Delete</a>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php displayAdminPageFooter() ?>