# wp-composer-demo

## Introduction
This project demonstrates how to set up WordPress using Composer.

## Requirements
- PHP 7.4 or higher
- Composer

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/yourusername/wp-composer-demo.git
    cd wp-composer-demo
    ```

2. Install dependencies using Composer:
    ```sh
    composer install
    ```

3. Configure your web server to serve the [dist](http://_vscodecontentref_/1) directory as the document root.

## Usage

### Adding Plugins and Themes

To add a WordPress plugin or theme, use the following commands:

- **Plugin:**
    ```sh
    composer require wpackagist-plugin/plugin-name
    ```

- **Theme:**
    ```sh
    composer require wpackagist-theme/theme-name
    ```

### Updating Dependencies

To update all dependencies to their latest versions, run:
```sh
composer update
```

### Final package code for deployment

Running `composer install` will create `dist` folder which will have full packaged code for WordPress core and custom/external plugin/theme spcified in composer.json file.

Use this `dist` folder to deploy

### Presentation

https://docs.google.com/presentation/d/1y0MwpRFEZXdHV2wKqm5vIO3pmhOf0PDNm0MLD5Pzvmo/edit?usp=sharing
