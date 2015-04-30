$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

$(function () {
 $('[data-toggle="tagcomment"]').each(function (index) {
     $(this).on("click", function (event) { 
        event.preventDefault();
        $("#tagcomments_"+$(this).attr('data-id')).toggle();
    });
 });
});

