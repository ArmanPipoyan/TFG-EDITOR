#include <Arduino.h>
#include <SPI.h>
#include <BLEPeripheral.h>
#define LED_BUILTIN PIN_LED1
BLEPeripheral ledPeripheral = BLEPeripheral();


BLEService ledService = BLEService("19b10001e8f2537e4f6cd104768a1214");
BLEUnsignedCharCharacteristic temperatureData = BLEUnsignedCharCharacteristic("19b10001e8f2537e4f6cd104768a1214", BLERead);
BLEDescriptor humidityDescriptor = BLEDescriptor("2901", "Humidity Percent");

char dataStream[]= {'A','B','C','D','E'};

const unsigned char midiData[] = {0x80, 0x80, 0x00, 0x00, 0x00};
void setup()
{
  pinMode(LED_BUILTIN, OUTPUT);

  ledPeripheral.setAdvertisedServiceUuid(ledService.uuid());
  ledPeripheral.addAttribute(ledService);
  ledPeripheral.addAttribute(temperatureData);
  ledPeripheral.addAttribute(humidityDescriptor);
  ledPeripheral.setLocalName("Nordic de Grupo 6");
  ledPeripheral.begin();
}

void loop()
{
  BLECentral central = ledPeripheral.central(); 

  if (central) {
    int i=0;
    while (central.connected()) {
      if(i==0){
        temperatureData.setValue(*midiData);
        

        i=1;
      }else if(i==1){
        temperatureData.setValue(dataStream[1]);
        i=2;
      }else if(i==2){
        temperatureData.setValue(dataStream[2]);
        i=0;
      }
      /*ledCharacteristic.setValue(*dataStream);*/
      if (temperatureData.written()) {
        if (temperatureData.value()) {
          digitalWrite(LED_BUILTIN, HIGH);
        }
        else{
          
          digitalWrite(LED_BUILTIN, LOW);
        }
      }
    }
  }
}