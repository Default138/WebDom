<?php

class Link {
    private string $LinkImg;
    private string $info;

    public function __construct(string $LinkImg, string $info)
    {
        $this->LinkImg = $LinkImg;
        $this->info = $info;
    }

    /**
     * Get the value of LinkImg
     */
    public function getLinkImg(): string
    {
        return $this->LinkImg;
    }

    /**
     * Set the value of LinkImg
     */
    public function setLinkImg(string $LinkImg): self
    {
        $this->LinkImg = $LinkImg;

        return $this;
    }

    /**
     * Get the value of info
     */
    public function getInfo(): string
    {
        return $this->info;
    }

    /**
     * Set the value of info
     */
    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }
}

