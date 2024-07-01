<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Post;


#[Route('/api', name: 'api_')]
class PostController extends AbstractController
{
    #[Route('/posts', name: 'post_index', methods: ['get'])]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {

        /**
         * @var Post[] $posts
         */
        $posts = $entityManager
            ->getRepository(Post::class)
            ->findAll();

        $data = [];

        foreach ($posts as $post) {
            $data[] = [
                'id' => $post->getId(),
                'title' => $post->getTitle(),
                'subtitle' => $post->getSubtitle(),
                'description' => $post->getDescription(),
                'userId' => $post->getUserId(),
                'tags' => $post->getTags(),
                'category' => $post->getCategory(),
                'image' => $post->getImage(),
                'createdAt' => $post->getCreatedAt(),
                'updatedAt' => $post->getUpdatedAt(),
            ];
        }

        return $this->json($data);
    }


    #[Route('/posts', name: 'post_create', methods: ['post'])]
    public function create(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        /**
         * @var Post $post
         */
        $post = new Post();
        $post->setTitle($request->get('title'));
        $post->setSubtitle($request->get('subtitle'));
        $post->setDescription($request->get('description'));
        $post->setUserId($request->get('userId'));
        $post->setTags($request->get('tags'));
        $post->setCategory($request->get('category'));
        $post->setImage($request->get('image'));
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());

        $entityManager->persist($post);
        $entityManager->flush();

        $data = [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'subtitle' => $post->getSubtitle(),
            'description' => $post->getDescription(),
            'userId' => $post->getUserId(),
            'tags' => $post->getTags(),
            'category' => $post->getCategory(),
            'image' => $post->getImage(),
            'createdAt' => $post->getCreatedAt(),
            'updatedAt' => $post->getUpdatedAt(),
        ];

        return $this->json($data);
    }


    #[Route('/posts/{id}', name: 'post_show', methods: ['get'])]
    public function show(EntityManagerInterface $entityManager, string $id): JsonResponse
    {
        /**
         * @var Post $post
         */
        $post = $entityManager->getRepository(Post::class)->find($id);

        if (!$post) {

            return $this->json('No post found for id ' . $id, 404);
        }

        $data = [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'subtitle' => $post->getSubtitle(),
            'description' => $post->getDescription(),
            'userId' => $post->getUserId(),
            'tags' => $post->getTags(),
            'category' => $post->getCategory(),
            'image' => $post->getImage(),
            'createdAt' => $post->getCreatedAt(),
            'updatedAt' => $post->getUpdatedAt(),
        ];

        return $this->json($data);
    }

    #[Route('/posts/{id}', name: 'post_update', methods: ['put', 'patch'])]
    public function update(EntityManagerInterface $entityManager, Request $request, string $id): JsonResponse
    {
        /**
         * @var Post $post
         */
        $post = $entityManager->getRepository(Post::class)->find($id);

        if (!$post) {
            return $this->json('No post found for id ' . $id, 404);
        }

        if ($request->get('title') !== null) {
            $post->setTitle($request->get('title'));
        }
        if ($request->get('subtitle') !== null) {
            $post->setSubtitle($request->get('subtitle'));
        }
        if ($request->get('description') !== null) {
            $post->setDescription($request->get('description'));
        }
        if ($request->get('userId') !== null) {
            $post->setUserId($request->get('userId'));
        }
        if ($request->get('tags') !== null) {
            $post->setTags($request->get('tags'));
        }
        if ($request->get('category') !== null) {
            $post->setCategory($request->get('category'));
        }
        if ($request->get('image') !== null) {
            $post->setImage($request->get('image'));
        }

        $post->setUpdatedAt(new \DateTimeImmutable());
        $entityManager->flush();

        $data = [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'subtitle' => $post->getSubtitle(),
            'description' => $post->getDescription(),
            'userId' => $post->getUserId(),
            'tags' => $post->getTags(),
            'category' => $post->getCategory(),
            'image' => $post->getImage(),
            'createdAt' => $post->getCreatedAt(),
            'updatedAt' => $post->getUpdatedAt(),
        ];

        return $this->json($data);
    }

    #[Route('/posts/{id}', name: 'post_delete', methods: ['delete'])]
    public function delete(EntityManagerInterface $entityManager, string $id): JsonResponse
    {
        /**
         * @var Post $post
         */
        $post = $entityManager->getRepository(Post::class)->find($id);

        if (!$post) {
            return $this->json('No post found for id ' . $id, 404);
        }

        $entityManager->remove($post);
        $entityManager->flush();

        return $this->json('Deleted a project successfully with id ' . $id);
    }
}
