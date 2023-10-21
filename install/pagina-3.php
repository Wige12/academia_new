<?php
$pasta = "../install/";

if(is_dir($pasta))
{
$diretorio = dir($pasta);

while($arquivo = $diretorio->read())
{
if(($arquivo != '.') && ($arquivo != '..'))
{
unlink($pasta.$arquivo);
rmdir($pasta); 

header('Location: ../../../../academia');
}
}

$diretorio->close();
}
else
{
echo 'A pasta não existe.';
}
?>