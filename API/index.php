<?php
/* Mostrar errores */
ini_set("display_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", "C:/xampp/htdocs/api/php_error_log");
/*Encabezada de las solicitudes*/
/*CORS*/
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
/*--- Requerimientos Clases o librerías*/
require_once "models/MySqlConnect.php";
/***--- Agregar todos los modelos*/
require_once "models/UsuarioModel.php";
require_once "models/LoginModel.php";
require_once "models/CategoriaModel.php";
require_once "models/ProductoModel.php";
require_once "models/MarcaModel.php";
require_once "models/EspecialidadModel.php";
require_once "models/ServicioModel.php";
require_once "models/SubServicioModel.php";
require_once "models/MedicoModel.php";
require_once "models/CitaModel.php";
require_once "models/FacturaModel.php";
require_once "models/SucursalModel.php";
/***--- Agregar todos los controladores*/
require_once "controllers/UsuarioController.php";
require_once "controllers/LoginController.php";
require_once "controllers/CategoriaController.php";
require_once "controllers/ProductoContoller.php";
require_once "controllers/MarcaController.php";
require_once "controllers/EspecialidadController.php";
require_once "controllers/ServicioController.php";
require_once "controllers/SubServicioController.php";
require_once "controllers/MedicoController.php";
require_once "controllers/CitaController.php";
require_once "controllers/FacturaController.php";
require_once "controllers/SucursalController.php";
//Enrutador
//RoutesController.php
require_once "controllers/RoutesController.php";
$index = new RoutesController();
$index->index();
