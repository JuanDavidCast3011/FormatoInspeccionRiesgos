<?php
namespace App\Controllers;
use \Core\View;
use \App\Models\modelo;

class Home extends \Core\Controller{
    public function index() {
        //Retornando index con información necesaria para los select de la base de datos
        View::renderTemplate('FormatoInspección.twig', 
            [
                'empresas' => modelo::getDataEmpresas(), 
                'grupoFact' => modelo::getDataGrupFact(),
                'codigoFact' => modelo::getDataCodFact()
            ]
        ); 
    }
    public function insert(){
        //Insertando cabecera
        $InfoID = modelo::InsertInfo($_POST);
        //Validando cabecera existe
        if($InfoID){
            //Insertando el resto de datos
            modelo::InsertDatos($_POST, $InfoID);
            header('location: ?Datos');
        }
    }
    public function Datos(){
        //Consiguiendo y retornando información de los registros existentes
        View::renderTemplate('VisualizacionRegistros.twig', [
            'empresas' => modelo::getDataEmpresas(),
            'registros' => modelo::getRegistros()
        ]);
    }
}