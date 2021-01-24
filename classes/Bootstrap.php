<?php

class Bootstrap{
  private $controller;
  private $action;
  private $request;

  /* We want this function to be loaded
  at the time the class is instanciate
  That's why be use __construct. The
  request will come in the URL of the
  page */
  public function __construct($request){
    $this->request = $request;
    if($this->request['controller'] == ""){
      /* If there is not request in the URL
      the w send the page to home page */
      $this->controller = 'home';
    } else{
      /* If there is a request then send the
      user to the page */
      $this->controller = $this->request['controller'];
    }
    if($this->request['action'] == ""){
      $this->action = 'index';
    } else{
      $this->action = $this->request['action'];
    }

    //Test check
    /* This should give you the word home */
    echo $this->controller;
  }

  /* This will instanciate what ever
  controller is typw in the URL */
  public function createController(){
    // Check class
    if (class_exists($this->controller)){
      $parents = class_parents($this->controller);
      // Check Extend
      If(in_array("controller", $parents)){
        if(method_exists($this->controller, $this->action)){
          return new $this->controller($this->action, $this->request);
        } else{
          // Method Does Not Exist
          echo '<h1>Method does not exist</h1>';
          return;
        }
      } else {
        // Base Controller Does Not Exist
        echo '<h1>Basse controller not found</h1>';
        return;
      }
    } else {
      // Controller Class Does Not Exist
      echo '<h1>Controller class does not exist</h1>';
      return;
    }
  }
}
