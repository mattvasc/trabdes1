<?php
  class Resultado{
    private $campo_pesquisado;
    private $valor_campo;
    private $estabelecimento;

      public function __construct()
      {
      }

      public function setCampoPesquisado($campo){ /*'CNPJ' ou 'Nome Fantasia' ou 'Razão Social e etc...'*/
        $this->campo_pesquisado = $campo;
      }
      public function setValorCampo($valor){ /*123123123123 ou 'Mec Dolands' ou 'Restaurante da dona Maria' e etc*/
        $this->valor_campo = $valor;
      }
      public function setEstabelecimento($estabelecimento){ /*123123123123 ou 'Mec Dolands' ou 'Restaurante da dona Maria' e etc*/
        $this->estabelecimento = $estabelecimento;
      }
      public function getCampoPesquisado(){
        return $this->campo_pesquisado;
      }
      public function getValorCampo(){
        return $this->valor_campo;
      }
      public function getEstabelecimento(){
        return $this->estabelecimento;
      }
  }



?>
