#include <ESP8266WiFi.h>
#include <SPI.h>
#include <RFID.h>

#define SS_PIN D4
#define RST_PIN D3

RFID rfid(SS_PIN, RST_PIN); 

// Setup variables:
    int serNum0;
    int serNum1;
    int serNum2;
    int serNum3;
    int serNum4;


const char* ssid     = "HUAWEI-jzuU";
const char* password = "eganugraha123";

const char* host = "192.168.100.3";

WiFiClient client;
const int httpPort = 80;
String url;

unsigned long timeout;

  
void setup() {
  Serial.begin(9600);
  delay(10);
  

  SPI.begin(); 
  rfid.init();
  
  // We start by connecting to a WiFi network
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}


void loop() {
  if (rfid.isCard()) {
        if (rfid.readCardSerial()) {
            if (rfid.serNum[0] != serNum0
                && rfid.serNum[1] != serNum1
                && rfid.serNum[2] != serNum2
                && rfid.serNum[3] != serNum3
                && rfid.serNum[4] != serNum4
            ) {
                /* With a new cardnumber, show it. */
                Serial.println(" ");
                Serial.println("Card found");
                serNum0 = rfid.serNum[0];
                serNum1 = rfid.serNum[1];
                serNum2 = rfid.serNum[2];
                serNum3 = rfid.serNum[3];
                serNum4 = rfid.serNum[4];
               
                //Serial.println(" ");
                Serial.println("Cardnumber:");
                Serial.print("Dec: ");
                Serial.print(rfid.serNum[0],DEC);
                Serial.print(", ");
                Serial.print(rfid.serNum[1],DEC);
                Serial.print(", ");
                Serial.print(rfid.serNum[2],DEC);
                Serial.print(", ");
                Serial.print(rfid.serNum[3],DEC);
                Serial.print(", ");
                Serial.print(rfid.serNum[4],DEC);
                Serial.println(" ");
                        
                Serial.print("Hex: ");
                Serial.print(rfid.serNum[0],HEX);
                Serial.print(", ");
                Serial.print(rfid.serNum[1],HEX);
                Serial.print(", ");
                Serial.print(rfid.serNum[2],HEX);
                Serial.print(", ");
                Serial.print(rfid.serNum[3],HEX);
                Serial.print(", ");
                Serial.print(rfid.serNum[4],HEX);
                Serial.println(" ");

                String UIDcard = String(rfid.serNum[0],HEX) +":"+ String(rfid.serNum[1],HEX) +":"+ String(rfid.serNum[2],HEX) +":"+ String(rfid.serNum[3],HEX) +":"+ String(rfid.serNum[4],HEX);
                
                Serial.print("connecting to ");
                Serial.println(host);
              
                if (!client.connect(host, httpPort)) {
                  Serial.println("connection failed");
                  //return;
                }
              
              // We now create a URI for the request
                url = "/penjadwalan/dashboard/tambah_rfid?uid_rfid=";
                url += UIDcard;
                
                Serial.print("Requesting URL: ");
                Serial.println(url);
              
              // This will send the request to the server
                client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                             "Host: " + host + "\r\n" + 
                             "Connection: close\r\n\r\n");
                timeout = millis();
                while (client.available() == 0) {
                  if (millis() - timeout > 5000) {
                    Serial.println(">>> Client Timeout !");
                    client.stop();
                    return;
                  }
                }
              
              // Read all the lines of the reply from server and print them to Serial
                while(client.available()){
                  String line = client.readStringUntil('\r');
                  Serial.print(line);
                }

                Serial.println();
                Serial.println("closing connection");
                Serial.println();

             } else {
               /* If we have the same ID, just write a dot. */
               Serial.print(".");
             }
          }
    }
    
    rfid.halt();
}
