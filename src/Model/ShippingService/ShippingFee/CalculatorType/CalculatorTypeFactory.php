<?php
namespace App\Model\ShippingService\ShippingFee\CalculatorType;

use App\Model\ShippingService\ShippingFee;
use App\Model\ShippingService\ShippingFee\Exception\InvalidArgumentShippingFeeConfigException;

/**
 * @package    App\Model\ShippingService\ShippingFee
 * @author     NgoLV <lavanngo@gmail.com>
 * @version    2019-08-19
 */
class CalculatorTypeFactory
{

    public static function createCalculatorType(array $calculatorTypeConfig): CalculatorType
    {
        $calculatorType = null;

        if (empty($calculatorTypeConfig['Class']) || !isset($calculatorTypeConfig['Coefficients']) || !method_exists($calculatorTypeConfig['Class'], "calculate")) {
            $strConfig = print_r($calculatorTypeConfig, true);
            throw new InvalidArgumentShippingFeeConfigException("Can not create shipping fee the config: {$strConfig}");
        } else {
            $calculatorType = new $calculatorTypeConfig['Class']();
            $calculatorType->setCoefficients($calculatorTypeConfig['Coefficients']);
        }

        return $calculatorType;
    }
}
