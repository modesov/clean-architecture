<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\News;
use App\Domain\Repository\NewsRepositoryInterface;
use App\Domain\ValueObject\NewsName;
use App\Domain\ValueObject\NewsUrl;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\News as NewsEntity;

class DbNewsRepository implements NewsRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private NewsRepository $newsRepository,
    ) {
    }

    public function findAll(): array
    {
        $newsEntities = $this->newsRepository->findAll();
        return !empty($newsEntities)
            ? array_map(function (NewsEntity $newsEntity) {
                return $this->mapEntityNews($newsEntity);
            }, $newsEntities)
            : [];
    }

    public function findById(int $id): ?News
    {
        $newsEntity = $this->newsRepository->find($id);
        return !empty($newsEntity) ? $this->mapEntityNews($newsEntity) : null;
    }

    /**
     * @param int[] $ids
     * @return array|News[]
     */
    public function findByIds(array $ids): array
    {
        $newsEntities = $this->newsRepository->findBy(['id' => $ids]);
        return !empty($newsEntities)
            ? array_map(function (NewsEntity $newsEntity) {
                return $this->mapEntityNews($newsEntity);
            }, $newsEntities)
            : [];
    }

    public function save(News $news): void
    {
        $newsEntity = new NewsEntity();
        $newsEntity
            ->setName($news->getName()->getValue())
            ->setUrl($news->getUrl()->getValue())
            ->setDate($news->getDate());

        $this->entityManager->persist($newsEntity);
        $this->entityManager->flush();

        $reflectionProperty = new \ReflectionProperty(News::class, 'id');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($news, $newsEntity->getId());
    }

    public function delete(News $news): void
    {
        $newsEntity = $this->entityManager->find(NewsEntity::class, $news->getId());
        if (!empty($newsEntity)) {
            $this->entityManager->remove($newsEntity);
        }
    }

    private function mapEntityNews(NewsEntity $newsEntity): News
    {
        $news = new News(
            new NewsUrl($newsEntity->getUrl()),
            new NewsName($newsEntity->getName()),
            \DateTime::createFromFormat('Y-m-d H:i:s', $newsEntity->getDate()->format('Y-m-d H:i:s')),
        );

        $reflectionProperty = new \ReflectionProperty(News::class, 'id');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($news, $newsEntity->getId());

        return $news;
    }
}