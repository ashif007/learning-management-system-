/**
 * Created by vamos on 3/9/17.
 */

$(".delete").click(function(e) {
    e.preventDefault();
    var form = $(this).parent();
    var tr = form.parent().parent();

    if(confirm("are you sure you want to delete"))
    {

        $.ajax({

            type: "DELETE",
            url: form.attr("action"),
            cache: false,
            success: function(data){
                tr.fadeOut('slow', function() {$(this).remove();});
            }

        });
        return false;
    }

});
