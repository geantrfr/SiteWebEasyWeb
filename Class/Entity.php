<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 19/03/2018
 * Time: 17:18
 */

abstract class Entity
{
    private $arrErrors = [];

    public function __construct($values)
    {
        $this->hydrate($values);
    }

    private function hydrate($values)
    {
        if (is_array($values)) {
            foreach ($values as $key => $value) {
                $methodName = 'set' . ucfirst($key);
                if (method_exists($this, $methodName)) {
                    $this->$methodName($value);
                } else {
                    //echo "la methode $methodName n'existe pas";
                }
            }
        }
    }

    public function getErrors()
    {
        foreach ($this->arrErrors as $key => $value) {
            echo $key . ' ' . $value . '<br />';
        }
    }

    protected function postError($txt)
    {
        $this->arrErrors[] = $txt;
    }

    /**
     * @return array
     */
    public function getArrErrors()
    {
        return $this->arrErrors;
    }

    /**
     * @param array $arrErrors
     */
    public function putArrErrors($arrErrors)
    {
        $this->arrErrors = $arrErrors;
    }



}