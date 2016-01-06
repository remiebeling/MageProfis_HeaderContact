<?php
class MageProfis_HeaderContact_Block_Config_Hours_Hour
extends Mage_Core_Block_Html_Select
{
/**
     * get Options
     * 
     * @return array
     */
    protected function _getOptions()
    {
        $methods = Mage::getSingleton('shipping/config')->getActiveCarriers();
        $options = array(
            1 => Mage::helper('headercontact')->__('Monday'),
            2 => Mage::helper('headercontact')->__('Tuesday'),
            3 => Mage::helper('headercontact')->__('Wednesday'),
            4 => Mage::helper('headercontact')->__('Thursday'),
            5 => Mage::helper('headercontact')->__('Friday'),
            6 => Mage::helper('headercontact')->__('Saturday'),
            7 => Mage::helper('headercontact')->__('Sunday'),
        );
        return $options;
    }
    /**
     * alias for self::setName
     * 
     * @param string $value
     * @return string
     */
    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml()
    {
        if (!$this->getOptions()) {
            foreach ($this->_getOptions() as $id => $label) {
                $this->addOption($id, addslashes($label));
            }
        }
        return parent::_toHtml();
    }
}