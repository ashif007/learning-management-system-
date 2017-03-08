/**
 * Created by terminator on 3/7/17.
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
