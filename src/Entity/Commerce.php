<?php

namespace App\Entity;

use App\Repository\CommerceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommerceRepository::class)
 */
class Commerce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="nom_du_commerce",type="string", length=250)
     */
    private $nom_du_commerce;

    /**
     * @ORM\Column(name="adresse",type="string", length=250)
     */
    private $adresse;

    /**
     * @ORM\Column(name="code_postal",type="string", length=250)
     */
    private $code_postal;

    /**
     * @ORM\Column(name="type_de_commerce",type="string", length=250)
     */
    private $type_de_commerce;

    /**
     * @ORM\Column(name="fabrique_a_paris",type="string", length=250)
     */
    private $fabrique_a_paris;

    /**
     * @ORM\Column(name="services",type="string", length=250)
     */
    private $services;

    /**
     * @ORM\Column(name="description",type="string", length=250)
     */
    private $description;

    /**
     * @ORM\Column(name="precisions",type="string", length=250)
     */
    private $precisions;

    /**
     * @ORM\Column(name="site_internet",type="string", length=250)
     */
    private $site_internet;

    /**
     * @ORM\Column(name="telephone",type="string", length=250)
     */
    private $telephone;

    /**
     * @ORM\Column(name="mail",type="string", length=250)
     */
    private $mail;

    /**
     * @ORM\Column(name="geo_shape",type="string", length=250)
     */
    private $geo_shape;

    /**
     * @return mixed
     */
    public function getNomDuCommerce()
    {
        return $this->nom_du_commerce;
    }

    /**
     * @param mixed $nom_du_commerce
     */
    public function setNomDuCommerce($nom_du_commerce): void
    {
        $this->nom_du_commerce = $nom_du_commerce;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * @param mixed $code_postal
     */
    public function setCodePostal($code_postal): void
    {
        $this->code_postal = $code_postal;
    }

    /**
     * @return mixed
     */
    public function getTypeDeCommerce()
    {
        return $this->type_de_commerce;
    }

    /**
     * @param mixed $type_de_commerce
     */
    public function setTypeDeCommerce($type_de_commerce): void
    {
        $this->type_de_commerce = $type_de_commerce;
    }

    /**
     * @return mixed
     */
    public function getFabriqueAParis()
    {
        return $this->fabrique_a_paris;
    }

    /**
     * @param mixed $fabrique_a_paris
     */
    public function setFabriqueAParis($fabrique_a_paris): void
    {
        $this->fabrique_a_paris = $fabrique_a_paris;
    }

    /**
     * @return mixed
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param mixed $services
     */
    public function setServices($services): void
    {
        $this->services = $services;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrecisions()
    {
        return $this->precisions;
    }

    /**
     * @param mixed $precisions
     */
    public function setPrecisions($precisions): void
    {
        $this->precisions = $precisions;
    }

    /**
     * @return mixed
     */
    public function getSiteInternet()
    {
        return $this->site_internet;
    }

    /**
     * @param mixed $site_internet
     */
    public function setSiteInternet($site_internet): void
    {
        $this->site_internet = $site_internet;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getGeoShape()
    {
        return $this->geo_shape;
    }

    /**
     * @param mixed $geo_shape
     */
    public function setGeoShape($geo_shape): void
    {
        $this->geo_shape = $geo_shape;
    }

    /**
     * @return mixed
     */
    public function getGeoPoint2d()
    {
        return $this->geo_point_2d;
    }

    /**
     * @param mixed $geo_point_2d
     */
    public function setGeoPoint2d($geo_point_2d): void
    {
        $this->geo_point_2d = $geo_point_2d;
    }

    /**
     * @ORM\Column(name="geo_point_2d",type="string", length=250)
     */
    private $geo_point_2d;

    public function getId(): ?int
    {
        return $this->id;
    }
}
