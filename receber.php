<?php
require('./fpdf/fpdf.php');
include('./class.ipdetails.php');
include('./banco.php');
#$ip = $_SERVER['REMOTE_ADDR'];
$ip = "189.73.71.160";
$ipdetails = new ipdetails($ip);
$ipdetails->scan();
$localOrcamento = $ipdetails->get_region()." - ".$ipdetails->get_city();

$checkPintura = isset($_POST['checkPintura']) ? $_POST['checkPintura'] : 0;
$CheckPortinhola = isset($_POST['CheckPortinhola']) ? $_POST['CheckPortinhola'] : 0;
$CheckalcaEnrolar = isset($_POST['CheckalcaEnrolar']) ? $_POST['CheckalcaEnrolar'] : 0;
$CheckBorraVedacao = isset($_POST['CheckBorraVedacao']) ? $_POST['CheckBorraVedacao'] : 0;
$CheckPvcGuias = isset($_POST['CheckPvcGuias']) ? $_POST['CheckPvcGuias'] : 0;
$CheckMkit = isset($_POST['CheckMkit']) ? $_POST['CheckMkit'] : 0;
$CheckCentral = isset($_POST['CheckCentral']) ? $_POST['CheckCentral'] : 0;
$nome =  $_POST['env_nome']/*utf8_decode('NOME: ' . strtoupper($_POST['env_nome']))*/; 
$email = $_POST['env_email'];
$endereco = utf8_decode('ENDEREÇO: ' . strtoupper($_POST['env_endereco']));
$cidade = $_POST['env_cidade'];
$telefone = $_POST['telefone'];
$porta = $_POST['porta'];
$resChapa = $_POST['resChapa'];
$totalChapa = $_POST['totalChapa'];
$guia = $_POST['guia'];
$tamGuia = $_POST['tamGuia'];
$resulGuia = $_POST['resulGuia'];
$nomeEixo = $_POST['nomeEixo'];
$lgr =  $_POST['lgr'];
$ltr = $_POST['ltr'];
$resulEixo = $_POST['resulEixo'];
$valorSoleira = $_POST['valorSoleira'];
$motor = $_POST['motor'];
$motorValor = $_POST['motorValor'];
$pvcGuias = $_POST['pvcGuias'];
$resultPinEletros = $_POST['resultPinEletros'];
$valPortinhola = $_POST['valPortinhola'];
$valAlcapao = $_POST['valAlcapao'];
$centDoisContr = $_POST['centDoisContr'];
$valorMontKit = $_POST['valorMontKit'];
$valBorraVedacao = $_POST['valBorraVedacao'];
$totalPvcGuias = $_POST['totalPvcGuias'];
$totalOrcam = $_POST['totalOrcam'];

$data = date('Y/m/d');



if ($checkPintura != '0') {
   
    $totalOrcam = $totalOrcam += $resultPinEletros;
} else {
    $linha14 = "Pintura Eletrostatica - ======= ";
}
if ($CheckPortinhola != '0') {
   
    $totalOrcam = $totalOrcam += $valPortinhola;
} else {
    $linha15 = "Portinhola - ======= ";
}
if ($CheckalcaEnrolar != '0') {
  
    $totalOrcam = $totalOrcam += $valAlcapao;
} else {
    $linha16 = "Alçapão de Enrolar - ======= ";
}
if ($CheckCentral != '0') {
    
    $totalOrcam = $totalOrcam += $centDoisContr;
} else {
    $linha17 = "Central com 2 controles - ======= ";
}
if ($CheckBorraVedacao != '0') {
  
    $totalOrcam = $totalOrcam += $valBorraVedacao;
} else {
    $linha10 = "Borracha vedação - ======= ";
}
if ($CheckPvcGuias != '0') {
    
} else {
    $linha11 = "PVC Guias - ======= ";
}
if ($CheckMkit != '0') {
    
    $totalOrcam = $totalOrcam += $valorMontKit;
} else {
    $linha18 = "Montagem de Kit - ======= ";
}

$totalAdic = $totalOrcam;
$total = "R$ " . number_format($totalAdic, 2, ',', '.');

