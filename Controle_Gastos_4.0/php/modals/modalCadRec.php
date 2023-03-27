<!-- Modal receita -->
<div class="modal fade" id="cadRec" tabindex="-1" aria-labelledby="cadRecLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cadRecLabel">Cadastrar Receita</h5>
                    </div>
                    <div class="modal-body">
                        <!-- Form -->
                        <form method = "post">
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Nome:</span>
                                    <input type="text" class="form-control" name="nomeRec" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">R$: ⠀⠀</span>
                                    <input type="text" class="form-control" name="valorRec" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Data:⠀</span>
                                    <input type="date" class="form-control" name="dataRec" value="<?php echo date('Y-m-d'); ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary" >Salvar</button>
                                </div>
                        </form>
                    </div>
                </div>
                </div>
 <!-- Fim Modal -->
<!-- Validar se o input é um numero -->
<script>
    var input = document.getElementById("valorRec").value;
    if(isNaN(input)){
        alert("Por favor, digite um valor válido!");
    }
</script>
 <?php
    //insert receita
    if(isset($_POST['nomeRec'])){
        $sql = $pdo ->prepare("insert into receitas(nome,valor,data_receita) values(:nome,:valor,:data_receita)");
        $sql->bindValue(':nome',$_POST['nomeRec']);
        $sql->bindValue(':valor',str_replace(',','.',$_POST['valorRec']));
        $sql->bindValue(':data_receita',$_POST['dataRec']);
        $sql->execute();
        echo '<script>window.location.href = "index.php";</script>';
    }
    //delete receita
    if(isset($_GET['excluir'])){
        $sql = $pdo->prepare("delete from receitas where id_receita = :id");
        $sql->bindValue(':id',$_GET['excluir']);
        $sql->execute();
    }
?>

    