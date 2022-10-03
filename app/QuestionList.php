<?php
namespace algo;
class QuestionList{
  public $questionlist = [];
  public function __construct($questionlist =[]){
     $this->questionlist = $questionlist;
  }
  // lấy tên file và xử lý file
  public function parse($path){
    $file = file_get_contents($path);
    $questionrm = $file;
      $arrayQuestions =explode("######",$questionrm);
      array_shift($arrayQuestions);
      foreach($arrayQuestions as $key=>$val){ 
        [$question,$answer] = explode("####",$val);
        $this->questionlist[] = new Question($question,$answer);
      };
  }
  // hiển thị toàn bộ câu hỏi đã lấy từ file questions.md
  public function all(){
    $qlist =$this->questionlist;
    if($qlist!=Null){
      dump($qlist);
    }else{
      return 'nothing to show';
    }

  }
}