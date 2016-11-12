<?php
  private $relacao;
  public function addRelacao(&$estabelecimento, &$categoria)  {
    if($estabelecimento and $categoria)
    {
      array_push(this->relacao, array($estabelecimento, $categoria) );
    }
  }
  public function getRelacao(){
    return $this->relacao;
  }

?>
