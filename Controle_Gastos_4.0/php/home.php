<?php
    include 'coneccao/conection.php';
    include 'modals/modalCadRec.php';
    include 'modals/modalCadDes.php';
    include 'modals/modalPesPerio.php';
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2 p-0">
            <!------ Menu lateral ------->
                <div class="d-flex flex-column vh-100 flex-shrink-0 p-3 text-white bg-dark" style="width: 250px;">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <svg class="bi me-2" width="30" height="22"> </svg> <span class="fs-5">Controle Despesas</span>
                    </a>
                        <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li> <a class="nav-menu nav-link active text-white" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pane-rec-des"> <span class="ms-2">Receitas e Despesas</span> </a> </li>
                        <li> <a class="nav-menu nav-link  text-white" id="pane-Dash-tab" data-bs-toggle="pill" data-bs-target="#pane-Dash"> <span class="ms-2">Dashboard</span> </a> </li>
                        <li> <a class="nav-menu nav-link text-white" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages"> <span class="ms-2">Settings</span> </a> </li>
                    </ul>
                        <hr>
                    <div class="dropdown"> <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false"> <img src="https://avatars.githubusercontent.com/u/7697483?s=400&u=554ab161c4517e7e0edb1aa2b924c6440f42f538&v=4" alt="" width="32" height="32" class="rounded-circle me-2"> <strong> Ola,Admin </strong> </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">Cadastrar categoria</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li>
                            <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="?logout">Sair</a></li>
                        </ul>
                    </div>
                </div>
            <!------ Fim menu lateral ------->
		</div>
        <!-------------------------------------------------- Segunda coluna ------------------------------------------------------------------>
		<div class="col-md-10 border">
        <div class="tab-content" id="v-pills-tabContent">
                <!-- Receitas e Despesas -->
                <div class="tab-pane fade show active" id="pane-rec-des" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="row">
                        <!--- Primeira coluna -->
                        <div class="col-md-6 p-3 border">
                                <div class="row">
                                    <div class="col-md-12 border pt2">
                                        <h5>Exibindo resultado para o ano <?php echo $ano_pes; ?> mes <?php echo $mes_pes; ?></h5>
                                    </div>
                                </div>
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Receitas</button>
                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Despesas</button>
                                </div>
                            </nav>
                                <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <!--- tabela receitas -->
                                        <div>
                                            <table class="table table-hover table-striped table-bordered">
                                                <tr class="table-dark">
                                                    <th>Nome</th>
                                                    <th>Valor</th>
                                                    <th>Data</th>
                                                    <th colspan="2"></th>
                                                </tr>
                                                <?php
                                                   $sql = $pdo->prepare("select id_receita,nome, sum(valor) as valor, data_receita from receitas where year(data_receita) = '$ano_pes' and month(data_receita) = '$mes_pes' group by nome");

                                                   $sql->execute();
                                                   $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
                                                   foreach($resultado as $linha){
                                                       echo'<tr>';
                                                           echo'<td>'.$linha['nome'].'</td>';
                                                           echo'<td>'."R$ ".$linha['valor'].'</td>';
                                                           //converter data para padrão brasileiro
                                                                $data = $linha['data_receita'];
                                                                $data = explode("-", $data);
                                                                $data = $data[2]."-".$data[1]."-".$data[0];
                                                           echo'<td>'.$data.'</td>';
                                                           echo'<td><a  class=" btn btn-warning" href="?editar='.$linha['id_receita'].'"><i class="bi bi-pencil"></i></a></td>';
                                                           echo'<td><a  class=" btn btn-danger" href="?excluir='.$linha['id_receita'].'"><i  class="bi bi-trash3"></i></a></td>';
                                                       echo'</tr>';
                                                   }
                                                        if(empty($resultado)){
                                                            echo'<tr>';
                                                                echo'<td colspan="4">Nenhum registro encontrado</td>';
                                                            echo'</tr>';
                                                        }
                                                ?>
                                            </table>
                                            <a class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadRec"><i class="bi bi-plus-circle"></i></a>
                                        </div>
                                    <!--- fim tabela receitas -->
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <!--- tabela despesas -->
                                        <div>
                                            <table class="table table-hover table-striped table-bordered" id="tblCustomers">
                                                <tr class="table-dark">
                                                    <th>Nome</th>
                                                    <th>Valor</th>
                                                    <th>Data</th>
                                                    <th colspan="2"></th>
                                                    <?php
                                                       //$sql = $pdo->prepare("select * from categoria_despesa cd inner join despesas d on cd.id_categoria_despesa = d.id_categoria_despesa where year(data_despesa) = '$ano_pes' and month(data_despesa) = '$mes_pes' order by nome");

                                                       $sql = $pdo->prepare("select id_despesa,nome, sum(valor) as valor, data_despesa from despesas d inner join categoria_despesa cd on d.id_categoria_despesa = cd.id_categoria_despesa where year(data_despesa) = '$ano_pes' and month(data_despesa) = '$mes_pes' group by nome");

                                                       $sql->execute();
                                                       $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
                                                       foreach($resultado as $linha){
                                                           echo'<tr>';
                                                               echo'<td>'.$linha['nome'].'</td>';
                                                               echo'<td>'."R$ ".$linha['valor'].'</td>';
                                                               //converter data para padrão brasileiro
                                                                    $data = $linha['data_despesa'];
                                                                    $data = explode("-", $data);
                                                                    $data = $data[2]."-".$data[1]."-".$data[0];
                                                                echo'<td>'.$data.'</td>';
                                                               echo'<td><a  class=" btn btn-warning" href="?editar='.$linha['id_despesa'].'"><i class="bi bi-pencil"></i></a></td>';
                                                               echo'<td><a  class=" btn btn-danger" href="?excluir='.$linha['id_despesa'].'"><i  class="bi bi-trash3"></i></a></td>';
                                                           echo'</tr>';
                                                       }
                                                            if(empty($resultado)){
                                                                echo'<tr>';
                                                                    echo'<td colspan="5">Nenhum registro encontrado</td>';
                                                                echo'</tr>';
                                                            }
                                                    ?>
                                                </tr>
                                            </table>
                                            <a class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadDesp"><i class="bi bi-plus-circle"></i></a>
                                            <!--- button download csv -->
                                            <a class="btn btn-success" href="?downloadCsv=<?php echo $mes_pes."-".$ano_pes; ?>"><i class="bi bi-download"></i></a>
                                            <!--- button export pdf -->
                                            <a class="btn btn-danger" onclick="Export()" ><i class="bi bi-file-pdf"></i></a>

                                            <script type="text/javascript">
                                                function Export() {
                                                    html2canvas(document.getElementById('tblCustomers'), {
                                                        onrendered: function (canvas) {
                                                            var data = canvas.toDataURL();
                                                            var docDefinition = {
                                                                content: [{
                                                                    image: data,
                                                                    width: 500
                                                                }]
                                                            };
                                                            pdfMake.createPdf(docDefinition).download("Table.pdf");
                                                        }
                                                    });
                                                }
                                            </script>

                                            

                                        </div>
                                    <!--- fim tabela despesas -->
                                </div>
                            </div>
                        </div>
                        <!-- Segunda coluna -->
                        <div class="col-md-6 p-3 border">
                            <!-- card com total de receitas - despesas -->
                                <?php include 'Cards/card_resumo.php'; ?>
                            <!-- fim card com total de receitas - despesas -->
                        </div>
                    </div>
                </div>
                <!-- Dashboard -->
                <div class="tab-pane fade" id="pane-Dash" role="tabpanel" aria-labelledby="pane-Dash-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include 'Cards/card_dashboard.php'; ?>
                        </div>
                    </div>
                </div>
                <!-- Settings -->
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <h1>ola</h1>
                </div>
            </div>
		</div>
        <!-- float button -->
        <div class="float-button" data-bs-toggle="tooltip" data-bs-placement="top" title="Pesquisar por período">
            <a href="" data-bs-toggle="modal" data-bs-target="#pesqPeriodo"> <i class="bi bi-search plus"></i> </a>         
        </div>
	</div>
</div>



<!-- toast -->
<div id="Toast" class="toast align-items-center text-white bg-success border-0" data-bs-toggle="toast" data-bs-autohide="true" data-bs-delay="1000">
    <div class="d-flex">
        <div class="toast-body">
        Salvo com sucesso!.
        </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>


<script>
    function myFunction() {
            var element = document.getElementById("Toast");
            // Create toast instance
            var myToast = new bootstrap.Toast(element);
            myToast.show();
    }
</script>

<button id="" onclick="myFunction()">Show Toast</button>

