this.addNumberInput = function addNumberInput(form, name, placeholder, required) {
  const div = $('<div class="form-group"></div>');
  const field = $('<input type="number" min="1" max="99" class="form-control" />');
  $(field).attr('id', name);
  $(field).attr('placeholder', placeholder);
  $(field).attr('name', name);
  if((/true/i).test(required)) {
    $(field).attr('required', 'required');
  }
  $(div).append(field);
  $(form).append(div);
};

this.addTextInput = function addTextInput(form, name, placeholder, required) {
  const div = $('<div class="form-group"></div>');
  const field = $('<input type="text" class="form-control" />');
  $(field).attr('id', name);
  $(field).attr('placeholder', placeholder);
  $(field).attr('name', name);
  if((/true/i).test(required)) {
    $(field).attr('required', 'required');
  }
  $(div).append(field);
  $(form).append(div);
};

this.addImageInput = function addImageInput(form, name, required) {
  const div = $('<div class="form-group"></div>');
  const field = $('<input type="file" accept="image/*" class="form-control" />');
  $(field).attr('id', name);
  $(field).attr('name', name);
  if((/true/i).test(required)) {
    $(field).attr('required', 'required');
  }
  $(div).append(field);
  $(form).append(div);
};

this.addSelect = function addSelect(form, name, options, placeholder, required) {
  const div = $('<div class="form-group"></div>');
  const field = $(`<select class="form-control"><option selected value="">${placeholder}</option></select>`);
  $(field).attr('id', name);
  $(field).attr('name', name);

  if((/true/i).test(required)) {
    $(field).attr('required', 'required');
  }

  $.each(options, function(index, page) {
    option = $('<option></option>');
    $(option).attr('value', page.id);
    $(option).html(page.title);
    $(field).append(option);
  });
  
  $(div).append(field);
  $(form).append(div);
}

this.addTextArea = function addTextArea(form, name) {
  const div = $('<div class="form-group"></div>');
  const quill = $('<div id="quill-editor"></div>');
  $(div).data('name', name);

  const field = $('<textarea class="d-none"></textarea>');
  $(field).attr('name', name);

  $(div).append(quill);
  $(form).append(div);
  $(form).append(field);
};

this.addHiddenInput = function addHiddenInput(form, name, value) {
  const field = $('<input type="hidden" />');
  $(field).attr('name', name).val(value);
  $(form).append(field);
};

this.postForm = function postForm(form) {
  $("#modalForm").removeAttr('onsubmit').ajaxForm((data) => {
    if (parseInt(data, 10) === 1) {
      window.location.reload();
    } else {
      this.alert('Erro', 'danger', data);
    }
  }).submit();
};

this.addSubmitInput = function addSubmitInput(form) {
  const footer = $('<div class="modal-footer"></div>');
  const submit = $('<input type="submit" class="btn btn-primary" value="Salvar" />');
  const cancel = $('<button class="btn btn-secondary" data-dismiss="modal">Cancel</button>');
  $(footer).append(submit);
  $(footer).append(cancel);
  $(form).append(footer);
};

this.populateForm = function populateForm(form, data) {
  this.addHiddenInput(form, 'id', 0);
  var json = JSON.parse(data);
  var attrs = Object.keys(json);
  for (var i = 0; i < attrs.length; i++) {
    var key = attrs[i];
    var attr = json[key];
    if (attr.type === "int") {
      this.addNumberInput(form, key, attr.placeholder, attr.required);
    } else if (attr.type === "string") {
      this.addTextInput(form, key, attr.placeholder, attr.required);
    } else if (attr.type === "image") {
      this.addImageInput(form, key, attr.required);
    } else if (attr.type === "text") {
      this.addTextArea(form, key);
    } else if (attr.type === "join") {
      this.addSelect(form, key, JSON.parse(attr.options), attr.placeholder, attr.required);
    }
  }
  this.addSubmitInput(form);
}

$(() => {
  $('#btnBanner').on('click', (event) => {
    let form = $('<form id="modalForm" action="save.php?entity=banner" method="post" onsubmit="event.preventDefault(); return postForm();" enctype="multipart/form-data"></form>');
    $.post('attributeArray.php', {'entity': 'Banner'}, (data) => {
      this.populateForm(form, data);
      this.showModal('Novo Banner', form);
    });
  });

  $('#btnPost').on('click', (event) => {
    let form = $('<form id="modalForm" action="save.php?entity=post" method="post" onsubmit="event.preventDefault(); return postForm();" enctype="multipart/form-data"></form>');
    $.post('attributeArray.php', {'entity': 'Post'}, (data) => {
      this.populateForm(form, data);
      this.showModal('Novo Post', form);
    });
  });

  $('#btnPage').on('click', (event) => {
    let form = $('<form id="modalForm" action="save.php?entity=page" method="post" onsubmit="event.preventDefault(); return postForm();" enctype="multipart/form-data"></form>');
    $.post('attributeArray.php', {'entity': 'Page'}, (data) => {
      this.populateForm(form, data);
      this.showModal('Nova Página', form);
    });
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
  $('.slide').each((index, element) => {
    let editClone = $(edit).clone();
    let trashClone = $(trash).clone(true);

    $(editClone).on('click', (event) => {
      $('#generic-modal').bind('shown.bs.modal', function populateData(event) {
        $('#generic-modal').unbind('shown.bs.modal', populateData);
        $("#generic-modal-title").html("Editar banner");
        $('#generic-modal input[name="id"]').val($(element).data('id'));
        let bannerImg = $('<img src="' + $(element).find('img').attr('src') + '" />');
        $('#generic-modal input[name="image"]').attr('required', false).before(bannerImg);
        $('#generic-modal input[name="link"]').val($(element).data('link'));
        $('#generic-modal input[name="sequence"]').val($(element).data('sequence'));
      });
      
      $('#btnBanner').trigger('click');
    });

    $(element).append(editClone);
    $(element).append(trashClone);
  });

  // EXISTING POSTS
  $('.post').each((index, element) => {
    let editClone = $(edit).clone();
    let trashClone = $(trash).clone(true);

    $(editClone).on('click', (event) => {
      $('#generic-modal').bind('shown.bs.modal', function populateData(event) {
        $('#generic-modal').unbind('shown.bs.modal', populateData);
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
      $('#generic-modal').bind('shown.bs.modal', function populateData(event) {
        $('#generic-modal').unbind('shown.bs.modal', populateData);
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
      let form = $('<form id="modalForm" action="save.php?entity=dynamicBlock" method="post" onsubmit="event.preventDefault(); return postForm();"></form>');
      $.post('attributeArray.php', {'entity': 'DynamicBlock'}, (data) => {
        this.populateForm(form, data);
        this.showModal('Nova Página', form);
      });

      $('#generic-modal').bind('shown.bs.modal', function populateData(event) {
        $('#generic-modal').unbind('shown.bs.modal', populateData);
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