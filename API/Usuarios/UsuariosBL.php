  <?php
 require '..\Conexion.php';
class usuariosBL
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Conexion();
    }

    public function create($usuarios, $apPaterno, $apMaterno, $huella)
    {
        $this->conn->OpenConection();
        $connSQL = $this->conn->getConection();
        $lastInsertId = 0;
        try {
            if ($connSQL) {
                $connSQL->beginTransaction();

                $sqlStatment = $connSQL->prepare(
                    "INSERT INTO usuarios VALUES(
                        default,
                        :nombre,
                        :apPaterno,
                        :apMaterno,
                        :huella
                        current_timestamp
                    )"
                );
                
                $sqlStatment->bindParam(':nombre', $nombre);
                $sqlStatment->bindParam(':apPaterno', $apPaterno);
                $sqlStatment->bindParam(':apMaterno', $apMaterno);
                $sqlStatment->bindParam(':huella', $huella);

                $sqlStatment->execute();
                $lastInsertId = $connSQL->lastInsertId();

                $connSQL->commit();
            }
            
        } catch (PDOException $e) {
            $connSQL->rollBack();
        }

        return $lastInsertId;


    }
    public function read($usuarios_id)
    {
     $this->conn->OpenConection();
     $connSQL = $this->conn->getConection();
     $arrayusuarios =  Array();
     if ($usuarios_id > 0) {
        
        $sqlQuery = "SELECT * FROM usuarios WHERE usuarios_id = ".$usuarios_id;
     } else {
        $sqlQuery = "SELECT * FROM usuarios";
     }
     foreach ($connSQL->query($sqlQuery) as $row ) 
     {
         $arrayusuarios[] = array(
             'usuarios_id' => $row['usuarios_id'],
             'nombre' => $row['nombre'],
             'apPaterno'   => $row['apPaterno'],
             'apMaterno'   => $row['apMaterno'],
             'huella'   => $row['huella'],
             'last_update' => $row['last_update']
         );
     }

     return $arrayusuarios;

    }
    public function update($usuarios_id,$nombre,$apPaterno,$apMaterno,$huella)
    {
        $this->conn->OpenConection();
        $connSQL = $this->conn->getConection();
        try {
            if ($connSQL) {
                $connSQL->beginTransaction();

                $sqlStatment = $connSQL->prepare(
                    "UPDATE usuarios
                        set nombre = :nombre,
                        apPaterno = :apPaterno,
                        apMaterno = :apMaterno,
                        huella = :huella
                        where usuarios_id = :usuarios_id
                        ");
                $sqlStatment->bindParam(':nombre', $nombre);
                $sqlStatment->bindParam(':apPaterno', $apPaterno);
                $sqlStatment->bindParam(':apMaterno', $apMaterno);
                $sqlStatment->bindParam(':huella', $huella);                
                $sqlStatment->bindParam(':usuarios_id', $usuarios_id);
                

                $sqlStatment->execute();

                $connSQL->commit();
            }
            else {
                $usuarios_id = 0;
            }
            
        } catch (PDOException $e) {
            $connSQL->rollBack();
            $usuarios_id = 0;
        }

        return $usuarios_id;
    }
    public function delete($usuarios_id)
    {
        $this->conn->OpenConection();
        $connSQL = $this->conn->getConection();
        try {
            
            if ($connSQL) {
                $connSQL->beginTransaction();
                $sqlStatment = $connSQL->prepare(
                    "DELETE FROM usuarios
                    WHERE usuarios_id = :usuarios_id"
                );
                $sqlStatment->bindParam(':usuarios_id', $usuarios_id);
                $sqlStatment->execute();

                $connSQL->commit();

            }
        } catch (PDOException $e) {

            $connSQL->rollBack();
            $usuarios_id = 0;
         
        }
        return $usuarios_id;
        
    }
}






?>