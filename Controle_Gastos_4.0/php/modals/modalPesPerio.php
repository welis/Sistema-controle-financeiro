<!-- Modal Pesquisar por periodo -->
<div class="modal fade" id="pesqPeriodo" tabindex="-1" aria-labelledby="pesqPeriodoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pesqPeriodoLabel">Pesquisar por periodo</h5>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <form method = "post">
                        <select class="form-select" name = "periodo_ano" required>
                            <option value="" selected hidden>Selecione o ano</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
                            <br>
                        <select class="form-select" name = "periodo_mes" required>
                            <option value="" selected hidden>Selecione o mês</option>
                            <option value="1">Janeiro</option>
                            <option value="2">Fevereiro</option>
                            <option value="3">Março</option>
                            <option value="4">Abril</option>
                            <option value="5">Maio</option>
                            <option value="6">Junho</option>
                            <option value="7">Julho</option>
                            <option value="8">Agosto</option>
                            <option value="9">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        </select>
                        <br>
                        <!-- checkbox Agrupar-->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="agrupar" id="agrupar" value="1">
                            <label class="form-check-label" for="agrupar">Agrupar</label>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" value="submit" class="btn btn-primary">Pesquisar</button>
                        </div>
                </form>
            </div>
        </div>
</div>
<!-- Fim Modal -->

<?php
     //pegar ano e mes do sistema
     $ano_pes = date('Y');
     $mes_pes = date('m');
     $agrupar = 0;
    
    //capturar dados do modal
    if(isset($_POST['periodo_ano'])){
        $ano_pes = $_POST['periodo_ano'];
        $mes_pes = $_POST['periodo_mes'];
        //pegar valor do checkbox agrupa
    }
     //verificar se o checkbox esta marcado
     if(isset($_POST['agrupar'])){
        $agrupar = 1;
    }else{
        $agrupar = 0;
    }
    //Voltar para o index
    //header("Location: index.php");
?>