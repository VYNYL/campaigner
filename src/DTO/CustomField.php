<?php

namespace Vynyl\Campaigner\DTO;

class CustomField implements Postable
{
    private $fieldName;

    private $value;

    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * @param mixed $fieldName
     * @return CustomField
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return CustomField
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function toPost()
    {
        return [
            'FieldName' => $this->getFieldName(),
            'Value' => $this->getValue(),
        ];
    }
}
