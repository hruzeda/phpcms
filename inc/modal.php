<?php
/**
 * PHP Version 7.3.1
 * Modal admin component
 *
 * @category Include
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://phpcms.com.br
 */ ?>
<div class="modal fade" id="generic-modal" tabindex="-1" role="dialog"
     aria-labelledby="generic-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-white">
        <h5 class="modal-title" id="generic-modal-label">
          <span class="fas fa-pencil-alt"></span>
          <span id="generic-modal-title"></span>
        </h5>
        <button class="close text-white" data-dismiss="modal" aria-label="Close">
          <span class="fas fa-times-circle"></span>
        </button>
      </div>
      <div id="generic-modal-body" class="modal-body"></div>
    </div>
  </div>
</div>

<script type="text/javascript">
  this.showModal = function showModal(title, content) {
    $('#generic-modal-title').html(title);
    $('#generic-modal-body').html(content);

    $('.modal').modal('hide');
    window.setTimeout(() => $('#generic-modal').modal('show'), 200);
  };

  $('#generic-modal').bind('shown.bs.modal', (event) => {
    if($('#quill-editor').length > 0) {
      const quill = new Quill('#quill-editor', {
        modules: {
          formula: true,
          syntax: true,
          toolbar: [
            [{'header': '1'}, {'header': '2'}, 'blockquote', 'code-block', {'size': []}],
            [{'align': []}, 'bold', 'italic', 'underline', 'strike', {'script': 'super'}, {'script': 'sub'}],
            [{'list': 'ordered'}, {'list': 'bullet'}, {'indent': '-1'}, {'indent': '+1'}],
            [{'color': []}, {'background': []}, 'link', 'image', 'video', 'formula']
          ],
        },
        theme: 'snow'
      });
      
      quill.on('text-change', (delta, oldDelta, source) => {
        $('#generic-modal textarea.d-none').val($(quill.root).html());
      });/*
      quill.bind('hidden.bs.modal', (event) => {

      });*/
    }
  });
</script>
