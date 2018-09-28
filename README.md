# Gulp Workflow with SASS and PUG
This workflow gathers some cool tasks like compiling [PUG](https://pugjs.org/ "PUG official website") files into HTML files, compiling [SASS](http://sass-lang.com/ "SASS official website") files into CSS files, minifying images and browser reloading.

## 1\. Getting Started

First you need to install [Node.js](https://nodejs.org/en/ "officiel Nodejs website") on your computer. Then open a terminal (Your favorite terminal will be perfect), and now go to the directory root with the following command:

`cd path/to/the/directory/gulp-workflow`


## 2\. Installation

Here, you can install dependencies (you need to [install yarn first](https://yarnpkg.com/lang/en/docs/install/ "yarn installation page")).
Run this command:

`yarn install`

It installs all dependancies found in the `package.json`.


## 3\. Run it

You need to install gulp globally with this command:

`yarn add gulp -g`

Then just run the following command line:

`gulp`

It executes the default task and launch the server.
I think it's better to show you this workflow in action. So the `index.html` is a kind of documentation and it can help you with some option.

## Changelog
* **V1.04** 2018-01-07:
    * Replace `npm` by `yarn`
    * Update `gulp-sass` version (resolve `node-sass` incompatibility with new versions of Node)
    * Update the doc
* **V1.03** 2017-08-15:
    * Replace  `gulp-jade` by `gulp-pug`
    * Fix some `gulpfile.js` errors
* **V1.02** 2016-11-03:
    * Now Browser reload the page when images and fonts are added to the project.
    * Add a .gitignore for node_modules
* **V1.01** 2016-06-22:
    * SASS `@import` with [the official SASS specification](http://sass-lang.com/guide "SASS Guide") for filenames. SASS files are now preceded by an underscore like `_colors.scss`.
    * Fix the directory structure in jade too.
* **V1.0** 2016-06-16: Initial release
