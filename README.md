# BEA Body Class
Easily handle body classes on theme for WP

# How to use
Hook wherever you want or simply use on top of you template and add or delete a wanted body class.

## To add a body class
BEA_Body_Class::get_instance()->add( 'my-custom-body-class' );
## To delete a body class
BEA_Body_Class::get_instance()->delete( 'page' );
