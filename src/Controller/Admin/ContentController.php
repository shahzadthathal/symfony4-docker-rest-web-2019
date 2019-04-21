<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


use App\Entity\Content;
use App\Form\ContentType;

class ContentController extends AbstractController
{
    /**
     * @Route("/admin/contents", name="admin_contents")
     */
    public function index()
    {
    	//$this->denyAccessUnlessGranted('ROLE_ADMIN');

    	// or add an optional message - seen by developers
    	$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        $items = $this->getDoctrine()->getRepository(Content::class)->findAll();

        return $this->render('admin/content/index.html.twig',[
            'items' => $items
        ]);
    }

    /**
     * @Route("/admin/content/update/{id}", requirements={"id": "\d+"}, name="admin_contents_update", methods={"GET","POST"})
     */

   public function update(Request $request, $id, \Swift_Mailer $mailer){

        $em = $this->getDoctrine()->getManager();

        $item = $em->getRepository(Content::class)->find($id);

        $oldStatus = $item->getStatus();

        $form = $this->createFormBuilder($item)
            ->add('status', ChoiceType::class, array(
        'choices' => array('Active' => 'Active', 'Pending' => 'Pending', 'Rejected'=>'Rejected')))
            ->add('title', TextType::class, array('attr' =>array('class' => 'form-control')))
            ->add('description', TextareaType::class, array('required' =>false,
                'attr' =>array('class' =>'form-control')))
            ->add('content', TextareaType::class, array('required' =>false,
                'attr' =>array('class' =>'form-control')))
            ->add('save', SubmitType::class, array(
                'label' =>'Update',
                'attr' =>array('class'=>'btn btn-primary mt-3')
            ))
            ->getForm();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $item->setUpdatedAt(date("Y-m-d H:i:s"));

            $em->flush();

            $this->addFlash('success', 'Item updated successfully');

            #Send notification
            if($item->getStatus() != 0){

                $status = '';
                if($item->getStatus() == 1){
                    $status = 'Approved';
                }
                elseif($item->getStatus() == 2){
                    $status = 'Rejected';
                }

                $message = (new \Swift_Message('Cotent update notification'))
                    ->setFrom('send@example.com')
                    ->setTo($item->getEmail())
                     ->setBody(
                        $this->renderView(
                                'emails/content-notification.html.twig',
                                [
                                    'title' => $item->getTitle(),
                                    'status' => $status
                                ]
                            ),
                            'text/html'
                        );
                $mailer->send($message);
            }


            return $this->redirectToRoute('admin_contents');
        }
        return $this->render('admin/content/update.html.twig',array(
            'form'=>$form->createView()
        ));
    }

    /**
     * @Route("/admin/content/detail/{id}", requirements={"id": "\d+"}, name="admin_contents_detail", methods={"GET"})
     */
    public function detail(Request $request, $id){

        $repo = $this->getDoctrine()->getRepository(Content::class);
        $item = $repo->find($id);
        return $this->render('admin/content/detail.html.twig',[
            'item' => $item
        ]);
    }

}
