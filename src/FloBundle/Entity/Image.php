<?php

namespace FloBundle\Entity;


/**
 * Image
 */
class Image
{
    /**
     * @var array
     */
    private $urls = array();


    /**
     * Set urls
     *
     * @param array $urls
     *
     * @return Image
     */
    public function setUrls($urls)
    {
        foreach ($urls as $url){
            array_push($this->urls, $url);
        }
        return $this;
    }

    /**
     * Get urls
     *
     * @return array
     */
    public function getUrls()
    {
        $urls = array();
        foreach ($this->urls as $url){
            array_push($urls, $url);
        }
        return $urls;
    }

    public $files;

    protected function getUploadDir()
    {
        return 'uploads/images';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }


    public function upload($files)
    {
        if ($files){
            foreach($files as $file)
            {
                $url = uniqid() . "." . $file->guessExtension();
                array_push($this->urls, $url);
                $file->move($this->getUploadRootDir(), $url);
                unset($file);
            }
        }
    }


    public function removeUpload($files)
    {
        if (gettype($files) == 'array'){
            foreach ($files as $file){
                if ($file = $this->getUploadRootDir().'/'.$file) {
                    unlink($file);
                }
            }
        }
        else{
            if (false !== $key = array_search($files, $this->urls, true)) {
                unset($this->urls[$key]);
                $this->urls = array_values($this->urls);
                unlink($this->getUploadRootDir().'/'.$files);
            }
        }

    }

    // GENERATED CODE //

   
    /**
     * @var integer
     */
    private $id;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


}
