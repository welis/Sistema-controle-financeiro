<?php
    $sql = $pdo->prepare("select categoria_despesa.nome, sum(despesas.valor) from categoria_despesa, despesas where despesas.id_categoria_despesa = categoria_despesa.id_categoria_despesa group by categoria_despesa.nome;");
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach($resultado as $linha){
        $nome_despesa = $linha['nome'];
        $total_despesas = $linha['sum(despesas.valor)'];
        echo'<h6>'.$nome_despesa.'</h6>';
        echo'<h1>R$ '.$total_despesas.'</h1>';

    }
?>
<div class="row">
		<div class="col-md-6 p-5">
            <!-- Grafico linha despesas -->
            <canvas id="GraficoMaioresDesp" width="30" height="30"></canvas>
            <script>
                var ctx = document.getElementById("GraficoMaioresDesp");
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["<?php  $sql = $pdo->prepare("select categoria_despesa.nome, sum(despesas.valor) from categoria_despesa, despesas where despesas.id_categoria_despesa = categoria_despesa.id_categoria_despesa group by categoria_despesa.nome;");
                                    $sql->execute();
                                    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($resultado as $linha){
                                        $nome_despesa = $linha['nome'];
                                        echo $nome_despesa;
                                    } ?>"],
                        datasets: [{
                            label: "Despesas",
                            data: [<?php  $sql = $pdo->prepare("select categoria_despesa.nome, sum(despesas.valor) from categoria_despesa, despesas where despesas.id_categoria_despesa = categoria_despesa.id_categoria_despesa group by categoria_despesa.nome;");
                                    $sql->execute();
                                    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($resultado as $linha){
                                        $total_despesas = $linha['sum(despesas.valor)'];
                                        echo $total_despesas . ',';
                                    } ?>
                                    ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 0.5
                        }]
                    },
                });
            </script>
		</div>
	</div>
