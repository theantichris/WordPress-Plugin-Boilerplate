WordPress-Plugin-Framework
==========================

My own framework for making the WordPress plugins the way I do.

The main plugin class is a Singleton pattern to ensure that only one instance created.

Right now it includes methods for activation, deactivation, and registering scripts and styles.

The base class sets up the text domain for internationalization and localization. A private method, translate(), is included to simplify use of the text domain. Just drop your i18n and l10n files into the lang directory.

A method for writing data to the debug.log (print_to_log()) is included.

The uninstall file is included and setup correctly to make sure it is only called from the WordPress dashboard.

Additional methods and classes will be built out as I get to them to further simplify the various WordPress APIs I use.