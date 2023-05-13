<?php  
    $idCliente = $_GET['idCliente'];
?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Atualizar de Cliente</h4>
    </div>
    <div class="card-body">
        <?php
        try{
            $dados = $clientes->listarCliente($idCliente);
        ?>
        <form action="listadeclientes.php" method="POST" name="clientes">
            <input type="hidden" name="acao" value="realizaredicao">
            <input type="hidden" name="idCliente" value="<?php echo $dados->idCliente?>">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Nome Completo</label>
                        <input class="form-control" type="text" name="nome" id="nome" value="<?php echo $dados->nome ?>">
                    </div>
                    <div class="form-group">
                        <label>Cpf</label>
                        <input class="form-control" type="text" name="cpf" id="cpf" value="<?php echo $dados->cpf ?>">
                    </div>
                    <div class="form-group">
                        <label>Data de Nascimento</label>
                        <input class="form-control" type="date" name="data_nasc" id="data_nasc" value="<?php echo $dados->data_nasc ?>">
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input class="form-control" type="text" name="telefone" id="telefone" value="<?php echo $dados->telefone ?>">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-info btn-fill pull-right" type="submit" name="enviar" id="enviar">
                    </div>
                </div>
            </div>
        </form>
        <?php  
            } catch(Exception $e){

            }
        ?>
    </div>
</div>