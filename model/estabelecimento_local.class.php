<?php
  private $relacao;
  public function addRelacao(&$estabelecimento, &$local)  {
    if($estabelecimento and $local)
    {
      array_push(this->relacao, array($estabelecimento, $local) );
    }
  }
  public function getRelacao(){
    return $this->relacao;
  }

?>
