<?php

namespace MamuzContentManager\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 * @ORM\Entity
 * @ORM\Table(name="MamuzPage")
 * @Annotation\Name("page")
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Annotation\Exclude()
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options": {"min":"1", "max":"255"}})
     * @Annotation\Options({"label":"Name"})
     * @Annotation\Required()
     * @var string
     */
    private $path;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"Alnum", "options": {"allowWhiteSpace":"false"}})
     * @Annotation\Validator({"name":"StringLength", "options": {"min":"1", "max":"255"}})
     * @Annotation\Options({"label":"Title"})
     * @var string
     */
    private $title = '';

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"Alnum", "options": {"allowWhiteSpace":"false"}})
     * @Annotation\Validator({"name":"StringLength", "options": {"max":"255"}})
     * @Annotation\Options({"label":"Description"})
     * @var string
     */
    private $description = '';

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Options({"label":"Content"})
     * @var string
     */
    private $content = '';

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @Annotation\Filter({"name":"Boolean"})
     * @Annotation\Options({"label":"Publish"})
     * @var bool
     */
    private $published = false;

    /**
     * destroy identity
     */
    public function __clone()
    {
        $this->id = null;
        $this->path = null;
    }

    /**
     * @param int $id
     * @return Page
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $path
     * @return Page
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $title
     * @return Page
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $description
     * @return Page
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $content
     * @return Page
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param boolean $published
     * @return Page
     */
    public function setPublished($published)
    {
        $this->published = $published;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isPublished()
    {
        return $this->published;
    }
}
