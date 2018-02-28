<?php

namespace App;

class Neuronio
{
	public $pesos;
	public $bias;
	
	public $iteracoes;
	public $taxa_aprendizado;
	public $max_iteracoes;

	public $acertos;
	public $limite;

	/*Construtor*/
	public function __construct($quantidadePesos)
	{
		$this->taxa_aprendizado = 1;		
		$this->bias = 0;
		$this->limite = 1;
		$this->max_iteracoes = 10;
		$this->pesos = $this->gerarPesos($quantidadePesos);
	}

	/*Função que gera os pesos randomicamente*/
	public function gerarPesos($quantidade)
	{
		$pesos = [];

		for($i = 0; $i < $quantidade; $i++)
		{
			$pesos[$i] = rand(-1, 1);
		}

		return $pesos;
	}

	/*Função que realiza a soma do produto entre os pesos e as entradas*/
	public function soma($entrada)
	{
		
		$soma = 0;
		$tamanho_pesos = count($this->pesos);

		for($i = 0; $i < $tamanho_pesos; $i++)
		{
			$soma += $entrada[$i] * $this->pesos[$i];
		}
		
		return $soma + $this->bias;
	}


	/*Função de Ativação*/
	public function ativacao($saida)
	{
		 
		if($saida > $this->limite)
        	return 1;
        
        else if($saida >= ($this->limite * -1) and $saida <= $this->limite)
            return 0;
        
        else
            return -1; 
	}

	/*Função de treinamento*/	
	public function treinamento($entradas, $respostas_esperadas)
	{
		for($i = 0; $i < $this->max_iteracoes; $i++)
		{
			$acertos = 0;

			for($x = 0; $x < count($entradas); $x++)
			{
				$soma = $this->soma($entradas[$x]);
				$sinal = $this->ativacao($soma);

				if($sinal == $respostas_esperadas[$x])
				{
					$acertos ++;
				}

				else
				{
					// echo "<br>Bias antigo {$this->bias}, ";
					for ($j = 0; $j < count($this->pesos); $j++)
					{

		            	$this->pesos[$j] = $this->pesos[$j] + ($this->taxa_aprendizado * $respostas_esperadas[$x] * $entradas[$x][$j]);
					}                
		            $this->bias = $this->bias + $this->taxa_aprendizado * $respostas_esperadas[$x];
		            // echo "Bias atualizado {$this->bias} <br>";
		            
				}


			}

			if($acertos == count($entradas))
			{
				// echo "Padrão encontrado<hr>";
				break;
			}
			else
			{
				// echo "Padrão não econtrado, voltar para o início<hr>";
			}
		}
	}

	/*Função de classificação*/
	public function classificar($entrada)
	{
		$soma = $this->soma($entrada);
		$saida = $this->ativacao($soma);
		return $saida;
	}
}