<?php
/**
 * PHP Version 7.2.6
 * Alert admin component
 *
 * @category Include
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://centrocastelo.org.br
 */ ?>
<div class="modal fade" id="alert-modal" tabindex="-1" role="dialog"
     aria-labelledby="alert-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-white">
        <h5 class="modal-title" id="alert-modal-label">
          <span class="fas fa-exclamation-triangle"></span>
          <span id="alert-modal-title"></span>
        </h5>
        <button class="close text-white" data-dismiss="modal" aria-label="Close">
          <span class="fas fa-times-circle"></span>
        </button>
      </div>
      <div class="modal-body">
        <p id="alert-modal-message"></p>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  this.alert = function alert(title, level, message) {
    $('.modal-header').removeClass().addClass('modal-header text-light bg-' + level);
    $('#alert-modal-title').html(title);
    $('#alert-modal-message').html(message);

    $('.modal').modal('hide');
    window.setTimeout(() => $('#alert-modal').modal('show'), 200);
  };
</script>
