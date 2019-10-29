<?php
// src/Controller/ApiController.php
namespace App\Controller;

use App\Entity\User;
use App\Entity\Anuncio;
use App\Entity\Multimedia;
use App\Entity\Texto;

use App\Api\UploadApiModel;

use DateTime;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ApiController
 *
 * @Route("/api")
 */
class ApiController extends FOSRestController
{
    /**
     * @Route("/login_check", name="login_check")
     */

         // USER URI's

         /**
          * @Rest\Post("/login_check", name="user_login_check")
          *
          * @SWG\Response(
          *     response=200,
          *     description="User was logged in successfully"
          * )
          *
          * @SWG\Response(
          *     response=500,
          *     description="User was not logged in successfully"
          * )
          *
          * @SWG\Parameter(
          *     name="_username",
          *     in="body",
          *     type="string",
          *     description="The username",
          *     schema={}
          * )
          *
          * @SWG\Parameter(
          *     name="_password",
          *     in="body",
          *     type="string",
          *     description="The password",
          *     schema={}
          * )
          *
          * @SWG\Tag(name="User")
          */
         public function getLoginCheckAction() {}

         /**
          * @Rest\Post("/register", name="user_register")
          *
          * @SWG\Response(
          *     response=201,
          *     description="User was successfully registered"
          * )
          *
          * @SWG\Response(
          *     response=500,
          *     description="User was not successfully registered"
          * )
          *
          * @SWG\Parameter(
          *     name="_name",
          *     in="body",
          *     type="string",
          *     description="The username",
          *     schema={}
          * )
          *
          * @SWG\Parameter(
          *     name="_email",
          *     in="body",
          *     type="string",
          *     description="The username",
          *     schema={}
          * )
          *
          * @SWG\Parameter(
          *     name="_username",
          *     in="body",
          *     type="string",
          *     description="The username",
          *     schema={}
          * )
          *
          * @SWG\Parameter(
          *     name="_password",
          *     in="query",
          *     type="string",
          *     description="The password"
          * )
          *
          * @SWG\Tag(name="User")
          */
         public function registerAction(Request $request, UserPasswordEncoderInterface $encoder) {
             $serializer = $this->get('jms_serializer');
             $em = $this->getDoctrine()->getManager();

             $user = [];
             $message = "";

             try {
                 $code = 200;
                 $error = false;

                 $name = $request->request->get('_name');
                 $email = $request->request->get('_email');
                 $username = $request->request->get('_username');
                 $password = $request->request->get('_password');

                 $user = new User();
                 $user->setName($name);
                 $user->setEmail($email);
                 $user->setUsername($username);
                 $user->setPlainPassword($password);
                 $user->setPassword($encoder->encodePassword($user, $password));
                 /*Mily*/
                 $user->updatedTimestamps();

                 $em->persist($user);
                 $em->flush();

             } catch (Exception $ex) {
                 $code = 500;
                 $error = true;
                 $message = "An error has occurred trying to register the user - Error: {$ex->getMessage()}";
             }

             $response = [
                 'code' => $code,
                 'error' => $error,
                 'data' => $code == 200 ? $user : $message,
             ];

             return new Response($serializer->serialize($response, "json"));
         }
         /*Mily*/
      /**
      * @Rest\Post("/serV1/addAnuncio.{_format}", name="anuncio_add", defaults={"_format":"json"})
      *
      * @SWG\Response(
      *     response=201,
      *     description="Anuncio was added successfully"
      * )
      *
      * @SWG\Response(
      *     response=500,
      *     description="An error was occurred trying to add new anuncio"
      * )
      *
      * @SWG\Parameter(
      *     name="_tipoId",
      *     in="body",
      *     type="string",
      *     description="The anuncio type id",
      *     schema={}
      * )
      * @SWG\Parameter(
      *     name="_nombre",
      *     in="body",
      *     type="string",
      *     description="The anuncio name",
      *     schema={}
      * )
      * @SWG\Parameter(
      *     name="_posX",
      *     in="body",
      *     type="string",
      *     description="The anuncio position X",
      *     schema={}
      * )
      * @SWG\Parameter(
      *     name="_posY",
      *     in="body",
      *     type="string",
      *     description="The anuncio position Y",
      *     schema={}
      * )
      * @SWG\Parameter(
      *     name="_posZ",
      *     in="body",
      *     type="string",
      *     description="The anuncio position Z",
      *     schema={}
      * )
      *
      * @SWG\Parameter(
      *     name="_estadoId",
      *     in="body",
      *     type="string",
      *     description="The anuncio status id",
      *     schema={}
      * )
      *
      * @SWG\Parameter(
      *     name="_cadena",
      *     in="body",
      *     type="string",
      *     description="The anuncio text",
      *     schema={}
      * )
      * @SWG\Parameter(
      *     name="_file",
      *     in="body",
      *     type="string",
      *     description="The anuncio text",
      *     schema={}
      * )
      * @SWG\Parameter(
      *     name="_alto",
      *     in="body",
      *     type="string",
      *     description="The anuncio text",
      *     schema={}
      * )
      * @SWG\Parameter(
      *     name="_ancho",
      *     in="body",
      *     type="string",
      *     description="The anuncio text",
      *     schema={}
      * )
      * @SWG\Tag(name="Anuncio")
      */
     public function addAnuncioAction(Request $request) {
         $serializer = $this->get('jms_serializer');
         $em = $this->getDoctrine()->getManager();
         $anuncio= [];
         $texto= [];
         $multimedia= [];
         $message = "";

         try {
            $code = 201;
            $error = false;
            $nombre = $request->request->get("_nombre", null);
            $tipoId = $request->request->get("_tipoId", null);
            $posX = $request->request->get("_posX", null);
            $posY = $request->request->get("_posY", null);
            $posZ= $request->request->get("_posZ", null);
            $estadoId = $request->request->get("_estadoId", null);

            if (!is_null($nombre) && !is_null($tipoId) && !is_null($posX) && !is_null($posY) && !is_null($posZ)&& !is_null($estadoId)) {
                $anuncio= new Anuncio();

                $tipo=$em->getRepository("App:Tipo")->find($tipoId);
                $estado=$em->getRepository("App:Estado")->find($estadoId);
                //Validar que estado y tipo devuelvan datos

                $anuncio->setNombre($nombre);
                $anuncio->setTipo($tipo);
                $anuncio->setEstado($estado);
                $anuncio->setPosX($posX);
                $anuncio->setPosY($posY);
                $anuncio->setPosZ($posZ);

                //$anuncio->setUser($user);
                /*Mily*/
                $date = new \DateTime('@'.strtotime('now'));
                $anuncio->setFechaCreacion($date);
                $anuncio->updatedTimestamps();


                $em->persist($anuncio);
                $em->flush();

                if ($tipo->getDescripcion()=='texto'){
                  // Instanciar el modelo texto
                  $cadena= $request->request->get("_cadena", null);
                  if (!is_null($cadena)){
                    //Validar lalongitud del texto
                    $longitud_cadena=strlen($cadena);
                    if ($longitud_cadena>= 1 && $longitud_cadena<=140){
                      $texto= new Texto();
                      $texto->setAnuncio($anuncio);
                      $texto->setCadena($cadena);
                      $em->persist($texto);
                      $em->flush();

                    } else {
                        $code = 500;
                        $error = true;
                        $message = "An error has occurred trying to add new texto - Error: text not have-----";
                    }
                  } else{
                      $code = 500;
                      $error = true;
                      $message = "An error has occurred trying to add new texto - Texto vacioooooo o null";
                  }

               }

               //Validar si es imagen o video, es decir Multimedia
              $tipoMult=$tipo->getDescripcion();
               if ($tipoMult=='imagen' or $tipoMult=='video' ){
                 // Instanciar el modelo Multimedia
                 if ($request->headers->get('Content-Type') === 'application/json') {
                     $uploadApiModel = $serializer->deserialize(
                         $request->getContent(),
                         UploadApiModel::class,
                         'json'
                     );
                     dd($uploadApiModel);
                 } else {
                   $file = $request->files->get('_file',null);
                 }
                 $ancho= $request->request->get("_ancho", null);
                 $alto= $request->request->get("_alto", null);

                 if (!is_null($file)&& !is_null($ancho)&& !is_null($alto)){

                     // Validar Extension para imagen y video

                     $extension=$file->guessExtension();
                     $extension_valida=false;
                     if ($tipoMult=='imagen'){
                       //Extention dbe ser jpg,jpeg,png
                       if($extension=='jpg' or $extension=='jpeg' or $extension=='png'){
                         $extension_valida=true;
                       }
                     }
                     if ($tipoMult=='video'){
                       //Extention dbe ser mp4,webm
                       if($extension=='mp4' or $extension=='webm'){
                         $extension_valida=true;
                       }
                     }

                     if ($extension_valida){
                          $originalFilename = $file->getClientOriginalName();
                          $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                          $fileName = $safeFilename.'-'.uniqid().'.'.$extension;
                          $size=$file->getClientSize();

                          $multimedia = new Multimedia();
                          $multimedia->setAnuncio($anuncio);
                          $multimedia->setEnlaceRuta($fileName);
                          $multimedia->setFormato($extension);
                          $multimedia->setPeso($size);
                          $multimedia->setAncho($ancho);
                          $multimedia->setAlto($alto);
                          $multimedia->setTipoMultimedia($tipoMult);
                          $em->persist($multimedia);
                          $em->flush();


                          try {
                            $file->move($this->getParameter('multimedia_directory'), $fileName);
                          } catch (FileException $e) {
                            $code = 500;
                            $error = true;
                            $message = "An error has occurred trying to move file - Error: {$ex->getMessage()}";
                          }

                     } else {
                         $code = 500;
                         $error = true;
                         $message = "An error has occurred extension file invalid multimedia";
                     }


                 } else {
                     $code = 500;
                     $error = true;
                     $message = "An error has occurred trying to add new multimedia ".$file;
                 }

              }

            } else {
                $code = 500;
                $error = true;
                $message = "An error has occurred trying to add new anuncio - Error: You must to provide a anuncio name".$nombre;
            }

         } catch (Exception $ex) {
             $code = 500;
             $error = true;
             $message = "An error has occurred trying to add new anuncio - Error: {$ex->getMessage()}";
         }

         //ver que devolver texto multimedia
         $tipoAnuncio = $tipo->getDescripcion()=='texto' ? $texto : $multimedia ;

         $response = [
             'code' => $code,
             'error' => $error,
             'data' => $code == 201 ? $tipoAnuncio : $message,
         ];

         return new Response($serializer->serialize($response, "json"));
     }
     /**
     * @Rest\Get("/serV1/showAnuncio/{id}.{_format}", name="anuncio_show", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get anuncio"
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="An error has occurred trying to get anuncio"
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="The anuncio ID"
     * )
     *
     *
     * @SWG\Tag(name="Anuncio")
     */
     public function showAnuncioAction(Request $request,$id) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $textos = [];
        $multimedias = [];
        $tipo = [];
        $message = "";

