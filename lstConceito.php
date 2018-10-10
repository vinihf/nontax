<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<title> Relações Não-Taxonômicas </title>
</head>
<body>

<script type="text/javascript" src="wz_tooltip.js"></script>
<div id="container">
	
	<div id="cabecalho">
		Aplicativo * Relações Não-Taxonômicas
	<span class="corpus">
		<?php 
			if($_GET['corp']==1){
				echo " - (Geologia)";
			}else if($_GET['corp']==2){
				echo " - (Estocástico)";
			}else if($_GET['corp']==3){
				echo " - (Processamento Paralelo)";
			}else if($_GET['corp']==4){
				echo " - (Mineração de Dados)";
			}else if($_GET['corp']==5){
				echo " - (Pediatria)";
			}
	
		?>
		
		</span>

		<a class="home" href="index.php"> <img src="./img/home.png" alt="Retornar para a Home" title="Retornar para a Home"> </a>
		
	</div>

	<div id="opcoes">
		
		<?php
			
			if(!isset($_GET['opcoes'])){
			
		?>

		<form action="lstConceito.php">
			Selecione os dados que deseja visualizar:<br>
			<select name="opcoes">
				<option value="sujeito">Sujeito
				<option value="verbo">Relação
				<option value="objeto">Objeto
			</select>
			<?php
			echo "<input type=hidden name='corp' value=".$_GET['corp'].">";
			?>
			<input type="submit" value="Exibir">
		</form>

		<?php
			}else{
				include 'conexaoBanco.php';
		?>
			<form action="lstConceito.php">
			Selecione os dados que deseja visualizar:<br>
			<select name="opcoes">
		<?php
				if($_GET['opcoes']=='sujeito'){
					echo '<option value="sujeito" selected>Sujeito';
				}else{
					echo '<option value="sujeito" >Sujeito';
				}
				if($_GET['opcoes']=='verbo'){
					echo '<option value="verbo" selected>Relação';
				}else{
					echo '<option value="verbo" >Relação';
				}
				if($_GET['opcoes']=='objeto'){
					echo '<option value="objeto" selected>Objeto';
				}else{
					echo '<option value="objeto" >Objeto';
				}
		?>
			</select>
			<?php echo "<input type=hidden name='corp' value=".$_GET['corp'].">";?>
			<input type="submit" value="Exibir">
		</form>
		
		<?php
			if(!isset($_GET['letra'])){
				$letra = 'TODOS';
			}else{
				$letra = $_GET['letra'];
			}
			
			$opcao = $_GET['opcoes'];
			$alfabeto = array('TODOS', 'MAIOR FREQUENCIA','MENOR FREQUENCIA','A','B','C','D','E','F','G','H','I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
			
			
			//Exibe Conceitos
			?>Classifique os dados de acordo com a letra inicial:<br><?php
				foreach($alfabeto as $let){
					
					echo "| <a href='lstConceito.php?corp=".$_GET['corp']."&opcoes=".$opcao."&letra=".$let."'> ".$let." </a>";
					
				}
				echo "|";
			?></div><?php
				
				if($letra=='TODOS'){
					
					if($opcao=="sujeito"){
						$resultado = $conexao->query("SELECT distinct ".$opcao.",freqSujeito FROM relacoesfrase where corpora = ".$_GET['corp']." order by ".$opcao);	
					}else if($opcao=="objeto"){
						$resultado = $conexao->query("SELECT distinct ".$opcao.",freqObjeto FROM relacoesfrase where corpora = ".$_GET['corp']." order by ".$opcao);
					}else if($opcao=="verbo"){
						$resultado = $conexao->query("SELECT distinct ".$opcao.",freqAcum FROM relacoesfrase where corpora = ".$_GET['corp']." order by ".$opcao);
					}
				}else if($letra=="MAIOR FREQUENCIA"){
					
					if($opcao=="sujeito"){

						$resultado = $conexao->query("SELECT distinct ".$opcao.", freqSujeito FROM relacoesfrase where corpora = ".$_GET['corp']." order by freqSujeito DESC");
					
					}else if($opcao=="objeto"){
						$resultado = $conexao->query("SELECT distinct ".$opcao." ,freqObjeto FROM relacoesfrase where corpora = ".$_GET['corp']." order by freqObjeto DESC");
					
					}else if($opcao=="verbo"){
						
						$resultado = $conexao->query("SELECT distinct ".$opcao." ,freqAcum,freqCompart FROM relacoesfrase where corpora = ".$_GET['corp']." order by freqAcum DESC, freqCompart DESC");
					}
				
				}else if($letra=="MENOR FREQUENCIA"){
				
					if($opcao=="sujeito"){

						$resultado = $conexao->query("SELECT distinct ".$opcao." , freqSujeito FROM relacoesfrase where corpora = ".$_GET['corp']." order by freqSujeito ASC");
					
					}else if($opcao=="objeto"){
						$resultado = $conexao->query("SELECT distinct ".$opcao." ,freqObjeto FROM relacoesfrase where corpora = ".$_GET['corp']." order by freqObjeto ASC");
					
					}else if($opcao=="verbo"){
						
						$resultado = $conexao->query("SELECT distinct ".$opcao." ,freqAcum,freqCompart FROM relacoesfrase where corpora = ".$_GET['corp']." order by freqAcum ASC, freqCompart ASC");
					}
				
				}else{
					
					if($opcao=="sujeito"){
							$resultado = $conexao->query("SELECT distinct ".$opcao." ,freqSujeito FROM relacoesfrase WHERE corpora = ".$_GET['corp']." AND ".$opcao." like '".$letra."%' order by ".$opcao);
					}else if($opcao=="verbo"){
							$resultado = $conexao->query("SELECT distinct ".$opcao." ,freqAcum FROM relacoesfrase WHERE corpora = ".$_GET['corp']." AND ".$opcao." like '".$letra."%' order by ".$opcao);
					}else if($opcao=="objeto"){
							$resultado = $conexao->query("SELECT distinct ".$opcao." ,freqObjeto FROM relacoesfrase WHERE corpora = ".$_GET['corp']." AND ".$opcao." like '".$letra."%' order by ".$opcao);
					}
					
				
				}

			echo "<div id='conceitos'>";
				echo "<table>";
				
				while ($linha = $resultado->fetch_array(MYSQLI_NUM)) {
					
					if($opcao=="sujeito"){
						
						echo "<tr><td><a href='detConceitos.php?corp=".$_GET['corp']."&suj=".utf8_encode($linha[0])."&verb=viss&obj=viss'>".utf8_encode($linha[0])."</a><span onmouseover=\"Tip('Índice de Frequência (tf-dcf)')\" onmouseout=\"UnTip()\" class='indice'>(".number_format($linha[1],2,",",".").")</span></td></tr>";
					
					}
					elseif($opcao=="objeto"){
						
						echo "<tr><td><a href='detConceitos.php?corp=".$_GET['corp']."&suj=viss&verb=viss&obj=".utf8_encode($linha[0])."'>".utf8_encode($linha[0])."</a><span onmouseover=\"Tip('Índice de Frequência (tf-dcf)')\" onmouseout=\"UnTip()\" class='indice'>(".number_format($linha[1],2,",",".").")</span></td></tr>";
					
					}
					elseif($opcao=="verbo"){
						
						echo "<tr><td><a href='detConceitos.php?corp=".$_GET['corp']."&suj=viss&verb=".utf8_encode($linha[0])."&obj=viss'>".utf8_encode($linha[0])."</a><span onmouseover=\"Tip('Índice de Frequência (tf-dcf)')\" onmouseout=\"UnTip()\" class='indice'>(".number_format($linha[1],2,",",".").")</span></td></tr>";
					
					}
				}
				echo "</table>";

				mysqli_free_result($resultado);
			
			echo "</div>";
			?>
			<div id="rodape">
				Vinicius Hartmann Ferreira<br>
				Programa de Pós-Graduação em Ciência da Computação - PUCRS
			</div>
			
			<?php
			
		}
		
			
		?>
	</div>
</div>

</body>


</html>