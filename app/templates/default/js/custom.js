$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

$(function () {
 $('[data-toggle="tagcomment"]').each(function (index) {
     $(this).on("click", function (event) { 
        event.preventDefault();
        $("#tagcomments_"+$(this).attr('data-id')).toggle();
    });
 });
});

$(function () {
 $('[data-toggle-comments="tagcomments"]').on("click", function (event) { 
        event.preventDefault();
        $('[data-type="tagcomment"]').toggle();
    });
});

$(function () {
  $('#btnPreview').on("click", function (event) {
    event.preventDefault();
    $.ajax({
        url: '../comment/preview',
        method: 'POST',
        type: 'POST',
        data: 'comment='+$('#maincomment').val(),
        success: function (data) {
            $('#preview').html(data);
        }
    });
  });
});