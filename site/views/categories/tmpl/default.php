<?php
/**
 * @package      CrowdFunding
 * @subpackage   Components
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;?>
<div class="cfunding<?php echo $this->pageclass_sfx;?>">
    <?php if ($this->params->get('show_page_heading', 1)) { ?>
    <h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
    <?php } ?>

    <?php if (empty($this->items)) { ?>
        <p class="alert alert-warning"><?php echo JText::_("COM_CROWDFUNDING_NO_ITEMS_MATCHING_QUERY"); ?></p>
    <?php } ?>

    <div class="row-fluid">
    <?php echo $this->loadTemplate($this->templateView); ?>
    </div>

</div>
<div class="clearfix"></div>
<div class="pagination">
    <?php if ($this->params->def('show_pagination_results', 1)) { ?>
        <p class="counter">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </p>
    <?php } ?>
    <?php echo $this->pagination->getPagesLinks(); ?>
</div>
<div class="clearfix"></div>