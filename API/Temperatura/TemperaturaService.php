<?php



require 'TemperaturaBL.php';

class TemperaturaService
{
    private $temperatura;
    private $TemperaturaBL;

    public function __construct()
    {
        $this->TemperaturaBL = new TemperaturaBL();
    }

    public function create($temperatura,$humedad)
    {
        $this->temperatura = $this->TemperaturaBL->create($temperatura,$humedad);
        if($this->temperatura > 0) {
            $response[] = array('response' => true);
            echo json_encode("response:true");
        }
        else {
            $response[] = array('response' => false);
            echo json_encode("response:false");
        }
    }

    public function read($temperatura_id)
    {
        $this->temperatura = $this->TemperaturaBL->read($temperatura_id);
        echo json_encode($this->temperatura);
    }

    public function update($temperatura_id,$temperatura,$humedad)
    {
        $this->temperatura = $this->TemperaturaBL->update($temperatura_id,$temperatura,$humedad);
        echo json_encode($this->temperatura);
    }

    public function delete($temperatura_id)
    {
        $this->temperatura = $this->TemperaturaBL->delete($temperatura_id);
        if($this->temperatura > 0) {
            $response[] = array('response' => true);
            echo json_encode("response:true");
        }
        else {
            $response[] = array('response' => false);
            echo json_encode("response:false");
        }
    }
}

$service = new temperaturaService();
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
            $service->create($data['temperatura'],$data['humedad']);
            break;
        }
        case 'PUT':
        {
            $data = json_decode(file_get_contents('php://input'), true);
            $service->update($data['temperatura_id'],$data['temperatura'],$data['humedad']);
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