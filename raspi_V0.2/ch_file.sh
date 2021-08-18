#!/bin/bash
read -p 'Input you wan ch:' ch
mv *_modify.php $ch'_modify.php'
mv *_modify.txt $ch'_modify.txt'
mv shell_* 'shell_'$ch
mv shell_$ch/motion_* shell_$ch/morion_$ch
sed -i 's/i2512/'$ch'/g' *.php
sed -i 's/i2512/'$ch'/g' shell_$ch/*.php
sed -i 's/i2512/'$ch'/g' shell_$ch/*.py
sed -i 's/i2512/'$ch'/g' shell_$ch/*.txt
sed -i 's/i2512/'$ch'/g' shell_$ch/*.sh
sed -i 's/i2512/'$ch'/g' /etc/crontab
