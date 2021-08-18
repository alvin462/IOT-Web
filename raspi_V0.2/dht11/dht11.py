import time
import Adafruit_DHT
import serial
import json

DHT_PIN = 4
DHT_SENSOR = Adafruit_DHT.DHT11
while 1:
    humidity, temperature = Adafruit_DHT.read(DHT_SENSOR, DHT_PIN)
    if humidity is not None and temperature is not None:
        print("Temp={0:0.1f}C Humidity={1:0.1F}%".format(temperature , humidity))
    time.sleep(1)
