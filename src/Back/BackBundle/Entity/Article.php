<?php

namespace Back\BackBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Back\BackBundle\Entity\Commentary;


/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Back\BackBundle\Entity\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="articles", cascade={"all"})
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="article", cascade={"all"})
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="Commentary", mappedBy="article")
     */
    private $commentaries;

    /**
     * @var string
     *
     * @ORM\Column(name="ArticleTitle", type="string", length=50)
     */
    private $articleTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="ArticleContent", type="text")
     */
    private $articleContent;

    /**
     * @var string
     *
     * @ORM\Column(name="articlePicture", type="string", length=255)
     */
    private $articlePicture;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commentaries = new ArrayCollection();
    }

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
     * Set articleTitle
     *
     * @param string $articleTitle
     *
     * @return Article
     */
    public function setArticleTitle($articleTitle)
    {
        $this->articleTitle = $articleTitle;

        return $this;
    }

    /**
     * Get articleTitle
     *
     * @return string
     */
    public function getArticleTitle()
    {
        return $this->articleTitle;
    }

    /**
     * Set articleContent
     *
     * @param string $articleContent
     *
     * @return Article
     */
    public function setArticleContent($articleContent)
    {
        $this->articleContent = $articleContent;

        return $this;
    }

    /**
     * Get articleContent
     *
     * @return string
     */
    public function getArticleContent()
    {
        return $this->articleContent;
    }

    /**
     * Set articlePicture
     *
     * @param string $articlePicture
     *
     * @return Article
     */
    public function setArticlePicture($articlePicture)
    {
        $this->articlePicture = $articlePicture;

        return $this;
    }

    /**
     * Get articlePicture
     *
     * @return string
     */
    public function getArticlePicture()
    {
        return $this->articlePicture;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Article
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set author
     *
     * @param \Back\BackBundle\Entity\User $author
     *
     * @return Article
     */
    public function setAuthor(\Back\BackBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Back\BackBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set categories
     *
     * @param \Back\BackBundle\Entity\Category $categories
     *
     * @return Article
     */
    public function setCategories(\Back\BackBundle\Entity\Category $categories = null)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return \Back\BackBundle\Entity\Category
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add commentary
     *
     * @param \Back\BackBundle\Entity\Commentary $commentary
     *
     * @return Article
     */
    public function addCommentary(\Back\BackBundle\Entity\Commentary $commentary)
    {
        $this->commentaries[] = $commentary;

        return $this;
    }

    /**
     * Remove commentary
     *
     * @param \Back\BackBundle\Entity\Commentary $commentary
     */
    public function removeCommentary(\Back\BackBundle\Entity\Commentary $commentary)
    {
        $this->commentaries->removeElement($commentary);
    }

    /**
     * Get commentaries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaries()
    {
        return $this->commentaries;
    }
}
