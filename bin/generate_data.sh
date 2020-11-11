cd php/data ; 

ls *localization | while read locfile ; do file=$(echo $locfile | sed 's/.localization//' ); loc=$(cat $locfile | sed 's/ | /|/g' ) ; echo -n $loc";" ; cat $file | sed 's/\r//g' | sed 's/\t/;/g' | awk -F ';' '{printf $1";"$4";"$8";"}' ; echo ; done   | sed 's/;[^:]*: /;/g'   | sed 's/^localization: //' | sed 's/;-/;/g'  | sed 's/ dBm;/;/g' > ../../data/data.csv
