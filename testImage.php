<?php
/*
Instantiate an Image object using the "new" keyword
Whatever params we use when instantiating are passed to __construct 
*/
require_once(DOC_ROOT."../core/libraries/Image.php");

$imageObj = new Image('http://placekitten.com/500/500');

/*
Call the resize method on this object using the object operator (single arrow ->) 
which is used to access methods and properties of an object
*/
$imageObj->resize(200,200);

# Display the resized image
$imageObj->display();

?>