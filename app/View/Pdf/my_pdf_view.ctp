<?php
App::import('Vendor','xtcpdf'); 
$tcpdf = new XTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans'



//$tcpdf->SetAuthor("KBS Homes & Properties at http://kbs-properties.com");
$tcpdf->SetAutoPageBreak( true, 25 );
$tcpdf->setHeaderFont(array('helvetica','',12));
$tcpdf->xheadercolor = array(255,255,255);
$tcpdf->SetTopMargin(45);

$tcpdf->xheadertext = $header;
$tcpdf->xfootertext = $footer;

$tcpdf->AddPage();

$html = "
<!-- EXAMPLE OF CSS STYLE -->
<style>
    
    td {
        text-align:center;
    }
    

</style>";
$html.=$table;
// Now you position and print your page content
// example: 

$tcpdf->SetTextColor(0, 0, 0);
$tcpdf->SetFont($textfont,14);
//$tcpdf->Cell(0,14, $html, 0,1,'L');
// ...
// etc.
// see the TCPDF examples 
 
 
$tcpdf->writeHTML($html, true, false, true, false, '');
 
$tcpdf->lastPage();
 
echo $tcpdf->Output(APP . 'files/pdf' . DS . 'test.pdf', 'F');
print $html;
?>


