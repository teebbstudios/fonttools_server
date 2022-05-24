<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Form\AdminType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProfileController extends AbstractController
{

    #[Route('/admin/profile', name: 'admin_profile')]
    public function editAdminProfile(Request $request, EntityManagerInterface $em): Response
    {
        $admin = $this->getUser();
        $profileForm = $this->createForm(AdminType::class, $admin);

        $profileForm->handleRequest($request);
        if ($profileForm->isSubmitted() && $profileForm->isValid()) {

            $admin = $profileForm->getData();
            $em->persist($admin);
            $em->flush();

            $this->addFlash('success', '您的个人信息修改成功！');
        }

        return $this->render('admin/profile.html.twig', [
            'form' => $profileForm->createView(),
        ]);
    }

}
