(function ($, w) {
  $(function () {
    var $html = $('html')
    var formfield = null
    $('.upload_image_button').on('click', function (e) {
      e.preventDefault()
      $html.addClass('Image')
      formfield = $(this).prev().attr('name')
      tb_show('', 'media-upload.php?type=image&TB_iframe=true')
    })
    w.original_send_to_editor = w.send_to_editor
    w.send_to_editor = function (html) {
      if (formfield) {
        var fileurl = $('img', '<div>' + html + '</div>').attr('src')
        var $field = $('#'+formfield)
        $field.val(fileurl)
        $field.change()
        tb_remove()
        $html.removeClass('Image')
        formfield = null
      } else {
        w.original_send_to_editor(html)
      }
    }
  })
})(jQuery, window)
