<?php

namespace Controllers;

use Entity\User;

class UserController extends Controller
{
    public function __contruct() {
      $this->flash = [];
    }
  
    public function index ($request)
    {
        $user = $request->getUser();
        //var_dump($user);
        if (NULL == $_SESSION){
          header('location: http://195.154.118.169/john/pcp/index.php?c=user&t=login');
        }
        echo $this->twig->render('accueil.html', [
          'user' => $user,
        ]);
    }
    //Permet de créer un utilisateur
    public function create ($request)
    {
      $entityManager = $request->getEm();
      $post= $request->getPost();
      $user= new User();
      
      $user-> setName($post['name']);
      $user-> setEmail($post['email']);
      $user-> setPassword($post['password']);
      
      
      $entityManager->persist($user);
      $entityManager->flush();
        
      $this->flash[] = "A new user has been created: " . $user->Getname();
      header('location: http://195.154.118.169/john/pcp/index.php?c=user&t=login');
    }
    
    public function new ($request){
      
      $userRepository = $request->getEm()->getRepository(User::class);
      $user = $userRepository->findAll();

      echo $this->twig->render('new.html',
        [
          "user" => $user,
        ]
       );
    }
    
    public function login ($request){
      
      $userRepository = $request->getEm()->getRepository(User::class);
      $user = $userRepository->findAll();
      
      echo $this->twig->render('login.html',
        [
          "user" => $user,
          //'flash' => $flash
        ]                      
        );
    }
    // Vérification de la correspondance Login/MDP
    public function authentification ($request){
      
      $entityManager = $request->getEm();
      $post= $request->getPost();
      $get = $request->getGet();
      
      $user = $request->getEm()->getRepository(User::class)->findOneBy(["email"=> $post["email"]]);
      
      //var_dump ($post);
      
      if (NULL ==! $user && $post["email"] == $user->getEmail()){
        
          if ($post["password"] == $user->getPassword()){

            echo "Bienvenue " . $user->getName()."!";
            session_start();
            $_SESSION["id"]=$user->getID();
            header('location: http://195.154.118.169/john/pcp/index.php?c=user&t=index');
           
        
          }
          else {
            echo $this->twig->render('login.html');
            echo "Impossible de vous connecter";
          }
      }else {
        echo $this->twig->render('login.html');
        echo "Impossible de vous connecter";
      }
    }
    // Permet de fermer sa session
    public function logout($request){
      
     $_SESSION = [];
      
     session_destroy();
      
      echo $this->twig->render('login.html');
      echo "session fermée";
    }
    //Afficher la liste des utilisateurs
    public function list ($request)
    {
      $userRepository = $request->getEm()->getRepository(User::class);
      $user = $request->getUser();
      $userList = $userRepository->findAll();

      echo $this->twig->render('list.html',
        [
          "userList" => $userList,
          "user"     => $user,
          "quantity" => count($userList)
        ]
      );
    }
    public function upgrade($request)
    {
      $entityManager = $request->getEm();
      $userRepository = $request->getEm()->getRepository(User::class);
      $get = $request->getGet();
      $post = $request->getPost();

      $user= $request->getEm()->getRepository("Entity\User")->findOneBy(["id"=> $get["id"]]);
      
      $user->setAdmin(1);
        
      $entityManager->persist($user);
      $entityManager->flush();
      
        echo $this->twig->render('list.html');
        echo "Admin attribué pour ID " . $user->getId() . "\n";
    }
}