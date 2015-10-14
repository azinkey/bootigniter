

<section id="main">
    <div class="container-fluid">
        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-10">
                    <h4 class="title">
                        <i class="fa fa-briefcase"></i>
                        <?php __('Permissions'); ?>
                    </h4>
                </div>
                <div class="col-xs-2 text-right hidden">
                    <button type="button" id="resetPermissionsButton" class="click-submit btn btn-default btn-sm" data-form="#resetPermissionsForm" title="<?php __('Update'); ?>">
                        <i class="fa fa-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php AZ::block('system-message'); ?>
        <div class="row-fluid">
            <?php echo form_open('admin/users/permissions_reset', array('id' => 'resetPermissionsForm')); ?>
            <div class="panel panel-default">

                <div class="panel-heading">
                    <?php __('Access Role Permissions'); ?>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body permission-table">
                    <table class="table">
                        <tr>
                            <th width="40%">
                                <i class="fa fa-list-ul"></i>
                            </th>
                            <?php foreach ($roles as $role) { ?>   
                                <th class="text-center">
                                    <?php echo $role->name; ?>
                                </th>
                            <?php } ?>
                        </tr>

                        <?php
                        if ($tasks && count($tasks)) {
                            $i = 0;
                            foreach ($tasks as $controller => $task) {
                                ?>

                                <tr>
                                    <th>
                                        <?php echo ucfirst($controller); ?>
                                    </th>
                                    <?php foreach ($roles as $role) { ?>   
                                        <th class="text-center"></th>
                                    <?php } ?>
                                </tr>
                                <?php
                                foreach ($task as $method) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo key_label($method); ?>
                                        </td>
                                        <?php
                                        foreach ($roles as $role) {
                                            ?>   

                                            <td class="text-center">
                                                <strong>
                                                    <?php
                                                    echo form_checkbox($controller . '[' . $method . '][' . $role->id . ']', true, check_permission($controller, $method, $role->id));
                                                    ?>
                                                </strong>
                                            </td>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                                ?>

                                <?php
                                $i++;
                            }
                        }
                        ?>

                    </table>
                </div>
                <div class="panel-footer text-right">
                    <?php __('Checked All Before'); ?>
                    <button type="submit" class="btn btn-primary" title="<?php __('Update'); ?>">
                        <i class="fa fa-2x fa-refresh"></i>
                        <?php __('Update'); ?>
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>
