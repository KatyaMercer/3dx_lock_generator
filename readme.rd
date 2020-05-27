Tool for generate

1) For beginners
Repack php to folder php
https://www.php.net/downloads.php
You can take last version

You can look example in folder examples
For generate location need run from command line for example

php wood_and_house.php
php maze.php

2) For advanced (install php like you prefer)
Look to example files and run from console

You can add new directory in core/companies/MyNameDir
with MyNameDir namespace and make your realisation of locations

In future i will think about dependence modules
And tool for upload default locations from files

If you see some problem, set me pull request

Examples:

$sfApp = new SvLoader(); // init project
$scene = new SvScene(); // create scene

$floor = new SvObject(); // create object
$floor->setXyz(0, -0.1, -100); // at coordinates
$floor->setWidth(100, 0.2, 150); //with width
$floor->setMaterial(SvMaterials::GRASS_1); // texture grass
$floor->setType(SvTypes::BOX); // box type
$scene->addObject($floor); // add to scene
