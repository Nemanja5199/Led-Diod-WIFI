#include <WiFi.h>
#include <ArduinoJson.h>
#include <WiFiClient.h>
#include <HTTPClient.h>


char ssid[] = "Bogi";
char password[] = "samo11Bogi0011";

WiFiClient client;
HTTPClient http;

int ledStatsu=0;

IPAddress serverIP(192,168,1,32);




unsigned long previousMillis = 0; // Variable to store the last time the loop was updated
const unsigned long interval = 100; // Interval in milliseconds (10 seconds)


void setup() {

  Serial.begin(115200);
  Conection();

  pinMode(2,OUTPUT);

 
}



void loop() {


  unsigned long currentMillis = millis(); // Get the current time

  // Check if the desired interval (10 seconds) has elapsed
  if (currentMillis - previousMillis >= interval) {
    // Update the loop every 10 seconds

     makeHTTPRequest();
     LedActivation(ledStatsu);

    // Reset the previousMillis variable to the current time for the next update
    previousMillis = currentMillis;
  }

  // Other non-blocking tasks in the loop can be placed here
}








void Conection() {



  WiFi.begin(ssid, password);
  Serial.println("");

  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  delay(1500);
}


void makeHTTPRequest() {


  if (!client.connect(serverIP, 80)) {
    Serial.println(F("Connection failed"));
    return;
  } 

  // Send HTTP request
  client.print(F("GET "));
  // This is the second half of a request (everything that comes after the base URL)
  client.print("/Php%20Programi/PHP%20Senzor/api/LedStatus"); // %2C == ,
  client.println(F(" HTTP/1.1"));

  //Headers
  client.print(F("Host: "));
  client.println(serverIP);

  client.println(F("Cache-Control: no-cache"));

  if (client.println() == 0)
  {
    Serial.println(F("Failed to send request"));
    return;
  }
  //delay(100);
  // Check HTTP status
  char status[32] = {0};
  client.readBytesUntil('\r', status, sizeof(status));
  if (strcmp(status, "HTTP/1.1 200 OK") != 0)
  {
    Serial.print(F("Unexpected response: "));
    Serial.println(status);
    return;
  }

  // Skip HTTP headers
  char endOfHeaders[] = "\r\n\r\n";
  if (!client.find(endOfHeaders))
  {
    Serial.println(F("Invalid response"));
    return;
  }




DynamicJsonDocument  doc(64);

DeserializationError error = deserializeJson(doc, client);

if (error) {
  Serial.print("deserializeJson() failed: ");
  Serial.println(error.c_str());
  return;
}

const char* root_0_status = doc[0]["status"]; // "1"
 
 Serial.println(root_0_status);

 ledStatsu= atoi(root_0_status);
 


}


void LedActivation(int Led){

  if(Led == 1){

    digitalWrite(2,HIGH);

  }

  else if (Led == 0){


 digitalWrite(2,LOW);
  }

}