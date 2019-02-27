function checkTwice(texto1)
{
    var check1=confirm(texto1);
    if (check1){
        var check2=confirm("Para concluir a exclusão, por favor, confirme abaixo. Este processo é irreversível!");
        if (check2){
            return true;
        }
        else return false;
    }
    else return false;
}


function verificarcpfVazio(cpf_cnpj){

        if ((!Testacpf(cpf_cnpj))||(cpf_cnpj=="")||(cpf_cnpj.length<12))
        {
            $("#alert").html('<div class="alert alert-dismissible alert-danger align-self-center offset-lg-4 offset-md-3 col-lg-4 col-md-4 col-xs-12 col-12" id="invalido" ><button type="button" class="close" data-dismiss="alert">&times;</button><strong>CPF</strong> Invalido ou em branco.</div>');
            $("#invalido").fadeIn();
            $("#cpf_cnpj").focus();
            return false;
        }
        else
        {
            $("#invalido").fadeOut();
            return true;
        }
    }
    function verificarcnpjVazio(cpf_cnpj){
        if ((!Testacnpj(cpf_cnpj)))
        {
            $("#alert").html('<div class="alert alert-dismissible alert-danger align-self-center offset-lg-4 offset-md-3 col-lg-4 col-md-4 col-xs-12 col-12" id="invalido" ><button type="button" class="close" data-dismiss="alert">&times;</button><strong>CNPJ</strong> Invalido.</div>');
            $("#invalido").fadeIn();
            $("#cpf_cnpj").focus();
            return false;
        }
        else
        {
            $("#invalido").fadeOut();
            return true;
        }
    }
    function Testacnpj(cpf_cnpj) {

    cpf_cnpj = cpf_cnpj.replace(/[^\d]+/g,'');

    if(cpf_cnpj == '') return false;

    if (cpf_cnpj.length != 14)
        return false;

    // Elimina cpf_cnpjs invalidos conhecidos
    if (cpf_cnpj == "00000000000000" ||
        cpf_cnpj == "11111111111111" ||
        cpf_cnpj == "22222222222222" ||
        cpf_cnpj == "33333333333333" ||
        cpf_cnpj == "44444444444444" ||
        cpf_cnpj == "55555555555555" ||
        cpf_cnpj == "66666666666666" ||
        cpf_cnpj == "77777777777777" ||
        cpf_cnpj == "88888888888888" ||
        cpf_cnpj == "99999999999999")
        return false;

    // Valida DVs
    tamanho = cpf_cnpj.length - 2
    numeros = cpf_cnpj.substring(0,tamanho);
    digitos = cpf_cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;

    tamanho = tamanho + 1;
    numeros = cpf_cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;

    return true;
    }
    function Testacpf(cpf_cnpj){
        var Soma;
        var Resto;
        Soma = 0;

        cpf_cnpj = cpf_cnpj.replace('.', '');
        cpf_cnpj = cpf_cnpj.replace('.', '');
        cpf_cnpj = cpf_cnpj.replace('-', '');

        if (cpf_cnpj == "00000000000")
            return false;
        for (i=1; i<=9; i++)
            Soma = Soma + parseInt(cpf_cnpj.substring(i-1, i)) * (11 - i);

        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))
            Resto = 0;

        if (Resto != parseInt(cpf_cnpj.substring(9, 10)) )
            return false;
        Soma = 0;

        for (i = 1; i <= 10; i++)
            Soma = Soma + parseInt(cpf_cnpj.substring(i-1, i)) * (12 - i);

        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11))
            Resto = 0;
        if (Resto != parseInt(cpf_cnpj.substring(10, 11) ) )
            return false;

        return true;
    }
function openNav() {
    $("#wrapper").toggleClass("toggled");
    $(".toggled").css('display','flex');
}
// limp
function resizeWindow(){
    if($( window ).width() < 768){
        $("#wrapper").attr('class','');
        $("#menu-button").show();
    }
}



function onlyNumber(){
    $(this).keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 44 && e.which != 46) {
            return false;
        }
    });
}

$( window ).resize(function() {
    resizeWindow();
});

//FunÃ§Ã£o CEP
    $("#cep").blur(function(){
        var cep = $(this).val().replace(/\D/g, '');
        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
            if (!("erro" in dados)) {
                $("#endereco").val(dados.logradouro);
                $("#bairro").val(dados.bairro);
                $("#cidade").val(dados.localidade);
                $("#estado").val(dados.uf);

                if( dados.logradouro != "" )
                    $("#endereco").attr('readonly', true);
                else
                    $("#endereco").attr('readonly', false);

                if( dados.bairro != "" )
                    $("#bairro").attr('readonly', true);
                else
                    $("#bairro").attr('readonly', false);

                $("#cidade").attr('readonly', true);
                $("#estado").attr('readonly', true);
                $("#cep-invalido").fadeOut();
                $("#complemento").focus();
            }
            else {
                //alert("CEP nÃ£o encontrado.");
                $("#alert-cep").html('<div class="alert alert-dismissible alert-warning col-md-12" id="cep-invalido" style="display:none;"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>CEP</strong> NÃ£o Encontrado. Por favor, insira o endereÃ§o, bairro, cidade e Estado manualmente.</div>');
                $("#cep-invalido").fadeIn();
                $("#endereco").attr('readonly', false);
                $("#bairro").attr('readonly', false);
                $("#cidade").attr('readonly', false);
                $("#estado").attr('readonly', false);
            }
        });
    });

$(document).ready( function () {
    //resizeWindow();
    var dataTable = $('#dataTable').dataTable({
        "columnDefs":
        [
            {
                "type": "html",
                "targets": '_all',
                "orderable": true,
                "searchable": true,
                "sortable": true
            }
        ],
        "columnDefs": [
            { "type": "num", "targets": 0 }
        ],
        "oLanguage":
        {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ à _END_ de _TOTAL_ registros totais",
            "sInfoEmpty": "Mostrando 0 à 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ &nbsp; Resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate":
            {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria":
            {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "order": [[ 1, 'desc' ]],
        }

    });
});
