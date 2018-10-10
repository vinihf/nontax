<?php
	include "conexaoBanco.php";
	
	if(isset($_GET['suj'])){
		$sujeito = $_GET['suj'];
	}
	
	if(isset($_GET['obj'])){
		$objeto = $_GET['obj'];
	}
	
	if(isset($_GET['verb'])){
		$verbo = $_GET['verb'];
	}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
		</span class="corpus">
		
		<a class="home" href="index.php"> <img src="./img/home.png" alt="Retornar para a Home" title="Retornar para a Home"> </a>
		<a class="home" href=<?php echo "lstConceito.php?corp=".$_GET['corp'];?>> <img src="./img/search.png" alt="Retornar para a seleção de dados" title="Retornar para a seleção de dados"> </a>
	</div>
	
	<div id="conceitos">
	
	<!-- EXIBE SUJEITOS -->
	
	<?php
	
	if($sujeito!="viss"){
		$opcao = "sujeito";
		$palavraChave = $sujeito;
	}else if($verbo!="viss"){
		$opcao = "verbo";
		$palavraChave = $verbo;
	}else if($objeto!="viss"){
		$opcao = "objeto";
		$palavraChave = $objeto;
	}
	
		
	$query = "select distinct sujeito,verbo,objeto,freqSujeito,freqObjeto,freqAcum from relacoesfrase where corpora = ".$_GET['corp']." and ".$opcao." = '".utf8_decode($palavraChave)."'";
	
	$resultado = $conexao->query($query);
	
	echo "<table align=center class='detTabela'>
	
	<thead>";
	
	if($opcao=="sujeito"){
		echo "<tr >
			<th class='destaque tituloTabela'>Sujeito <span class='indice'>(tf-dcf)</span></th>
			<th class='tituloTabela'>Relação <span class='indice'>(Freq Acum)</span></th>
			<th class='tituloTabela'>Objeto <span class='indice'>(tf-dcf)</span></th>
		</tr>";
	}else if($opcao=="verbo"){
		echo "<tr>
			<th class='tituloTabela'>Sujeito <span class='indice'>(tf-dcf)</span></th>
			<th class='destaque tituloTabela'>Relação <span class='indice'>(Freq Acum)</span></th>
			<th class='tituloTabela'>Objeto <span class='indice'>(tf-dcf)</span></th>
		</tr>";	
	}else if($opcao=="objeto"){
	echo "<tr>
			<th class='tituloTabela'>Sujeito <span class='indice'>(tf-dcf)</span></th>
			<th class='tituloTabela'>Relação <span class='indice'>(Freq Acum)</span></th>
			<th class='destaque tituloTabela'>Objeto <span class='indice'>(tf-dcf)</span></th>
		</tr>";
	}
	echo "</thead>";
	
	
	
	
	while ($linha = $resultado->fetch_array(MYSQLI_NUM)) {
				
		echo "<tr >
			<td class='colunaTabela'><a href='detConceitos.php?corp=".$_GET['corp']."&suj=".utf8_encode($linha[0])."&obj=viss&verb=viss'>".utf8_encode($linha[0])."</a><span onmouseover=\"Tip('Índice de Frequência (tf-dcf)')\" onmouseout=\"UnTip()\"  class='indice'> (".number_format($linha[3],2,",",".").")</span></td>
			 <td class='colunaTabela'><a href='detConceitos.php?corp=".$_GET['corp']."&suj=viss&obj=viss&verb=".utf8_encode($linha[1])."'>".utf8_encode($linha[1])."</a><span onmouseover=\"Tip('Índice de Frequência Acumulada')\" onmouseout=\"UnTip()\"  class='indice'> (".number_format($linha[5],2,",",".").")</span></td>
			 <td class='colunaTabela'><a href='detConceitos.php?corp=".$_GET['corp']."&suj=viss&obj=".utf8_encode($linha[2])."&verb=viss'>".utf8_encode($linha[2])."</a> <span onmouseover=\"Tip('Índice de Frequência (tf-dcf)')\" onmouseout=\"UnTip()\"  class='indice'> (".number_format($linha[4],2,",",".").")</span></td>
			 </tr>";
	}
	
	echo "</table>";
	
	?>
	
	</div>
	
	<div id="rodape">
				Vinicius Hartmann Ferreira<br>
				Programa de Pós-Graduação em Ciência da Computação - PUCRS
		</div>
</div>
</body>
</html>