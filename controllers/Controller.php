<?php

namespace Controllers;

use \Twig_Loader_Filesystem;
use \Twig_Environment;

class Controller
{
    protected $twig;

    function __construct()
    {
      //var_dump($_SESSION["id"]);
      $className = substr(get_class($this), 12, -10);
      // Twig Configuration
      // echo $className;
      if ($className) {
        $path=strtolower($className);
      }
      else {
        $path="";
      }
      //die($path);
      //Charge la page Twig correspondante a la requete url
      $loader= new Twig_Loader_Filesystem('./views/' .$path);
      $loader->addPath('./views');
      /*$loader = new \Twig\Loader\ArrayLoader([
        'base.html.twig' => '{% block content %}{% endblock %}',
        ]);*/
      /*$loader= new \Twig\Loader\ArrayLoader([
        'base.html.twig'  => "./views/templates",
        'login.html' => ("./views/".$path),
        'list.html'  => ("./views/".$path),
        'accueil.html' =>("./views/".$path),
        'index.html' => '{% extends "base.html" %}{% block content %} {% endblock %}',
      ]);*/
      //renvoi un tableau de debug & cache
      $this->twig = new Twig_Environment($loader, array(
          'debug' => true,
          'cache' => false,
      ));
      $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }

}