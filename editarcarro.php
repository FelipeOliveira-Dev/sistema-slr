<?php  
    $idCarros = $_GET['idCarros'];
?>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Editar Veículo</h4>
            </div>
            <div class="card-body">
                <?php  
                    try{
                        $dados = $carros->listar($idCarros);
                ?>
                <form action="listadeveiculos.php" method="POST" name="carros">
                    <input type="hidden" name="acao" value="realizaredicao">
                    <input type="hidden" name="idCarros" value="<?php echo $dados->idCarros?>">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Modelo</label>
                                <input class="form-control" type="text" name="modelo" id="modelo" value="<?php echo $dados->modelo; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cor</label>
                                <input class="form-control" type="text" name="cor" id="cor" value="<?php echo $dados->cor; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="XYZ-0000">Placa</label>
                                <input class="form-control" type="text" name="placa" id="placa" value="<?php echo $dados->placa; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Ano de Fabricação</label>
                                <input class="form-control" type="text" name="anoFab" id="anoFab" value="<?php echo $dados->anoFab; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Marca</label>
                                <input class="form-control" type="text" name="marca" id="marca" value="<?php echo $dados->marca; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Status</label>
                                <input class="form-control" type="text" name="status" id="status" value="<?php echo $dados->status; ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Enviar</label>
                                <button type="submit" class="btn btn-primary" id="editar">Editar</button>
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
                            