<?php

namespace App\Twig;



use App\Entity\Cliente;
use App\Entity\User;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class FxExtension extends AbstractExtension{
    protected $em;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return array(
            new TwigFilter('format_sexo', array($this, 'formatSexo')),
            new TwigFilter('format_estado_civil', array($this, 'formatEstadoCivil')),
            new TwigFilter('format_tipo_documento', array($this, 'formatTipoDocumento')),
            new TwigFilter('format_tipo_cliente', array($this, 'formatTipoCliente')),
            new TwigFilter('format_mayuscula', array($this, 'formatMayuscula')),
            new TwigFilter('format_tipo', array($this, 'formatTipo')),
            new TwigFilter('format_tipo_interno', array($this, 'formatTipoInterno')),
            new TwigFilter('format_rol', array($this, 'formatRol')),
            new TwigFilter('format_contabilizar', array($this, 'formatConta')),
            new TwigFilter('format_local', array($this, 'formatLocal')),
            new TwigFilter('formatEstadosCaja', array($this, 'formatEstadosCaja')),

        );
    }


    public function formatSexo($char)
    {
        if ($char === 'm' || $char === 'M') return "Masculino";
        else if ($char === 'f' || $char === 'F') return "Femenino";

        return '--';
    }

    public function formatEstadoCivil($char)
    {
        if ($char === 's' || $char === 'S') return "Soltero";
        else if ($char === 'c' || $char === 'C') return "Casado";
        else if ($char === 'v' || $char === 'V') return "Viudo";
        else if ($char === 'd' || $char === 'D') return "Divorciado";

        return '--';
    }
    public function formatRol($rol){
        $string = $rol;
        switch ($string){
            case 'ROLE_ADMIN':
                return "ADMINISTRADOR";

            case 'ROLE_SUPERVISOR_VENTAS':
                return "Jefe Ventas";
            case 'ROLE_VENTAS':
                return "Vendedor";

        }
        dd($rol);
        return $rol;
    }

    public function formatTipoDocumento($string)
    {
        $string = strtolower($string);

        if ($string === 'dni') return "DNI";
        else if ($string === 'pasaporte') return "Pasaporte";

        return $string;
    }


    public function getName()
    {
        return 'fx_extension';
    }


    public function formatTipo($int){


        if($int==1) return "FACTURA";
        else if($int==2) return "FACTURA  CREDITO";
        else if($int==3) return "BOLETA DE VENTA";
        else if($int==4) return "BOLETA DE CREDITO";
        else if($int==5) return "VALE DE CREDITO";
        else if($int==6) return "VALE DE CONTROL";
        else if($int==7) return "VALE DE PAGO";
        else if($int==8) return "RECIBO DE EGRESO";
        else return "CODIGO NO IDENTIFICADO";
    }

    public function formatTipoCliente($string)
    {
        $string = strtolower($string);

        if ($string == Cliente::DNI ) return "DNI";
        else if ($string == Cliente::RUC) return "RUC";


        return $string;
    }
    public function formatConta($bool){
        return $bool==true?"SI":"NO";
    }

    public function formatEstadosCaja($string){
        if ($string === 'abierto') return "ABIERTO";
        else if ($string === 'cerrado') return "CERRADO";
        return '--';
    }
}
