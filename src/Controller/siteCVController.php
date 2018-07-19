<?php
// src/Controller/siteCV.php
namespace App\Controller;
use App\Entity\Contact;
use App\Entity\Cv;
use App\Form\ContactType;

//use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class siteCVController extends Controller
{

    /**
     * @Route("/sitecv", name="sitecv")
     */


     public function new(Request $request, \Swift_Mailer $mailer)
        {
            //get data from database
            $repo_cvs = $this->getDoctrine()->getRepository(Cv::class);
            $cvs=$repo_cvs->findAll();
            //dump($cvs);


            // creates a task and gives it some dummy data for this example
            $contact = new Contact();

            $form = $this->createForm(ContactType::class, $contact);

            // build the form ...

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($contact);
                $entityManager->flush();

                    $contactFormTitre = $contact->getTitre();
                    $contactFormNom = $contact->getNom();
                    $contactFormMail = $contact->getMail();
                    $contactFormData = $contact->getMessage();


                    $message = (new \Swift_Message('SiteCV'))
                        ->setFrom('formagrey@gmail.com')
                        ->setTo('freemc@wanadoo.fr')
                        ->setBody(
                            $this->renderView(
                                // templates/emails/registration.html.twig
                                'sitecv/mail.html.twig', [
                                    'contact' => $contactFormData,
                                    'nom' => $contactFormNom,
                                    'mail' => $contactFormMail,
                                    'titre' => $contactFormTitre
                            ]
                            ),
                            'text/html'
                        )
                        /*
                         * If you also want to include a plaintext version of the message
                        ->addPart(
                            $this->renderView(
                                'emails/registration.txt.twig',
                                array('name' => $name)
                            ),
                            'text/plain'
                        )
                        */
                    ;

                    //$mailer->send($message);
                    $this->push($contactFormNom. " : " . $contactFormTitre, $contactFormData. " ".$contactFormMail);
                    //dump($contactFormNom.$contactFormTitre.$contactFormData);
                    return $this->redirect($request->getUri());


                }

            // render the template

            return $this->render('sitecv/sitecv.html.twig', array(
                'form' => $form->createView(),
                'cv' => $cvs
            ));
        }

        //Fonction API PushBullet permet la d'être averti lors de l'envoi du formulaire
        public function push($title, $body)
        {
            $headers = array(
              'Access-Token: o.IPHVANsQSbHAnGGQIzKexczWC29vEChm', // cle d'autorisation d'accès
              'Content-Type: application/json'
            );

            // récupération des informations à trasmettre à PushBullet pour le message d'avertissement
            // par souci de sécurité seul le titre et le corps du message sont transmis (ni le nom ni le mail ne sont transmis)
            $post = array('type' => 'note' ,
                          'title'=> $title,
                          'body'=> $body
                      );

        // encodage des donnée en json format obligatoire pour PushBullet
        $post = json_encode($post);

        $ch = curl_init("https://api.pushbullet.com/v2/pushes");


          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); //=header
          curl_setopt($ch,CURLOPT_POST, 1);// réaliser la méthode
          curl_setopt($ch,CURLOPT_POSTFIELDS,$post); // contenu du post
          // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //retour du message d'erreur
          curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3); //fin de session en cas de problème
          curl_setopt($ch,CURLOPT_TIMEOUT, 20);//fin de la requete en cas de problème

          curl_exec($ch); //execute la requete et envoi le message
          curl_close($ch); //ferme la connection

        }



        /**
         * @Route("/sitecv/projets", name="projets")
         */
        public function projets()
            {
                return $this->render('sitecv/projets.html.twig', array()
            );
         }


}
