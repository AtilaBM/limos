<?php
include_once("../../../objs/objetos.php");
session_start();
include_once("../../../conexao.php");
include("../../../layout/header.php");

$query = 'SELECT * FROM `ad` WHERE id_res = ' . $_SESSION["restaurante"]->id . ';';
$result = mysqli_query($conexao, $query);
$ad_bd = mysqli_fetch_assoc($result);
$ad = new ad($ad_bd["id_ad"], $ad_bd["id_res"], $ad_bd["data_inicio_ad"], $ad_bd["data_fim_ad"], $ad_bd["status_ad"], $ad_bd["status_pag_ad"]);
$ad->id_res = $ad_bd["id_res"];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/boot.css">
    <link rel="stylesheet" href="../../../css/sbr_res/promocao/pagar.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Pagamento Promoção de Restaurante Limos</title>
</head>

<body>

    <header class="main_header">
        <div class="main_header_content">
            <div class="img_logo">
                <a href="../../sbr/index.php" class="logo">
                    <img src="../../../img/limos_vermelho.png" alt="Bem vindo ao projeto Limos" title="Bem vindo ao projeto Limos"></a>
            </div>

            <nav class="main_header_content_menu">
                <div class="menu_a_inportant">
                    <a href="../index.php" class="cadastro_menu">Voltar</a>
                </div>
            </nav>
        </div>
    </header>

    <section>
        <article class="pagamento">
            <header>
                <h1>Pagamento</h1>
            </header>
            <form action="pagar.php" method="post">
                <div class="form-content">

                    <div class="group-input">
                        <div class="group-input1">
                            <input type="text" name="nome" id="nome" required autocomplete="off" <?php $_SESSION['admres']->nomeAdmRes() ?>>
                            <input type="text" placeholder="Ensira seu CPF/CNPJ" name="cnpj" id="cnpj" required autocomplete="off" <?php $_SESSION['restaurante']->cnpj() ?>>
                        </div>
                        <div class="cartao-main">
                                <input type="text" placeholder="XXXX XXXX XXXX XXXX" name="numero" id="numero" required autocomplete="off" class="cartao" >
                            </div>
                            <div class="group-input1">


                            <input type="date" placeholder="Validade" name="validade" id="validade" required>
                            <input type="text" placeholder="CVV" name="cvv" id="cvv" required autocomplete="off" maxlength="3" minlength="3">

                        </div>

                        <div class="select-group">
                            <div class="select-group-content">
                                <select name="parcela" id="parcela" required>
                                    <option value="#" selected disabled>Parcelas</option>
                                    <option value="1"> 1x de <?php $ad->formataParcelaAd(1) ?></option>
                                    <option value="2"> 2x de <?php $ad->formataParcelaAd(2) ?></option>
                                    <option value="3"> 3x de <?php $ad->formataParcelaAd(3) ?></option>
                                    <option value="4"> 4x de <?php $ad->formataParcelaAd(4) ?></option>
                                    <option value="5"> 5x de <?php $ad->formataParcelaAd(5) ?></option>
                                    <option value="6"> 6x de <?php $ad->formataParcelaAd(6) ?></option>
                                    <option value="7"> 7x de <?php $ad->formataParcelaAd(7) ?></option>
                                    <option value="8"> 8x de <?php $ad->formataParcelaAd(8) ?></option>
                                    <option value="9"> 9x de <?php $ad->formataParcelaAd(9) ?></option>
                                    <option value="10"> 10x de <?php $ad->formataParcelaAd(10) ?></option>
                                    <option value="11"> 11x de <?php $ad->formataParcelaAd(11) ?></option>
                                    <option value="12"> 12x de <?php $ad->formataParcelaAd(12) ?></option>
                                </select>
                                <button type="submit">Concluir Pagamento</button>
                            </div>
                        </div>
                        <?php include_once("../../../avisos.php"); ?>
                    </div>
            </form>
        </article>
    </section>
    <?php include("../../../layout/footer.php"); ?>
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script>

$('#numero').on('input propertychange', function() {
  var node = $('#numero')[0]; // vanilla javascript element
  var cursor = node.selectionStart; // store cursor position
  var lastValue = $('#numero').val(); // get value before formatting
  
  var formattedValue = formatCardNumber(lastValue);
  $('#numero').val(formattedValue); // set value to formatted
  
  // keep the cursor at the end on addition of spaces
  if(cursor === lastValue.length) {
    cursor = formattedValue.length;
    // decrement cursor when backspacing
    // i.e. "4444 |" => backspace => "4444|"
    if($('#numero').attr('data-lastvalue') && $('#numero').attr('data-lastvalue').charAt(cursor - 1) == " ") {
      cursor--;
    }
  }

  if (lastValue !== formattedValue) {
    // increment cursor when inserting character before a space
    // i.e. "1234| 6" => "5" typed => "1234 5|6"
    if(lastValue.charAt(cursor) == " " && formattedValue.charAt(cursor - 1) == " ") {
      cursor++;
    }
  }
  
  // set cursor position
  node.selectionStart = cursor;
  node.selectionEnd = cursor;
  // store last value
  $('#numero').attr('data-lastvalue', formattedValue);
});

function formatCardNumber(value) {
  // remove all non digit characters
  var value = value.replace(/\D/g, '');
  var formattedValue;
  var maxLength;
  // american express, 15 digits
  if ((/^3[47]\d{0,13}$/).test(value)) {
    formattedValue = value.replace(/(\d{4})/, '$1 ').replace(/(\d{4}) (\d{6})/, '$1 $2 ');
    maxLength = 17;
  } else if((/^3(?:0[0-5]|[68]\d)\d{0,11}$/).test(value)) { // diner's club, 14 digits
    formattedValue = value.replace(/(\d{4})/, '$1 ').replace(/(\d{4}) (\d{6})/, '$1 $2 ');
    maxLength = 16;
  } else if ((/^\d{0,16}$/).test(value)) { // regular cc number, 16 digits
    formattedValue = value.replace(/(\d{4})/, '$1 ').replace(/(\d{4}) (\d{4})/, '$1 $2 ').replace(/(\d{4}) (\d{4}) (\d{4})/, '$1 $2 $3 ');
    maxLength = 19;
  }
  
  $('#numero').attr('maxlength', maxLength);
  return formattedValue;
}

// funcoes para permitir apenas numeros
 
      $("#numero").keydown(function (e) {       
	if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||        
		(e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||          
		(e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||           
		(e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||            
		(e.keyCode >= 35 && e.keyCode <= 39)) {          
			 return;
	}   
	if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		e.preventDefault();
	}
});

	$("#cnpj").keydown(function (e) {       
	if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||        
		(e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||          
		(e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||           
		(e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||            
		(e.keyCode >= 35 && e.keyCode <= 39)) {          
			 return;
	}   
	if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		e.preventDefault();
	}
});

	$("#cvv").keydown(function (e) {       
	if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||        
		(e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||          
		(e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||           
		(e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||            
		(e.keyCode >= 35 && e.keyCode <= 39)) {          
			 return;
	}   
	if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		e.preventDefault();
	}
});
    
    </script>
</body>

</html>