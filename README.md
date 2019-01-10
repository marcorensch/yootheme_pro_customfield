# Customfield Widget for Yootheme Pro
Customfield Widget for Yootheme Pro Templates to display Joomla! Customfields as Widgets where you want.

## Installation
Follow the official instructions from Yootheme to use Custom Elements on your Site:<br>
https://yootheme.com/support/yootheme-pro/joomla/custom-elements

Copy the Folder "nx_customfields" into your Child Theme

## Usage
The Widget / Element supports multiple Customfields per Element and (actually) two Display states.  
1. Add the widget to your site  
2. Select the Layout  
3. Add a new ITEM to the widget  

### An item contains the following fields: 
* __Select Layout__  
Here you can select the Frontend Layout for your Customfields
* __Content__  
Title for this item in builder  
* __Customfield__  
The name of your custom field you want to display  
* __Prefix__  
Text which will be rendered before the custom field value without spaces  
* __Suffix__  
Text which will be rendered after the custom field value without spaces  

### Overview Layout & Advanced Tab
* __Name__  
Widget Name inside Builder
* __ID__  
HTML Container ID for this Widget
* __Class__  
HTML Container class for this widget
* __CSS__  
CSS rules for this element __Note:__ at the moment you have to use this field in combination with your elements root id or class otherwise the classes "el-container / el-name / el-number" will be used globally

# Layouts
## Block Layout
In Block Layout Mode your Customfield will be rendered in a simple Div Element. Additional Items can be added, they will also be rendered inside its own div elements.

## Result Table
The Result Table Layout is not really a table container. In the actual release it is a fixed div Construct to display Game Results like so:


Team A Name | Team A Points | Divider (:) | Team B Points | Team B Name
--- | --- | --- | --- | ---

This means you have to add your customfields (items) which holds your data in the same order (first item = Team A Name, second item = Team A Points...)
