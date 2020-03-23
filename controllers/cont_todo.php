<?php
// CONTROLE DE ROTA DA INDEX
$acao = (isset($_GET['acao'])) ? $_GET['acao'] : '';

// INICIO CARREGA TABELA PENDENTE//
if ($acao == 'carregaTabelaPendente')
{
    require_once ('conexao.php');
    $sql = "SELECT * FROM lista_todo WHERE situacao = 'P'";
    $result = mysqli_query($conexao, $sql);

?>
    <table id="todo_table_pendente" class="js-table-checkable table table-hover table-vcenter font-size-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Responsável</th>
                <th>Email</th>
                <th>Detalhes</th>
                <th>Data Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
    while ($rows = $result->fetch_assoc())
    {
        $id_reg = $rows['id_reg'];
        $nome_resp = $rows['nome_responsavel'];
        $email = $rows['email'];
        $descricao = $rows['descricao'];
        $data_criacao = $rows['data_criacao'];
?>
                <tr>
                    <td class='text-center font-size-mini'>
                        <?php echo $id_reg ?>
                    </td>
                    <td class='font-w600 font-size-mini'>
                        <?php echo $nome_resp ?>
                    </td>
                    <td class='font-w600 font-size-mini'>
                        <?php echo $email ?>
                    </td>
                    <td class='font-w600 font-size-mini'>
                        <?php echo $descricao ?>
                    </td>
                    <td class='font-w600 font-size-mini'>
                        <?php echo $data_criacao ?>
                    </td>
                    <td class='text-center'>
                        <button id="todo_end" type="button" class="btn btn-sm btn-primary">Concluir Tarefa</button>
                    </td>
                </tr>
                <?php
    }
?>
        </tbody>
    </table>
    <?php
}

// FIM CARREGA TABELA PENDENTE//

// INICIO CARREGA TABELA FINALIZADA//
else if ($acao == 'carregaTabelaFinalizada')
{
    require_once ('conexao.php');
    $sql = "SELECT * FROM lista_todo WHERE situacao = 'C'";
    $result = mysqli_query($conexao, $sql);

?>
        <table id="todo_table_finalizada" class="js-table-checkable table table-hover table-vcenter font-size-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Responsável</th>
                    <th>Email</th>
                    <th>Detalhes</th>
                    <th>Data Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
    while ($rows = $result->fetch_assoc())
    {
        $id_reg = $rows['id_reg'];
        $nome_resp = $rows['nome_responsavel'];
        $email = $rows['email'];
        $descricao = $rows['descricao'];
        $data_criacao = $rows['data_criacao'];
?>
                    <tr>
                        <td class='text-center font-size-mini'>
                            <?php echo $id_reg ?>
                        </td>
                        <td class='font-w600 font-size-mini'>
                            <?php echo $nome_resp ?>
                        </td>
                        <td class='font-w600 font-size-mini'>
                            <?php echo $email ?>
                        </td>
                        <td class='font-w600 font-size-mini'>
                            <?php echo $descricao ?>
                        </td>
                        <td class='font-w600 font-size-mini'>
                            <?php echo $data_criacao ?>
                        </td>
                        <td class='text-center'>
                            <button id="todo_devolve" type="button" class="btn btn-sm btn-primary">Devolver Tarefa</button>
                        </td>
                    </tr>
                    <?php
    }
?>
            </tbody>
        </table>
        <?php
}

// FIM CARREGA TABELA FINALIZADA//

// INICIO FUNCAO ADD TAREFA//
else if ($acao == 'add_tarefa')
{
    $nome_resp = (isset($_GET['nome_resp'])) ? $_GET['nome_resp'] : '';
    $email = (isset($_GET['email'])) ? $_GET['email'] : '';
    $descricao = (isset($_GET['descricao'])) ? $_GET['descricao'] : '';
    require_once ('conexao.php');
    $sql = "INSERT INTO lista_todo (nome_responsavel,email, descricao) values ('$nome_resp','$email','$descricao')";
    if ($conexao->query($sql))
    {
        $response['status'] = 'success';
    }
    else
    {
        $response['status'] = 'error';
    }
    echo json_encode($response);
}
// FIM FUNCAO ADD TAREFA//

// INICIO FUNCAO CONCLUI TAREFA//
else if ($acao == 'conclui_tarefa')
{
    $id_reg = (isset($_GET['id_reg'])) ? $_GET['id_reg'] : '';
    require_once ('conexao.php');
    $sql = "UPDATE lista_todo SET situacao = 'C' WHERE id_reg = $id_reg";
    if ($conexao->query($sql))
    {
        $response['status'] = 'success';
    }
    else
    {
        $response['status'] = 'error';
    }
    echo json_encode($response);
}

// FIM FUNCAO CONCLUI TAREFA//

// INICIO FUNCAO DEVOLVE TAREFA//
else if ($acao == 'devolve_tarefa')
{
    $id_reg = (isset($_GET['id_reg'])) ? $_GET['id_reg'] : '';
    require_once ('conexao.php');
    $psw = mysqli_real_escape_string($conexao, $_GET['psw']);

    $query_valida_supervisor = "SELECT psw FROM sys_supervisor WHERE psw = MD5('{$psw}')";
    $result_supervisor = mysqli_query($conexao, $query_valida_supervisor);
    $valida_supervisor = mysqli_num_rows($result_supervisor);

    $query_valida_qtd = "SELECT qtd_conc FROM lista_todo WHERE id_reg = $id_reg";
    $result_qtd = mysqli_query($conexao, $query_valida_qtd);
    $valida_qtd = $result_qtd->fetch_assoc();

    if ($valida_supervisor >= 1 and $valida_qtd['qtd_conc'] < 2)
    {
        $sql = "UPDATE lista_todo SET situacao = 'P', qtd_conc = qtd_conc + 1  WHERE id_reg = $id_reg";
        if ($conexao->query($sql))
        {
            $response['status'] = 'success';
        }
        else
        {
            $response['status'] = 'error';
        }
    }
    else if ($valida_supervisor >= 1 and $valida_qtd >= 2)
    {
      $response['status_qtd'] = 'erro_qtd';
      $response['status'] = 'error';
    } else{
      $response['status_psw'] = 'erro_psw';
      $response['status'] = 'error';
    }

    echo json_encode($response);
}
else
{
    die();

}
// FIM FUNCAO DEVOLVE TAREFA//
?>
