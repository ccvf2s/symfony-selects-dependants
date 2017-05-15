Symfony selects dependants
--------------------------

Welcome to my repository about how to make Symfony Form
dependants with Form Events (How to Dynamically Modify Forms).

The version of this Symfony project is 3.0.2.

What is inside
--------------

This repository come with:

    * Symfony 3 standard edition version 3.0.2
    * Vagrant packaged by puphpet

How to install that?
--------------------

The first step if you want to use vagrant(it requires virtualbox)
is to download it after that you can launch these differents commands
in your current project:

    * composer install
    * vagrant up
    * cd /var/www/html/[your-directory-git]
    * bin/console do:sc:cr -e=dev
    * bin/console do:fi:lo -e=dev
    * bin/console assets:install -e=dev
    
    And enjoy at: 192.168.56.104/carma/web/app_dev.php
    
If you want to use the project without vagrant, you can install 
APACHE, MYSQL AND PHP in your system and launch the two 
precedents commands for Symfony 3 and enjoy!!!
