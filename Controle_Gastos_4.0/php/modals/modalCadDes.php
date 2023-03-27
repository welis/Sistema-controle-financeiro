<!-- Modal despesa -->
<div class="modal fade" id="cadDesp" tabindex="-1" aria-labelledby="cadDespLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cadDespLabel">Cadastrar Despesa</h5>
                        </div>
                        <div class="modal-body">
                            <!-- Form -->
                            <form method = "post">
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Nome:</span>

                                        <select class="form-select" name="nomeDesp">
                                            <option selected hidden>Selecione a despesa</option>
                                            <?php $sql = $pdo->prepare("select * from categoria_despesa order by nome");
                                                  $sql->execute();
                                                    if($sql->rowCount() > 0){
                                                        foreach($sql->fetchAll() as $categoria){
                                                            echo '<option value="'.$categoria['id_categoria_despesa'].'">'.$categoria['nome'].'</option>';
                                                        }
                                                    }
                                            ?>
                                        </select>
                                         <!-- Cadastrar categoria -->
                                        <a  class=" btn btn-primary" href="?excluir='.$linha['id_despesa'].'" data-bs-placement="top" title="Cadastrar categoria" data-bs-toggle="modal" data-bs-target="#Cad-categoria-des">
                                            <i  class="bi bi-plus-circle"></i>
                                        </a>
                                    </div>
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">R$: ⠀⠀</span>
                                        <input type="text" class="form-control" name="valorDesp" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Data:⠀</span>
                                        <input type="date" class="form-control" name="dataDesp" value="<?php echo date('Y-m-d'); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                    </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    </div>
<!-- Fim Modal -->
<!--Modal cadastrar categoria -->
<div class="modal fade" id="Cad-categoria-des" tabindex="-1" aria-labelledby="cadCatDespLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cadCatDespLabel">Cadastrar Categoria</h5>
            </div>
                <div class="modal-body">
                <!-- Form -->
                <form method = "post">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Nome categoria:</span>
                        <input type="text" class="form-control" name="nomeCatDesp" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                    </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal -->

<?php
    //insert despesas
    if(isset($_POST['nomeDesp'])){
        $nomeDesp = $_POST['nomeDesp'];
        $valorDesp = str_replace(',', '.', $_POST['valorDesp']);
        $dataDesp = $_POST['dataDesp'];
        $sql = $pdo->prepare("insert into despesas (id_categoria_despesa, valor, data_despesa) values (:id_categoria_despesa, :valor, :data_despesa)");
        $sql->bindValue(":id_categoria_despesa", $nomeDesp);
        $sql->bindValue(":valor", $valorDesp);
        $sql->bindValue(":data_despesa", $dataDesp);
        $sql->execute();
        echo '<script>window.location.href = "index.php";</script>';
    }
    //delete despesas
    if(isset($_GET['excluir'])){
        $id = $_GET['excluir'];
        $sql = $pdo->prepare("delete from receitas where id_receita = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        $sql = $pdo->prepare("delete from despesas where id_despesa = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        //header("location: index.php");
        echo '<script>window.location.href = "index.php";</script>';
    }
    //insert categoria despesas
    if(isset($_POST['nomeCatDesp'])){
        $nomeCatDesp = $_POST['nomeCatDesp'];
        $sql = $pdo->prepare("insert into categoria_despesa (nome) values (:nome)");
        $sql->bindValue(":nome", $nomeCatDesp);
        $sql->execute();
        echo '<script>window.location.href = "index.php";</script>';
    }
?>