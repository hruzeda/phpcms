<?php
/**
 * PHP Version 7.2.6
 * Login to admin component
 *
 * @category Include
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://centrocastelo.org.br
 */ ?>
<button id="btn-show-login" type="button" class="btn btn-dark" data-toggle="modal"
  data-target="#login-modal">
  <span class="fas fa-cog"></span>
</button>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true"
  aria-labelledby="login-modal-label">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <?php if (LOGGED_USER == null) { ?>
      <form id="loginForm" method="post" action="login.php" class="modal-content">
    <?php } else { ?>
      <form id="loginForm" method="post" action="changePassword.php" class="modal-content">
    <?php } ?>
      <div class="modal-header">
        <h5 class="modal-title" id="login-modal-label">Login</h5>
        <a class="btn close" data-dismiss="modal">
          <span class="fas fa-times-circle"></span>
        </a>
      </div>
      <div class="modal-body">
        <?php if (LOGGED_USER == null) { ?>
          <div class="form-group">
            <input class="form-control" type="password" id="pwd" name="pwd" placeholder="Senha" />
          </div>
        <?php } else { ?>
          <div class="form-group">
            <input class="form-control" type="password" id="new" name="new" placeholder="Nova Senha" />
          </div>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <?php if (LOGGED_USER == null) { ?>
          <input type="submit" class="btn btn-primary" value="Login" />
          <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />
        <?php } else { ?>
          <input type="submit" class="btn btn-primary" value="Trocar senha" />
          <a href="<?php ROOT; ?>logout.php" class="btn btn-dark">Logout</a>
        <?php } ?>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  $(() => {
    $('#loginForm').ajaxForm((data) => {
      if (parseInt(data, 10) === 1) {
        window.location.reload();
      } else {
        this.alert('Falha na autenticação', 'danger', 'A senha que você informou está incorreta');
      }
    })
  });
</script>
