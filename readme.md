# Facebook Developer World HACK Indonesia sample application

Sample application presented by [Niall Kennedy](https://github.com/niallkennedy) in Bangalore, India on September 17, 2012. It is an example of how to create a simple Open Graph website with Facebook login.

I created a fake website for ICC World Twenty20 that may track cricket matches and teams. This example is for a single match, England v India, and expressing fan status for the Indian cricket team.

## Getting started

You will need a web server capable of interpreting PHP. The server must be accessible on the public Internet from Facebook's servers in the United States.

## Configuration

Define variables in `config.php` specific to your server and Facebook application. Retrieve application-specific information from the [Facebook Developers site's application browser](https://developers.facebook.com/apps/). Define the base URL where you uploaded these files; this base URL will be used to build absolute URLs in the sample PHP.

Select how your application integrates with Facebook in your application's basic settings. This example is a Website with Facebook Login.

Define Open Graph noun and verb pairs for your application.
https://developers.facebook.com/apps/{your_app_id}/opengraph/getting-started

* "attend" a "match" where attend is the verb and match is the noun.
* "fan" a "team" where fan is the verb and team is the noun. Fan inherits from [Like](https://developers.facebook.com/docs/opengraph/actions/builtin/likes/).
* Try adding a custom property to the "team" object in your Facebook dashboard. I used "founded" DateTime.

Populate the App Details section of your application profile. These values will appear in your login permissions dialog.

## Helpful debug links

Something broke! Facebook has some useful web tools to help you explore problems and debug your application or website.

* [W3C Validator](http://validator.w3.org/) checks your webpage HTML for conformance against a known HTML type. Lots of errors on your page could cause errors in parsing.
* [Open Graph URL debugger](https://developers.facebook.com/tools/debug) parses your webpage URL and displays extracted data. Fix errors and warnings.
* [Graph API Explorer](https://developers.facebook.com/tools/explorer) helps you test data retrieval as a specific application or from a temporary Graph API Explorer session.
* The app roles page in your application dashboard can create test users and add extra developers for an application.
* Your Facebook account's [application settings page](https://www.facebook.com/settings?tab=applications) lists all applications associated with your account. Delete an application relationship and all data to start fresh when testing.

## Externals

Repository includes [Facebook PHP SDK](https://github.com/facebook/facebook-php-sdk) for server-side communication with Facebook servers and [Bootstrap](https://github.com/twitter/bootstrap) for simple styling.