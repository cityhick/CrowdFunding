<?php
/**
 * @package      CrowdFunding
 * @subpackage   Components
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('JPATH_PLATFORM') or die;

class JFormFieldCfAmount extends JFormField
{
    /**
     * The form field type.
     *
     * @var    string
     *
     * @since  11.1
     */
    protected $type = 'cfamount';

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     *
     * @since   11.1
     */
    protected function getInput()
    {
        // Initialize some field attributes.
        $size      = $this->element['size'] ? ' size="' . (int)$this->element['size'] . '"' : '';
        $maxLength = $this->element['maxlength'] ? ' maxlength="' . (int)$this->element['maxlength'] . '"' : '';
        $readonly  = ((string)$this->element['readonly'] == 'true') ? ' readonly="readonly"' : '';
        $disabled  = ((string)$this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
        $class     = (!empty($this->element['class'])) ? ' class="' . (string)$this->element['class'] . '"' : "";

        // Initialize JavaScript field attributes.
        $onchange = $this->element['onchange'] ? ' onchange="' . (string)$this->element['onchange'] . '"' : '';

        // Prepare currency object.
        $params     = JComponentHelper::getParams("com_crowdfunding");
        /** @var  $params Joomla\Registry\Registry */

        $currencyId = $params->get("project_currency");
        $currency = CrowdFundingCurrency::getInstance(JFactory::getDbo(), $currencyId, $params);

        // Prepare amount object.
        $amount = new CrowdFundingAmount($this->value);
        $amount->setCurrency($currency);

        if ($currency->getSymbol()) { // Prepended
            $html = '<div class="input-prepend input-append"><span class="add-on">' . $currency->getSymbol() . '</span>';
        } else { // Append
            $html = '<div class="input-append">';
        }

        $html .= '<input type="text" name="' . $this->name . '" id="' . $this->id . '"' . ' value="' . $amount->format() . '"' .
            $class . $size . $disabled . $readonly . $onchange . $maxLength . '/>';

        // Appended
        $html .= '<span class="add-on">' . $currency->getAbbr() . '</span></div>';

        return $html;
    }
}
