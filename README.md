# WordPress-Plugin-Framework

My own framework for making the WordPress plugins the way I do.

The main plugin class is a Singleton pattern to ensure that only one instance created.

Includes blank methods for activation, deactivation, and registering scripts and styles.

The base class sets up the text domain for internationalization and localization. Just drop your i18n and l10n files into the lang directory.

A blank uninstall file is included and setup correctly to make sure it is only called from the WordPress dashboard.

Additional methods and classes will be built out as I get to them to further simplify the various WordPress APIs I use.

## Helper Functions

I include some helper functions within the main class of the framework. They are public, static functions so can be used anywhere.

### print_to_log()

Writes a message to debug.log in the wp-content folder if you have the wp-config.php setup to do that.

### make_singular()

Takes a plural string and makes it singular.