<?php

$nome = $_POST['nome'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];
$cidade = $_POST['cidade'];
$telefone = $_POST['telefone'];
$cep = $_POST['cep'];
$lgr = str_replace(',', '.', $_POST['lgr']);
$ltr = str_replace(',', '.', $_POST['ltr']);
$porta = $_POST['porta'];
$guia = $_POST['guia'];


//Soma altura com o rolo mais multiplicado pela largura
$resChapa = ($ltr + 0.60) * $lgr;

//verifica qual é o peso da chapa
switch ($porta) {
    case 'chapa 24 fechada':
        $peso = 9.5;
        $lamina = 117.90;
        break;
    case 'chapa 24 transvision':
        $peso = 8.5;
        $lamina = 132.90;
        break;
    case 'chapa 22 fechada':
        $peso = 10.5;
        $lamina = 138.90;
        break;
    case 'chapa 22 transvision':
        $peso = 9.5;
        $lamina = 153.90;
        break;
    case 'chapa 20 fechada':
        $peso = 13;
        $lamina = 153.90;
        break;
    case 'chapa 20 transvision':
        $peso = 12.5;
        $lamina = 173.90;
        break;
}

// multiplica o peso para reschapa

$resLamina = $peso * $resChapa;

//pega o resLamina e verifica qual peso do motor ideal 

if (($resLamina >= 0) && ($resLamina <= 176)) {
    $motor = "AC Motor 200KG c/botoeira";
    $motorValor = 1057.79;
}
if (($resLamina >= 177) && ($resLamina <= 264)) {
    $motor = "AC Motor 300KG c/botoeira";
    $motorValor = 1383.98;
}
if (($resLamina >= 265) && ($resLamina <= 352)) {
    $motor = "AC Motor 400KG c/botoeira";
    $motorValor = 1402.50;
}
if (($resLamina >= 353) && ($resLamina <= 440)) {
    $motor = "AC Motor 500KG c/botoeira";
    $motorValor = 1533.13;
}
if (($resLamina > 441) && ($resLamina < 528)) {
    $motor = "AC Motor 600KG c/botoeira";
    $motorValor = 2578.00;
}
if (($resLamina > 529) && ($resLamina < 704)) {
    $motor = "AC Motor 800KG c/botoeira";
    $motorValor = 2289.00;
}
if (($resLamina > 705) && ($resLamina < 880)) {
    $motor = "AC Motor 1000KG c/botoeira";
    $motorValor = 2699.00;
}
if (($resLamina >= 881) && ($resLamina <= 1320)) {
    $motor = "AC Motor 1500KG c/botoeira";
    $motorValor = 3737.00;
}

//multiplica reschapa para tabela de preço da chapa linha 221

$totalChapa = $lamina * $resChapa;

//multiplica por dois a altura para guia

$tamGuia = $ltr * 2;

//Verifica o valor da guia e depois multiplica o valor do metro da guia escolhida para total de metros da variavel tamGuia
switch ($guia) {
    case 'Guia de 50 mm':
        $valorGuia =  23.20;
        break;
    case 'Guia de 70 mm':
        $valorGuia = 25.53;
        break;
    case 'Guia de 90 mm':
        $valorGuia = 34.86;
        break;
}

$resulGuia = $valorGuia * $tamGuia;

//Verifica a largura do eixo e exibe o valor

if ($lgr >= 0 && $lgr <= 6) {
    $valorEixo = 72.70;
    $nomeEixo = "Eixo 4 Pol";
}
if ($lgr >= 6.1 && $lgr <= 7.5) {
    $valorEixo = 195.00;
    $nomeEixo = "Eixo 5 Pol";
}
if ($lgr >= 7.6 && $lgr <= 8.5) {
    $valorEixo = 219.00;
    $nomeEixo = "Eixo 6 Pol";
}
if ($lgr >= 8.6 && $lgr <= 15) {
    $valorEixo = 299.00;
    $nomeEixo = "Eixo 8 Pol";
}

$resulEixo = $valorEixo * $lgr;

// multiplica o valor da Soleira em T para a largura

$valorSoleira = 25.50 * $lgr;

// multiplica o valor da borracha vedação para a largura

$valBorraVedacao = 3.38 * $ltr;

//multiplicar altura por 4 pvc guias e multiplicar o valor pelo total

$pvcGuias = $lgr * 4;
$totalPvcGuias = 2.21 * $pvcGuias;

//valor montagem kit
$valorMontKit = 100;

//pintura Eletrostatica multiplica a varivale valorPinEletros pela altura
$valorPinEletros = 45.47;
$resultPinEletros = $valorPinEletros * $resChapa;

//valor da portinhola
$valPortinhola = 636.63;

//valor alçapão
$valAlcapao = 441.97;

//valor central com 2 controles
$centDoisContr = 209.80;

//total
$totalOrcam = $totalChapa + $resulGuia + $resulEixo + $valorSoleira + $motorValor;

