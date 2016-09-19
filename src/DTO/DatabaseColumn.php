<?php

namespace Vynyl\Campaigner\DTO;


class DatabaseColumn
{

    private $columnName = "";

    private $columnType = "";

    private $columnSize = 500;

    private $isCustom = false;

    private $variable = "";

    /**
     * @return mixed
     */
    public function getColumnName()
    {
        return $this->columnName;
    }

    /**
     * @param mixed $columnName
     * @return DatabaseColumn
     */
    public function setColumnName($columnName)
    {
        $this->columnName = $columnName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getColumnType()
    {
        return $this->columnType;
    }

    /**
     * @param mixed $columnType
     * @return DatabaseColumn
     */
    public function setColumnType($columnType)
    {
        $this->columnType = $columnType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getColumnSize()
    {
        return $this->columnSize;
    }

    /**
     * @param mixed $columnSize
     * @return DatabaseColumn
     */
    public function setColumnSize($columnSize)
    {
        $this->columnSize = $columnSize;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsCustom()
    {
        return $this->isCustom;
    }

    /**
     * @param mixed $isCustom
     * @return DatabaseColumn
     */
    public function setIsCustom($isCustom)
    {
        $this->isCustom = $isCustom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /**
     * @param mixed $variable
     * @return DatabaseColumn
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;
        return $this;
    }

    public function toPost()
    {
        return [
            'ColumnName' => $this->getColumnName(),
            'ColumnType' => $this->getColumnType(),
            'ColumnSize' => $this->getColumnSize(),
        ];
    }

}
