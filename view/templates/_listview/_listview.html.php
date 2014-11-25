<?php
/**
 * <%= viewFolderName %>/view.html.php
 *
 * View and display logic for back-end administrator view <%= name %> in <%= componentName %> component
 *
 * @package		<%= _.slugify(componentName) %>
 * @subpackage	<%= viewFolderName %>
 *
 * @copyright	Copyright (C) <%= currentDate %> <%= authorName %>. All rights reserved.
 * @license		<%= license %>
 */
defined('_JEXEC') or die;
/**
 * Class		<%= viewClassName %>
 * @author		<%= authorName %> <<%= authorEmail %>>
 * TODO: Describe your view here
 */
class <%= viewClassName %>View<%= _.underscored(componentName) %> extends JViewLegacy {
	// TODO: place attributes here: ex. $protected $items;
    	protected $items;
    	protected $pagination;
    	protected $state;
    	
	/**
	 * Display logic for when view is displayed
	 *
	 * @author <%= authorName %> <<%= authorEmail %>>
	 *
	 * @param String $tpl template which is used to display the component page (view)
	 *
	 * @return bool whether items have been displayed
	 */
	public function display($tpl = null) {
        	$this->state = $this->get('State');
        	$this->items = $this->get('Items');
        	$this->pagination = $this->get('Pagination');	
        	
	        // Check for errors.
	        if (count($errors = $this->get('Errors'))) {
	            throw new Exception(implode("\n", $errors));
	        }
	        
        	//<%= componentName %>Helper::addSubmenu('<%= viewClassName %>');	        
        
		// TODO: constructor logic here
		parent::display($tpl);
	}
	
	/**
	* Add the page title and toolbar.
	*
	* @since	1.6
	*/
	protected function addToolbar() {
	require_once JPATH_COMPONENT . '/helpers/<%= _.underscored(componentName) %>.php';
	$state = $this->get('State');
	$canDo = Metro_<%= viewFolderName.slice(0,-1) %>Helper::getActions($state->get('filter.category_id'));
	JToolBarHelper::title(JText::_('COM_<%= _.underscored(componentName).toUpperCase() %>_TITLE_<%= _.classify(viewClassName).toUpperCase() %>'), '<%= viewFolderName %>.png');
	//Check if the form exists before showing the add/edit buttons
	$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/<%= viewFolderName.slice(0,-1) %>';
	if (file_exists($formPath)) {
	    if ($canDo->get('core.create')) {
	        JToolBarHelper::addNew('<%= viewFolderName.slice(0,-1) %>.add', 'JTOOLBAR_NEW');
	    }
	    if ($canDo->get('core.edit') && isset($this->items[0])) {
	        JToolBarHelper::editList('<%= viewFolderName.slice(0,-1) %>.edit', 'JTOOLBAR_EDIT');
	    }
	}
	if ($canDo->get('core.edit.state')) {
	    if (isset($this->items[0]->state)) {
	        JToolBarHelper::divider();
	        JToolBarHelper::custom('<%= viewFolderName %>.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
	        JToolBarHelper::custom('<%= viewFolderName %>.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
	    } else if (isset($this->items[0])) {
	        //If this component does not use state then show a direct delete button as we can not trash
	        JToolBarHelper::deleteList('', '<%= viewFolderName %>.delete', 'JTOOLBAR_DELETE');
	    }
	    if (isset($this->items[0]->state)) {
	        JToolBarHelper::divider();
	        JToolBarHelper::archiveList('<%= viewFolderName %>.archive', 'JTOOLBAR_ARCHIVE');
	    }
	    if (isset($this->items[0]->checked_out)) {
	        JToolBarHelper::custom('<%= viewFolderName %>.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
	    }
	}
	//Show trash and delete for components that uses the state field
	if (isset($this->items[0]->state)) {
	    if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
	        JToolBarHelper::deleteList('', '<%= viewFolderName %>.delete', 'JTOOLBAR_EMPTY_TRASH');
	        JToolBarHelper::divider();
	    } else if ($canDo->get('core.edit.state')) {
	        JToolBarHelper::trash('<%= viewFolderName %>.trash', 'JTOOLBAR_TRASH');
	        JToolBarHelper::divider();
	    }
	}
	if ($canDo->get('core.admin')) {
	    JToolBarHelper::preferences('com_<%= _.underscored(componentName) %>');
	}
	//Set sidebar action - New in 3.0
	JHtmlSidebar::setAction('index.php?option=com_<%= _.underscored(componentName) %>&view=<%= viewFolderName %>');
	$this->extra_sidebar = '';
	
		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_PUBLISHED'),
			'filter_published',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), "value", "text", $this->state->get('filter.state'), true)
		);
	}
    
	protected function getSortFields()
	{
		return array(
		'a.id' => JText::_('JGRID_HEADING_ID'),
		'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
		'a.state' => JText::_('JSTATUS'),
		'a.title' => JText::_('COM_<%= <%= _.underscored(componentName).toUpperCase() %> %>_<%= _.classify(viewClassName).toUpperCase() %>_TITLE'),
		);
	}	
}
