<?php

class MageProfis_HeaderContact_Block_Config_Hours extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{

    /**
     * 
     * @return type
     */
    protected function _getAttrRenderer()
    {
        if (!$this->_groupRenderer)
        {
            $this->_groupRenderer = $this->getLayout()->createBlock(
                    'headercontact/config_hours_hour', '', array('is_render_to_js_template' => true)
            );
            $this->_groupRenderer->setClass('list');
        }
        return $this->_groupRenderer;
    }

    public function _prepareToRender()
    {
        $this->addColumn('day', array(
            'label' => Mage::helper('headercontact')->__('day'),
            'renderer' => $this->_getAttrRenderer(),
        ));
        $this->addColumn('time_from', array(
            'label' => Mage::helper('headercontact')->__('from'),
            'style' => 'width:60px'
        ));
        $this->addColumn('time_to', array(
            'label' => Mage::helper('headercontact')->__('to'),
            'style' => 'width:60px'
        ));
        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('headercontact')->__('Add');
    }

    /**
     * Prepare existing row data object
     *
     * @param Varien_Object
     */
    protected function _prepareArrayRow(Varien_Object $row)
    {
        $row->setData(
                'option_extra_attr_' . $this->_getAttrRenderer()->calcOptionHash($row->getData('day')), 'selected="selected"'
        );
    }

}
