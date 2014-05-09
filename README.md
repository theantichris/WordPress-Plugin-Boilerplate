# WordPress Plugin Framework

## Composer

I have created a Composer package of just the framework part of this project (no plugin boilerplate). If you don't use Composer you can also just drop the framework files from the package and drop them into your plugin. The files have been refactored and namespaced to work with any plugin.

## Introduction

This is an OOP framework for developing WordPress plugins.

The main class uses the Singleton pattern to make sure that only one instance of the plugin is ever created.

I have included blank methods for activation, deactivation, and registering scripts and styles.

The base class sets up the text domain for internationalization and localization. Just drop your i18n and l10n files into the lang directory.

I have included a blank uninstall file that is setup to make sure it can only be called from the WordPress dashboard.

All custom plugin functionality should be started in the run_plugin() method.

## Instantiating Objects

When instantiating an object such as Custom_Post_Type or Taxonomy save it to the proper array property on the main class.

```
$this->custom_post_types[ 'new_custom_post_type' ] = Custom_Post_Type( $plural_post_type_name, $capabilities, $support, $menu_icon );
```

## Custom Post Types

You can create a custom post type through the CustomPostType object. The class accepts optional arguments for post capabilities (array), post support ( array ), and menu icon (string). If nothing is specified they are set to the WordPress default

Create new custom post types in the main plugin class constructor.

```
$new_post_type = new Custom_Post_Type( $plural_post_type_name, $capabilities, $support, $menu_icon );
```

## Taxonomies

Taxonomies can be added to post types by creating a Custom_Taxonomy object. The $post_types parameter is options and will use “post” if not specified, it will accept a string or array of strings.

```
$new_taxonomy = new Custom_Taxonomy( $plural_taxonomy_name, $post_types );
```

## Terms

You can add terms to a Custom_Taxonomy object by using the add_terms() method. It accepts a single parameter that can either be a string or array of strings.

```
$new_taxonomy->add_terms( $terms );
```

## Pages

You can create new dashboard pages by using the Menu_Page, Object_Page, Utility_Page, Sub_Menu_Page, and Options_Page classes.

The only required fields are $page_title and $view_path. The $parent_slug field is only required for Sub_Menu_Page.

All pages use the View object to echo the HTML.

To add a top-level menu page use the Menu_Page class.

```
$menu_page = new Menu_Page( $page_title, $view_path, $capability = 'manage_options', $icon_url = null, $position = null, $view_data = array(), $parent_slug = null );
```

### Removing Pages

You can remove a page using the remove_page( $page_slug ) method.

## View

There is a View class that provides to introduce some MVC functionality to the framework and make it simpler to create pages and other output.

To create a view place a PHP file that displays the HTML into the /views/ directory.

Assign the file name to $view_file. If you need to pass any data to the View assign it to an associative array to the $view_data property.

View::render() must be echoed.

```
echo View::render( $view_file, $view_data = null );
```

## Settings

You can create options for your plugin using the Settings class.

```
$setting = new Settings( $page_slug ); // Creates the settings object with the slug of the page. This could be a default page or one you create.
$setting->add_section( 'My Section', $view ); // Creates the settings section your options will be grouped under. The view will contain the header for the section.
$setting->add_field( 'My Field', $view ); // Creates the field and adds it to the section. The view needs to contain the input field for the option.
```

## Helper Functions

Some helper functions are included in the main plugin class. They are public, static functions so can be used anywhere.

### print_to_log()

Writes a message to debug.log in the wp-content folder if you have the wp-config.php setup to do that. It will accept any variable or string.

```
WordPress_Plugin_Framework::print_to_log( $message_to_send );
```

### make_singular()

Takes a plural string and makes it singular.

```
$singular_string = WordPress_Plugin_Framework::make_singular( $plural_string );
```

### make_slug()

Takes a string and makes a WordPress slug by replacing spaces with hyphens and making all letters lowercase.

```
$slug = WordPress_Plugin_Framework::make_slug( $string );
```
