<?php

class MageProfis_HeaderContact_Block_Contact extends Mage_Core_Block_Template
{

    protected $opening_hours = null;

    /**
     * get array with Hours from store config
     * @return boolean || array
     */
    protected function getOpeningHours()
    {
        if (is_null($this->opening_hours))
        {
            $setting = Mage::getStoreConfig('headercontact/hours/hours');
            $hours = array();
            if ($setting)
            {
                $setting = unserialize($setting);
                if (is_array($setting))
                {
                    $i = 0;
                    foreach ($setting as $hour)
                    {
                        $hours[$i] = $hour;
                        $i++;
                    }
                    $this->opening_hours = $hours;
                } else
                {
                    return false;
                }
            }
        }
        return $this->opening_hours;
    }

    /**
     * get Today opening hours by day index 
     * @return array 
     */
    protected function getTodaysHours()
    {
        $today = date('N');
        $todays_hours = array();
        foreach ($this->getOpeningHours() as $hour)
        {
            if (isset($hour['day']) && $hour['day'] == $today)
            {
                $todays_hours[] = $hour;
            }
        }
        return $todays_hours;
    }

    /**
     * check if a phone number is available in module configuration.
     * In not use the default number
     * @return string
     */
    protected function getPhone()
    {
        $config = Mage::getStoreConfig('headercontact/contact/phone');
        $imprint = Mage::getStoreConfig('general/imprint/telephone');
        if ($config != "")
        {
            return $config;
        }
        return $imprint;
    }

    /**
     * check if a phone number is available in module configuration.
     * In not use the default number
     * @return string
     */
    protected function getEmailAddress()
    {
        $config = Mage::getStoreConfig('headercontact/contact/email');
        $imprint = Mage::getStoreConfig('trans_email/ident_general/email');
        if ($config != "")
        {
            return $config;
        }
        return $imprint;
    }

    /**
     * check if support is currently available
     * @return boolean
     */
    protected function getIsOpen()
    {
        $stamp = Mage::getModel('core/date')->timestamp(time());
        $currentDay = date('Y-m-d', $stamp);
        foreach ($this->getTodaysHours() as $hour)
        {

            $from = strtotime($currentDay . ' ' . $hour['time_from']);
            $to = strtotime($currentDay . ' ' . $hour['time_to']);
            if ($from < $stamp && $to > $stamp)
            {
                return true;
            }
        }
        return false;
    }

}
