
(function ($) {

    $(document).ready(function () {
        var site_url = $('meta[name="site_url"]').attr('content');

        $('.toggle-nav').click(function () {
            // Calling a function in case you want to expand upon this.
            toggleNav();
        });

        $(window).resize(function () {
            var maxH = ($("#main").height() > $(window).height()) ? $("#main").height() : $(window).height();
            $(".sidebar-menu").height(maxH + 50);
        });

        $(document).keyup(function (e) {
            if (e.keyCode == 27) {
                if ($('#wrapper').hasClass('show-nav')) {
                    toggleNav();
                }
            }
        });

        $("#sidebarMenu li.parent").click(function () {
            $(this).find(".submenu").toggle();
            if ($(this).find(".submenu").css('display') === 'block') {
                $("#sidebarMenu li").removeClass('active');
                $("#sidebarMenu li.parent").find(".submenu").hide();
                $(this).addClass('active');
                var window_width = $(window).width();
                var sidebar_width = (window_width > 360) ? '0px' : '0px';
                $(".sidebar .submenu").css('left', sidebar_width);
                $(this).find(".submenu").slideDown(400);
                $.cookie('open_parent', $(this).attr('id'));
            } else {
                $.removeCookie('open_parent');
                $(this).removeClass('active');
            }
        });


        var modelObj = $('<div class="modal fade" tabindex="-1" role="dialog"><div class="modal-dialog modal-sm"><div class="modal-content"></div></div></div>');

        $("a.edit-box").click(function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            modelObj.appendTo($("body"));
            modelObj.find(".modal-content").load(href, function () {
                modelObj.modal("toggle");
            });
        });
        modelObj.on('hidden.bs.modal', function () {
            modelObj.remove();
        })

        $("a.remove-box").click(function (e) {
            e.preventDefault();
            var target = $(this).attr('href');
            bootbox.confirm("Are you sure?", function (result) {
                if (result) {
                    window.location = target;
                }
            });
            return false;
        });

        $(".click-submit").click(function (e) {
            e.preventDefault();
            var form = $(this).data('form');
            var returnUrl = $(this).data('return');

            var active_lang = $(".nav-tabs .active").data('lang');
            if (active_lang) {
                form = $("#section-" + active_lang).find('form');
            }

            if (returnUrl) {
                var hiddenReturn = $('<input/>', {type: 'hidden', id: 'return', name: 'return', value: returnUrl});
                hiddenReturn.appendTo(form);
            }
            if (form) {
                $(form).submit();
            }
            return true;
        });

        $(".nav-tabs li.active a.tab-title").click(function (e) {
            e.preventDefault();
        });

        var fieldType = $("#contentFieldType").val();
        var field = $("#fieldOptionsWrapper").data('field');
        if (fieldType !== 'text') {
            var param = (field > 0) ? fieldType + '/' + field : fieldType;
            $("#fieldOptionsWrapper").load(site_url + 'admin/contents/field_type_options/' + param);
        }
        $("#contentFieldType").change(function () {
            var param = (field > 0) ? $(this).val() + '/' + field : $(this).val();
            $("#fieldOptionsWrapper").load(site_url + 'admin/contents/field_type_options/' + param);
        });



        $(document).on('click', '.add-option', function () {

            var type = $(this).data('type');
            var option_wrap = $(this).parent().parent().parent();

            switch (type) {
                case 'select':
                    addSelectOptionRow(option_wrap);
                    break;
                case 'checkbox':
                    addCheckboxOptionRow(option_wrap);
                    break;
                case 'radio':
                    addRadioOptionRow(option_wrap);
                    break;
            }

        });
        $(document).on('click', '.remove-option', function () {
            $(this).parent().parent().remove();
        });

        $(".slimScroll").slimScroll({
            height: '150px',
            size: '3px',
            position: 'right',
            color: '#00B1E1',
            alwaysVisible: true,
            distance: '0px',
            railVisible: true,
            railColor: '#222',
            railOpacity: 0.3,
            wheelStep: 10,
            allowPageScroll: false,
            disableFadeOut: false
        });

        $("#loadActivity").click(function (e) {
            e.preventDefault();
            var count_post = $("#activities").children().length;
            $.ajax({
                url: site_url + "admin/dashboard/load_activity_json",
                dataType: 'json',
                data: {
                    'offset': count_post
                },
                type: 'post',
                cache: false,
                success: function (responseJSON) {
                    if (responseJSON.length) {
                        postHandler(responseJSON);
                    } else {
                        $("#loadActivity").remove();
                    }
                },
            });


        });


    });

    function toggleNav() {
        if ($('#wrapper').hasClass('show-nav')) {
            // Do things on Nav Close
            $('#wrapper').removeClass('show-nav');
        } else {
            // Do things on Nav Open
            $('#wrapper').addClass('show-nav');
            var maxH = ($("#main").height() > $(window).height()) ? $("#main").height() : $(window).height();
            $(".sidebar-menu").height(maxH + 50);
        }
        //$('#site-wrapper').toggleClass('show-nav');
    }



    function addSelectOptionRow(option_wrap) {
        //var index = option_wrap.children().length;
        var rowHtml = '<tr><td><input class="form-control" type="text" name="options[value][]" /></td><td><input class="form-control" type="text" name="options[title][]" /></td><td><a href="javascript:void(0);" class="remove-option"><span class="glyphicon glyphicon-minus-sign"></span></a><a href="javascript:void(0);" class="add-option" data-type="select"><span class="glyphicon glyphicon-plus-sign"></span></a></td></tr>';
        option_wrap.append(rowHtml);
    }

    function addCheckboxOptionRow(option_wrap) {
        var rowHtml = '<tr><td><select name="options[value][]" class="form-control input-sm"><option value="0">No</option><option value="1">Yes</option></select></td><td><input class="form-control" type="text" name="options[title][]" /></td><td><a href="javascript:void(0);" class="remove-option"><span class="glyphicon glyphicon-minus-sign"></span></a><a href="javascript:void(0);" class="add-option" data-type="checkbox"><span class="glyphicon glyphicon-plus-sign"></span></a></td></tr>';
        option_wrap.append(rowHtml);
    }

    function addRadioOptionRow(option_wrap) {
        var rowHtml = '<tr><td class="hidden"><select name="options[value][]" class="form-control input-sm"><option value="0">No</option><option value="1">Yes</option></select></td><td><input class="form-control" type="text" name="options[title][]" /></td><td><a href="javascript:void(0);" class="remove-option"><span class="glyphicon glyphicon-minus-sign"></span></a><a href="javascript:void(0);" class="add-option" data-type="radio"><span class="glyphicon glyphicon-plus-sign"></span></a></td></tr>';
        option_wrap.append(rowHtml);
    }

    var postHandler = function (postsJSON) {
        $.each(postsJSON, function (i, post) {

            $('<li class="media"></li>')

                    .html('<div class="media-object pull-left"><i class="glyphicon glyphicon-tag primary"></i></div><div class="media-body"><p class="media-heading">' + post.subject + '</p><p class="media-text">' + post.body + '</p><p class="media-meta">' + post.created + '</p></div>')
                    .appendTo($('#activities'))
                    .hide()
                    .slideDown();
        });
    };


})(jQuery);