try{

    $sql = $pdo->prepare("INSERT INTO orcamento_vendas VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->execute(array($nome, $email, $endereco, $cidade, $telefone, $data, $localOrcamento, $resChapa, $porta, $tamGuia, $lgr, $guia, $nomeEixo, $motor, $checkPintura, $CheckPortinhola, $CheckalcaEnrolar, $CheckCentral, $CheckBorraVedacao, $CheckPvcGuias, $pvcGuias, $CheckMkit));

}catch(Exception $e){
    echo $e->getMessage();
}

//echo $nome;

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('./images/Logo.jpg', 5, 10, -900);
        $this->Image('./images/INMETRO.jpg', 85, 10, -4800);
        $this->Image('./images/ISO.jpg', 100, 8, -3600);
        $this->Image('./images/QUALIDADE.jpg', 120, 10, -4800);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 10);
        // Move to the right

        // Title
        $this->Cell(350, 10, utf8_decode('ORÇAMENTO VENDAS'), 0, 1, 'C');
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'B', 11);
        $this->Line(220, 240, 0, 240);
        $this->Cell(0, -70, utf8_decode('ATENÇÃO:(*)'), 0, 1, 'L');
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 80, utf8_decode('(*) O transporte do motor até a assistência técnica, é de total responsabilidade do cliente.'), 0, 1, 'L');
        $this->Cell(0, -70, utf8_decode('(*) As entregas só podem ser recebidas pelo cliente ou por seu representante.'), 0, 1, 'L');
        $this->Cell(0, 80, utf8_decode('(*) Caro cliente, confira sua mercadoria no ato da entrega, não aceitaremos reclamações posteriores.'), 0, 1, 'L');
        $this->Cell(0, -70, utf8_decode('(*) Prazo de entrega passará a contar somente após a confirmação do pagamento da entrega.'), 0, 1, 'L');
        $this->Line(220, 275, 0, 275);
        $this->Cell(0, 110, utf8_decode('Rua Luis Delgado, 42 - Jd. Modelo - São Paulo/Tel.:(11) 4386-1001'), 0, 1, 'C');
        $this->Cell(0, -100, utf8_decode('www.originalportas.com.br - contato@originalportas.com.br'), 0, 1, 'C');
        // Page number
        //$this->Cell(0, 120, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(190, 10, $nome, 'T,L,R', 1, 'L');
