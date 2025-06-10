<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/histo.css">
<title>Histórico de Dados</title>
</head>
<body>
    <div class="container">
        <h1>Histórico de Dados</h1>
        
        <table id="data-table">
            <thead>
                <tr>
                    <th>Data e Hora</th>
                    <th>Temperatura (°C)</th>
                    <th>Umidade (%)</th>
                    <th>Nível de Água (%)</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        
        <button class="load-more" onclick="loadMoreData()">Carregar Mais Dados</button>
    </div>

    <script src="js/paghistorico.js"></script>
</body>
</html>
