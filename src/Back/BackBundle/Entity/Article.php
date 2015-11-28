<?php

namespace Back\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity="Commentary", inversedBy="article", cascade={"all"})
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
     * Set commentaries
     *
     * @param \Back\BackBundle\Entity\Commentary $commentaries
     *
     * @return Article
     */
    public function setCommentaries(\Back\BackBundle\Entity\Commentary $commentaries = null)
    {
        $this->commentaries = $commentaries;

        return $this;
    }

    /**
     * Get commentaries
     *
     * @return \Back\BackBundle\Entity\Commentary
     */
    public function getCommentaries()
    {
        return $this->commentaries;
    }

    public function toString() {
        return $this->getArticleTitle().' - '. $this->getArticleContent();
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
}
