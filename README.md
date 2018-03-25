# Field Thumbnail for Drupal 8

This provides the ability to add images and detailed descriptions to fields, so content editors have a better sense
of what the field will look like on the published page.

This module adds a "Field Thumbnail" fieldset to the config form of every field instance on the site.
There is a "Thumbnail" field where you can upload an example of how the field is rendered on the published page,
and a "Description" text field where you can add details that supplement the default field description.

If either field is populated, a "Preview Field" link will be appended to the Field Label. 
This link will trigger a modal that displays the uploaded image, the "Field Thumbnail" description, and the 
default field description text.

This was created to make field-naming a little less stressful - instead of coming up with a few words that define 
a complex visual element, the editor can reference an image that shows instead of tells.