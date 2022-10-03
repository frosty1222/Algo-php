<?php
namespace algo;
class Question {
   public $question;
   public $answer;
   public function __construct($question,$answer){
      $this->question = $question;
      $this->answer = $answer;
   }
}
?>