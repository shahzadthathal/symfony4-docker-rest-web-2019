<?php

namespace App\Controller\Rest;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use App\Entity\Content;
use App\Form\ContentType;
use App\Service\ContentService;

class ContentController extends FOSRestController
{
    /**
     * @var ContentService
     */
    private $contentService;
    /**
     * ArticleController constructor.
     * @param ContentService $contentService
     */
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    /**
    * Lists all Contents.
    * @Rest\Get("/contents")
    * http://sf4.local/api/contents
    * @return Response
    */
    public function getContents()
    {
       /* $user = $this->getUser();
        $user->getApiToken();
        exit;*/

        $items = $this->contentService->getAllContents();
        return $this->handleView($this->view($items));
    }

    /**
    * Create Content.
    * @Rest\Post("/content")
    * http://sf4.local/api/content/
    * @return Response
    */
    public function postContent(Request $request)
    {
        $item = new Content();
        $form = $this->createForm(ContentType::class, $item);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()) {

            $item->setUserId(2);
            $item->setCreatedAt(date("Y-m-d H:i:s"));
            $item->setUpdatedAt(date("Y-m-d H:i:s"));

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
            return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }

    /**
    * Lists all Contents.
    * @Rest\Get("/content/{id}")
    * http://sf4.local/api/content/3
    * @return Response
    */
    public function getContent(Request $request,$id)
    {

        $items = $this->contentService->getContent($id);
        return $this->handleView($this->view($items));
    }

}
