<?php

namespace FloBundle\Entity;

/**
 * Cours
 */
class Cours
{
    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \FloBundle\Entity\Categorie
     */
    private $categorie;

    /**
     * @var \FloBundle\Entity\Image
     */
    private $image;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set categorie
     *
     * @param \FloBundle\Entity\Categorie $categorie
     *
     * @return Cours
     */
    public function setCategorie(\FloBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \FloBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set image
     *
     * @param \FloBundle\Entity\Image $image
     *
     * @return Cours
     */
    public function setImage(\FloBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \FloBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}