$pdf->Cell(190, 5, $endereco, 'L,R', 1, 'L');
$pdf->Cell(190, 10, utf8_decode('CIDADE : ' . strtoupper(strval($cidade))), 'L,R', 1, 'L');
$pdf->Cell(190, 5, utf8_decode('TELEFONE : ' . strtoupper(strval($telefone))), 'L,R', 1, 'L');
$pdf->Cell(190, 10, utf8_decode('DATA: '.date('d/m/Y')), 'L,R,B', 1, 'L');
//$pdf->Cell(190, 5, utf8_decode('LOCAL ORÇAMENTO : '.strtoupper($ipdetails->get_region().' - '.$ipdetails->get_country())), 'L,R,B', 0, 'L');
$pdf->Ln(15);
$pdf->SetFont('Arial', '', 8);
//$pdf->Line(220,100,0,100);
$pdf->Cell(190, 10, utf8_decode('1 PORTA:  ').(str_replace('.', ',', $ltr)).utf8_decode('  X  '). str_replace('.', ',', $lgr), 0, 1, 'C');
$pdf->Cell(190, 5, utf8_decode('QUANTIDADE   |   UN.           |  DESCRIÇÃO'), 'T,L,R', 1, 'L');
if(strlen($resChapa) == 1){
    $pdf->Cell(190, 5, $resChapa . '                             ' . utf8_decode('M²') . '                 ' . utf8_decode(strtoupper(strval($porta))), 'T,L,R', 1, 'L');
}elseif(strlen($resChapa) == 2){
    $pdf->Cell(190, 5, $resChapa . '                           ' . utf8_decode('M²') . '                 ' . utf8_decode(strtoupper(strval($porta))), 'T,L,R', 1, 'L');
}elseif(strlen($resChapa) == 3){ 
    $pdf->Cell(190, 5, $resChapa . '                          ' . utf8_decode('M²') . '                 ' . utf8_decode(strtoupper(strval($porta))), 'T,L,R', 1, 'L');   
}elseif(strlen($resChapa) == 4){
    $pdf->Cell(190, 5, $resChapa . '                        ' . utf8_decode('M²') . '                 ' . utf8_decode(strtoupper(strval($porta))), 'T,L,R', 1, 'L');
}elseif (strlen($resChapa) <= 10){
    $pdf->Cell(190, 5, round($resChapa, 2) . '                        ' . utf8_decode('M²') . '                 ' . utf8_decode(strtoupper(strval($porta))), 'T,L,R', 1, 'L');

}else{
    $pdf->Cell(190, 5, $resChapa . '                          ' . utf8_decode('M²') . '                 ' . utf8_decode(strtoupper(strval($porta))), 'T,L,R', 1, 'L');
}
if(strlen($tamGuia) == 1){
    $pdf->Cell(190, 5, $tamGuia . '                             ' . 'ML.               ' . utf8_decode(strtoupper(strval($guia))), 'T,L,R', 1, 'L');
}elseif(strlen($tamGuia) == 2){
    $pdf->Cell(190, 5, $tamGuia . '                           ' . 'ML.               ' . utf8_decode(strtoupper(strval($guia))), 'T,L,R', 1, 'L');
}elseif(strlen($tamGuia) == 3){
    $pdf->Cell(190, 5, $tamGuia . '                          ' . 'ML.               ' . utf8_decode(strtoupper(strval($guia))), 'T,L,R', 1, 'L');       
}elseif (strlen($tamGuia) == 4){
    $pdf->Cell(190, 5, $tamGuia . '                        ' . 'ML.               ' . utf8_decode(strtoupper(strval($guia))), 'T,L,R', 1, 'L');  
}else{
    $pdf->Cell(190, 5, $tamGuia . '                         ' . 'ML.               ' . utf8_decode(strtoupper(strval($guia))), 'T,L,R', 1, 'L');
}
if(strlen($lgr) == 1){
    $pdf->Cell(190, 5, str_replace('.', ',', $lgr) . '                             ' . 'ML.               ' . utf8_decode(strtoupper(strval($nomeEixo))), 'T,L,R', 1, 'L');
}elseif(strlen($lgr)  == 2){
    $pdf->Cell(190, 5, str_replace('.', ',', $lgr) . '                           ' . 'ML.               ' . utf8_decode(strtoupper(strval($nomeEixo))), 'T,L,R', 1, 'L'); 
}elseif(strlen ($lgr) == 3) {
    $pdf->Cell(190, 5, str_replace('.', ',', $lgr) . '                          ' . 'ML.               ' . utf8_decode(strtoupper(strval($nomeEixo))), 'T,L,R', 1, 'L');
}elseif(strlen($lgr) == 4){
    $pdf->Cell(190, 5, str_replace('.', ',', $lgr) . '                        ' . 'ML.               ' . utf8_decode(strtoupper(strval($nomeEixo))), 'T,L,R', 1, 'L');         
}else{
    $pdf->Cell(190, 5, str_replace('.', ',', $lgr) . '                        ' . 'ML.               ' . utf8_decode(strtoupper(strval($nomeEixo))), 'T,L,R', 1, 'L');
}
if(strlen($lgr) == 1){
    $pdf->Cell(190, 5, str_replace('.', ',', $lgr) . '                             ' . 'ML.               ' . utf8_decode('SOLEIRA EM T'), 'T,L,R', 1, 'L');
}elseif(strlen($lgr) == 2){
     $pdf->Cell(190, 5, str_replace('.', ',', $lgr) . '                           ' . 'ML.               ' . utf8_decode('SOLEIRA EM T'), 'T,L,R', 1, 'L');
}elseif(strlen($lgr) == 3){
    $pdf->Cell(190, 5, str_replace('.', ',', $lgr) . '                          ' . 'ML.               ' . utf8_decode('SOLEIRA EM T'), 'T,L,R', 1, 'L');
}elseif(strlen($lgr) == 4){
    $pdf->Cell(190, 5, str_replace('.', ',', $lgr) . '                        ' . 'ML.               ' . utf8_decode('SOLEIRA EM T'), 'T,L,R', 1, 'L');      
}else{
    $pdf->Cell(190, 5, str_replace('.', ',', $lgr) . '                      ' . 'ML.               ' . utf8_decode('SOLEIRA EM T'), 'T,L,R', 1, 'L');
}
$pdf->Cell(190, 5, '1                             ' . 'PC                ' . utf8_decode(strtoupper(strval($motor))), 'T,L,R,B', 1, 'L');

