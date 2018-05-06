# Custom Site Information

1: We have to enable this module.
2: Enable "Default rest resource 	/page_json/{sitekey}/{id}" under admin/config/services/rest with following value:

 * URL : admin/config/services/rest/resource/default_rest_resource/edit
 * Methods : GET
 * Accepted request formats : JSON
 * Authentication providers : cookie

# Done Tasks
*This module will add a new form text field named "Site API Key" in the "Site Information" (/admin/config/system/site-information) form with the default value of “No API Key yet”.
* When this form is submitted, the value that the user entered for this field should be saved as the system variable named "siteapikey".
* A Drupal message will inform the user that the Site API Key has been saved with that value.
* When this form ((/admin/config/system/site-information) ) is visited after the "Site API Key" is saved, the field will populated with the correct value.
* The text of the "Save configuration" button changed to "Update Configuration".
* This module also provides a URL that responds with a JSON representation of a given node with the content type "page" only if the previously submitted API Key and a node id (nid) of an appropriate node are present, otherwise it will respond with "access denied".

# Example URL

http://localhost/page_json/FOOBAR12345/17
