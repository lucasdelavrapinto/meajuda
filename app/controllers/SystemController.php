<?php

class SystemController extends Controller {

  public function listas()
  {
    $query = Conta::get();
    return $query;
  }

}
