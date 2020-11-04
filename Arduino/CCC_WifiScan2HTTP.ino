/*
  Web client

 This sketch connects to a website (http://www.google.com)
 using the WiFi module.

 This example is written for a network using WPA encryption. For
 WEP or WPA, change the Wifi.begin() call accordingly.

 This example is written for a network using WPA encryption. For
 WEP or WPA, change the Wifi.begin() call accordingly.

 Circuit:
 * Board with NINA module (Arduino MKR WiFi 1010, MKR VIDOR 4000 and UNO WiFi Rev.2)

 created 13 July 2010
 by dlf (Metodo2 srl)
 modified 31 May 2012
 by Tom Igoe
 */


#include <SPI.h>
#include <WiFiNINA.h>

#include "arduino_secrets.h"
///////please enter your sensitive data in the Secret tab/arduino_secrets.h
char ssid1[] = SECRET_SSID_1;        // your network SSID (name)
char pass1[] = SECRET_PASS_1;    // your network password (use for WPA, or use as key for WEP)
char ssid2[] = SECRET_SSID_2;        // your network SSID (name)
char pass2[] = SECRET_PASS_2;    // your network password (use for WPA, or use as key for WEP)
char ssid3[] = SECRET_SSID_3;        // your network SSID (name)
char pass3[] = SECRET_PASS_3;    // your network password (use for WPA, or use as key for WEP)
int keyIndex = 0;            // your network key Index number (needed only for WEP)

int status = WL_IDLE_STATUS;
// if you don't want to use DNS (and reduce your sketch size)
// use the numeric IP instead of the name for the server:
//IPAddress server(74,125,232,128);  // numeric IP for Google (no DNS)
char server[] = SERVER_DOMAIN;    // name address for Google (using DNS)

// Initialize the Ethernet client library
// with the IP address and port of the server
// that you want to connect to (port 80 is default for HTTP):
WiFiClient client;

void setup() {
  //Initialize serial and wait for port to open:
  Serial.begin(9600);
  pinMode(LED_BUILTIN, OUTPUT);
}

void wifiWebScan() {
  // check for the WiFi module:
  if (WiFi.status() == WL_NO_MODULE) {
    Serial.println("Communication with WiFi module failed!");
    // don't continue
    while (true);
  }

  String fv = WiFi.firmwareVersion();
  if (fv < WIFI_FIRMWARE_LATEST_VERSION) {
    Serial.println("Please upgrade the firmware");
  }

  String content = getlistNetworks();

  // attempt to connect to Wifi network:
  while (status != WL_CONNECTED) {
    Serial.print("Attempting to connect to SSID: ");
    Serial.println(ssid1);
    status = WiFi.begin(ssid1, pass1);
    if (status != WL_CONNECTED) {
        ledPrintError();
        delay(1000);
        Serial.print("Attempting to connect to SSID: ");
        Serial.println(ssid2);
        status = WiFi.begin(ssid2, pass2);
    }
    if (status != WL_CONNECTED) {
        ledPrintError();
        delay(1000);
        Serial.print("Attempting to connect to SSID: ");
        Serial.println(ssid3);
        status = WiFi.begin(ssid3, pass3);
    }
    if (status != WL_CONNECTED) {
        ledPrintError();
        delay(10000);
    }
  }
  Serial.println("Connected to wifi");
  printWifiStatus();

  Serial.println("\nStarting connection to server...");
  // if you get a connection, report back via serial:
  if (client.connect(server, 80)) {
    Serial.println("connected to server");
    digitalWrite(LED_BUILTIN, HIGH);   // turn the LED on (HIGH is the voltage level)
    // Make a HTTP request:
    client.print("POST ");
    client.print(SERVER_PATH);
    client.println(" HTTP/1.1");
    client.print("Host: ");
    client.println(SERVER_DOMAIN);
    client.println("Connection: close");
    client.print("Content-length: ");
    client.println(content.length());
    client.println();
    client.println(content);
    digitalWrite(LED_BUILTIN, LOW);   // turn the LED on (HIGH is the voltage level)

  } else {
      Serial.println("connection failed :(");
      ledPrintError();
  }
}

