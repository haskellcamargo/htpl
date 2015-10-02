<?php

namespace HTPL {
  use \Exception;

  class Parser {
    private $ast;

    public function __construct($source) {
      $this->ast = simplexml_load_string($source);
      if ($this->ast === false) {
        $messages = [];

        foreach (libxml_get_errors() as $error) {
          $messages[] = $error;
        }

        throw new Exception(join($messages));
      }
    }

    public function getAst() {
      return $this->ast;
    }
  }
}
