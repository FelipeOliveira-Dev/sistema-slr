<?php  
    $id = $_GET['id'];
?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Atualizar Funcionário</h4>
    </div>
    <div class="card-body">
        <?php  
        try{
            $dados = $func->listar($id);
        ?>
        <form action="" method="POST" name="funcionarios">
            <input type="hidden" name="acao" value="realizaredifunc">
            <input type="hidden" name="id" value="<?php echo $dados->id?>">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" type="text" name="nome_func" id="nome_func" placeholder="Nome" value="<?php echo $dados->nome_func ?>">
                    </div>
                    <div class="form-group">
                        <label>Cpf</label>
                        <input class="form-control" type="text" name="cpf" id="cpf" placeholder="CPF" value="<?php echo $dados->cpf ?>">
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input class="form-control" type="text" name="telefone" id="telefone" placeholder="Tel. Ex:(88) 9999-9999" value="<?php echo $dados->telefone ?>">
                    </div>
                    <div class="form-group">
                        <label>Senha do Funcionário</label>
                        <input class="form-control" type="text" name="senha" id="senha" placeholder="Senha do Funcionário" value="<?php echo $dados->senha ?>">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-info btn-fill pull-right" type="submit" name="enviar" id="enviar">
                    </div>
                </div>
            </div>
        </form>
        <?php 
            }catch(Exception $e){

            } 
        ?>
    </div>
</div>