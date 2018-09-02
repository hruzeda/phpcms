this.addNumberInput = function addNumberInput(form, name, placeholder, required) {
  const div = $('<div class="form-group"></div>');
  const field = $('<input type="number" min="1" max="99" class="form-control" />');
  $(field).attr('id', name);
  $(field).attr('placeholder', placeholder);
  $(field).attr('name', name);
  if (required) {
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
  if (required) {
    $(field).attr('required', 'required');
  }
  $(div).append(field);
  $(form).append(div);
};

this.addImageInput = function addImageInput(form, name, required) {
  const div = $('<div class="form-group"></div>');
  const field = $('<input type="file" accept="image/*" class="form-control" />');
  $(field).attr('id', name);
  $(field).addClass('form-control');
  $(field).attr('name', name);
  if (required) {
    $(field).attr('required', 'required');
  }
  $(div).append(field);
  $(form).append(div);
};

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

this.addSubmitInput = function addSubmitInput(form) {
  const footer = $('<div class="modal-footer"></div>');
  const submit = $('<input type="submit" class="btn btn-primary" value="Salvar" />');
  const cancel = $('<button class="btn btn-secondary" data-dismiss="modal">Cancel</button>');

  $(form).ajaxForm((data) => {
    if (parseInt(data, 10) === 1) {
      window.location.reload();
    } else {
      this.alert('Erro', 'danger', data);
    }
  });

  $(footer).append(submit);
  $(footer).append(cancel);
  $(form).append(footer);
};
