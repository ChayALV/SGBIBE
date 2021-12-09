<?php
//Libreria de NuSoap 
require_once("../Library/NuSoap/nusoap.php");
//La clase esta echa para verificar que los alumnos esten en la BD
//O si no es el caso que se inserten en la DB
//Y si es un administrativo que lo valide normalmente
class AutenticacionDeUsuarios
{
    //variables de INGRESO
    public $matriculaOrCorreo;
    public $password;
    //Constructor
    function __construct($matriculaDeAdOAl, $passwordAoA){
        $this->matriculaOrCorreo = $matriculaDeAdOAl;
        $this->password = $passwordAoA; 
    }
    //Peticion al servidor
    public function peticionAlServidor(){
        $cliente = new nusoap_client("https://mi-escuelamx.com/ws/wsUTSEM/Datos.asmx?wsdl",'wsdl','','','','');
        $error = $cliente->getError(); 
        if ($error) {
            echo "Hubo un errror en el sistema :".$error."...";
        } 
        $parametros = array(
            'lsMatricula' =>  $this->matriculaOrCorreo,
            'lsPassword' => $this->password
        );
        $resultado = $cliente->call('Login', $parametros);
        if (!isset($resultado['LoginResult']['diffgram'])) {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Si sigues intentando forzar el login tu IP será permanentemente suspendida</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            return false;
        }
        $data = $resultado['LoginResult']['diffgram'];
        if (empty($data)) {
            return false;
        }else{
            $data = $resultado['LoginResult']['diffgram']['NewDataSet']['Alumno'];
            array_walk_recursive($data, function (&$item, $key) {
                if (!mb_detect_encoding($item, 'utf-8', true)) {
                    $item = utf8_encode($item);
                }
            });
            //retotrnamos el arrayr que nos arroja el webservice
            //print_r($data);
            return $data;
        }
    }
    //Reescribiendo el aarar para formateralo a JSON
    public function getJsonDeInformacion(){
        $array_del_alumon = self::peticionAlServidor();
        print_r($array_del_alumon);
        if ($array_del_alumon) {
            $json_de_inofrmacion_encode = json_encode($array_del_alumon,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $json_de_inofrmacion_decode = json_decode($json_de_inofrmacion_encode);
            print_r($json_de_inofrmacion_decode);
            //return $json_de_inofrmacion_decode;
        } else {
            echo "No jalo";
            //return false;
        }
    }
    //Funcion de validacion y/o insercioncon a la DB
    public function validacionOinsercion(){
        //variables
        $data = self::peticionAlServidor(); // Data de la peticion SOAP
        include("Conexion.php"); // conexion a la db
        $matriculaAlumno = $this->matriculaOrCorreo; // Matricula del alumno o correo del aministrador
        //validacion si la matricula insertada es un correo
        if (filter_var($matriculaAlumno, FILTER_VALIDATE_EMAIL)) {
            $funcion = $this->validacionDeAdministrativo($matriculaAlumno);
            return $funcion;
        }else{
            // consulta a la DB
            $consulta_del_alumno = mysqli_query($conexion,"SELECT * FROM `Alumnos` WHERE Matricula = '$matriculaAlumno'");
            if (!$consulta_del_alumno) {
                echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Si sigues intentando forzar el login tu IP será permanentemente suspendida</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                return false;
            }else{
                if ($datos_de_alumno = $consulta_del_alumno->fetch_array()) {
                    $passwordAlumno = md5($this->password);
                    //validamos que la password sea correcta
                    if ($passwordAlumno == $datos_de_alumno['Contraseña']) {
                        return $datos_de_alumno;
                    } else {
                        $fallo = 2002;
                        return $fallo;
                    }
                }else{
                    if ($data) {
                        $dataAlumno = self::getJsonDeInformacion();
                        $passwordAlumno = md5($this->password);
                        $insertar_alumno_BD = mysqli_query($conexion,"INSERT INTO `Alumnos` (`Matricula`, `Nombre`, `Apellidos`, `Contraseña`, `Carrera`, `Grado`, `Grupo`, `Becado`, `Nivel`, `Cuatrimestre`, `Email`) 
                                                            VALUES ('$dataAlumno->matricula', '$dataAlumno->nombre', '$dataAlumno->apaterno $dataAlumno->amaterno', '$passwordAlumno', '$dataAlumno->desc_carrera', '$dataAlumno->desc_grado', '$dataAlumno->grupo', 0, 1, '$dataAlumno->desc_grupo', '$dataAlumno->mail');");
                        $consulta_del_alumno = mysqli_query($conexion,"SELECT * FROM `Alumnos` WHERE Matricula = '$matriculaAlumno'");
                        if($datos_de_alumno = $consulta_del_alumno->fetch_array()){
                            return $datos_de_alumno;
                        }
                    }else{
                        $fallo = 2001;
                        return $fallo;
                    }
                }
            }
        }
    }
    //Validacion de la infrmacion de un administrativo   
    public function validacionDeAdministrativo($emailAdministrador){
        include("Conexion.php"); // conexion a la db
        //consulta a la db si existe el usuario
        $consulta_del_adminisrativo = mysqli_query($conexion, "SELECT * FROM `Usuarios` WHERE  Email = '$emailAdministrador'");
        if ($datos_de_administrativo = $consulta_del_adminisrativo->fetch_array()) {
            $passwordAdministrativo = $this->password;
            //validamos que la password sea correcta
            if ($passwordAdministrativo == $datos_de_administrativo['Password']) {
                return $datos_de_administrativo;
            } else {
                $fallo = 1002;
                return $fallo;
            }
        }else{
            $fallo = 1001;
            return $fallo;
        }
    }
}

$logIN = new AutenticacionDeUsuarios('TI2018S031','GABC7118');
$datosDeUsuarios = $logIN->getJsonDeInformacion();
?>

