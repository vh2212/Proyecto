  <?php
 require '..\Conexion.php';
class temperaturaBL
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Conexion();
    }

    public function create($temperatura, $humedad)
    {
        $this->conn->OpenConection();
        $connSQL = $this->conn->getConection();
        $lastInsertId = 0;
        try {
            if ($connSQL) {
                $connSQL->beginTransaction();

                $sqlStatment = $connSQL->prepare(
                    "INSERT INTO temperatura VALUES(
                        default,
                        :temperatura,
                        :humedad,
                        current_timestamp
                    )"
                );
                
                $sqlStatment->bindParam(':temperatura', $temperatura);
                $sqlStatment->bindParam(':humedad', $humedad);

                $sqlStatment->execute();
                $lastInsertId = $connSQL->lastInsertId();

                $connSQL->commit();
            }
            
        } catch (PDOException $e) {
            $connSQL->rollBack();
        }

        return $lastInsertId;


    }
    public function read($temperatura_id)
    {
     $this->conn->OpenConection();
     $connSQL = $this->conn->getConection();
     $arraytemperatura =  Array();
     if ($temperatura_id > 0) {
        
        $sqlQuery = "SELECT * FROM temperatura WHERE temperatura_id = ".$temperatura_id;
     } else {
        $sqlQuery = "SELECT * FROM temperatura";
     }
     foreach ($connSQL->query($sqlQuery) as $row ) 
     {
         $arraytemperatura[] = array(
             'temperatura_id' => $row['temperatura_id'],
             'temperatura' => $row['temperatura'],
             'humedad'   => $row['humedad'],
             'last_update' => $row['last_update']
         );
     }

     return $arraytemperatura;

    }
    public function update($temperatura_id,$temperatura,$humedad)
    {
        $this->conn->OpenConection();
        $connSQL = $this->conn->getConection();
        try {
            if ($connSQL) {
                $connSQL->beginTransaction();

                $sqlStatment = $connSQL->prepare(
                    "UPDATE temperatura
                        set temperatura = :temperatura,
                        humedad = :humedad
                        where temperatura_id = :temperatura_id
                        ");
                $sqlStatment->bindParam(':temperatura', $temperatura);
                $sqlStatment->bindParam(':humedad', $humedad);
                $sqlStatment->bindParam(':temperatura_id', $temperatura_id);
                

                $sqlStatment->execute();

                $connSQL->commit();
            }
            else {
                $temperatura_id = 0;
            }
            
        } catch (PDOException $e) {
            $connSQL->rollBack();
            $temperatura_id = 0;
        }

        return $temperatura_id;
    }
    public function delete($temperatura_id)
    {
        $this->conn->OpenConection();
        $connSQL = $this->conn->getConection();
        try {
            
            if ($connSQL) {
                $connSQL->beginTransaction();
                $sqlStatment = $connSQL->prepare(
                    "DELETE FROM temperatura
                    WHERE temperatura_id = :temperatura_id"
                );
                $sqlStatment->bindParam(':temperatura_id', $temperatura_id);
                $sqlStatment->execute();

                $connSQL->commit();

            }
        } catch (PDOException $e) {

            $connSQL->rollBack();
            $temperatura_id = 0;
         
        }
        return $temperatura_id;
        
    }
}






?>