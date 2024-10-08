var PortletDraggable = {
    init: function () {
        $("#m_sortable_portlets").sortable({
            connectWith: ".m-portlet__head",
            items: ".m-portlet",
            opacity: .8,
            handle: ".m-portlet__head",
            coneHelperSize: !0,
            placeholder: "m-portlet--sortable-placeholder",
            forcePlaceholderSize: !0,
            tolerance: "pointer",
            helper: "clone",
            tolerance: "pointer",
            forcePlaceholderSize: !0,
            helper: "clone",
            cancel: ".m-portlet--sortable-empty",
            revert: 250,
            update: function (e, t) {
                t.item.prev().hasClass("m-portlet--sortable-empty") && t.item.prev().before(t.item)
                var data = $(this).sortable('serialize');
                var d = {
                    action : 'attribute_order',
                    data : data
                }
                $.post('/admin/ajaxload', d, function (r) {
                    if(r.status == 'success'){
                        var t = window.location.toString();
                        $("#tabs_attribute").load(t + " #tabs_attribute_inner", function () {
                            $(document.body).trigger("select-value-init");
                            $(document.body).trigger("remove_row");
                            PortletDraggable.init();
                            $("#tabs_option").load(t + " #tabs_option_inner");
                        }); 
                    }
                });

            },
        }),
        $("#m_sortable_option").sortable({
            connectWith: ".m-portlet__head",
            items: ".m-portlet",
            opacity: .8,
            handle: ".m-portlet__head",
            coneHelperSize: !0,
            placeholder: "m-portlet--sortable-placeholder",
            forcePlaceholderSize: !0,
            tolerance: "pointer",
            helper: "clone",
            tolerance: "pointer",
            forcePlaceholderSize: !0,
            helper: "clone",
            cancel: ".m-portlet--sortable-empty",
            revert: 250,
            update: function (e, t) {
                t.item.prev().hasClass("m-portlet--sortable-empty") && t.item.prev().before(t.item)
                var data = $(this).sortable('serialize');
                alert(data);
                var d = {
                    action : 'option_order',
                    data : data
                }
                $.post('/admin/ajaxload', d, function (r) {
                    if(r.status == 'success'){
                        var t = window.location.toString();
                        $("#tabs_attribute").load(t + " #tabs_attribute_inner", function () {
                            $(document.body).trigger("select-value-init");
                            $(document.body).trigger("remove_row");
                            PortletDraggable.init();
                            $("#tabs_option").load(t + " #tabs_option_inner");
                        }); 
                    }
                });

            },
        })
        
    }
};
jQuery(document).ready(function () {
    PortletDraggable.init()
});
