//////////////////////////////////////////////////////////////////////////////////////////
//							View compilation (for public views)
//////////////////////////////////////////////////////////////////////////////////////////

Views must be compiled before being used.
To compile a view execute the following in a terminal:

php starter.php

To run a process to auto-compile views, set the path in 'views' folder:

cd /renderization/views

And then execute:

watch -d 'php <path_to_starter.php'>

i.e.: watch -d 'php /Volumes/proyectos/a4ai/web/wordpress/wp-content/themes/A4AI/renderization/starter.php'

//////////////////////////////////////////////////////////////////////////////////////////
//									 Clear caches
//////////////////////////////////////////////////////////////////////////////////////////

There is SH file called 'restart.sh' in the root of the theme. We could invoke it to clear
all the caches, it also invokes the previous starter.php file.

./restart.sh

As before, we could call it in the watch command:

watch -d ./<path_to_restart.sh>

i.e.: watch -d /Volumes/proyectos/a4ai/web/wordpress/wp-content/themes/A4AI/restart.sh

//////////////////////////////////////////////////////////////////////////////////////////
//								  Clear WPEngine Cache
//////////////////////////////////////////////////////////////////////////////////////////

The A4AI project is hosted by WPEngine. This service has a enabled cache that should be
cleared after any update to view the changes.

In the Wordpress Dashboard we have a link at the top of the left sidebar called 'WP Engine',
there we should click on the button 'Purge All Caches'. This should be done in the 
production server after any update.

//////////////////////////////////////////////////////////////////////////////////////////
//									Theme Structure
//////////////////////////////////////////////////////////////////////////////////////////

- custom-css/
- fonts/ Font types.
- functions.php Custom theme functionalities. Dashboard report and report_items are here.
- images/
- inc/ Vendor libraries
	- lightncandy/ PHP implementation of Handlebars
		https://github.com/zordius/lightncandy
	- owl-carousel/ Own Carousel used for some carousels in the site.
	- simplehtmldom/ PHP library to parse HTML elements, it was used in 2014 Report, not
		used now.
- lang/ Static internationalisation labels.
- page-templates/ Custom Page templates
	- a4ai-template-single.php Single template
	- a4ai-template.php
- renderization/ Custom template engine
- restart.sh After any change in any view we should execute this file to apply changes and
	clear all the caches. If we change report table we should also invoke this file.
- scripts/ JavaScript files.
- styles/ CSS files.
	- a4ai.css Main CSS file

//////////////////////////////////////////////////////////////////////////////////////////
//									Renderization folder
//////////////////////////////////////////////////////////////////////////////////////////

- compiled-views Any template used by this engine must be compiled before use. After any
	change it should be compiled to view the changes. To compile them use starter.php as
	described above.
- compiler.php This class is used to compile views. It contains the array of helpers, so
	if a new helper is needed it should be added here.
- controller.php This class manages the view that should be rendered and the model that
	should be executed to obtain the JSON data.
- dashboard/ This folder contains the files needed to render the private report management
	in the dashboard. Out of this folder you will find the files to render user public
	views.
- data/ Contains cached data to avoid calling the external Data API.
	- api.php This resource is called from JS to gets data from the external API, the first
		time a URL is asked for it calls the external API and stores the result in a file,
		any later call will get the stored file data.
- models/ Here you will find the models that return the data shown in the view. The name
	of each file will match the name of the view with PHP as extension. report.hbs will
	ask models/report.php for data.
- utils/ auxiliary methods.
- views/ Template views. Any change should be followed by a call of the starter.php file.

//////////////////////////////////////////////////////////////////////////////////////////
//									Public resource flow
//////////////////////////////////////////////////////////////////////////////////////////

- A user visits the /report resource. This resource is supported by this render engine.
- renderer.php looks for a template called report. It uses compiled views so it search for
	the file renderization/compiled-views/report.php. This is the reason why you have to
	compile any changed view.
- Now, renderer.php will look for a model to obtain the data. If exists it will be called
	renderization/models/report.php.
- The compiled view is executed, it used the model-returned data to replace the handlebars
	tags. The returned value is the HTML that is send to the browser.
	
//////////////////////////////////////////////////////////////////////////////////////////
//								   Private Report Management
//////////////////////////////////////////////////////////////////////////////////////////

- functions.php defines two custom report types:
	- report: a report represents a year A4AI report.
	- report_item: each report part of one report, it could be a chapter, part of a chapter,
		a table, a chart, etc.
		
	These report types are used to manage the report in the private dashboard and to 
	generate the report that the user views in the public report section.
	
	In functions.php some Wordpress handlers are defined for the report management.
	
- renderization/dashboard/compiled-views These folder contains the compiled views used in
	the private area, dashboard.
- renderization/dashboard/css These CSS files are used in the private area for the report
	management.
- renderization/dashboard/data Contains cached data.
	- charts.json Defines the catalogue of charts that appears in any report item edition.
	- tables.json This file contains the catalogue of tables of the report. Tables are
		generated in renderization/utils/report_utils.php and are cached in this file. Any
		change in the generation of the tables should be followed by a removal of this file.
		DO NOT delete charts.json.
- js/ JavaScript files used in the report management.
- views/ The views used in the dashboard. Any change should be followed by a removal of
	the compiled view.
	
//////////////////////////////////////////////////////////////////////////////////////////
//									Report Data Tables
//////////////////////////////////////////////////////////////////////////////////////////

To create a new data table for the report you will need to create TXT file with the HTML of
the table in the directory /renderization/models/tables. You could follow the syntax of
any of the existing ones to create a new table. Notice that the caption of the table
includes the tag {{caption}} that is replaced in the PHP code.

The <table> tag must have a unique id. Once the table is created you should include it in 
the function generateDataTables of the file /renderization/utils/report_utils.php.

Thar function returns an object that includes the catalogue of tables for each year. The
identifier of the table in that object must match the id you set in the <table> tag.

After creating a table you need to delete the cached file:

renderization/dashboard/data/tables.json

That file is removed by the SH restart.sh, so you could invoke it to create the new
catalogue of tables.