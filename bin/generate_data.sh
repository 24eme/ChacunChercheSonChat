cd php/data ; 

echo "res;dbm0;mac0;ssid0;dbm1;mac1;ssid1;dbm2;mac2;ssid2;dbm3;mac3;ssid3;dbm4;mac4;ssid4;dbm5;mac5;ssid5;dbm6;mac6;ssid6;dbm7;mac7;ssid7;dbm8;mac8;ssid8;dbm9;mac9;ssid9;" > ../../data/data.csv
ls *localization | while read locfile ; do file=$(echo $locfile | sed 's/.localization//' ); loc=$(cat $locfile | sed 's/ | /|/g' ) ; echo -n $loc";" ; cat $file | sed 's/\r//g' | sed 's/\t/;/g' | awk -F ';' '{printf $1";"$4";"$8";"}' ; echo ; done   | sed 's/;[^:]*: /;/g'   | sed 's/^localization: //' | sed 's/;-/;/g'  | sed 's/ dBm;/;/g' >> ../../data/data.csv
