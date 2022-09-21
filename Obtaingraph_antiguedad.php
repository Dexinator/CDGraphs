<?php

class Obtain_data{
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo; // PDO object
  private $stmt; // SQL statement
  public $error; // Error message
  
  function __construct() {
    try {
      $this->pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER, DB_PASSWORD, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED
        ]
      );
    } catch (Exception $ex) { exit($ex->getMessage()); }
  }


  function __destruct() {
    $this->pdo = null;
    $this->stmt = null;
  }
  function check ($selected_pivot) {


    // (C2) DATABASE ENTRY
    try {
      //select date_format(attendance_date, '%M %Y') as "Month",COUNT(CASE WHEN attendance_status = "Present" then 1 END) as "Present", COUNT(CASE WHEN attendance_status = "Absent" then 1 END) as "Absent"  from tbl_attendance where attendance_date<"2022-04-01" group by year(attendance_date),month(attendance_date);
      //$this->stmt = $this->pdo->prepare("SELECT * FROM tbl_attendance  where attendance_date >= ? AND  attendance_date <= ?");
      if ($selected_pivot=="ninguno"){
        $this->stmt = $this->pdo->prepare("SELECT antiguedad, count(antiguedad) as 'Cantidad_antig' FROM `survey` GROUP BY antiguedad ORDER BY `Cantidad_antig` DESC");
        $this->stmt->execute();
      }
      if ($selected_pivot=="sexo"){
        $this->stmt = $this->pdo->prepare("SELECT antiguedad, COUNT(CASE WHEN sexo = 'H' then 1 END) as 'Hombres',COUNT(CASE WHEN sexo = 'M' then 1 END) as 'Mujeres',COUNT(CASE WHEN sexo != '' then 1 END) as 'Total' FROM `survey` GROUP BY antiguedad ORDER BY `Total` DESC");
        $this->stmt->execute();
      }
      elseif  ($selected_pivot=="antiguedad"){
        $this->stmt = $this->pdo->prepare("SELECT antiguedad, COUNT(CASE WHEN referencia= 'Me lo mencionó un muchacho de players checkpoint' then 1 END) as 'Me lo mencionó un muchacho de players checkpoint',COUNT(CASE WHEN referencia= 'Fachada' then 1 END) as 'Fachada',COUNT(CASE WHEN referencia= 'Amigo' then 1 END) as 'Amigo',COUNT(CASE WHEN referencia= 'Lo encontré caminando ' then 1 END) as 'Lo encontré caminando ',COUNT(CASE WHEN referencia= 'Social Media' then 1 END) as 'Social Media',COUNT(CASE WHEN referencia= 'Lo encontré en internet' then 1 END) as 'Lo encontré en internet',COUNT(CASE WHEN referencia= 'Factor xpirence' then 1 END) as 'Factor xpirence',COUNT(CASE WHEN referencia= 'Mis hijas' then 1 END) as 'Mis hijas',COUNT(CASE WHEN referencia= 'Me trajeron' then 1 END) as 'Me trajeron',COUNT(CASE WHEN referencia= 'Mi hermano' then 1 END) as 'Mi hermano',COUNT(CASE WHEN referencia= 'Arcant ' then 1 END) as 'Arcant ',COUNT(CASE WHEN referencia= 'Vi por google' then 1 END) as 'Vi por google',COUNT(CASE WHEN referencia= 'Estaba buscando un café en maps y me llamo la atención ' then 1 END) as 'Estaba buscando un café en maps y me llamo la atención ',COUNT(CASE WHEN referencia!= 'Mi novio me trajo ' then 1 END) as 'Total'FROM `survey` GROUP BY antiguedad ORDER BY `Total` DESC");
        $this->stmt->execute();
      }
      elseif  ($selected_pivot=="suc_Favorita"){
        $this->stmt = $this->pdo->prepare("SELECT antiguedad, COUNT(CASE WHEN suc_Favorita= 'Cholula' then 1 END) as 'Cholula',COUNT(CASE WHEN suc_Favorita= '2 Ote' then 1 END) as '2 Ote',COUNT(CASE WHEN suc_Favorita= '16 de Seprtiembre' then 1 END) as '16 de Seprtiembre',COUNT(CASE WHEN suc_Favorita!= '' then 1 END) as 'Total'FROM `survey` GROUP BY antiguedad ORDER BY `Total` DESC");
        $this->stmt->execute();
      }
      elseif  ($selected_pivot=="frecuencia"){
        $this->stmt = $this->pdo->prepare("SELECT antiguedad, COUNT(CASE WHEN frecuencia= 2 then 1 END) as '2',COUNT(CASE WHEN frecuencia= 1 then 1 END) as '1',COUNT(CASE WHEN frecuencia= 4 then 1 END) as '4',COUNT(CASE WHEN frecuencia= 3 then 1 END) as '3',COUNT(CASE WHEN frecuencia!= '' then 1 END) as 'Total'FROM `survey` GROUP BY antiguedad ORDER BY `Total` DESC");
        $this->stmt->execute();
      }
      elseif  ($selected_pivot=="juego_favorito"){
        $this->stmt = $this->pdo->prepare("SELECT antiguedad, COUNT(CASE WHEN juego_favorito= 'Sushi' then 1 END) as 'Sushi',COUNT(CASE WHEN juego_favorito= 'Catán' then 1 END) as 'Catán',COUNT(CASE WHEN juego_favorito= 'Fantasma' then 1 END) as 'Fantasma',COUNT(CASE WHEN juego_favorito= 'Código' then 1 END) as 'Código',COUNT(CASE WHEN juego_favorito= 'Splendor' then 1 END) as 'Splendor',COUNT(CASE WHEN juego_favorito= 'King' then 1 END) as 'King',COUNT(CASE WHEN juego_favorito= 'Century' then 1 END) as 'Century',COUNT(CASE WHEN juego_favorito= 'Carcassone' then 1 END) as 'Carcassone',COUNT(CASE WHEN juego_favorito= 'Azul' then 1 END) as 'Azul',COUNT(CASE WHEN juego_favorito!= '' then 1 END) as 'Total'FROM `survey` GROUP BY antiguedad ORDER BY `Total` DESC");
        $this->stmt->execute();
      }
      elseif  ($selected_pivot=="satisfacción"){
        $this->stmt = $this->pdo->prepare("SELECT antiguedad, COUNT(CASE WHEN satisfacción= 3 then 1 END) as '3',COUNT(CASE WHEN satisfacción= 4 then 1 END) as '4',COUNT(CASE WHEN satisfacción= 2 then 1 END) as '2',COUNT(CASE WHEN satisfacción!= '' then 1 END) as 'Total'FROM `survey` GROUP BY antiguedad ORDER BY `Total` DESC");
        $this->stmt->execute();
      }
      elseif  ($selected_pivot=="ocupación"){
        $this->stmt = $this->pdo->prepare("SELECT antiguedad, COUNT(CASE WHEN ocupación= 'AE' then 1 END) as 'AE',COUNT(CASE WHEN ocupación= 'TC' then 1 END) as 'TC',COUNT(CASE WHEN ocupación= 'ST' then 1 END) as 'ST',COUNT(CASE WHEN ocupación= 'MT' then 1 END) as 'MT',COUNT(CASE WHEN ocupación= 'DE' then 1 END) as 'DE',COUNT(CASE WHEN ocupación= 'JU' then 1 END) as 'JU',COUNT(CASE WHEN ocupación!= '' then 1 END) as 'Total'FROM `survey` GROUP BY antiguedad ORDER BY `Total` DESC");
        $this->stmt->execute();
      }

      return $this->stmt->fetchall(); 
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
  }
  

  
}

define("DB_HOST", "localhost");
define("DB_NAME", "surveytest");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");



$_AVT = new Obtain_data();



if (isset($_GET["selected_pivot"])){
  $selected_pivot=$_GET["selected_pivot"];
  $records=$_AVT->check($selected_pivot);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($records);
}else {
  echo json_encode("LauraSAD");
}



?>