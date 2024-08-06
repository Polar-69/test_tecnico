<?php
class converterNumber{
    public $numRomano;
    public $numArabic;

    public function __construct($numRomano = null, $numArabic = null)
    {
        $this->numRomano = $numRomano;
        $this->numArabic = $numArabic;
    }

    public function converterToRoman($integer){ 
        // A matriz com as chaves são símbolos romanos e seu valor é equivalente em algarismos arábicos
        $number = array(
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        );
        //Inicialize a variável para retorno e construa os números convertidos
        $return = '';

        // loop para percorrer todo o array para construir o número
        while($integer > 0) 
        {
            foreach($number as $rom=>$arb) 
            {
                if($integer >= $arb)
                {
                    $integer -= $arb;
                    $return .= $rom;
                    break;
                }
            }
        }
        // Devolva o número
        return $return;
    }

    public function converterToArabic($roman) {
        $map = array(
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        );
        $return = 0;
        $i = 0;
        $length = strlen($roman);
        while ($i < $length) {
            foreach ($map as $key => $value) {
                // Verifique se a substring corresponde a uma chave do mapa
                if (substr($roman, $i, strlen($key)) === $key) {
                    $return += $value;
                    $i += strlen($key);
                    break;
                }
            }
        }
        return $return;
    }
}
?>