/*echo ' Nome => ' . $nome . ' |';
echo ' Endereço =>' . $endereco . ' |';
echo ' Cidade => ' . $cidade . ' |';
echo ' UF => ' . $uf . ' |';
echo ' Telefone => ' . $telefone . ' |';
echo ' CEP => ' . $cep . ' |';
echo ' Largura => ' . $lgr . ' |';
echo ' Altura => ' . $ltr . ' |';
echo ' Porta => ' . $porta . ' |';
echo ' Guia => ' . $guia . ' |';
echo ' resChapa => ' . $resChapa . ' |';
echo ' Peso => ' . $peso . ' |';
echo ' resLamina => ' . $resLamina . ' |';
echo ' Motor => ' . $motor . ' |';
echo ' motorValor => ' . $motorValor . ' |';
echo ' totalChapa => ' . $totalChapa . ' |';
echo ' tamanho da guia => ' . $tamGuia . ' |';
echo ' valor da guia => ' . $valorGuia . ' |';
echo ' valor final da guia => ' . $resulGuia . ' |';
echo ' nome do eixo => ' . $nomeEixo . ' |';
echo ' valor do eixo => ' . $valorEixo . ' |';
echo ' valor final do eixo => ' . $resulEixo . ' |';
echo ' valor final da soleira => ' . $valorSoleira . ' |';
echo ' PVC Guias => ' . $pvcGuias . ' |';
echo ' total pvc guias => ' . $totalPvcGuias . ' |';
echo ' valor da montagem kit => ' . $valorMontKit . ' |';
echo ' teste => ' . $endereco . ' |';*/

?>
<!doctype html>
<html lang="pt-br">

