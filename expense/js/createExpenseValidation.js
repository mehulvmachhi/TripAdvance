/* ***************************** Validation Script Part Starts ****************************************/
$(document).ready(function() {
    $("#createExpenseFormId").tooltip({
        position: {
            my: "center bottom-20",
            at: "center top",
            using: function(position, feedback) {
                $(this).css(position);
                $("<div>")
                        .addClass("arrow")
                        .addClass(feedback.vertical)
                        .addClass(feedback.horizontal)
                        .appendTo(this);
            }
        }
    });
    $.validator.setDefaults({
        //submitHandler: function() { alert("submitted!"); },
        showErrors: function(map, list) {
            // there's probably a way to simplify this
            var focussed = document.activeElement;
            if (focussed && $(focussed).is("input, textarea")) {
                $(this.currentForm).tooltip("close", {
                    currentTarget: focussed
                }, true)
            }
            this.currentElements.removeAttr("title").removeClass("ui-state-highlight");
            $.each(list, function(index, error) {
                $(error.element).attr("title", error.message).addClass("ui-state-highlight");
            });
            if (focussed && $(focussed).is("input, textarea")) {
                $(this.currentForm).tooltip("open", {
                    target: focussed
                });
            }
        }
    });
    $.validator.addMethod(
    "indianDate",
    function(value, element) {
        // put your own logic here, this is just a (crappy) example
        return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);
    },
    "Please enter a date in the format dd/mm/yyyy."
    );
    $("#createExpenseFormId").validate({
        messages: {
            createExpenseTrip:{
                required:"Select Trip"                                                
            },            
            createExpenseCategory:{
                required:"Select Category"                                                
            },
            createExpenseName:{
                required:"Enter Expense Name"
            },
            createExpenseAmount: {
                required: "Enter Expense Amount"                
            },
            createExpenseDate: {
                required: "Select Expense Date"
            }
        },
        rules: {
            createExpenseTrip:{
                "required": true                                                 
            },            
            createExpenseCategory:{
                "required": true                                                 
            },
            createExpenseName:{
                "required": true 
            },
            createExpenseAmount:{
                "required": true
            },
            createExpenseDate: {
                "required": true,
                "indianDate": true
            }
        }
    });               
});
/* **************************************** Validation Script Part Ends ****************************************/  // JavaScript Document