<?php


namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Post;
use Gumlet\ImageResize;
use Cocur\Slugify\Slugify;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Gumlet\ImageResizeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @return Response
     * @Route("/Admin/Games", name="admin_home")
     */
    public function Admin_home()
    {
        $genre = $this->getDoctrine()->getRepository(Genre::class)->findBy(array(), ['name' => 'DESC']);
        $posts = $this->getDoctrine()->getRepository(Post::class)->findBy(array(), ['TimePosted' => 'DESC']);

        return $this->render('Admin/Admin_games.html.twig', [
            'genres' => $genre,
            'posts' => $posts
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @Route("/Admin/New_Post", name="admin_new_post")
     * @throws ImageResizeException
     */
    public function Admin_new_post(Request $request, EntityManagerInterface $em)
    {
        $slugify = new Slugify();

        $form = $this->createForm(PostType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            $slug = $slugify->slugify($post->getTitle());
            /**
             * @var UploadedFile $posterFile
             */
            $posterFile = $form['posterFile']->getData();

            $destination = $this->getParameter('upload_dir').$slug;
            if (!file_exists($destination)){
                mkdir($destination, 0777, true);
            }

            $originalFilename = pathinfo($posterFile->getClientOriginalName(), PATHINFO_FILENAME);

            $newFilename = $originalFilename.'-'.uniqid().'.'.$posterFile->guessExtension();
            $posterFile->move(
                $destination,
                $newFilename
            );

            $resizedPoster = new ImageResize($destination.'/'.$newFilename);
            $resizedPoster->resizeToWidth(600);
            $resizedPoster->save($destination.'/'.$newFilename);
//
            $post->setPosterFileName($newFilename);

//            DEFAULT VALUES FOR A POST
            $post->setTimePosted();
            $post->setSlug($slug);
            $post->setViews(0);
            $post->setDownloads(0);

//            SAVE AND UPLOAD TO DATABASE
            $em->persist($post);
            $em->flush();

            $this->addFlash('success', 'Game Posted');

//            REDIRECT TO ADMIN HOME
            return $this->redirectToRoute('admin_home');
        }

        return $this->render('Admin/Admin_new_post.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param $slug
     * @return Response
     * @Route("/Edit/{slug}", name="admin_edit_post")
     * @throws ImageResizeException
     */
    public function Admin_edit_post(EntityManagerInterface $em, Request $request, $slug)
    {
        $post = $this->getDoctrine()->getRepository(Post::class)->findOneBy(['slug' => $slug]);

        $slugify = new Slugify();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /**
             * @var UploadedFile $posterFile
             */
            $posterFile = $form['posterFile']->getData();

            $destination = $this->getParameter('upload_dir').$slug;
            if (!file_exists($destination)){
                mkdir($destination, 0777, true);
            }

            $originalFilename = pathinfo($posterFile->getClientOriginalName(), PATHINFO_FILENAME);

            $newFilename = $originalFilename.'-'.uniqid().'.'.$posterFile->guessExtension();
            $posterFile->move(
                $destination,
                $newFilename
            );

            $resizedPoster = new ImageResize($destination.'/'.$newFilename);
            $resizedPoster->resizeToWidth(600);
            $resizedPoster->save($destination.'/'.$newFilename);

            $oldPosterFileName = $post->getPosterFileName();
            unlink($destination.'/'.$oldPosterFileName);

            $post->setPosterFileName($newFilename);
            $post->setTimePosted();

            $em->flush();

            $this->addFlash('success', $post->getTitle().' Updated!');

//            REDIRECT TO ADMIN HOME
            return $this->redirectToRoute('admin_home');
        }

        return $this->render('Admin/Admin_edit_post.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @param $slug
     * @return Response
     * @Route("/Admin/{slug}/Preview", name="admin_post_preview")
     */
    public function Admin_post_preview($slug){
        $post = $this->getDoctrine()->getRepository(Post::class)->findOneBy(['slug' => $slug]);

        return $this->render('Admin/Admin_post_preview.html.twig',[
            'post' => $post
        ]);
    }

    /**
     * @return Response
     * @Route("Admin/Requests", name="admin_handle_request")
     */
    public function Admin_handle_request()
    {
        return $this->render('Admin/Admin_handle_request.html.twig');
    }
}