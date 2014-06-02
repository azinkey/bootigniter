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
                        <h4 class="semibold">28</h4>
                        <p class="nm text-muted">
                            <span class="semibold"><?php __('Bounce Rate'); ?></span>
                            <span class="text-danger"><i class="ico-arrow-down4"></i> 32%</span>
                        </p>
                    </div>
                    <div class="col-xs-4 text-center">
                        <h4 class="semibold">1098</h4>
                        <p class="nm text-muted">
                            <span class="semibold"><?php __('Page Views'); ?></span>
                            <span class="text-danger"><i class="ico-arrow-down4"></i> 32%</span>
                        </p>
                    </div>
                    <div class="col-xs-4 text-center">
                        <h4 class="semibold">9999</h4>
                        <p class="nm text-muted">
                            <span class="semibold"><?php __('Total Visits'); ?></span>
                            <span class="text-danger"><i class="ico-arrow-down4"></i> 32%</span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    (function($) {
        (function() {
           
            // You can represent data from "Visitors" Table through its controller
            $.plot("#visitChart", [{
                    label: "Visit (All)",
                    color: "#93A7CB",
                    data: [
                        ["Jan", 47],
                        ["Feb", 84],
                        ["Mar", 60],
                        ["Apr", 143],
                        ["May", 39],
                    ]
                }, {
                    label: "Visit (Mobile)",
                    color: "#94A8CC",
                    data: [
                        ["Jan", 40],
                        ["Feb", 32],
                        ["Mar", 16],
                        ["Apr", 47],
                        ["May", 98],
                    ]
                }], {
                series: {
                    lines: {
                        show: true
                    },
                    points: {
                        show: true,
                        radius: 4
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