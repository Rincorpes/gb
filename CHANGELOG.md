# v-1.1.4

** Changes **

- ``enqueue-scripts.php`` file moved to ``/src/scripts/``
- ``bg_get_scripts()`` and ``gb_get_styles()`` functions added to set scripts and stylesheets params.
- some changes in the enqueue scripts filter
- ``CDN`` constatnt added as a config param. If true, scripts and styles like bootstrap, jQuery, html5shiv or font awesome will be loaded from cdn and not from local.

# v-1.1.0

** Changes **

- ``gb_get_title()`` function added. This function allows you to get easily the page title no matter if is home, page, category or sigle page. This is usefull because you can get te title of any post as a page title.
- ``gb_get_page_type()`` function added. With this function you can get the actual page type. **website** for any page and **article** for single pages.
- ``gb_get_page_image()`` function added. Returns a featured image for any page or the post featured image.
- ``gb_get_page_description()`` function added. Returns the site, page or article description.
- ``gb_description_meta_tag()`` function added. This prints the description meta tag in the ``<heas>`` html tag.
- Some changes in the opengraph function
- ``gb_twitter_card()`` function added. This function loads the twitter card meta tags that we need in th ``<head>`` html tag

# v 1.0.3

** Changes **

- ``/src/filters`` dir added

# v 1.0.2

** Changes **

- ``/src/setup`` dir added

# v 1.0.1

** Changes **

- Fixed text domain