<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BinaryController extends Controller
{

    /**
     * index page of binary converter
     *
     * @return View
     */
    public function index(): View
    {
        return view('binary.index');
    }

    /**
     * convert numbers
     *
     * @param Request $request
     * @return View
     */
    public function convert(Request $request): View
    {
        $data=[];
        $from=$request->from;
        if(!$request->number){
            $data['binary'] = 'Type the number';
            $data['decimal'] = 'Type the number';
        }else{
            if ($from === 'decimal') {
                $data['dec_original'] = $request->number;
                $data[$from]=$this->fromDecToBin($request->number);
            } else {
                $data['bin_original'] = $request->number;
                $data[$from]=$this->fromBinToDec($request->number);
            }
        }
        return view('binary.index')->with($data);
    }


    /**
     * convert given binary number to decimal
     *
     * @param $number
     * @return string
     */
    protected function fromBinToDec($number): string
    {
        $parts = explode('.',$number);

        $binaryToInteger = 0;
        $binNumbers = str_split($parts[0]);

        $maxTwoDegree = count($binNumbers) - 1;
        foreach($binNumbers as $number){
            $binaryToInteger += $number == 1 ? 2 ** $maxTwoDegree : 0;
            $maxTwoDegree--;
        }

        if(!isset($parts[1])) return $binaryToInteger;
        $binNumbers = str_split($parts[1]);
        $maxTwoDegree = -1;
        $fractionalBinary = 0;
        foreach($binNumbers as $number){
            $fractionalBinary += $number == 1 ? 2 ** $maxTwoDegree : 0;
            $maxTwoDegree--;
        }
        return $binaryToInteger.'.'.$fractionalBinary;
    }

    /**
     * convert given decimal number to binary
     *
     * @param $number
     * @return string
     */
    protected function fromDecToBin($number): string
    {
        if(!is_numeric($number)) return 'Type the correct number';
        $parts = [];
        $parts[0] = (int) $number;
        $parts[1] = $this->getFractional($number);

        $integerBinary = '';
        while($parts[0] > 1){
            $integerBinary .= $parts[0]%2;
            $parts[0] /=2;
        }
        $integerBinary = strrev($integerBinary);

        $fractionalBinary = '';
        for($i = 0; $i < 6; $i++){
            $parts[1] *= 2;
            $fractionalBinary .= $parts[1] >= 1 ? '1' : '0';
            $parts[1] = $this->getFractional($parts[1]);
        }
        return $integerBinary.'.'.$fractionalBinary;
    }

    protected function getFractional($number)
    {
        $temp = (int) $number;
        if($temp == $number) return 0;
        $temp = str_replace($temp.'.','0.',$number); //если вычитать математически бывают ошибки например 129.61 - 129 = 0.61000000000001
        return $temp;
    }
}
