<div class="card">
  <div class="card-header">
    <h5>Saldo</h5>
  </div>
  <div class="card-body">
    <div class="row">
		<div class="col-md-6">
            <h5 class="card-title">Receitas</h5>
            <p class="card-text">
                <?php 
                    $sql = $pdo->prepare("select sum(valor) as total from receitas where year(data_receita) = '$ano_pes' and month(data_receita) = '$mes_pes'");
                    $sql->execute();
                    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach($resultado as $linha){
                        $total_receitas = $linha['total'];
                        echo'<h1>R$ '.$linha['total'].'</h1>';
                    }
                ?>
            </p>
		</div>
        <div class="col-md-6">
            <h5 class="card-title">Despesas</h5>
            <p class="card-text">
                <?php 
                    $sql = $pdo->prepare("select sum(valor) as total from despesas where year(data_despesa) = '$ano_pes' and month(data_despesa) = '$mes_pes'");
                    $sql->execute();
                    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach($resultado as $linha){
                        $total_despesas = $linha['total'];
                        echo'<h1>R$ '.$linha['total'].'</h1>';
                    }
                ?>
            </p>
		</div>
	</div>
    <div class="row">
		<div class="col-md-6">
        <h5 class="card-title">Total</h5>
            <p class="card-text">
                <?php 
                    $total = $total_receitas - $total_despesas;
                    echo'<h1>R$ '.$total.'</h1>';
                ?>
            </p>
		</div>
        <div class="col-md-6">
            <h5 class="card-title">Total</h5>
            <!-- Grafico receitas vs despesas -->
            <canvas id="myChart" width="250" height="300"></canvas>
                <script>
                    var ctx = document.getElementById("myChart");
                            var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Receitas', 'Despesas'],
                                datasets: [{
                                label: '',
                                data: [<?php echo $total_receitas; ?>, <?php echo $total_despesas; ?>],
                                backgroundColor: [
                                    'rgba(54,162,235,0.3)',
                                    'rgba(255,99,132,0.3)'
                            ],
                                borderWidth: 0
                            }]
                            },
                                options: {
                                //cutoutPercentage: 40,
                                responsive: false,
                            }
                            });
                    </script>
            <!-- fim grafico receitas vs despesas -->

        </div>
	</div>
  </div>
</div>