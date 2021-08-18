# -*- coding:utf-8 -*-
from bs4 import BeautifulSoup
import requests
response = requests.get('https://weather.yam.com/永康區/臺南市')
soup = BeautifulSoup(response.text, 'html.parser')
soup.encoding = 'utf-8'
result=soup.find('div',class_='tempB')
temp=result.getText().lstrip().rstrip().strip('℃')
my_data = {'mode': 'ai_temp','ai_temp': temp}
r = requests.post('http://120.114.142.22/php/contorl_fan.php',data = my_data,headers={"Content-Type": "application/x-www-form-urlencoded"})
fp=open("/var/www/html/php/ai_temp.txt","w")
print('室外溫度:'+temp,file=fp)
fp.close() 
