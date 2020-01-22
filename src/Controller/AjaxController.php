<?php


namespace App\Controller;


use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @Route("/Admin/Home/Delete/{id}", name="delete_post", methods={"DELETE"})
     */
    public function Delete_Post(Request $request, $id, EntityManagerInterface $em)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
        $postImagesDirectory = $this->getParameter('upload_dir').$post->getSlug();
        if (file_exists($postImagesDirectory)){
            self::removeDirectory($postImagesDirectory);
        }
        $em->remove($post);
        $em->flush();
        

        $respond = new Response();
        $respond->send();
    }

    function removeDirectory($path) {
        $files = glob($path . '/*');
        foreach ($files as $file) {
            is_dir($file) ? removeDirectory($file) : unlink($file);
        }
        rmdir($path);
        return;
    }

}