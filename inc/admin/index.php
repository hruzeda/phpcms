<?php
/**
 * PHP Version 7.2.6
 * Menu admin include
 *
 * @category Include
 * @package  None
 * @author   hruzeda <hruzeda@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://centrocastelo.org.br
 */ ?>
<div id="cover"></div>

<div id="menu-admin" class="nav-scroller py-1 mb-2">
  <nav class="nav d-flex">
    <button id="btnBanner" class="btn btn-primary mr-2">Novo Banner</button>
    <button id="btnPost" class="btn btn-primary mr-2">Novo Post</button>
    <button id="btnPage" class="btn btn-primary">Nova Página</button>
  </nav>
</div>

<script type="text/javascript" src="js/init.admin.js"></script>
<script type="text/javascript">
  $(() => {
    $('#btnBanner').on('click', (event) => {
      let form = $('<form action="save.php?entity=banner" method="post" enctype="multipart/form-data"></form>');
        <?php $attr = app\Banner::getAttributeArray();
        app\App::populateForm($attr); ?>
      this.showModal('Novo Banner', form);
    });

    $('#btnPost').on('click', (event) => {
      let form = $('<form action="save.php?entity=post" method="post" enctype="multipart/form-data"></form>');
        <?php $attr = app\Post::getAttributeArray();
        app\App::populateForm($attr); ?>
      this.showModal('Novo Post', form);
    });

    $('#btnPage').on('click', (event) => {
      let form = $('<form action="save.php?entity=page" method="post" enctype="multipart/form-data"></form>');
        <?php $attr = app\Page::getAttributeArray();
        app\App::populateForm($attr); ?>
      this.showModal('Nova Página', form);
    });

    // DELETE BUTTON TEMPLATE
    let trash = $('<button class="btn btn-dark btn-admin"></button>');
    let trashIcon = $('<span class="fas fa-trash-alt"></span>');
    $(trash).append(trashIcon);

    $(trash).on('click', (event) => {
      if (confirm('Você tem certeza que deseja excluir este elemento?')) {
        let element = $(event.currentTarget).parent();
        $.post('delete.php', {
          id: $(element).data('id'),
          entity: $(element).data('type'),
        }, (data) => {
          if (parseInt(data, 10) === 1) {
            window.location.reload();
          } else {
            this.alert('Erro', 'danger', data);
          }
        });
      }
    });

    // EDIT BUTTON TEMPLATE
    let edit = $('<button class="btn btn-dark btn-admin"></button>');
    let editIcon = $('<span class="fas fa-pencil-alt"></span>');
    $(edit).append(editIcon);

    // EXISTING BANNERS
    $('.carousel-item').each((index, element) => {
      let editClone = $(edit).clone();
      let trashClone = $(trash).clone(true);

      $(editClone).on('click', (event) => {
        $('#btnBanner').trigger('click');
        $("#generic-modal-title").html("Editar banner");
        $('#generic-modal input[name="id"]').val($(element).data('id'));
        let bannerImg = $('<img src="' + $(element).find('img').attr('src') + '" />');
        $('#generic-modal input[name="image"]').before(bannerImg);
        $('#generic-modal input[name="link"]').val($(element).data('link'));
        $('#generic-modal input[name="sequence"]').val($(element).data('sequence'));
      });

      $(element).append(editClone);
      $(element).append(trashClone);
    });

    // EXISTING POSTS
    $('.post').each((index, element) => {
      let editClone = $(edit).clone();
      let trashClone = $(trash).clone(true);

      $(editClone).on('click', (event) => {
        $('#generic-modal').bind('shown.bs.modal', (event) => {
          $("#generic-modal-title").html("Editar post");
          $('#generic-modal input[name="id"]').val($(element).data('id'));
          let postImg = $('<img src="' + $(element).find('img').attr('src') + '" />');
          $('#generic-modal input[name="image"]').before(postImg);
          $('#generic-modal input[name="title"]').val($(element).data('title'));
          $("#generic-modal .ql-editor").html($(element).data('content'));
          $('#generic-modal textarea.d-none').val($(element).data('content'));
        });

        $('#btnPost').trigger('click');
      });

      $(element).css('background', '#ddd');
      $(element).append(editClone);
      $(element).append(trashClone);
    });

    // EXISTING PAGES
    $('.page').each((index, element) => {
      let editClone = $(edit).clone();
      let trashClone = $(trash).clone(true);

      $(editClone).on('click', (event) => {
        $('#generic-modal').bind('shown.bs.modal', (event) => {
          $("#generic-modal-title").html("Editar post");
          $('#generic-modal input[name="id"]').val($(element).data('id'));
          let postImg = $('<img src="' + $(element).find('img').attr('src') + '" />');
          $('#generic-modal input[name="image"]').before(postImg);
          $('#generic-modal input[name="title"]').val($(element).data('title'));
          $("#generic-modal .ql-editor").html($(element).data('content'));
          $('#generic-modal textarea.d-none').val($(element).data('content'));
        });

        $('#btnPost').trigger('click');
      });

      $(element).css('background', '#ddd');
      $(element).append(editClone);
      $(element).append(trashClone);
    });

    // EXISTING BLOCKS
    $('.dynamic-block').each((index, element) => {
      let editClone = $(edit).clone();

      $(editClone).on('click', (event) => {
        let form = $('<form action="save.php?entity=dynamicBlock" method="post"></form>');
            <?php $attr = app\DynamicBlock::getAttributeArray();
            app\App::populateForm($attr); ?>

        $('#generic-modal').bind('shown.bs.modal', (event) => {
          $('#generic-modal input[name="id"]').val($(element).data('id'));
          $('#generic-modal select[name="page"]').val($(element).data('page'));
          $("#generic-modal .ql-editor").html($(element).data('content'));
          $('#generic-modal textarea.d-none').val($(element).data('content'));
        });

        this.showModal('Editar caixa de conteúdo', form);
      });

      $(element).append(editClone);
    });
  });
</script>
