<?php

namespace Controllers;

use Models\Competences;

class CompetenceController extends Controller
{
  
public function list($request)
    {
      $user = $request->getUser();
      $competenceRepository = $request->getEm()->getRepository('Entity\Competence');
      $competences = $competenceRepository->findAll();
      
      if (NULL == $_SESSION){
        header('location: http://195.154.118.169/john/pcp/index.php?c=user&t=login');
      }
      
      foreach ($competences as $competence) {
         //var_dump(count($competence->getTaches()));
      }
      echo $this->twig->render('list.html',
        [
          "competences" => $competences,
          "user" =>$user,
        ]
      );
    }
}