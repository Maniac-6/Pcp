<?php
namespace Entity;

class Request 
{
  
    private $get;
    private $post;
    private $em;
    private $user;
    
    public function setEm($em) 
    {
      $this->em = $em;
    }
    
    public function getEm() 
    {
      return $this->em;
    }
  
    public function setPost($post)
    {
      $this->post= $post;
    }
    
    public function getPost() {
      return $this->post;
    }
   
    public function setGet($get){
      $this->get= $get;
    }
   
    public function getGet(){
      return $this->get;
    }
  
    public function setUser($user){
      $this->user=$user;
    }
  
    public function getUser(){
      return $this->user;
    }

}