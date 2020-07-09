<?php


namespace Controllers;

use Entity\Tache;
use Entity\Competence;

class TacheController extends Controller
{
  
  public function list($request)
    {
      $user = $request->getUser();
      $competence = $request->getEm()->getRepository("Entity\Competence")->findAll();
      $tacheRepository = $request->getEm()->getRepository(Tache::class);
      $taches = $tacheRepository->findAll();

      if (NULL == $_SESSION){
        header('location: http://195.154.118.169/john/pcp/index.php?c=user&t=login');
      }
    
      echo $this->twig->render('list.html',
        [
          "user" =>$user,
          "taches" => $taches,
          "competence" =>$competence,
        ]
      );
    }
  public function edit($request){
    $user = $request->getUser();
    $get = $request->getGet();
    //var_dump ($get);
    $tache = $request->getEm()->getRepository("Entity\Tache")->findOneBy(["id"=> $get["id"]]);
    $competences = $request->getEm()->getRepository("Entity\Competence")->findAll();
    
    echo $this->twig->render('edit.html',
        [
          "user" =>$user,
          "tache" => $tache,
          "competences" =>$competences,
        ]
      );
  }
  public function update($request){
    
    $entityManager = $request->getEm();
    $post = $request->getPost();
    $get = $request->getGet();
    $tache = $request->getEm()->getRepository("Entity\Tache")->findOneBy(["id"=> $get["id"]]);
    //$tache->removeCompetence($competence);
    //var_dump ($get['id']);
    //var_dump ($tache->getDescription());die;
    $tache->setDescription($post['description']);
    $tache->setDate(new \DateTime($post['date']));
    $tache->setCommentaire($post['commentaire']);
    
    $tache->removeCompetences();
    //var_dump($post['competences']);die;
    foreach ($post['competences'] as $competence_id){
         //var_dump( $competence_id);
      $competence = $entityManager->getRepository(Competence::class)->find($competence_id);
      $tache->addCompetence($competence);
      
    }
    $entityManager->persist($tache);
    $entityManager->flush();
    //var_dump($request->getPost()['competences']);die;
    
    echo $this->twig->render('new.html');
    echo "updated Tache with ID " . $tache->getId() . "\n";
    /*die('create');*/
    
  }
  public function new($request){
    $user = $request->getUser();
    $tache = new Tache();
    $competences = $request->getEm()->getRepository("Entity\Competence")->findAll();
    
    echo $this->twig->render('new.html',
        [
          "user" =>$user,
          "tache" => $tache,
          "competences" =>$competences,
        ]
      );
  }
  
  public function create($request){
    //var_dump("plop",$request->getPost(),$request->getGet());die;
    
    $entityManager = $request->getEm();
    $post= $request->getPost();
    $tache = new Tache();
    $dt=new \Datetime($post['date']);
    
    
    $tache->setDescription($post['description']);
    $tache->setDate($dt);
    $tache->setCommentaire($post['commentaire']);
    
    foreach ($post['competences'] as $competence_id){
         //var_dump( $competence_id);
      $competence = $entityManager->getRepository(Competence::class)->find($competence_id);
      $tache->addCompetence($competence);
      
    }
    //var_dump($request->getPost()['competences']);die;
    $entityManager->persist($tache);
    $entityManager->flush();
    echo $this->twig->render('new.html');
    echo "Created Tache with ID " . $tache->getId() . "\n";
    /*die('create');*/
  }
  
  public function remove($request){
    $entityManager = $request->getEm();
    $get = $request->getGet();
    $id = $get["id"];

    $tache = $entityManager->getRepository("Entity\Tache")->find($id);
    
    $entityManager->remove($tache);
    $entityManager->flush();
    
    echo $this->twig->render('list.html');
    echo "Tache deleted" . $tache->getId() . "\n";
  }
}