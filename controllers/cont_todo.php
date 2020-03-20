<?php
$acao = (isset($_GET['acao'])) ? $_GET['acao'] : '';

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
else if ($acao == 'devolve_tarefa')
{
    $id_reg = (isset($_GET['id_reg'])) ? $_GET['id_reg'] : '';
    require_once ('conexao.php');
    $psw = mysqli_real_escape_string($conexao, $_GET['psw']);

    $query_valida = "SELECT * FROM sys_supervisor WHERE psw = MD5('{$psw}')";
    $result = mysqli_query($conexao, $query_valida);
    $row = mysqli_num_rows($result);

    if ($row >= 1)
    {
        $sql = "UPDATE lista_todo SET situacao = 'P' WHERE id_reg = $id_reg";
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
    else
    {
        $response['status'] = 'error';
        echo json_encode($response);
    }
}
else
{
    die();

}
?>
