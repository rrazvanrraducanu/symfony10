<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FlowerRepository")
 */
class Flower
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nume;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $culoare;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $marime;
    /**
     * @ORM\Column(type="integer")
     */
    private $pret;
////////////////////////////////////////
    public function getId()
    {
        return $this->id;
    }
    public function getNume()
    {
        return $this->nume;
    }
    public function getCuloare()
    {
        return $this->culoare;
    }
    public function getMarime()
    {
        return $this->marime;
    }
    public function getPret()
    {
        return $this->pret;
    }
    /////////////////////////////////////////////
    public function setId($id)
    {
        return $this->id=$id;
    }
    public function setNume($nume)
    {
        return $this->nume=$nume;
    }
    public function setCuloare($culoare)
    {
        return $this->culoare=$culoare;
    }
    public function setMarime($marime)
    {
        return $this->marime=$marime;
    }
    public function setPret($pret)
    {
        return $this->pret=$pret;
    }
}
