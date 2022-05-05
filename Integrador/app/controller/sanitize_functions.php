
<?php

function sanitize_cpf($cpf)
{

    $cpf = trim($cpf);
    $cpf = str_replace(['.', '-'], ['', ''], $cpf);
    return $cpf;
}

function sanitize_phone($number)
{
    $number = trim($number);
    $number = str_replace(['(', ')', '-', ' '], ['', '', '', ''], $number);
    return $number;
}

function sanitize_cep($cep)
{
    $cep = trim($cep);
    $cep = str_replace(['.', '-'], ['', ''], $cep);
    return $cep;
}

