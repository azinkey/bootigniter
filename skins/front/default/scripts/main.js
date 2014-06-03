
(function($) {

    $(document).ready(function() {
        
        var modelObj = $('<div class="modal fade" tabindex="-1" role="dialog"><div class="modal-dialog modal-sm"><div class="modal-content"></div></div></div>');
        modelObj.on('hidden.bs.modal', function() {
            modelObj.remove();
        })
        
        $("a.ajax-box").each(function() {
            $(this).click(function(e) {
                e.preventDefault();
                var href = $(this).attr('href');
                modelObj.appendTo($("body"));
                modelObj.find(".modal-content").load(href, function() {
                    modelObj.modal("toggle");
                });
            });
        });




    });


})(jQuery);