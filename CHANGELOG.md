## Version 6.0.0

* Removed framework, see [SPF](https://github.com/theantichris/Simple-Plugin-Framework)
* Simplified main plugin class and uninstall.php to just be a boilerplate

## Version 5.0.1

* Added hooks to enqueue scripts and styles in the admin as well as the front end
* $plugin_url and $plugin_path are now static properties, each one now has a getter
* The path to the view folder is now hardcoded, references to the view should only be the file name now
* Moved remove_page() from subclasses to Page class. Sub_Menu_Page overrides it.

## Version 5.0.0

* Settings class

## Version 4.0.0

* Pages

## Version 3.0.0

* Taxonomies

## Version 2.0.0

* Added creation of basic custom post type
* Added helper method to make strings singular
* Changed print_to_log() to be public and static so it can be used outside the main class easily

### Version 1.0.1

* Removed DRY text domain stuff

### Version 1.0.0

* Initial release