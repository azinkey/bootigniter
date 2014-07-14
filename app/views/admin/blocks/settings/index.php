

<section id="main">
    <div class="container-fluid">

        <div class="page-header page-header-block">
            <div class="row-fluid">
                <div class="col-xs-7">
                    <h4 class="title">
                        <i class="fa fa-gears"></i>
                        <?php __('Settings') ?>
                    </h4>
                </div>
                <div class="col-xs-5">
                    <div class="btn-group pull-right">

                        <?php if (have_permission('settings/save')) : ?>

                            <button type="button" id="saveSettingsButton" class="click-submit btn-primary btn-sm btn" data-form="#saveSettingsForm" title="<?php __('Save Settings') ?>">
                                <i class="fa fa-refresh"></i>
                            </button>
                        <?php endif; ?>
                        <?php if (have_permission('settings/save_setting') || have_permission('settings/save_group') || have_permission('settings/save_section')) : ?>
                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">^</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <?php if (have_permission('settings/save_setting')) : ?>
                                    <li>
                                        <a href="<?php _u('admin/settings/edit_setting') ?>" class="">
                                            <i class="fa fa-ellipsis-h fa-fw"></i>
                                            <?php __('New Field') ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (have_permission('settings/save_group')) : ?>
                                    <li>
                                        <a href="<?php _u('admin/settings/edit_group') ?>" class="">
                                            <i class="fa fa-fw fa-folder-open "></i>
                                            <?php __('New Group') ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (have_permission('settings/save_section')) : ?>
                                    <li>
                                        <a href="<?php _u('admin/settings/edit_section') ?>" class="">
                                            <i class="fa fa-fw fa-gear"></i>
                                            <?php __('New Section') ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <!-- Add New Group -->
                    <div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="Group Model" aria-hidden="true">
                        <div class="modal-dialog  modal-sm">
                            <div class="modal-content">
                                <?php AZ::block('settings/group-form'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- Add New Section -->
                    <div class="modal fade" id="sectionModal" tabindex="-1" role="dialog" aria-labelledby="Section Model" aria-hidden="true">
                        <div class="modal-dialog  modal-sm">
                            <div class="modal-content">
                                <?php AZ::block('settings/section-form'); ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <?php AZ::block('system-message'); ?>
        <div class="row-fluid">

            <div class="tabbable tabs-left">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs">

                    <?php
                    $i = 0;
                    foreach ($section_A as $sid => $section) {
                        $class = ($sid == $q) ? 'active' : '';
                        $btnClass = ($sid == $q) ? 'btn-default' : 'btn-primary';
                        $i++;
                        ?>
                        <li class="section-tab <?php echo $class; ?>">

                            <a href="<?php echo _u('admin/settings/index/' . $sid); ?>" class="tab-title">
                                <i class="fa  fa-cog"></i>
                                <span class="hidden-xxs"><?php echo __($section, true); ?></span>
                            </a>

                            <?php if (have_permission('settings/edit_section') || have_permission('settings/remove_section')) : ?>

                                <div class="hidden-xs btn-group pull-right m5 <?php echo $btnClass; ?>">

                                    <button data-toggle="dropdown" class="btn btn-sm <?php echo $btnClass; ?> dropdown-toggle" type="button">
                                        <span class="caret"></span>
                                        <span class="sr-only">^</span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                        <?php if (have_permission('settings/edit_section')) : ?>
                                            <li>

                                                <a href="<?php _u('admin/settings/edit_section/' . $sid) ?>">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                    <span class="hidden-xs"><?php __('Edit'); ?></span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (have_permission('settings/remove_section')) : ?>
                                            <li>

                                                <a href="<?php _u('admin/settings/remove_section/' . $sid) ?>" data-target="#modal" class="remove-box">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                    <span class="hidden-xs"><?php __('Remove'); ?></span>
                                                </a>

                                            </li>
                                        <?php endif; ?>
                                    </ul>

                                </div>
                            <?php endif; ?>

                        </li>
                        <?php
                    }
                    ?>
                </ul>

                <?php
                echo form_open('admin/settings/save', array('id' => 'saveSettingsForm'));
                ?>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active">
                        <h4 class="underline"><?php __($active_section->title); ?>
                            <?php if (have_permission('settings/edit_section') || have_permission('settings/remove_section')) : ?>

                                <div class="dropdown pull-right visible-xs">
                                    <a data-toggle="dropdown" class="dropdown-toggle cp">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                        <?php if (have_permission('settings/edit_section')) : ?>
                                            <li>

                                                <a href="<?php _u('admin/settings/edit_section/' . $sid) ?>" data-target="#editSettingsSectionModel" class="">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                    <?php __('Edit'); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (have_permission('settings/remove_section')) : ?>
                                            <li>

                                                <a href="<?php _u('admin/settings/remove_section/' . $sid) ?>" data-target="#modal" class="remove-box">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                    <?php __('Remove'); ?>
                                                </a>

                                            </li>
                                        <?php endif; ?>
                                    </ul>

                                </div>
                                <?php
                            endif;
                            ?>
                            <div class="clearfix"></div>
                        </h4>
                        <?php
                        $configGroups = get_setting_groups($q);

                        if (count($configGroups)) {
                            ?>
                            <div class="panel-group">
                                <?php
                                foreach ($configGroups as $group) {
                                    ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row-fluid">

                                                <h4 class="panel-title">
                                                    <a class="collapsed pull-left" data-toggle="collapse" data-parent="#accordion" href="#group<?php echo $group->id; ?>">
                                                        <span class="glyphicon pull-left hidden-xs"></span>
                                                        <?php echo $group->title; ?>

                                                    </a>

                                                    <?php if (have_permission('settings/edit_section') || have_permission('settings/remove_section')) : ?>

                                                        <div class="dropdown pull-right">
                                                            <a data-toggle="dropdown" class="dropdown-toggle cp">
                                                                <span class="glyphicon glyphicon-pencil"></span>
                                                            </a>
                                                            <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                                <?php if (have_permission('settings/edit_group')) : ?>
                                                                    <li>
                                                                        <a href="<?php _u('admin/settings/edit_group/' . $group->id) ?>" data-target="#editSettingsGroupModel" class="">
                                                                            <span class="glyphicon glyphicon-edit"></span>
                                                                            <?php __('Edit'); ?>
                                                                        </a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if (have_permission('settings/remove_group')) : ?>                                             
                                                                    <li>
                                                                        <a href="<?php _u('admin/settings/remove_group/' . $group->id) ?>" data-target="#modal" class="remove-box">
                                                                            <span class="glyphicon glyphicon-trash"></span>
                                                                            <?php __('Remove'); ?>
                                                                        </a>

                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>

                                                        </div>
                                                        <?php
                                                    endif;
                                                    ?>

                                                    <div class="clearfix"></div>
                                                </h4>
                                            </div>

                                        </div>

                                    
                                    <div id="group<?php echo $group->id; ?>" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <?php
                                            $configurations = get_settings($group->id);
                                            
                                            foreach ($configurations as $configuration) {
                                                ?>
                                                <div class="field-row row-fluid">
                                                    <div class="col-md-4">
                                                        <label for="<?php echo $configuration->key; ?>">
                                                            <?php echo key_label($configuration->key); ?>
                                                        </label>



                                                    </div>

                                                    <div class="col-md-8">
                                                        <div class="row-fluid">
                                                            <div class="col-xs-10 p0">
                                                                <?php echo setting_field_render($configuration->id); ?>

                                                            </div>
                                                            <div class="col-xs-2 text-right pull-right p0">
                                                                <?php if (have_permission('settings/edit_setting') || have_permission('settings/remove_setting')) : ?>

                                                                    <div class="dropdown pull-right text-left">
                                                                        <a data-toggle="dropdown" class="dropdown-toggle cp">
                                                                            <span class="glyphicon glyphicon-pencil"></span>
                                                                        </a>
                                                                        <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                                                            <?php if (have_permission('settings/edit_setting')) : ?>
                                                                                <li>

                                                                                    <a href="<?php _u('admin/settings/edit_setting/' . $configuration->id) ?>" data-target="#editSettingsFieldModel" class="">
                                                                                        <span class="glyphicon glyphicon-edit"></span>
                                                                                        <?php __('Edit'); ?>
                                                                                    </a>
                                                                                </li>
                                                                            <?php endif; ?>
                                                                            <?php if (have_permission('settings/remove_setting')) : ?>
                                                                                <li>

                                                                                    <a href="<?php _u('admin/settings/remove_setting/' . $configuration->id) ?>" class="remove-box">
                                                                                        <span class="glyphicon glyphicon-trash"></span>
                                                                                        <?php __('Remove'); ?>
                                                                                    </a>
                                                                                </li>
                                                                            <?php endif; ?>
                                                                        </ul>

                                                                    </div>
                                                                    <?php
                                                                endif;
                                                                ?>

                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>


                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>


            </div>
            <?php echo form_close(); ?>
            <div class="clearfix"></div>
        </div>
    </div>

</div>
</section>

<script>
    (function($) {
        $(document).ready(function() {
            $(document).on('click', '.show-datepicker', function() {
                $(this).datepicker();
            });
        });
    })(jQuery);
</script>