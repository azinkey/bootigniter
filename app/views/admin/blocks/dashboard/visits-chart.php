<div class="row-fluid">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
                <div class="state-container">
                    <div id="visitChart" class="state-placeholder"></div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row-fluid">
                    <div class="col-xs-4 text-center">
                        <h4 class="semibold text-warning"><?php echo $new_visits; ?></h4>
                        <p class="nm text-muted">
                            <span class="semibold text-warning"><?php __('New Visits'); ?></span>
                            <span class="text-warning"><i class="ico-arrow-down4"></i> <?php echo $new_visits_percent; ?>%</span>
                        </p>
                    </div>
                    <div class="col-xs-4 text-center">
                        <h4 class="semibold text-primary"><?php echo $return_visits; ?></h4>
                        <p class="nm text-muted">
                            <span class="semibold text-primary"><?php __('Returning Visits'); ?></span>
                            <span class="text-primary"><i class="ico-arrow-down4"></i> <?php echo $return_visits_percent; ?>%</span>
                        </p>
                    </div>
                    <div class="col-xs-4 text-center">
                        <h4 class="semibold text-success"><?php echo $total_visits; ?></h4>
                        <p class="nm text-muted">
                            <span class="semibold text-success"><?php __('Total Visits'); ?></span>                        </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
       
        
    </div>
</div>
<?php
?>
<script type="text/javascript">
    (function ($) {

        $(document).ready(function () {
            $("#sessionMatrix").change(function () {

            });
        });

        (function () {
            // You can represent data from "Visitors" Table through its controller
            $.plot("#visitChart", [{
                    label: "Visit (Desktop)",
                    color: "#93A7CB",
                    data: [
<?php
if (count($track_all_visitor)) {
    foreach ($track_all_visitor as $key => $visit) {
        echo '["' . $key . '",' . $visit . "],";
    }
}
?>
                    ]
                }, {
                    label: "Visit (Mobile)",
                    color: "#F8862C",
                    data: [
<?php
if (count($track_mobile_visitor)) {
    foreach ($track_mobile_visitor as $key => $visit) {
        echo '["' . $key . '",' . $visit . "],";
    }
}
?>
                    ]
                }], {
                series: {
                    lines: {
                        show: true
                    },
                    points: {
                        show: true,
                        radius: 2
                    }
                },
                grid: {
                    borderColor: "rgba(0, 0, 0, 0.05)",
                    borderWidth: 1,
                    hoverable: true,
                    backgroundColor: "transparent"
                },
                tooltip: true,
                tooltipOpts: {
                    content: "%x : %y",
                    defaultTheme: true
                },
                xaxis: {
                    tickColor: "rgba(0, 0, 0, 0.05)",
                    mode: "categories"
                },
                yaxis: {
                    tickColor: "rgba(0, 0, 0, 0.05)"
                },
                shadowSize: 0
            });
        })();
    })(jQuery);

</script>