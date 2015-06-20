var MT = {
    oTable : null,

    init : function () {

    },

    getDataTable : function (source) {
        if(CURRENT_LANG=="tr") var oLang = {oLanguage : {"sUrl": BASE + "/sbadmin/assets/js/plugins/data-tables/turkish.json"}};
        else oLang = {};
        var options = {
            "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
            "sPaginationType": "bootstrap",
            //"oLanguage": oLang,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": source
        };
        MT.oTable = $('#datatable_ajax2').dataTable($.extend(options, oLang ));
    },
    dataTableReload : function () {
        if(MT.oTable!=null) MT.oTable.fnDraw();
    },

    deleteAjaxWithConfirm : function(url,token){
        bootbox.confirm(LANG.sureDelete, function(result) {
            if(result==true && url!="" && url!="#"){
                $.ajax({
                    type: 'post',
                    url: url,
                    data: { _method:'DELETE',_token :token},
                    success: function(response) {
                        if(response=="ok"){
                            MT.showNotification("",LANG.successful,"lime");
                            MT.dataTableReload();
                        }else{
                            MT.showNotification(LANG.error + " : ",LANG.an_error_occured,"ruby");
                        }
                    }
                });
            }
        });
    },

    showNotification : function(title,content,theme){
        theme = (theme=="") ? "teal" : theme;
        // theme : teal,amethyst,ruby,tangerine,lemon,lime,ebony,smoke
        var settings = {theme: theme,sticky: false, horizontalEdge: "top", verticalEdge: "right", life : 3000};
        if($.trim(title) != '') settings.heading = $.trim(title);
        $.notific8('zindex', 11500);
        $.notific8($.trim(content), settings);
    },

    initDatePicker : function () {
        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                autoclose: true,
                language : CURRENT_LANG
            });
        }
    }
};


$(document).ready(function () {
    $('body').on("click",".del-item",function () {
        MT.deleteAjaxWithConfirm($(this).attr("href"),$(this).data("token"));
        return false;
    });
});