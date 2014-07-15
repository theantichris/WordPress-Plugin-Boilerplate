# WordPress Plugin Boilerplate

## Introduction

This is an object oriented boilerplate for developing a WordPress plugin.

The main class uses the Singleton pattern to make sure that only one instance of the plugin is ever created.

Blank methods for activation, deactivation, and registering scripts and styles are included and tied to the correct hooks.

The base class sets up the text domain for internationalization and localization. Just drop your i18n and l10n files
into the lang directory and change the $text_domain property to your text domain.

A blank uninstall file is included. It is setup to make sure it can only be called from the WordPress dashboard.

All custom plugin functionality should be added to the __run_plugin()__ method.

## Setup

1. Clone or download the source to your plugin directory
1. Rename the folder to the name of your plugin
1. Rename __wordpress-plugin-boilerplate.php__ to NAME_OF_YOUR_PLUGIN.php
1. Rename the __WordPress_Plugin_Boilerplate__ class to NAME_OF_YOUR_PLUGIN
1. Change the class name in the `WordPress_Plugin_Boilerplate::get_instance();` line to the name of your class
1. Update the plugin header with your plugins information
1. Set the __$text_domain__ property to your text domain
    * This is only needed if you are using text domains for i18n and i10n
1. Start coding