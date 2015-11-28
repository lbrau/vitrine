<?php

namespace Back\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToMany(targetEntity="Article", mappedBy="commentaries", cascade={"all"})
     */
    private $article;

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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->article = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add article
     *
     * @param \Back\BackBundle\Entity\Article $article
     *
     * @return Commentary
     */
    public function addArticle(\Back\BackBundle\Entity\Article $article)
    {
        $this->article[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \Back\BackBundle\Entity\Article $article
     */
    public function removeArticle(\Back\BackBundle\Entity\Article $article)
    {
        $this->article->removeElement($article);
    }

    /**
     * Get article
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticle()
    {
        return $this->article;
    }

    public function __toString() {
        return $this->getCommentaryTitle();
    }
}
