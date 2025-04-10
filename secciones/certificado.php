<?php

require('../librerias/fpdf/fpdf.php');
include_once '../configuraciones/bd.php';

$conexionBD=BD::crearInstancia();


function agregarTexto($pdf, $texto, $x, $y, $align='L', $fuente, $size=10, $r=0, $g=0, $b=0) {
      $pdf->SetFont($fuente,"", $size);
//    $pdf->Text($x, $y, $texto)
       $pdf->SetXY($x, $y);
       $pdf->SetTextColor($r,$g,$b);
       $pdf->Cell(0,10, $texto,0,0,$align); //0 y 10 representa x,y alineado el texto, 0,1 representa ancho y alto y la alineacion
       
}

function agregarImagen($pdf, $imagen, $x, $y){
      $pdf->Image($imagen, $x, $y, 0); 
}

$idcurso=isset($_GET['idcurso'])?$_GET['idcurso']:'';
$idalumno=isset($_GET['idalumno'])?$_GET['idalumno']:'';

$sql="SELECT alumnos.nombre, alumnos.apellidos, nombre_curso 
FROM alumnos, cursos WHERE alumnos.id=:idalumno AND cursos.id=:idcurso";
$consulta=$conexionBD->prepare($sql);
$consulta->bindParam(':idalumno', $idalumno);
$consulta->bindParam(':idcurso', $idcurso);
$consulta->execute();
$alumno=$consulta->fetch(PDO::FETCH_ASSOC);
//print_r($alumno); 



$pdf=new FPDF("L", "mm", array(254,194));
$pdf->AddPage();
$pdf->setFont("Arial", "B", 16);
agregarImagen($pdf, "../src/Certificado.jpg",0,0);
agregarTexto($pdf,  ucwords($alumno['nombre']." ".$alumno['apellidos']), 155, 90, 'L', "Helvetica", 30, 0, 84, 115);
agregarTexto($pdf, ucwords($alumno['nombre_curso']), -140, 145, 'C', "Helvetica", 11, 0, 84, 115);
//agregarTexto($pdf, date("d/m/Y"), 160, 145, 'C', "Helvetica", 11, 0, 84, 115);
$pdf->Output(); 


//print_r($_GET);

/* $pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Yeison Carmona!');
$pdf->Output(); */

//print_r($alumno['nombre']." ".$alumno['apellidos']);  ucwords($alumno['nombre']." ".$alumno['apellidos'])
//print_r($alumno['nombre_curso']); ucwords($alumno['nombre_curso'])

?>