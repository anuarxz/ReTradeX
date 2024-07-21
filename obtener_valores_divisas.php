<?php

function obtenerValoresDivisas()
{
    // Pares de divisas que deseas obtener
    $paresDivisas = ['EURUSD', 'GBPUSD', 'EURGBP', 'USDJPY', 'USDCAD'];

    // Obtener los valores de las divisas y almacenarlos en una lista
    $valoresDivisas = array();
    foreach ($paresDivisas as $par) {
        $url = "https://query1.finance.yahoo.com/v10/finance/quoteSummary/$par=X?modules=price";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        $valor = $data['quoteSummary']['result'][0]['price']['regularMarketPrice']['raw'];
        $maximoDiario = $data['quoteSummary']['result'][0]['price']['regularMarketDayHigh']['raw'];
        $minimoDiario = $data['quoteSummary']['result'][0]['price']['regularMarketDayLow']['raw'];
        $valoresDivisas[$par] = array(
            'valor' => $valor,
            'maximoDiario' => $maximoDiario,
            'minimoDiario' => $minimoDiario
        );
    }

    // Devolver los valores de las divisas en formato JSON
    return json_encode($valoresDivisas);
}


// Llamar a la función para obtener los valores de las divisas
echo obtenerValoresDivisas();

?>
