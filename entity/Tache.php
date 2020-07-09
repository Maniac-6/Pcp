<?php

namespace Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="tache")
 */
class Tache
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
  
    /**
    * @var string
    *
    * @ORM\Column(name="commentaire", type="string", length=255)
    */
    private $commentaire;
    
  
    /**
     * @ORM\ManyToMany(targetEntity="Competence",inversedBy="tache")
     */
    protected $competences;
  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->competences = new \Doctrine\Common\Collections\ArrayCollection();
    }
   
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Tache
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Tache
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
  
    /**
     * Set commentaire.
     *
     * @param string $commentaire
     *
     * @return Tache
     */
  
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire.
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Add competence.
     *
     * @param \Entity\Competence $competence
     *
     * @return Tache
     */
    public function addCompetence(\Entity\Competence $competence)
    {
        $this->competences[] = $competence;

        return $this;
    }

    public function removeCompetences(){
      foreach ($this->competences as $competence){
        $this->removeCompetence($competence);
      }
    }
  
    /**
     * Remove competence.
     *
     * @param \Entity\Competence $competence
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCompetence(\Entity\Competence $competence)
    {
        return $this->competences->removeElement($competence);
    }

    /**
     * Get competences.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetences()
    {
        return $this->competences;
    }
}
