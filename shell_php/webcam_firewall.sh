#!/bin/sh
iptables -t nat -A POSTROUTING -p tcp -d 172.31.255.25 --dport 8081 -j MASQUERADE
