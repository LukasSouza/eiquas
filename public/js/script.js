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

$(document).ready( function () {
    //resizeWindow();

    $(".decimal").on("keypress keyup blur",function (event) {
        //this.value = this.value.replace(/[^0-9\.]/g,'');
        $(this).val($(this).val().replace(/[^0-9\.]/g,''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $(".number").on("keypress keyup blur",function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 44 && e.which != 46) {
            return false;
        }
    });

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
            "order": [[ 0, 'asc' ]],
        }

    });

    var dataTableParam = $('#dataTableParam').DataTable({
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
        },
        "order": [[ 0, "asc" ],[ 1, "asc" ]]

    });

    $( window ).resize(function() {
        resizeWindow();
    });
    
    //Função CEP
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


});
