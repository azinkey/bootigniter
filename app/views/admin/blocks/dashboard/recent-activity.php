<div class="panel-minimal">
    <div class="panel-heading">
        <h2 class="panel-title">
            <span class="glyphicon glyphicon-flag"></span> 
            <?php __('Latest Activities'); ?>
        </h2>
    </div>

    <ul class="media-list media-list-feed" id="activities">

        <?php
        if ($activities && count($activities)) {
            foreach ($activities as $activity) {
                ?>
                <li class="media">
                    <div class="media-object pull-left">
                        <i class="glyphicon glyphicon-flash primary"></i>
                    </div>
                    <div class="media-body">
                        <p class="media-heading"><?php echo $activity->subject; ?></p>
                        <p class="media-text">
                            <?php echo $activity->body; ?>
                        </p>
                        <p class="media-meta"><?php echo date_when(human_to_unix($activity->created)); ?></p>
                    </div>
                </li>
                <?php
            }
        } else {
            ?>
            <blockquote>
                <small>
                    <?php __('no_record'); ?>
                </small>
            </blockquote>

            <?php
        }
        ?>
    </ul>
    <?php if ($activities && count($activities) > 5) { ?>
        <ul class="media-list media-list-feed" >
            <li class="media" id="nextFeed">
                <div class="media-object pull-left">
                    <i class="glyphicon glyphicon-refresh"></i>
                </div>
                <div class="media-body">
                    <a id="loadActivity" class="media-heading text-primary" href="javascript:void(0);"><?php __('Load more feed'); ?></a>
                </div>
            </li>
        </ul>
    <?php } ?>
</div>