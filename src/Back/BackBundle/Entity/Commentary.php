<?php

namespace Back\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Back\BackBundle\Entity\Article;

/**
 * Commentary
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Back\BackBundle\Entity\Repository\CommentaryRepository")
 */
class Commentary
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
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="commentaries")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\Column(name="CommentaryAuthor", type="string", length=50)
     */
    private $commentaryAuthor;

    /**
     * @var string
     *
     * @ORM\Column(name="CommentaryTitle", type="string", length=50)
     */
    private $commentaryTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="CommentaryContent", type="text")
     */
    private $commentaryContent;

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
     * Set commentaryTitle
     *
     * @param string $commentaryTitle
     *
     * @return Commentary
     */
    public function setCommentaryTitle($commentaryTitle)
    {
        $this->commentaryTitle = $commentaryTitle;

        return $this;
    }

    /**
     * Get commentaryTitle
     *
     * @return string
     */
    public function getCommentaryTitle()
    {
        return $this->commentaryTitle;
    }

    /**
     * Set commentaryContent
     *
     * @param string $commentaryContent
     *
     * @return Commentary
     */
    public function setCommentaryContent($commentaryContent)
    {
        $this->commentaryContent = $commentaryContent;

        return $this;
    }

    /**
     * Get commentaryContent
     *
     * @return string
     */
    public function getCommentaryContent()
    {
        return $this->commentaryContent;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Commentary
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

    public function __toString() {
        return $this->commentaryTitle;
    }

    /**
     * Set article
     *
     * @param \Back\BackBundle\Entity\Article $article
     *
     * @return Commentary
     */
    public function setArticle(\Back\BackBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Back\BackBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set commentaryAuthor
     *
     * @param string $commentaryAuthor
     *
     * @return Commentary
     */
    public function setCommentaryAuthor($commentaryAuthor)
    {
        $this->commentaryAuthor = $commentaryAuthor;

        return $this;
    }

    /**
     * Get commentaryAuthor
     *
     * @return string
     */
    public function getCommentaryAuthor()
    {
        return $this->commentaryAuthor;
    }
}
