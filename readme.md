## Wordpress Development

### Project Name

> Fictional University

### Project setup

Created using [WP Bootstrap Starter theme](https://github.com/aknjoroge/wp-bootstrap-starter), following Brad Schiff's ['Become a WordPress Developer: Unlocking Power With Code'](https://www.udemy.com/course/become-a-wordpress-developer-php-javascript/learn/lecture/7072580#overview) course

### Author

> Aknjoroge

## Feature stories

- ### Project Setup using Bootstrap 4

Instead of using the template code the Instructor provided, I decided to create the mark up and stylying on my own using Bootstarp 4 & fontawesome

- ### Blog, archive, 404 & search page designed

I implemented blogs and pagination on the blog page and styled the archive, 404 and search pages to display relevant content to a user

- ### Event post type & custom query

Defined an event post type and using a custom url query to load only future events in the post type archive page

- ### Pagination implementation on a custom query

Implemented pagination for past events using custom query

- ### Post type relations using custom fields

Relating different custom post types to each other using a relational custom field and fetching the data using a meta_query

- ### Custom thumbnails size

Added custom crop sizes for thumbnails or media uploaded, this works hand in hand with 'Manual Image Crop plugin by Tomasz Sita'

- ### Dynamic page banner that can handle a callback function

Defined a function thats used on pages and other post types to create a page banner that allows custom setting of the title, subtitle or background image. The function also accepts a callback function that can be used to provide dynamic content below the title

- ### Campus MAP rendering

On the campus archive page, Im presenting all campuses on a map using ACF Google maps component, the map location is also present in an individual campus page, where programs taught in the campus are highlighted

- ### Js powered live-search using WP Rest API

A user can open the js powered search modal using the s key or clicking on search header icon, this provides a user with a text field that uses axios to fetch data from the wordpress Rest API as they type in, all defined in a js class.

Registered a custom field to the Rest api response of a post to show the author name.

- ### Js Custom WP Rest API route

Defined a custom rest route to facilitate an advanced search which utilizes relations among different post types such as professors and programs. The endpoint also improves performance as it bundles only the required data by the frontend.

- ### Role management and custom post type permissions

Managing roles using "members" and updated permissions types for custom post types where each post type has a unique capability type that can be used to assign permissions to different role

For subscriber accounts, Im hidding the login top bar and blocking access to the backend dashboard

- ### Updated Login page

Added filters for the login header title, site html and header link,

Loading the main css styles on the login page that allows for the customization of the header and body background

- ### Notes Component

Added note taking functionality where subscribers can create, update or delete private notes. The notes are sanitized and marks as private using the 'wp_insert_post_data' filter and a user can only have a total of 5 private notes

Also the notes page can only be accessed by loggedin users

- ### Like Component & Custom REST API route

Defined custom rest endpoints for liking and unliking a professor. This includes a POST route for creating a like post type and inserting a the professor ID in the a custom field called 'professor_id'. A user can then delete the like using a DELETE route provided.

This feature is only available to loggein in users
