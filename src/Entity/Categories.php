<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="full_url_UNIQUE", columns={"full_url"})},
 *     indexes={
 *     @ORM\Index(name="full_search_map",columns={"active", "deleted", "end_time", "start_time", "site_map"}),
 *     @ORM\Index(name="cat_deleted", columns={"deleted"}),
 *     @ORM\Index(name="cat_start_end_time", columns={"start_time", "end_time"}),
 *     @ORM\Index(name="parent_id", columns={"parent_id"}),
 *     @ORM\Index(name="full_search_top_menu", columns={"top_menu", "end_time", "start_time", "deleted", "active"}),
 *     @ORM\Index(name="full_search", columns={"parent_id", "active", "deleted", "start_time", "end_time"}),
 *     @ORM\Index(name="cat_active", columns={"active"}),
 *     @ORM\Index(name="cat_active_deleted", columns={"active", "deleted"}),
 *     @ORM\Index(name="cat_active_deleted_start_end_time", columns={"deleted", "created", "start_time", "end_time"})
 * })
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Categories
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $parentId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=100, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="full_url", type="string", length=250, nullable=false)
     */
    private $fullUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="meta", type="string", length=255, nullable=true)
     */
    private $meta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="keywords", type="string", length=255, nullable=true)
     */
    private $keywords;

    /**
     * @var int
     *
     * @ORM\Column(name="active", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $active = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="deleted", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $deleted = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="datetime", nullable=false)
     */
    private $startTime;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="end_time", type="datetime", nullable=true)
     */
    private $endTime;

    /**
     * @var int
     *
     * @ORM\Column(name="top_menu", type="integer", nullable=false)
     */
    private $topMenu = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="site_map", type="integer", nullable=false)
     */
    private $siteMap = '0';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function setParentId(int $parentId): self
    {
        $this->parentId = $parentId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getFullUrl(): ?string
    {
        return $this->fullUrl;
    }

    public function setFullUrl(string $fullUrl): self
    {
        $this->fullUrl = $fullUrl;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMeta(): ?string
    {
        return $this->meta;
    }

    public function setMeta(?string $meta): self
    {
        $this->meta = $meta;

        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(?string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(int $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getDeleted(): ?int
    {
        return $this->deleted;
    }

    public function setDeleted(int $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function updateModifiedDatetime(): void
    {
        $this->setCreated($this->created ?? new \DateTime());
        $this->setUpdated(new \DateTime());

    }


    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(?\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(?\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getTopMenu(): ?int
    {
        return $this->topMenu;
    }

    public function setTopMenu(int $topMenu): self
    {
        $this->topMenu = $topMenu;

        return $this;
    }

    public function getSiteMap(): ?int
    {
        return $this->siteMap;
    }

    public function setSiteMap(int $siteMap): self
    {
        $this->siteMap = $siteMap;

        return $this;
    }


}
