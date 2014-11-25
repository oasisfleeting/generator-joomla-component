<?php
/**
 * <%= viewFolderName %>/edit.php
 *
 * Default view for view <%= name %> in <%= componentName %> component
 *
 * @package		<%= _.underscored(componentName) %>
 * @subpackage	<%= viewFolderName %>
 *
 * @copyright	Copyright (C) <%= currentDate %> <%= authorName %>. All rights reserved.
 * @license		<%= license %>
 */
// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_<%= _.underscored(componentName) %>/assets/css/<%= _.underscored(componentName) %>.css');
?>
<script type="text/javascript">
    Joomla.submitbutton = function(task)
    {
        if (task == '<%= viewFolderName.slice(0,-1) %>.cancel') {
            Joomla.submitform(task, document.getElementById('<%= viewFolderName.slice(0,-1) %>-form'));
        }
        else {
            
            if (task != '<%= viewFolderName.slice(0,-1) %>.cancel' && document.formvalidator.isValid(document.id('<%= viewFolderName.slice(0,-1) %>-form'))) {
                
                Joomla.submitform(task, document.getElementById('<%= viewFolderName.slice(0,-1) %>-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>
<form action="<?php echo JRoute::_('index.php?option=com_<%= _.underscored(componentName) %>&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="<%= viewFolderName.slice(0,-1) %>-form" class="form-validate">
	<div class="control-group">
		<div style="float: left;padding-right: 10px;"><?php echo $this->form->getLabel('title'); ?></div>
		<?php echo $this->form->getInput('title'); ?>
	</div>
	<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>
            <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_<%= _.underscored(componentName).toUpperCase() %>_TITLE_GENERAL')); ?>
            <div class="row-fluid">
                    <div class="span6 form-horizontal">
                            <fieldset class="adminform">
                                    <div class="control-group">
                                            <div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
                                            <div class="controls"><?php echo $this->form->getInput('id'); ?></div>
                                    </div>
                                    <input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
                                    <input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
                                    <input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
                                    <input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />
                                    <?php if(empty($this->item->created_by)){ ?>
                                    <input type="hidden" name="jform[created_by]" value="<?php echo JFactory::getUser()->id; ?>" />
                                    <?php } 
                                            else{ ?>
                                    <input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />
                                    <?php } ?>
                                    <div class="control-group">
                                            <div class="control-label"><?php echo $this->form->getLabel(''); ?></div>
                                            <div class="controls"><?php echo $this->form->getInput(''); ?></div>
                                    </div>
                            </fieldset>
                    </div>
            </div>
            <?php echo JHtml::_('bootstrap.endTab'); ?>
            <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'information', JText::_('COM_<%= _.underscored(componentName).toUpperCase() %>_TITLE_INFORMATION')); ?>      
            <div class="span6 form-horizontal">
                    <fieldset class="adminform">
                            <div class="control-group">
                                    <div class="control-label"><?php echo $this->form->getLabel(''); ?></div>
                                    <div class="controls"><?php echo $this->form->getInput(''); ?></div>
                            </div>
                    </fieldset>
            </div>
            <div class="span6 form-horizontal">
                    <fieldset class="adminform">
                            <div class="control-group">
                                    <div class="control-label"><?php echo $this->form->getLabel(''); ?></div>
                                    <div class="controls"><?php echo $this->form->getInput(''); ?></div>
                            </div>
                    </fieldset>
            </div>
            <?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php echo JHtml::_('bootstrap.endTabSet'); ?>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<script type="text/javascript"></script>
