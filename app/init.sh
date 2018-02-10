#!/bin/bash

rm -rf templates_c/
mkdir templates_c

chmod -R 755 .

chmod -R 644 *.php */*.php */*.html */*.inc */*.jpg */*/*.jpg

chmod 777 templates_c respaldobd tmp
