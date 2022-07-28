<?php
namespace Modules;
include "MainServices.php";
use Modules\MainService;
class MAILGUN{

    // Listar de manera fija el listado de correos a mandar
    // Agregar consulta para obtener listado desde una Base de datos
    static function getMailGroup($groups){ // $groups el nombre del grupo de correos EJEMPLO: reservation
        $emails = array();
        // $emailsArrays = explode(",", $groups);

        foreach ($groups as $key => $email) {
            switch ($email) {
                case 'reservation':
                    // array_push($emails,"reservaciones@budget.com.mx");
                    // array_push($emails,"gerencia.reservaciones@budget.com.mx");
                    array_push($emails,"5.7.zatarain@gmail.com");
                    break;
                
                default:
                    # en el default dse puede hacer una consulta a la base de datos de listado de correos
                    break;
            }
        }


        return $emails;

    }

    // Funcion principal CONSTRUYE el cuerpo del corre y lo envia
    static function buildBodyEmail($datadefautl=array()){
        if(count($datadefautl)<1){
            $datadefautl = array(
                "title"=>"Mensaje de correo MAILGUN",
                "to"=>array("5.7.zatarain@gmail.com"),
                "areaTo"=>array(),
                "cc"=>array(),
                "areaCc"=>array(),
                "subject"=>"Envio default de correo Sr, envio de prueba. [archivo: MAILGUN.PHP, funcion:buildBodyEmail]",
                "template"=>"<h1>plantilla por default, aqui puedes agregar tu codigo HTML</h1>",
                "data"=>array('msg'=>"Sin datos","texto"=>"Envio default de correo Sr, deberia revisarlo. [archivo: MAILGUN.PHP, funcion:buildBodyEmail]")
            );
        }

        // armar correos a quienes se les van a mandar
            $to = (isset($_POST['to'])==1 && empty($_POST['to'])==0)?$_POST['to']:$datadefautl['to'];
            $areaTo = (isset($_POST['areaTo'])==1 && empty($_POST['areaTo'])==0)?self::getMailGroup($_POST['areaTo']):self::getMailGroup($datadefautl['areaTo']);
            
            $toSend = array_merge($to,$areaTo); //unir los array de correos
            $toSend = implode(",",$toSend); // convertir lista de correo a string separadas por ","
        // armar correos a quienes se les van a mandar

        // armar correon con copia a quienes se les van a mandar
            $cc = (isset($_POST['cc'])==1 && empty($_POST['cc'])==0)?$_POST['cc']:$datadefautl['cc'];
            $areaCc = (isset($_POST['areaCc'])==1 && empty($_POST['areaCc'])==0)?self::getMailGroup($_POST['areaCc']):self::getMailGroup($datadefautl['areaCc']);

            $ccSend = array_merge($cc,$areaCc); //unir los array de correos con copia
            $ccSend = implode(",",$ccSend); // convertir lista de correo que son con copia a string separadas por "," 
        // armar correon con copia a quienes se les van a mandar
        // return self::getMailGroup($_POST['areaCc']);

        //Titulo del mensaje
            $title = (isset($_POST['title']) && empty($_POST['title'])==0)?$_POST['title']:$datadefautl['title'];
        //Titulo del mensaje

        //Asunto del mensaje
            $subjet = (isset($_POST['subject']) && empty($_POST['subject'])==0)?$_POST['subject']:$datadefautl['subject'];
        //Asunto del mensaje

        //Template del mensaje
            $template = (isset($_POST['template']) && empty($_POST['template'])==0)?$_POST['template']:$datadefautl['template'];
        //Template del mensaje
        
        //Datos del mensaje
            $dataPetición = (isset($_POST['data']) && empty($_POST['data'])==0)?$_POST['data']:$datadefautl['data'];
        //Datos del mensaje
        
        // obtener la plantilla del correo
            // $arrayDataView =array("template"=>$template,"data"=>$dataPetición);
            // $htmlTemplate = MainServices::loadViewEmail($arrayDataView);
        // obtener la plantilla del correo

        $data = array(
            'from'=>''.$title.' no-reply@emailconf.paylesscar.com.mx',
            'to'=>$toSend,
            'cc'=>$ccSend,
            'subject'=>$subjet,
            'html'=>$template//$htmlTemplate
        );
        return $data;
        // $result=MainServices::sendMailApi($data);
        // return $result;
        // return $data;

    }

    // enviar al sendMail solamente el array construido
    static function sendEmail($dataEmail){
        $result=MainServices::sendMailApi($dataEmail);
        return $result;
    }
}
