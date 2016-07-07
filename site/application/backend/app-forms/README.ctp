
Creating a new form


1. ``` vagrant up ```
2. ``` vagrant ssh ```
1. Create schema in database
1. Bake model
	``` cd /srv/site/application/backend/app-forms/Console ```
	``` ./cake bake ```
	Choose [M] for model
	Pick the table you want to create a model
1. Bake controller.
	
	Choose [C]
	Answers questions as follows:

	```
	---------------------------------------------------------------
	Baking TravelapplicationsController
	---------------------------------------------------------------
	Would you like to build your controller interactively?
	Warning: Choosing no will overwrite the TravelapplicationsController. (y/n) 
	[y] > y
	Would you like to use dynamic scaffolding? (y/n) 
	[n] > 
	Would you like to create some basic class methods 
	(index(), add(), view(), edit())? (y/n) 
	[n] > y
	Would you like to create the basic class methods for admin routing? (y/n) 
	[n] > 
	Would you like this controller to use other helpers
	besides HtmlHelper and FormHelper? (y/n) 
	[n] > 
	Would you like this controller to use other components
	besides PaginatorComponent? (y/n) 
	[n] > 
	Would you like to use Session flash messages? (y/n) 
	[y] > 

	---------------------------------------------------------------
	The following controller will be created:
	---------------------------------------------------------------
	Controller Name:
		Travelapplications
	Components:
		Paginator, Session
	---------------------------------------------------------------
	Look okay? (y/n) 
	[y] > 

	```

1. Bake views
	Choose [V]
	Pick table

1. Visit form in web browser
1. modify


