# v-1.1.24

** Change **

- ``gb_suscribe()`` function remove from ``functions.php`` and added to ``src/suscribe/gb-suscribe.php``
- ``src/suscribe/mailchimp-api-config.php`` file added to get from it sensible information like the api key and the list id.

# v-1.1.22

** Changes **

- Slider loop dir changed
- Older posts loop dir changed
- Edu widget file name changed
- ``gb_get_posts()`` and ``gb_get_loop_title()`` functions added to the loop file in the ``src/filters`` dir.
- ``gb_paginate_links()`` function added to the pagination file in the ``src/filters`` dir.
- ``gb_comments()`` function added to the pagination file in the ``src/filters`` dir.
- ``gb_excerpt_more()`` funtion added to the loop file and removed from the ``src/setup/cleanup.php`` file

# v-1.1.15

** Changes **

- Some changes in Gb Ads subpackage

# v-1.1.12

** Changes **

- ``src/menus.php`` muved to ``src/filters`` dir.
- ``src/searchform.php`` muved to ``src/filters`` dir.

# v-1.1.10

** Changes **

- Google analytics, facebook and Google adsense php functions muved to ``src/scripts`` dir.
- **js-** prefix added to analytics, facebook and adsensescripts.
- Google Analytics script added to ``wp_head()`` action.
- Google adSense and Facebook sacripts addend to ``wp_footer()`` action.

# v-1.1.6

** Changes **

- ``IE_SUPPORT`` constant added for config porpouse
- ``gb_html_tag()`` function added.

# v-1.1.4

** Changes **

- ``enqueue-scripts.php`` file muved to ``/src/scripts/``
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