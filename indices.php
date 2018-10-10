<html>

<head>
	<link rel="stylesheet" type="text/css" href="estilo2.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title> Relações Não-Taxonômicas </title>
</head>

<body>
	
	<div id="container">
		
		<div id="cabecalho">
			Aplicativo * Relações Não-Taxonômicas
		</div>
		
		<div id="menu">
				<a href="index.php"> Home </a> |
				<a href="uso.php"> Informações de Uso </a> |
				<a href="publicacao.php"> Publicações </a> |
				<a href="autores.php"> Autores </a> |
		</div>
		
		<div id="conteudo">

			<p>	Índice de Relevância </p>
			
			As relações estão classificadas de acordo com o <u>índice de Frequência Acumulada</u>: Esse índice é calculado através da soma da frequência (tf-dcf) 
			de todos os termos (sujeitos e objetos) envolvidos em uma relação (verbo).<br><br>
			Cabe salientar que o índice tf-dcf utiliza-se de outros corpora contrastantes na realização de seu cálculo, por isso, sempre que a casa decimal 
			da frequência obtida for diferente de zero (0), indica que esse termo apareceu também em pelo menos um outro corpus. 
			<br><br>
			Para esse trabalho foram utilizados os 5 corpora: Pediatria, Geologia,Mineração de Dados, Modelagem Estocastica e Processamento Paralelo.
			Para o cálculo do tf-dcf dos termos de cada um desses corpora foram utilizados os outros quatro como corpora contrastantes.
			<br><br>
			<b>Exemplo da frequência acumulada:</b><br><br>
			
			<table align="center">
			<tr>
				<td><b>sujeito</b></td><td><b>relação</b></td><td><b>objeto</b></td>
			</tr>
			<tr><td>lactente (114,00)</td><td>recebe (167,50)</td> <td>estimulação (11,00)</td></tr>    
			<tr><td>leucemia (14,50)</td><td>recebe (167,50)</td><td>quimioterapia (28,00)</td></tr>
			</table>
			<br>
		Nesse exemplo, uma lista organizada pelo índice tf-dcf dos termos, do mais relevante ao menos relevante, ficaria:
		<br><br>
		<table align="center">
		<tr><td>lactente</td><td>114,00</td></tr>
		<tr><td>quimioterapia</td><td>28,00</td></tr>
		<tr><td>leucemia</td><td>14,50</td><td>(o termo leucemia apareceu também em outro corpora)</td></tr>  
		<tr><td>estimulação</td><td>11,00</td></tr>
		</table><br>
		Esses 4 termos estão relacionados pelo verbo "receber", dessa forma a soma, ou seja, a frequência aculumada da relação "receber" é de <b>167,50</b> (114,00+28,00+14,50+11,00)<br>
		<br>
		A ideia é que quanto maior for a frequência acumulada, mais relevante é essa relação, podendo ser relevante porque relaciona termos mais relevantes, ou relevante por possuir muitas ocorrências do verbo.<br><br>
		
		Os conceitos (sujeito e objeto) por sua vez são ordenados através do índice tf-dcf obtido no processo de extração de conceitos realizado pela ferramenta <a href="http://www.inf.pucrs.br/~ontolp/exato.php" target="_blank"> ExATOlp </a> <a href="http://www.youtube.com/watch?v=2LbpdpL3aLQ" target="_blank"> (demo) </a>.
			<br>
			<br>
			<a href="uso.php">voltar</a>
		</div>
		
		<div id="rodape">
				Vinicius Hartmann Ferreira<br>
				Programa de Pós-Graduação em Ciência da Computação - PUCRS
		</div>
	
	</div>
	

</body>

</html>