<head>
    <title>Portal do Serralheiro</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            //jQuery('#formulario').submit(function() {
            var dados = jQuery("#formulario").serialize();

            jQuery.ajax({
                type: "POST",
                url: "#",
                data: dados,
                success: function(data) {
                    alert(data);
                }
            });

            return false;
            // });
            jQuery('checkebox').submit(function() {
                var dados = jQuery(this).serialize();

                jQuery.ajax({
                    type: "POST",
                    url: "receber.php",
                    data: dados,
                    success: function(data) {
                        alert(data);
                    }
                });

                return false;
            });
        });

        function mascara(i, t) {

            var v = i.value;

            if (isNaN(v[v.length - 1])) {
                i.value = v.substring(0, v.length - 1);
                return;
            }

            if (t == "alt") {
                var altura = document.getElementById("alt");
                if (v[0] <= 6 && v[0] != 0) {
                    i.setAttribute("maxlength", "4");
                    if (v.length == 1) {
                        i.value += ",";
                        altura.onfocusout = function() {
                            if (i.value.length < 3) {
                                i.value += "0";
                                console.log("altura00v", v.length);
                                console.log("altura00i", i.value);
                                console.log("altura00i2length", i.value.length);
                                console.log("altura00array", v[0]);
                            }
                        }
                    }
                } else {
                    i.value = "";
                    alert("ALTURA MAXIMA PERMITIDA 6 METROS E NÃO PODE INICIAR COM 0");
                }

            }

            if (t == "lgr") {
                var largura = document.getElementById("lgr");
                if (v[0] <= 10 && v[0] != 0) {
                    i.setAttribute("maxlength", "4");
                    if (v.length == 1) {
                        i.value += ",";
                        largura.onfocusout = function() {
                            if (i.value.length < 3) {
                                i.value += "0";
                                console.log("altura00v", v.length);
                                console.log("altura00i", i.value);
                                console.log("altura00i2length", i.value.length);
                                console.log("altura00array", v[0]);
                            }
                        }
                    }
                } else {
                    alert("ALTURA MAXIMA PERMITIDA 10 METROS E NÃO PODE INICIAR COM 0");
                    i.value = "";
                }
            }

            if (t == "cep") {
                i.setAttribute("maxlength", "9");
                if (v.length == 5) i.value += "-";
            }

            if (t === "tel") {
                if (v.length === 1) i.value = "(" + i.value;
                if (v.length === 3) i.value += ") ";
                if (v[5] == 9) {
                    i.setAttribute("maxlength", "15");
                    if (v.length === 10) i.value += "-";
                } else {
                    i.setAttribute("maxlength", "14");
                    if (v.length === 9) i.value += "-";
                }
            }
        }

        function validarNome() {
            var campoNome = document.getElementById("nome").value;
            console.log(campoNome);

            if (typeof campoNome === "undefined") {
                document.getElementById("email").disabled = true;
            } else {
                document.getElementById("email").disabled = false;
            }
        }

        function validarEmail() {
            var campoEmail = document.getElementById("email").value;

            if (typeof campoEmail === "undefined") {
                document.getElementById("endereco").disabled = true;
            } else {
                document.getElementById("endereco").disabled = false;
            }
        }

        function validarEndereco() {
            var campoEndereco = document.getElementById("endereco").value;

            if (typeof campoEndereco === "undefined") {
                document.getElementById("cidade").disabled = true;
            } else {
                document.getElementById("cidade").disabled = false;
            }
        }

        function validarCidade() {
            var campoCidade = document.getElementById("cidade").value;

            if (typeof campoCidade === "undefined") {
                document.getElementById("tel").disabled = true;
            } else {
                document.getElementById("tel").disabled = false;
            }
        }

        function validarCep() {
            var campoCep = document.getElementById("cep").value;

            if (typeof campoCep === "undefined") {
                document.getElementById("tel").disabled = true;
            } else {
                document.getElementById("tel").disabled = false;
            }
        }

        function validarTel() {
            var campoTel = document.getElementById("tel").value;

            if (typeof campoTel === "undefined") {
                document.getElementById("cep").disabled = true;
            } else {
                document.getElementById("cep").disabled = false;
            }
        }

        function validarCep() {
            var campoCep = document.getElementById("cep").value;

            if (typeof campoCep === "undefined") {
                document.getElementById("lgr").disabled = true;
            } else {
                document.getElementById("lgr").disabled = false;
            }
        }

        function validarLgr() {
            var campoLgr = document.getElementById("lgr").value;

            if (typeof campoLgr === "undefined") {
                document.getElementById("alt").disabled = true;
            } else {
                document.getElementById("alt").disabled = false;
            }
        }

        function validarAlt() {
            var campoAlt = document.getElementById("alt").value;

            if (typeof campoAlt === "undefined") {
                document.getElementById("porta").disabled = true;
            } else {
                document.getElementById("porta").disabled = false;
            }
        }



        function validarForm() {
            var optionSelect = document.getElementById("porta").value;
            /*
            var campoCidade = document.getElementById("cidade").value;
            var campoTelefone = document.getElementById("tel").value;
            var campoCep = document.getElementById("cep").value;
            var optionSelect = document.getElementById("lgr").value;
            var optionSelect = document.getElementById("alt").value;

            console.log('campo', optionSelect);

           
            if( typeof  campoNome === "undefined"){
                document.getElementById("email").disabled = true;
            } else {
                document.getElementById("email").disabled = false;
            }*/

            if (optionSelect == "0") {
                document.getElementById("chapa").disabled = true;
            } else {
                document.getElementById("chapa").disabled = false;
            }
        }

        var resultPinEletros = 0;

        function myFunction() {
            var CheckPinElet = document.getElementById("CheckPinElet");
            var resChapa = document.getElementById("resChapa");
            var totalChapa = document.getElementById("totalChapa");




            if (CheckPinElet.checked == true) {
                resChapa.style.display = "block";
                //totalChapa.style.display = "block";
                resultPinEletros = "<?php echo $resultPinEletros ?>";
                sessionStorage.setItem("teste", JSON.stringify(resultPinEletros));
            } else {
                resChapa.style.display = "none";
                //totalChapa.style.display = "none";
                var resultPinEletros = 0;
            }


            var CheckPortinhola = document.getElementById("CheckPortinhola");
            var qtdPortinhola = document.getElementById("qtdPortinhola");
            var totalPortinhola = document.getElementById("totalPortinhola");

            if (CheckPortinhola.checked == true) {
                qtdPortinhola.style.display = "block";
                //totalPortinhola.style.display = "block";
                var valPortinhola = "<?php echo $valPortinhola ?>";
            } else {
                qtdPortinhola.style.display = "none";
                //totalPortinhola.style.display = "none";
                var valPortinhola = 0;
            }


            var CheckalcaEnrolar = document.getElementById("CheckalcaEnrolar");
            var qtdalcapao = document.getElementById("qtdalcapao");
            var totalalcapao = document.getElementById("totalalcapao");

            if (CheckalcaEnrolar.checked == true) {
                qtdalcapao.style.display = "block";
                //totalalcapao.style.display = "block";
                var valAlcapao = "<?php echo $valAlcapao ?>";

            } else {
                qtdalcapao.style.display = "none";
                //totalalcapao.style.display = "none";
                var valAlcapao = 0;
            }

            var CheckCentral = document.getElementById("CheckCentral");
            var qtdCentral = document.getElementById("qtdCentral");
            var totalCentral = document.getElementById("totalCentral");

            if (CheckCentral.checked == true) {
                qtdCentral.style.display = "block";
                //totalCentral.style.display = "block";
                var centDoisContr = "<?php echo $centDoisContr ?>";

            } else {
                qtdCentral.style.display = "none";
                //totalCentral.style.display = "none";
                var centDoisContr = 0;
            }

            var CheckBorraVedacao = document.getElementById("CheckBorraVedacao");
            var qtdBorraVedacao = document.getElementById("qtdBorraVedacao");
            var totalBorraVedacao = document.getElementById("totalBorraVedacao");

            if (CheckBorraVedacao.checked == true) {
                qtdBorraVedacao.style.display = "block";
                //totalBorraVedacao.style.display = "block";
                var valBorraVedacao = "<?php echo $valBorraVedacao ?>";

            } else {
                qtdBorraVedacao.style.display = "none";
                //totalBorraVedacao.style.display = "none";
                var valBorraVedacao = 0;
            }

            var CheckPvcGuias = document.getElementById("CheckPvcGuias");
            var qtdPvcGuias = document.getElementById("qtdPvcGuias");
            var totalPvcGuias = document.getElementById("totalPvcGuias");

            if (CheckPvcGuias.checked == true) {
                qtdPvcGuias.style.display = "block";
                //totalPvcGuias.style.display = "block";
                var totalPvcGuias = "<?php echo $totalPvcGuias ?>";

            } else {
                qtdPvcGuias.style.display = "none";
                //totalPvcGuias.style.display = "none";
                var totalPvcGuias = 0;
            }

            var CheckMkit = document.getElementById("CheckMkit");
            var qtdCentral = document.getElementById("qtdCheckMkit");
            var valorMontKit = document.getElementById("valorMontKit");

            if (CheckMkit.checked == true) {
                qtdCheckMkit.style.display = "block";
                //valorMontKit.style.display = "block";
                var valorMontKit = "<?php echo $valorMontKit ?>";

            } else {
                qtdCheckMkit.style.display = "none";
                //valorMontKit.style.display = "none";
                var valorMontKit = 0;
            }

            var checkSoleira = document.getElementById("checkSoleira");
            var qtdCheckSoleira = document.getElementById("qtdCheckSoleira");
            var valorReforSoleira = document.getElementById("valorReforSoleira");

            if (checkSoleira.checked == true) {
                qtdCheckSoleira.style.display = "block";
                //valorMontKit.style.display = "block";
                var valorReforSoleira = 27.98;

            } else {
                qtdCheckSoleira.style.display = "none";
                //valorMontKit.style.display = "none";
                var valorReforSoleira = 0;
            }

            var pintura = document.getElementById("pintura").value;
            var qtdCheckPintura = document.getElementById("qtdCheckPintura");
            var valorPintura = document.getElementById("valorPintura");

            if (pintura != '0') {
                if(pintura == 'Basica'){
                    qtdCheckPintura.style.display = "block";
                    //valorPintura.style.display = "block";
                    var valorPintura = 45.47;
                }else{
                    qtdCheckPintura.style.display = "block";
                    //valorPintura.style.display = "block";
                    var valorPintura = 57.13;
                }

            } else {
                qtdCheckPintura.style.display = "none";
                //valorMontKit.style.display = "none";
                var valorPintura = 0;
            }

            var telescopica = document.getElementById("telescopica").value;
            var qtdCheckTelescopica = document.getElementById("qtdCheckTelescopica");
            var valorTelescopica = document.getElementById("valorTelescopica");

            if (telescopica != '0') {
                if(telescopica == '65X60'){
                    qtdCheckTelescopica.style.display = "block";
                    //valorPintura.style.display = "block";
                    var valorTelescopica = 46.00;
                }else{
                    qtdCheckTelescopica.style.display = "block";
                    //valorPintura.style.display = "block";
                    var valorTelescopica = 100.27;
                }

            } else {
                qtdCheckTelescopica.style.display = "none";
                //valorMontKit.style.display = "none";
                var valorTelescopica = 0;
            }

            var tubo = document.getElementById("tubo").value;
            var qtdCheckTubo = document.getElementById("qtdCheckTubo");
            var valorTubo = document.getElementById("valorTubo");

            if (tubo != '0') {
                if(tubo == '40X30'){
                    qtdCheckTubo.style.display = "block";
                    //valorPintura.style.display = "block";
                    var valorTubo = 9.07;
                }else if(tubo == '50X30'){
                    qtdCheckTubo.style.display = "block";
                    //valorPintura.style.display = "block";
                    var valorTubo = 13.34;
                }else if(tubo == '60X40'){
                    qtdCheckTubo.style.display = "block";
                    //valorPintura.style.display = "block";
                    var valorTubo = 18.53;
                }else{
                    qtdCheckTubo.style.display = "block";
                    //valorPintura.style.display = "block";
                    var valorTubo = 23.20;
                }

            } else {
                qtdCheckTubo.style.display = "none";
                //valorMontKit.style.display = "none";
                var valorTubo = 0;
            }

            //Calcular reforço da soleira

            if(valorReforSoleira != 0){
                 totalReforSoleira = valorReforSoleira * "<?php echo $lgr ?>";
            }else{
                 totalReforSoleira = 0;
            }

            //Calcular grupo de pintura

            var grupoPintura = document.getElementById("grupoPintura").value;
            var qtdCheckGrupoPintura = document.getElementById("qtdCheckGrupoPintura");
            var valorGupoPintura = document.getElementById("valorGrupoPintura");

            if (grupoPintura != '0') {
                if(grupoPintura == ' Basica'){
                    qtdCheckTubo.style.display = "block";
                    //valorPintura.style.display = "block";
                    var valorTubo = 9.07;
                }else if(tubo == '50X30'){
                    qtdCheckTubo.style.display = "block";
                    //valorPintura.style.display = "block";
                    var valorTubo = 13.34;
                }else if(tubo == '60X40'){
                    qtdCheckTubo.style.display = "block";
                    //valorPintura.style.display = "block";
                    var valorTubo = 18.53;

            //Calcular o valor da pintura

            if(valorPintura != 0){
                 totalPintura = valorPintura * "<?php echo $resChapa ?>";
            }else{
                 totalPintura = 0;
            }

            //Calcular o valor da guia telescopica

            var telesAltura = parseFloat(<?php echo $ltr ?>);
            var totalTelesAlt = telesAltura + telesAltura;
            
            if(valorTelescopica != 0){
                 totalTelescopica = valorTelescopica * totalTelesAlt;
                 console.log("altura", totalTelescopica);
                 console.log("totalTelesAlt", totalTelesAlt);
            }else{
                 totalTelescopica = 0;
            }

            //Calcular o valor do Tubo de Afastamento
            
            var tuboAltura = parseFloat(<?php echo $ltr ?>);
            var totalTuboAlt = tuboAltura + tuboAltura;

            if(valorTubo != 0){
                totalTubo = valorTubo * totalTuboAlt;
                console.log("altura", totalTubo);
                console.log("totalTuboAlt", totalTuboAlt);
            }else{
                 totalTubo = 0;
            }

             subTotal = parseFloat("<?php echo $totalOrcam ?>");
             total = (parseFloat(subTotal) + parseFloat(resultPinEletros) + parseFloat(valPortinhola) + parseFloat(valAlcapao) + parseFloat(centDoisContr) + parseFloat(valorMontKit) + parseFloat(valBorraVedacao) + parseFloat(totalReforSoleira) + parseFloat(totalPintura) +  parseFloat(totalTelescopica) + parseFloat(totalPvcGuias) + parseFloat(totalTubo));

             ValFormSubTotal = subTotal.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
             valFormTotal = total.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
            /*
            console.log(resultPinEletros);
            console.log(valPortinhola);
            console.log(valAlcapao);
            console.log(centDoisContr);
            console.log(valBorraVedacao);
            console.log(total);
            console.log('henrique', document.getElementById('pintura').value);
            console.log('henrique', document.getElementById('CheckPinElet').value);*/

            if (resultPinEletros == 0 && valPortinhola == 0 && valAlcapao == 0 && centDoisContr == 0 && valorMontKit == 0 && valBorraVedacao == 0 && totalPvcGuias == 0 && valorReforSoleira == 0 && valorPintura == 0 && valorTelescopica == 0 && valorTubo == 0) {
                document.getElementById("total").innerHTML = '<b> ' + ValFormSubTotal + '</b>';
            } else {
                document.getElementById("total").innerHTML = '<b>' + valFormTotal + '</b>';
            }

            /*console.log('pintura: ', pintura);
            console.log('qtdCheckPintura: ', "<?php echo $resChapa ?>");
            console.log('valorPintura: ', valorPintura);
            console.log('totalPintura: ', totalPintura.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }));*/


        }

        window.onload = function() {
            var nome = "<?php echo $nome ?>";
            var email = "<?php echo $email ?>";
            var endereco = "<?php echo $endereco ?>";
            var telefone = "<?php echo $telefone ?>";
            var cidade = "<?php echo $cidade ?>";
            var porta2 = "<?php echo $porta ?>";
            var guia2 = "<?php echo $guia ?>";
            var nomeEixo2 = "<?php echo $nomeEixo ?>";
            var motor = "<?php echo $motor ?>";
            var ltr = "<?php echo $ltr ?>";

            console.log('nome: ', nome);
            console.log('email: ', email);
            console.log('telefone: ', telefone);
            //console.log('totalTubo: ', totalTubo);


            document.getElementById('env_nome').value = nome;
            document.getElementById('env_email').value = email;
            document.getElementById('env_endereco').value = endereco;
            document.getElementById('telefone').value = telefone;
            document.getElementById('env_cidade').value = cidade;
            document.getElementById('porta2').value = porta2;
            document.getElementById('guia2').value = guia2;
            document.getElementById('nomeEixo2').value = nomeEixo2;
            document.getElementById('motor').value = motor;
            document.getElementById('ltr').value = ltr; 

            console.log('tetes', document.getElementById('env_nome'));


        };
    </script>
</head>

<body>

    <div class="container col-sm-6 col-xs-6  main-image">
        <div class="text-center">
            <img src="/sao_paulo/imagens/logotipo_original_medium.png" class="rounded  mb-3 col-4" alt="...">
        </div>
        <form method="post" action="#" id="formulario" name="formulario">
            <div class="form-row mb-3">
                <div class="col">
                    <input type="text" name="nome" id="nome" onchange="validarNome()" class="form-control" placeholder="Nome" required />
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <input type="text" name="email" id="email" onchange="validarEmail()" class="form-control" placeholder="Email" required disabled />
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <input type="text" name="endereco" id="endereco" onchange="validarEndereco()" class="form-control" placeholder="Endereço" required disabled />
                </div>
                <div class="col">
                    <input type="text" name="cidade" id="cidade" onchange="validarCidade()" class="form-control" placeholder="Cidade" required disabled />
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <input type="text" oninput="mascara(this, 'tel')" onchange="validarTel()" id="tel" name="telefone" class="form-control telefone" placeholder="Telefone" disabled required />
                </div>
                <div class="col">
                    <input type="text" oninput="mascara(this, 'cep')" onchange="validarCep()" id="cep" name="cep" class="form-control" placeholder="Cep" required disabled />
                </div>
            </div>
            <div class="card mb-3" style="background-color: #003e62">
                <div class="card-header">

                </div>
                <div class="card-body ">
                    <div class="input-group input-group-sm ">
                        <div class="input-group-prepend ">
                            <span class="input-group-text" id="inputGroup-sizing-sm ">Largura</span>
                        </div>
                        <input type="text" oninput="mascara(this, 'lgr')" onchange="validarLgr()" class="form-control col-sm-6 col-xs-6" name="lgr" id="lgr" aria-label="Exemplo do tamanho do input" aria-describedby="inputGroup-sizing-sm" disabled />
                        <div class="input-group-prepend  pl-2 ">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Altura</span>
                        </div>
                        <input type="text" oninput="mascara(this, 'alt')" onchange="validarAlt()" id="alt" class="form-control col-sm-4 col-xs-4" name="ltr" id="ltr" aria-label="Exemplo do tamanho do input" aria-describedby="inputGroup-sizing-sm" disabled />
                    </div>
                </div>
                <div class="container">
                    <div class="input-group mb-3 text-center col-sm-12 col-xs-4 pl-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Modelo da Porta</label>
                        </div>
                        <select name="porta" class="custom-select col-sm-12 col-xs-6" id="porta" onchange="validarForm()" disabled>
                            <option value="0">Seleciona uma Chapa...</option>
                            <option value="chapa 24 fechada">chapa 24 fechada</option>
                            <option value="chapa 24 transvision">chapa 24 transvision</option>
                            <option value="chapa 22 fechada">chapa 22 fechada</option>
                            <option value="chapa 22 transvision">chapa 22 transvision</option>
                            <option value="chapa 20 fechada">chapa 20 fechada</option>
                            <option value="chapa 20 transvision">chapa 20 transvision</option>
                        </select>
                    </div>
                    <div class="input-group mb-3 col-sm-12 col-xs-4 pl-3 text-center">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Guia</label>
                        </div>
                        <select name="guia" class="custom-select col-sm-12 col-xs-6" id="chapa" onchange="document.forms['formulario'].submit();" disabled>
                            <option value="0">Selecione uma Guia...</option>
                            <option value="Guia de 50 mm">Guia de 50 mm</option>
                            <option value="Guia de 70 mm">Guia de 70 mm</option>
                            <option value="Guia de 90 mm">Guia de 90 mm</option>
                        </select>
                    </div>
                    <div class="text-center mb-3">
                        <!-- <button type="submit" class="btn btn-primary btn-lg active mb-3" role="button" aria-pressed="true">Gerar Orçamento</button> -->
                    </div>
                </div>
        </form>
    </div>
    <?php if (!empty($resChapa)) {


        $teste =
            "<table class='table table-striped mb-3 text-white'>
                <thead>
                    <tr>
                        <th scope='col'>Descrição</th>
                        <th scope='col'>Unid.</th>
                        <th scope='col'>Qtd.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>" . $porta . "</td>
                        <td>M²</td>
                        <td>" . str_replace('.', ',', $resChapa) . "</td>
                        <!-- <td> R$ " . number_format($totalChapa, 2, ',', '.')  . "</td> -->
                    </tr>
                    <tr>
                        <td>" . $guia . "</td>
                        <td>ML.</td>
                        <td>" . str_replace('.', ',', $tamGuia) . "</td>
                        <!-- <td> R$" . number_format($resulGuia, 2, ',', '.') . " </td> -->
                    </tr>
                    <tr>
                        <td>" . $nomeEixo . "</td>
                        <td>ML.</td>
                        <td>" . str_replace('.', ',', $lgr) . "</td>
                        <!-- <td> R$ " . number_format($resulEixo, 2, ',', '.') . " </td> -->
                    </tr>
                    <tr>
                        <td>Soleira em T</td>
                        <td>ML.</td>
                        <td>" . str_replace('.', ',', $lgr) . "</td>
                        <!-- <td> R$ " . number_format($valorSoleira, 2, ',', '.') . " </td> -->
                    </tr>
                    <tr>
                        <td>" . $motor . "</td>
                        <td>PC.</td>
                        <td>1</td>
                        <!-- <td> R$ " . number_format($motorValor, 2, ',', '.') . "</td> -->
                    </tr>
                </tbody>
        </table>
        <table class='table table-striped mb-3 text-white'>
             <thead>
             <h2 class='text-center text-white'>Itens Opcionais</h2>
                 <tr>
                     <th scope='col'>Descrição</th>
                     <th scope='col'>Unid.</th>
                     <th scope='col'>Qtd.</th>
                 </tr>
             </thead>
             <form method='post' action='receber.php' id='checkebox'>
             <tbody>
                 <tr>
                     <td> <input type='checkbox' id='CheckPinElet' name='checkPintura' onclick='myFunction()'> Pintura Eletrostatica</td>
                     <td>M²</td>
                     <td ><p id='resChapa' style='display:none'>" . str_replace('.', ',', $resChapa) . "</p></td>
                     <!-- <td><p id='totalChapa' style='display:none'> R$" . $resultPinEletros . "</p></td> -->
                 </tr>
                 <tr>
                     <td> <input type='checkbox' id='CheckPortinhola' name='CheckPortinhola' onclick='myFunction()'> Portinhola </td>
                     <td>PC.</td>
                     <td> <p id='qtdPortinhola' style='display:none'> 1 </p> </td>
                     <!-- <td><p id='totalPortinhola' style='display:none'> R$" . $valPortinhola . "</p></td> -->
                 </tr>
                 <tr>
                     <td> <input type='checkbox' id='CheckalcaEnrolar' name='CheckalcaEnrolar' onclick='myFunction()'> Alçapão de enrolar</td>
                     <td>PC.</td>
                     <td> <p id='qtdalcapao' style='display:none'> 1 </p> </td>
                     <!-- <td><p id='totalalcapao' style='display:none'> R$" . $valAlcapao . "</p></td> -->
                 </tr>
                 <tr>
                     <td> <input type='checkbox' id='CheckCentral' name='CheckCentral' onclick='myFunction()'> Central com 2 controles </td>
                     <td>PC.</td>
                     <td> <p id='qtdCentral' style='display:none'> 1 </p> </td>
                     <!-- <td><p id='totalCentral' style='display:none'> R$" . $centDoisContr . "</p></td> -->
                 </tr>
                 <tr>
                     <td> <input type='checkbox' id='CheckBorraVedacao' name='CheckBorraVedacao' onclick='myFunction()'> Borracha Vedação </td>
                     <td>ML.</td>
                     <td> <p id='qtdBorraVedacao' style='display:none'>" . $lgr . "</p> </td>
                     <!-- <td><p id='totalBorraVedacao' style='display:none'> R$" . $valBorraVedacao . "</p></td> -->
                 </tr>
                 <tr>
                     <td> <input type='checkbox' id='CheckPvcGuias' name='CheckPvcGuias' onclick='myFunction()'> PVC Guias </td>
                     <td>ML.</td>
                     <td> <p id='qtdPvcGuias' style='display:none'>" . $pvcGuias . "</p> </td>
                     <!-- <td><p id='totalPvcGuias' style='display:none'> R$" . $totalPvcGuias . "</p></td> -->
                 </tr>
                 <tr>
                     <td> <input type='checkbox' id='CheckMkit' name='CheckMkit' onclick='myFunction()'> Montagem de Kit </td>
                     <td>PC.</td>
                     <td> <p id='qtdCheckMkit' style='display:none'> 1 </p> </td>
                     <!-- <td><p id='valorMontKit' style='display:none'> R$" . $valorMontKit . "</p></td> -->
                 </tr>
                 <tr>
                     <td> <input type='checkbox' id='checkSoleira' name='checkSoleira' onclick='myFunction()'> Reforço da Soleira </td>
                     <td>PC.</td>
                     <td> <p id='qtdCheckSoleira' style='display:none'> 1 </p> </td>
                     <!-- <td><p id='valorReforSoleira' style='display:none'> R$" . $valorMontKit . "</p></td> -->
                 </tr>
                 <tr>
                     <td> 
                        <select name='pintura' class='custom-select col-sm-6 col-xs-3' id='pintura' onchange='myFunction()' >
                            <option value='0'>Pintura...</option>
                            <option value='Basica'>Basica (Branco, Cinza Platina, Preto)</option>
                            <option value='Especial'>Especial (demais cores)</option>
                            <option value='0'>Sem Pintura</option>
                        </select>
                     </td>
                     <td>M²</td>
                     <td> <p id='qtdCheckPintura' style='display:none'>" . str_replace('.', ',', $resChapa) . "</p> </td>
                     <!-- <td><p id='valorPintura' style='display:none'> R$" . $valorMontKit . "</p></td> -->
                 </tr>
                 <tr>
                     <td> 
                        <select name='telescopica' class='custom-select col-sm-6 col-xs-3' id='telescopica' onchange='myFunction()' >
                            <option value='0'>Guia Telescopica...</option>
                            <option value='65X60'>65X60</option>
                            <option value='90X90'>90X90</option>
                            <option value='0'>Sem Guia Telescopica</option>
                        </select>
                     </td>
                     <td>ML.</td>
                     <td> <p id='qtdCheckTelescopica' style='display:none'> ". ($ltr + $ltr) ." </p> </td>
                     <!-- <td><p id='valorTelescopica' style='display:none'> R$" . $valorMontKit . "</p></td> -->
                 </tr>
                 <tr>
                     <td> 
                        <select name='tubo' class='custom-select col-sm-6 col-xs-3' id='tubo' onchange='myFunction()' >
                            <option value='0'>Tubo de Afastamento...</option>
                            <option value='40X30'>40X30</option>
                            <option value='50X30'>50X30</option>
                            <option value='60X40'>60X40</option>
                            <option value='80X40'>80X40</option>
                            <option value='0'>Sem Tubo de Afastamento</option>
                        </select>
                     </td>
                     <td>ML.</td>
                     <td> <p id='qtdCheckTubo' style='display:none'> ". ($ltr + $ltr) ." </p> </td>
                     <!-- <td><p id='valorTubo' style='display:none'> R$" . $valorMontKit . "</p></td> -->
                 </tr>
                 <tr>
                    <td><b>Valor Total</b></td>
                    <td id='total'><b> R$ " . number_format($totalOrcam, 2, ',', '.') . " </b></td>
                 </tr>
             </tbody>
         </table>
         <input type='hidden'  name='env_nome' id='env_nome' />
         <input type='hidden'  name='env_email' id='env_email' />
         <input type='hidden'  name='env_endereco' id='env_endereco' />
         <input type='hidden'  name='telefone' id='telefone' />
         <input type='hidden'  name='env_cidade' id='env_cidade' />
         <input type='hidden'  name='porta' id='porta2' />
         <input type='hidden'  name='resChapa' value=" . $resChapa . " />
         <input type='hidden'  name='totalChapa' value=" . $totalChapa . " />
         <input type='hidden'  name='guia' id='guia2' />
         <input type='hidden'  name='tamGuia' value=" . $tamGuia . " />
         <input type='hidden'  name='resulGuia' value=" . $resulGuia . " />
         <input type='hidden'  name='nomeEixo' id ='nomeEixo2' />
         <input type='hidden'  name='lgr' value=" . $lgr . " />
         <input type='hidden'  name='ltr' id = 'ltr'  />
         <input type='hidden'  name='resulEixo' value=" . $resulEixo . " />
         <input type='hidden'  name='valorSoleira' value=" . $valorSoleira . " />
         <input type='hidden'  name='motor' id='motor' />
         <input type='hidden'  name='motorValor' value=" . $motorValor . " />
         <input type='hidden'  name='valBorraVedacao' value=" . $valBorraVedacao . " />
         <input type='hidden'  name='pvcGuias' value=" . $pvcGuias . " />
         <input type='hidden'  name='totalPvcGuias' value=" . $totalPvcGuias . " />
         <input type='hidden'  name='resChapa' value=" . $resChapa . " />
         <input type='hidden'  name='resultPinEletros' value=" . $resultPinEletros . " />

         <input type='hidden'  name='valPortinhola' value=" . $valPortinhola . " />
         <input type='hidden'  name='valAlcapao' value=" . $valAlcapao . " />
         <input type='hidden'  name='centDoisContr' value=" . $centDoisContr . " />
         <input type='hidden'  name='valBorraVedacao' value=" . $valBorraVedacao . " />
         <input type='hidden'  name='totalPvcGuias' value=" . $totalPvcGuias . " />
         <input type='hidden'  name='valorMontKit' value=" . $valorMontKit . " />
         <input type='hidden'  name='totalOrcam' value=" . $totalOrcam . " />
         ";
        echo $teste;
    }
    if (!empty($resChapa)) {
        echo "<div class='text-center'><a href='index.php' class='btn btn-secondary btn-lg mb-3' role='button' aria-pressed='true'>Voltar</a> <button type='submit' id='dados' class='btn btn-primary btn-lg active mb-3' role='button' aria-pressed='true'>Gerar Orçamento</button></div>
        <div class='text-white text-center mb-3'><b>Esta versão é beta, somente para testes</b></div>
        ";
    }
    ?>

    </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>