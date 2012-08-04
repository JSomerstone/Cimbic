<?php
namespace JSomerstone\Cimbic\Core;

class Model extends \JSomerstone\JSFramework\Model
{
    /**
     * General getter for properties
     * @param string $property Name of the property to get
     * @return misc|null
     */
    public function get($property)
    {
        if (property_exists($this, $property))
        {
            return $this->$property;
        } else {
            return null;
        }
    }

    /**
     * General setter for properties
     * @param string $property Name of the property to set
     * @param misc $value Value to set $property
     * @return void
     */
    public function set($property, $value)
    {
        if (property_exists($this, $property))
        {
            $this->$property = $value;
        }
    }
}