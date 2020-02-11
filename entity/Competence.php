<?php

namespace Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="competence")
 */
class Competence
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=50, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="lib", type="string", length=255)
     */
    private $lib;
  
     /**
     * @ORM\ManyToMany(targetEntity="Tache",mappedBy="competences")
     */
    protected $taches;
    
    public function __toString() {
      return $this->lib;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Competence
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set lib
     *
     * @param string $lib
     *
     * @return Competence
     */
    public function setLib($lib)
    {
        $this->lib = $lib;

        return $this;
    }

    /**
     * Get lib
     *
     * @return string
     */
    public function getLib()
    {
        return $this->lib;
    }
    /**
     * Add tach.
     *
     * @param \Entity\Tache $tach
     *
     * @return Competence
     */
    public function addTache(\Entity\Tache $tache)
    {
        $this->taches[] = $tache;

        return $this;
    }

    /**
     * Remove tach.
     *
     * @param \Entity\Tache $tach
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTache(\Entity\Tache $tache)
    {
        return $this->taches->removeElement($tache);
    }

    /**
     * Get taches.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTaches()
    {
        return $this->taches;
    }
}
