$(document).ready(function(){
    
    $( document ).ajaxStart(function() {
        $.blockUI({ message: '<h1><img src="assets/img/ajax-loader1.gif" class="loadingimags" /> </h1>' });  
    });
	
    $(document).ajaxStop($.unblockUI); 
    
    $.fn.formatedDATE = function(date)
    {
        var d = new Date(date);
        var day = d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();
        if (day < 10) 
        {
            day = "0" + day;
        }
        if (month < 10) 
        {
            month = "0" + month;
        }
        return day + "/" + month + "/" + year;
    };
    
    $.fn.openDialogueWithoutTitleBar = function(id)
    {
        if($("#"+id).parents(".ui-dialog").is(":visible") == false)
        {
            $("#"+id).siblings(".ui-dialog-titlebar").hide();
            $("#"+id).dialog("open");
        }
    };

    $.fn.closeDialogueWithoutTitleBar = function(id)
    {
        if($("#"+id).parents(".ui-dialog").is(":visible"))
        {    
            $("#"+id).dialog("close");
        } 
    };
    
    $(document).on("keydown",".number",function(event)
    {
        // Allow: backspace, delete, tab, escape, enter and .
        if ( $.inArray(event.keyCode,[46,8,9,27,13,190]) !== -1 ||
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else
        {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) 
            {
                event.preventDefault(); 
            }   
        }
    });
    
});