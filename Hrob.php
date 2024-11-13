<?php

class Hrob
{
    private $id;
    private $nazev;
    private $popis;
    private $x;
    private $y;

    /**
     * @param $nazev
     * @param $popis
     * @param $x
     * @param $y
     */
    public function __construct($nazev, $popis, $x, $y)
    {
        $this->nazev = $nazev;
        $this->popis = $popis;
        $this->x = $x;
        $this->y = $y;
    }


    public static function getAllBod(){
        $sql = "select * from bod";

        try {
            global $link;
            $stmt = $link->prepare($sql);
            if (!$stmt) {
                throw new \mysqli_sql_exception($link->error);
            }return $stmt->execute();
        } catch (\mysqli_sql_exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
    public function insertBod(){
        $sql = "INSERT INTO bod  (popis,nazev,x,y) VALUES (?,?, ?,?)";

        try {
            global $link;
            $stmt = $link->prepare($sql);
            if (!$stmt) {
                throw new \mysqli_sql_exception($link->error);
            }
            $stmt->bind_param('ssii',$this->popis,$this->nazev,$this->x,$this->y);
            return $stmt->execute();
        } catch (\mysqli_sql_exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }

    }

    public static function deleteBod($id) {
        $sql = "DELETE FROM bod WHERE id = ?";

        try {
            global $link;
            $stmt = $link->prepare($sql);
            if (!$stmt) {
                throw new \mysqli_sql_exception($link->error);
            }
            $stmt->bind_param('i', $id);
            return $stmt->execute();
        } catch (\mysqli_sql_exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function updateBod($id) {
        $sql = "UPDATE bod SET popis = ?, nazev = ? WHERE id = ?";

        try {
            global $link;
            $stmt = $link->prepare($sql);
            if (!$stmt) {
                throw new \mysqli_sql_exception($link->error);
            }
            $stmt->bind_param('ssi', $this->popis, $this->nazev, $id);
            return $stmt->execute();
        } catch (\mysqli_sql_exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public static function getIdByCoordinates($x, $y) {
        $sql = "SELECT id FROM bod WHERE x = ? AND y = ?";

        try {
            global $link;
            $stmt = $link->prepare($sql);
            if (!$stmt) {
                throw new \mysqli_sql_exception($link->error);
            }
            $stmt->bind_param('ii', $x, $y);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                return $row['id'];
            }
            return null; // Vrátí null pokud není nalezen žádný záznam
        } catch (\mysqli_sql_exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}