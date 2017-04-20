<?php

namespace FloBundle\Entity;

/**
 * Galerie
 */
class Galerie
{
    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $contenu;

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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Galerie
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set image
     *
     * @param \FloBundle\Entity\Image $image
     *
     * @return Galerie
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
