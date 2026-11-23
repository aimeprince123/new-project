HEARTBEAT MONITORING — STANDALONE PROJECT

This folder is independent of the school_form project.

INSTALL:
1. Copy the entire heartbeat_monitoring folder into C:\xampp\htdocs\
2. Start Apache and MySQL in XAMPP.
3. Open phpMyAdmin and import database/heartbeat_db.sql.
4. Edit config.php if your MySQL username/password differs from XAMPP defaults.
5. Open arduino/Heartbeat_GSM_System.ino in Arduino IDE.
6. Install the SparkFun MAX3010x Pulse and Proximity Sensor Library and the ESP32 board package.
7. Set Wi-Fi name/password, computer LAN IP in serverURL, and the API key in BOTH api_receive.php and the Arduino sketch.
8. Upload the sketch to ESP32.
9. Open http://localhost/heartbeat_monitoring/heartbeat.php

WIRING:
MAX30102: VIN->3.3V, GND->GND, SDA->GPIO21, SCL->GPIO22.
SIM800L: TXD->GPIO16, RXD->GPIO17, GND->common GND, VCC->regulated
3.7–4.2V supply capable of around 2A peak current. Check your board's
logic-level requirements. Never power SIM800L from ESP32 3.3V.

The example assumes MAX30102 + SIM800L. SIM800L requires compatible 2G
coverage, a working SIM with voice/SMS service, antenna and airtime.
Use +250780986245 as the configured call/SMS destination.

The GSM alert waits for three consecutive calculated averages at or below
40 BPM and rearms after an average above 45 BPM. This is an educational
prototype, not a medical device; readings can be inaccurate. Do not rely
on it as the only emergency response system.
