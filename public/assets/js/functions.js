$('.mydata').click(function(e) {
  var meuid = e.target.id;
  var minhanovadata = $('#datepicker2').val();
  $('#exampleModal').modal('show');

  $('#datepicker2').change(function() {
    minhanovadata = $(this).val();
  });

  $('#btn_salvar_novadata').click(function() {
    saveNovaData(meuid, minhanovadata);
  });
});

function saveNovaData(id, data) {
  $.ajax({
    type: 'POST',
    url: '/altera-data',
    data: { minhanovadata: data, meuid: id },
    success: function(response) {
      if (response == 'ok') {
        Swal.fire({
          position: 'center',
          type: 'success',
          title: 'Sua alteração foi salva!',
          showConfirmButton: false,
          timer: 1500
        });
        location.reload();
      }
    }
  });
}

function confirmacao(id) {
  var resposta = confirm('Deseja remover?');
  if (resposta == true) {
    window.location = '/deleta-lancamento/' + id + "')";
  }
}

function initMaskMoney() {
  $('.money').priceFormat({
    prefix: 'R$ ',
    centsSeparator: ',',
    thousandsSeparator: '.'
  });
}

function limparCampos() {
  $('#lastName').val('');
  $('#valor').val('R$ 0,00');
}

function formatData(date) {
  options = { day: 'numeric', month: 'numeric', year: 'numeric' };
  data = new Date(date).toLocaleString('pt-BR', options);
  return data;
}

function formatValor(valor) {
  var val = valor.toFixed(2).replace('.', ',');
  return val;
}

$('#btn_salvar').click(function(e) {
  e.preventDefault();
  var serializeDados = $('#form_cadastra_lancamento').serialize();
  var conf = confirm('Confirma a operação:');
  if (conf == true) {
    console.log('enviando..');
    $.ajax({
      type: 'POST',
      url: '/cadastra-lancamento',
      data: serializeDados,
      success: function(response) {
        location.reload();
      }
    });
  } else {
    console.log('desistiu');
  }
});

function createConta() {
  Swal.fire({
    title: 'Informe o nome da sua conta',
    input: 'text',
    text: 'exemplo: Carteira, Banco do Brasil, Itaú, ...',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Salvar'
  }).then(result => {
    console.log(result.value);
    $.ajax({
      type: 'POST',
      url: '/cadastra-conta',
      data: { input: result.value },
      cache: false,
      success: function(response) {
        if (response == 'ok') {
          console.log('conta salva');
          location.reload();
        }
      },
      failure: function(response) {
        swal(
          'Internal Error',
          'Oops, your note was not saved.', // had a missing comma
          'error'
        );
      }
    });
  });
}

function meAjuda() {
  Swal.fire(
    'Dica:',
    'Para editar uma data, basta posicionar o cursor do mouse encima, a data mudará de cor e então basta clicar :) ',
    'question'
  );
}
