$(document).ready(function() {
    carregaTabela();
    $(document).on('click', '#add_todo', function() { //Chama a função addTarefa
        addTarefa();
    });
    $(document).on('click', '#todo_end', function() { //Chama a função concluiTarefa
        var id_reg = $(this).parents('tr').find("td:eq(0)").text()
        concluiTarefa(id_reg);
    });
    $(document).on('click', '#todo_devolve', function() { //Chama a função devolveTarefa
        var id_reg = $(this).parents('tr').find("td:eq(0)").text()
        devolveTarefa(id_reg);
    });
})



function carregaTabela() {
    var todo_table_pendente = jQuery("#todo_table_pendente").dataTable();
    var todo_table_finalizada = jQuery("#todo_table_finalizada").dataTable();
}


function addTarefa() { //Adiciona Nova Tarefa
    swal.fire({
        type: 'info',
        title: "Adicionar Nova Tarefa",
        html: "<div class='form-group form-row'>" +
            "<div class='col'>" +
            "<label>Nome Responsável</label>" +
            "<input name='nome_resp' id='nome_resp' type='text' class='form-control'>" +
            "<label>Email</label>" +
            "<input name='email' id='email' type='text' class='form-control'>" +
            "<label>Descrição</label>" +
            "<textarea class='form-control form-control-sm' id='descricao' name='descricao' rows='10' style='margin-top: 0px; margin-bottom: 0px; height: 115px;'></textarea>" +
            "</div>" +
            "</div>",
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: 'green',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Adicionar',
        showLoaderOnConfirm: true,
        customClass: 'swal-wide',

        preConfirm: function() {
            var nome_resp = document.getElementById('nome_resp');
            var email = document.getElementById('email');
            var descricao = document.getElementById('descricao');
            return new Promise(function(resolve) {
                $.ajax({
                        cache: false,
                        url: './controllers/cont_todo.php',
                        data: {
                            acao: "add_tarefa",
                            nome_resp: nome_resp.value,
                            email: email.value,
                            descricao: descricao.value,
                        },
                        dataType: 'json'
                    })
                    .done(function(response) {
                        swal.fire('Tarefa Adicionada com Sucesso!', response.message, response.status);
                        $('.swal2-confirm').click(function() {
                            document.location.reload(true); //Recarrega a página
                        })
                    })
                    .fail(function() {
                        swal.fire('Oops...', 'Algo deu errado com o Servidor !', 'error');
                    });
            });

        },
        allowOutsideClick: false
    });

}

function concluiTarefa(id_reg) { //CONCLUI Tarefa
    swal.fire({
        type: 'question',
        title: "Concluir Tarefa",
        text: "Você tem certeza que deseja concluir esta tarefa?",
        showCancelButton: true,
        cancelButtonText: 'Não, acho que esqueci uma coisinha...',
        confirmButtonColor: 'green',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim! :)',
        showLoaderOnConfirm: true,
        customClass: 'swal-wide',

        preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                        cache: false,
                        url: './controllers/cont_todo.php',
                        data: {
                            acao: "conclui_tarefa",
                            id_reg: id_reg
                        },
                        dataType: 'json'
                    })
                    .done(function(response) {
                        swal.fire('Tarefa Concluida com Sucesso!', response.message, response.status);
                        $('.swal2-confirm').click(function() {
                            document.location.reload(true); //Recarrega a página
                        })
                    })
                    .fail(function() {
                        swal.fire('Oops...', 'Algo deu errado com o Servidor !', 'error');
                    });
            });

        },
        allowOutsideClick: false
    });

}

function devolveTarefa(id_reg) { //DEVOLVE Tarefa
    swal.fire({
        type: 'question',
        title: "Devolver Tarefa",
        html: "<div class='form-group form-row'>" +
            "<div class='col'>" +
            "<form>" +
            "<label>Senha Supervisor</label>" +
            "<input name='psw' id='psw' type='password' class='form-control'>" +
            "</form>" +
            "</div>" +
            "</div>",
        showCancelButton: false,
        cancelButtonText: 'Não',
        confirmButtonColor: 'green',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Devolver',
        showLoaderOnConfirm: true,
        customClass: 'swal-wide',

        preConfirm: function() {
            var psw = document.getElementById('psw');
            return new Promise(function(resolve) {
                $.ajax({
                        cache: false,
                        url: './controllers/cont_todo.php',
                        data: {
                            acao: "devolve_tarefa",
                            id_reg: id_reg,
                            psw: psw.value
                        },
                        dataType: 'json'
                    })
                    .done(function(response) {
                        if (response.status == "success") {
                            swal.fire('Tarefa Devolvida com Sucesso!', response.message, response.status);
                            $('.swal2-confirm').click(function() {
                                document.location.reload(true); //Recarrega a página
                            })
                        } else if (response.status_qtd == 'erro_qtd') {
                            swal.fire('Excedeu a quantidade de devoluções!', response.message, response.status);
                        } else {
                          swal.fire('Senha Incorreta!', response.message, response.status);
                        }
                    })
                    .fail(function() {
                        swal.fire('Oops...', 'Algo deu errado com o Servidor !', 'error');
                    });
            });

        },
        allowOutsideClick: false
    });

}

$.extend(true, $.fn.dataTable.defaults, { // extende os parametros default do datatables
    language: {
        lengthMenu: "_MENU_",
        search: "_INPUT_",
        searchPlaceholder: "Pesquisar...",
        InfoFiltered: "",
        loadingRecords: "Carregando...",
        infoEmpty: "Mostrando 0 para 0 de 0 registros",
        emptyTable: "Nenhum registro encontrado",
        info: "Página <strong>_PAGE_</strong> de <strong>_PAGES_</strong>",
        paginate: {
            first: 'Primeira',
            previous: 'Anterior',
            next: 'Próxima',
            last: 'Última'
        }
    }
});

$('#carregaTabPendente').load('./controllers/cont_todo.php?acao=carregaTabelaPendente'); //Faz um Load no php para imprimir o html da tabela de tarefas Pendentes
$('#carregaTabFinalizado').load('./controllers/cont_todo.php?acao=carregaTabelaFinalizada'); //Faz um Load no php para imprimir o html da tabela de tarefas Finalizadas