        try {
            $code = 200;
            $error = false;

            //$anuncioId = $request->query->get("id", null);
            if (!is_null($id)){
              //obtener el tipo de aviso
              $anuncio= $em->getRepository("App:Anuncio")->find($id);
              $estado=$anuncio->getEstado();
              $tipoEstado=$estado->getDescripcion();

              if ($tipoEstado=='stopped'){
                $tipo=$anuncio->getTipo();
                $tipoAnuncio=$tipo->getDescripcion();
                if ($tipoAnuncio=='texto'){
                    $textos = $em->getRepository("App:Texto")->findBy([
                      "anuncio" => $id,
                    ]);

                    if (is_null($textos)) {
                      $textos = [];
                  }
                }

                if ($tipoAnuncio=='imagen' or $tipoAnuncio=='video'){
                    $multimedias = $em->getRepository("App:Multimedia")->findBy([
                      "anuncio" => $id,
                    ]);

                    if (is_null($multimedias)) {
                      $multimedias = [];
                  }
                }

                //ver que devolver texto multimedia
                $tipoAnuncio = $tipo->getDescripcion()=='texto' ? $textos : $multimedias;

                $response = [
                    'code' => $code,
                    'error' => $error,
                    'data' => $code == 200 ? $tipoAnuncio : $message,
                ];
              } else {
                $code = 500;
                $error = true;
                $message = "An error has occurred trying to show anuncio - Error: the state has to be stopped: ".$tipoEstado;
                
                $response = [
                    'code' => $code,
                    'error' => $error,
                    'data' => $code == 200 ? $tipoAnuncio : $message,
                ];

              }

            }

        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to get anuncio - Error: {$ex->getMessage()}";
        }



        return new Response($serializer->serialize($response, "json"));

     }
  /*endMily*/

}
