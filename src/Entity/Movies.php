<?php

namespace App\Entity;


class Movies
{
   
    private $nom;

    private $realisateur;

    private $anneeProduction;

    private $nationalite;

    private $derniereDiffusion;

    private $nbDiffusion;

    private $nbPremierePartie;

    private $moyenneDiffusionParAn;

    /*
    *
    * @paramm array return data json
    *
    */
    private $data = [];


    public function getNom()
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRealisateur()
    {
        return $this->realisateur;
    }

    public function setRealisateur(string $realisateur)
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    public function getAnneeProduction()
    {
        return $this->anneeProduction;
    }

    public function setAnneeProduction(int $anneeProduction)
    {
        $this->anneeProduction = $anneeProduction;

        return $this;
    }

    public function getNationalite()
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }


     public function getDerniereDiffusion()
    {
        return $this->derniereDiffusion;
    }

    public function setDerniereDiffusion(int $derniereDiffusion)
    {
        $this->derniereDiffusion = $derniereDiffusion;

        return $this;
    }



    public function getNbDiffusion()
    {
        return $this->nbDiffusion;
    }

    public function setNbDiffusion(int $nbDiffusion)
    {
        $this->nbDiffusion = $nbDiffusion;

        return $this;
    }

    public function getNbPremierePartie()
    {
        return $this->nbPremierePartie;
    }

    public function setNbPremierePartie(int $nbPremierePartie)
    {
        $this->nbPremierePartie = $nbPremierePartie;

        return $this;
    }

    public function getMoyenneDiffusionParAn()
    {
        return $this->moyenneDiffusionParAn;
    }

    public function setMoyenneDiffusionParAn(string $moyenneDiffusionParAn)
    {
        $this->moyenneDiffusionParAn = $moyenneDiffusionParAn;

        return $this;
    }

    public function getData()
    {

      return $this->data[] = $data;
    }
}
