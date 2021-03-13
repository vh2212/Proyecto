<?php



require 'UsuariosBL.php';

class UsuariosService
{
    private $usuarios;
    private $UsuariosBL;

    public function __construct()
    {
        $this->UsuariosBL = new UsuariosBL();
    }

    public function create($nombre,$apPaterno,$apMaterno,$huella)
    {
        $this->usuarios = $this->UsuariosBL->create($nombre,$apPaterno,$apMaterno,$huella);
        if($this->usuarios > 0) {
            $response[] = array('response' => true);
            echo json_encode("response:true");
        }
        else {
            $response[] = array('response' => false);
            echo json_encode("response:false");
        }
    }

    public function read($usuarios_id)
    {
        $this->usuarios = $this->UsuariosBL->read($usuarios_id);
        echo json_encode($this->usuarios);
    }

    public function update($usuarios_id,$nombre,$apPaterno,$apMaterno,$huella)
    {
        $this->usuarios = $this->UsuariosBL->update($usuarios_id,$nombre,$apPaterno,$apMaterno,$huella);
        echo json_encode($this->usuarios);
    }

    public function delete($usuarios_id)
    {
        $this->usuarios = $this->UsuariosBL->delete($usuarios_id);
        if($this->usuarios > 0) {
            $response[] = array('response' => true);
            echo json_encode("response:true");
        }
        else {
            $response[] = array('response' => false);
            echo json_encode("response:false");
        }
    }
}

$service = new usuariosService();
switch ($_SERVER['REQUEST_METHOD']) 
{
    case 'GET':
        {
            if (empty($_GET['param'])) {
                $service->read($_GET['param']);
            } else {
                $service->read($_GET['param']);
            }
            
            
            break;
        }
        case 'POST':
        {
        //print_r($_POST);
        $data = json_decode(file_get_contents('php://input'), true);
            $service->create($data['nombre'],$data['apPaterno'],$data['apMaterno'],$data['huella']);
            break;
        }
        case 'PUT':
        {
            $data = json_decode(file_get_contents('php://input'), true);
            $service->update($data['usuarios_id'],$data['nombre'],$data['apPaterno'],$data['apMaterno'],$data['huella']);
            break;
        }
        case 'DELETE':
        {
            parse_str(file_get_contents('php://input'), $_DELETE);
            if (empty($_GET['param'])) {
                $service->delete($_GET['param']);
            } else {
                $service->delete($_GET['param']);
            }
            break;
        }
        
    
}

?>