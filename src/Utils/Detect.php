<?php
/**
 * Created by PhpStorm.
 * User: dinhnhatbang
 * Date: 3/17/18
 * Time: 7:28 PM
 */

namespace Cottect\Utils;

class Detect
{
    protected $data;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    public function isEmail()
    {
        if (filter_var($this->data, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function isPhone()
    {
        $data = str_replace(['-', '.', ' ', '+'], '', $this->data);
        if (preg_match('/^(01[2689]|09)[0-9]{8}$/', $data)) {
            return true;
        }
        return false;
    }
}
