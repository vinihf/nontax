<?php
		
		include "conexaoBanco.php";
		
		echo "############################################";
		echo "-------INICIANDO LEITURA DE ARQUIVO---------";
		
		$arquivo = file('C:\\Users\\Vinicius Ferreira\\Desktop\\RelacoesPorFrase.csv'); 
		$relacoes = array();

		if ( ! empty( $arquivo ) )
		{
			foreach ( $arquivo as $linha ) 
			{
				$conteudoSeparado = explode( ';', $linha );

				if ( isset( $conteudoSeparado[0], $conteudoSeparado[1], $conteudoSeparado[2],$conteudoSeparado[3],$conteudoSeparado[4],$conteudoSeparado[5],$conteudoSeparado[6],$conteudoSeparado[7]) )
				{
					/*$sujeito = strtr(strtolower($conteudoSeparado[0]),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞ‗","אבגדהוזחטיךכלםמןנסעףפץצקרשüת‏ÿ");
					$verbo= strtr(strtolower($conteudoSeparado[2]),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞ‗","אבגדהוזחטיךכלםמןנסעףפץצקרשüת‏ÿ");
					$objeto= strtr(strtolower($conteudoSeparado[3]),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞ‗","אבגדהוזחטיךכלםמןנסעףפץצקרשüת‏ÿ");*/
					
					$sujeito = $conteudoSeparado[0];
					$verbo= $conteudoSeparado[2];
					$objeto= $conteudoSeparado[3];
					
					$freqSujeito = str_replace(',','.',$conteudoSeparado[1]);
					$freqObjeto = str_replace(',','.',$conteudoSeparado[4]);
					$freqAcum = str_replace(',','.',$conteudoSeparado[5]);
					$freqCompart = str_replace(',','.',$conteudoSeparado[6]);
					$freqRel = str_replace(',','.',$conteudoSeparado[7]);

					
						$relacoes[] = array('sujeito' => $sujeito,'verbo' => $verbo,'objeto' => $objeto,'freqSujeito' => $freqSujeito, 'freqObjeto' => $freqObjeto, 'freqAcum' => $freqAcum, 'freqCompart' => $freqCompart, 'freqRel' => $freqRel);

				}
			}
		}
		
		foreach($relacoes as $relacao){
			$query = "INSERT INTO `relacoesfrase` (sujeito, verbo, objeto,freqSujeito,freqObjeto,freqAcum,freqCompart,freqRel,corpora) VALUES ('".$relacao['sujeito']."','".$relacao['verbo']."','".$relacao['objeto']."',".$relacao['freqSujeito']." , ".$relacao['freqObjeto']." , ".$relacao['freqAcum']." , ".$relacao['freqCompart']." , ".$relacao['freqRel'].",5 );";
			echo $query;
			mysql_query($query,$conexao);
		}
		
		echo "fim";
		
		?>