if ($checkPintura != '0') {
    if(strlen($resChapa) == 1){
        $pdf->Cell(190, 5, $resChapa . '                             ' . utf8_decode('M²') . '                 ' . utf8_decode('PINTURA ELETROSTATICA'), 'L,R,B', 1, 'L');
    }elseif(strlen($resChapa) == 2){
        $pdf->Cell(190, 5, $resChapa . '                           ' . utf8_decode('M²') . '                 ' . utf8_decode('PINTURA ELETROSTATICA'), 'L,R,B', 1, 'L');
    }elseif(strlen($resChapa) == 3){
        $pdf->Cell(190, 5, $resChapa . '                          ' . utf8_decode('M²') . '                 ' . utf8_decode('PINTURA ELETROSTATICA'), 'L,R,B', 1, 'L');
    }elseif(strlen($resChapa) == 4 ){ 
        $pdf->Cell(190, 5, $resChapa . '                        ' . utf8_decode('M²') . '                 ' . utf8_decode('PINTURA ELETROSTATICA'), 'L,R,B', 1, 'L'); 
    }elseif(strlen($resChapa) <= 10){
        $pdf->Cell(190, 5, round($resChapa, 2) . '                        ' . utf8_decode('M²') . '                 ' . utf8_decode('PINTURA ELETROSTATICA'), 'L,R,B', 1, 'L');        
    }else{
        $pdf->Cell(190, 5, $resChapa . '                         ' . utf8_decode('M²') . '                 ' . utf8_decode('PINTURA ELETROSTATICA'), 'L,R,B', 1, 'L');
    }
}
if ($CheckPortinhola != '0') {
    $pdf->Cell(190, 5, '1                             ' . 'PC.               ' . utf8_decode('PORTINHOLA'), 'L,R,B', 1, 'L');
}
if ($CheckalcaEnrolar != '0') {
    $pdf->Cell(190, 5, '1                             ' . 'PC.               ' . utf8_decode('ALÇAPÃO DE ENROLAR'), 'L,R,B', 1, 'L');
}
if ($CheckCentral != '0') {
    $pdf->Cell(190, 5, '1                             ' . 'PC.               ' . utf8_decode('CENTRAL COM 2 CONTROLES'), 'L,R,B', 1, 'L');
}
if ($CheckBorraVedacao != '0') {
    if(strlen($lgr) == 1){
        $pdf->Cell(190, 5, $lgr . '                             ' . 'ML.               ' . utf8_decode('BORRACHA VEDAÇÃO'), 'L,R,B', 1, 'L');
    }elseif(strlen($lgr) == 2) {
        $pdf->Cell(190, 5, $lgr . '                           ' . 'ML.               ' . utf8_decode('BORRACHA VEDAÇÃO'), 'L,R,B', 1, 'L'); 
    }elseif (strlen($lgr) == 3){   
        $pdf->Cell(190, 5, $lgr . '                          ' . 'ML.               ' . utf8_decode('BORRACHA VEDAÇÃO'), 'L,R,B', 1, 'L'); 
    }elseif(strlen($lgr) == 4){ 
        $pdf->Cell(190, 5, $lgr . '                        ' . 'ML.               ' . utf8_decode('BORRACHA VEDAÇÃO'), 'L,R,B', 1, 'L');    

    }else{
        $pdf->Cell(190, 5, $lgr . '                        ' . 'ML.               ' . utf8_decode('BORRACHA VEDAÇÃO'), 'L,R,B', 1, 'L');
    }
}
if ($CheckPvcGuias != '0') {
    if(strlen($pvcGuias) == 1){
        $pdf->Cell(190, 5, $pvcGuias . '                             ' . 'ML.               ' . utf8_decode('PVC GUIAS'), 'L,R,B', 1, 'L');
    }elseif(strlen($pvcGuias) == 2) {
        $pdf->Cell(190, 5, $pvcGuias . '                           ' . 'ML.               ' . utf8_decode('PVC GUIAS'), 'L,R,B', 1, 'L');
    }elseif(strlen($pvcGuias) == 3){
        $pdf->Cell(190, 5, $pvcGuias . '                          ' . 'ML.               ' . utf8_decode('PVC GUIAS'), 'L,R,B', 1, 'L');      
    }elseif(strlen($pvcGuias) == 4){ 
        $pdf->Cell(190, 5, $pvcGuias . '                        ' . 'ML.               ' . utf8_decode('PVC GUIAS'), 'L,R,B', 1, 'L');     
    }else{
        $pdf->Cell(190, 5, $pvcGuias . '                         ' . 'ML.               ' . utf8_decode('PVC GUIAS'), 'L,R,B', 1, 'L');
    }
}
if ($CheckMkit != '0') {
    $pdf->Cell(190, 5, '1                             ' . 'PC.               ' . utf8_decode('MONTAGEM DE KIT'), 'L,R,B', 1, 'L');
}
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(190, 5, utf8_decode('VALOR DOS PRODUTOS:........................' . utf8_decode(strtoupper(strval($total)))), 0, 1, 'R');
$pdf->SetFont('Arial', 'B', 13);
$pdf->SetTextColor(220,50,50);
$pdf->Cell(190, 20, utf8_decode('SÓ TERÁ VALIDADE O ORÇAMENTO, PÓS CONSULTA COM OS CONSULTORES.'), 0, 1, 'C');
$pdf->SetTextColor(0,0,0);
$pdf->Output();