void loop() {
  while (true) {
      wifiWebScan();
      // if there are incoming bytes available
      // from the server, read them and print them:
      while (client.available()) {
          char c = client.read();
          Serial.write(c);
      }

      // if the server's disconnected, stop the client:
      if (!client.connected()) {
          Serial.println();
          Serial.println("disconnecting from server.");
          client.stop();

          // do nothing forevermore:
          delay(1000);
      }
      client.stop();
      WiFi.disconnect();
      status = WL_IDLE_STATUS;
      Serial.println("====== end ======");
      delay(10000);
  }
}


void printWifiStatus() {
  // print the SSID of the network you're attached to:
  Serial.print("SSID: ");
  Serial.println(WiFi.SSID());

  // print your board's IP address:
  IPAddress ip = WiFi.localIP();
  Serial.print("IP Address: ");
  Serial.println(ip);

  // print the received signal strength:
  long rssi = WiFi.RSSI();
  Serial.print("signal strength (RSSI):");
  Serial.print(rssi);
  Serial.println(" dBm");
}


String getlistNetworks() {
  // scan for nearby networks:
  Serial.println("** Scan Networks **");
  digitalWrite(LED_BUILTIN, HIGH);   // turn the LED on (HIGH is the voltage level)
  int numSsid = WiFi.scanNetworks();
  digitalWrite(LED_BUILTIN, LOW);   // turn the LED on (HIGH is the voltage level)

  if (numSsid == -1)
  {
    Serial.println("Couldn't get a WiFi connection");
    return "";
  }

  // print the list of networks seen:
  Serial.print("number of available networks: ");
  Serial.println(numSsid);

  // print the network number and name for each network found:
  String data = "";

  for (int thisNet = 0; thisNet < numSsid; thisNet++) {
    data += thisNet + 1;
    data += ") ";
    data += "Signal: ";
    data += WiFi.RSSI(thisNet);
    data += " dBm";
    data += "\tChannel: ";
    data += WiFi.channel(thisNet);
    byte bssid[6];
    data += "\t\tBSSID: ";
    data += getMacAddress(WiFi.BSSID(thisNet, bssid));
    data += "\tEncryption: ";
    data += getEncryptionType(WiFi.encryptionType(thisNet));
    data += "\t\tSSID: ";
    data += WiFi.SSID(thisNet);
    data += "\r\n";
  }
  Serial.println(data);
  Serial.flush();
  Serial.println();
  return data;
}

String getEncryptionType(int thisType) {
  String data = "";
  // read the encryption type and print out the name:
  switch (thisType) {
    case ENC_TYPE_WEP:
      data += "WEP";
      break;
    case ENC_TYPE_TKIP:
      data += "WPA";
      break;
    case ENC_TYPE_CCMP:
      data += "WPA2";
      break;
    case ENC_TYPE_NONE:
      data += "None";
      break;
    case ENC_TYPE_AUTO:
      data += "Auto";
      break;
    case ENC_TYPE_UNKNOWN:
    default:
      data += "Unknown";
      break;
  }
  return data;
}

String get2Digits(byte thisByte) {
  String data = "";
  if (thisByte < 0xF) {
    data += "0";
  }
  data += thisByte, HEX;
  return data;
}

String getMacAddress(byte mac[]) {
  String data = "";
  for (int i = 5; i >= 0; i--) {
    if (mac[i] < 16) {
      data += "0";
    }
    data += mac[i], HEX;
    if (i > 0) {
      data += ":";
    }
  }
  data += "\t";
  return data;
}

void ledPrintError() {
    digitalWrite(LED_BUILTIN, HIGH);   // turn the LED on (HIGH is the voltage level)
    delay(100);
    digitalWrite(LED_BUILTIN, LOW);   // turn the LED on (HIGH is the voltage level)
    delay(100);
    digitalWrite(LED_BUILTIN, HIGH);   // turn the LED on (HIGH is the voltage level)
    delay(100);
    digitalWrite(LED_BUILTIN, LOW);   // turn the LED on (HIGH is the voltage level)
    delay(100);
    digitalWrite(LED_BUILTIN, HIGH);   // turn the LED on (HIGH is the voltage level)
    delay(100);
    digitalWrite(LED_BUILTIN, LOW);   // turn the LED on (HIGH is the voltage level)
}
