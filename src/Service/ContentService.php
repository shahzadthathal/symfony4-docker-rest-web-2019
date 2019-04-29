<?php

namespace App\Service;


use App\Entity\Content;
use App\Repository\ContentRepository;
use Doctrine\ORM\EntityNotFoundException;
/**
 * Class ContentService
 * @package App\Service
 */
final class ContentService
{
    /**
     * @var ContentRepository
     */
    private $contentRepository;
    
    public function __construct(
        ContentRepository $contentRepository
    ) {
        $this->contentRepository = $contentRepository;
    }
    /**
     * @return array|null
     */
    public function getAllContents(): ?array
    {
        return $this->contentRepository->findAll();
    }

    /**
     * @param Content $content
     * @return Content
     */
    public function addContent(Content $content): Content
    {
        $this->contentRepository->save($content);
        return $content;
    }

    /**
     * @param int $contentId
     * @return Content
     * @throws EntityNotFoundException
     */
    public function getContent(int $contentId)
    {
        $item = $this->contentRepository->findById($contentId);
        if (!$item) {
            throw new EntityNotFoundException('item with id '.$contentId.' does not exist!');
        }
        return $item;
    }
}
