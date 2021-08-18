#!/bin/bash


i2511=$(du -sbc /var/www/html/i2511)

while [ ${i2511:32:11} -ge 47000000000 ]
do
	delect=$(ls -trl /var/www/html/i2511/*mp4 | head -n 1 | sed 's/^.*i2511\///g')
	rm -f /var/www/html/i2511/${delect}
	echo 'i2511被刪除的檔案' ${delect} >> /var/www/html/shell_php/delect.log
	i2511=$(du -sbc /var/www/html/i2511)

done


i2512=$(du -sbc /var/www/html/i2512)

while [ ${i2512:32:11} -ge 47000000000 ]
do
	delect=$(ls -trl /var/www/html/i2512/*mp4 | head -n 1 | sed 's/^.*i2512\///g')
	rm -f /var/www/html/i2512/${delect}
	echo 'i2512被刪除的檔案' ${delect} >> /var/www/html/shell_php/delect.log
	i2512=$(du -sbc /var/www/html/i2512)
done


#40000000000 
