# https://neverlanes.alwaysdata.net/

# Descriere
O aplicatie a unei companii de transport in comun: PHP+ SQLMyAdmin.

Aplicatia are mai multe functionalitati:

Clientii se pot loga si isi pot vedea biletele sau abonamentele (client demo: username- DoryDi, parola- parolaDorel)
Soferii se pot loga, isi vad biletele si abonamentele, precum si traseele active ale lor. Pot actualiza statia la care se afla in momentul respectiv. (sofer demo: username- jessy, parola- parolaJessy)
Adminul se poate loga, isi vede biletele, precum si toti userii aplicatiei. Poate descarca un excel cu datele tuturor clientilor si soferilor si poate importa un excel cu clientii pe care vrea sa i adauge in baza de date. La prima logare in cont acestia urmeaza sa-si aleaga parola. (admin demo: username- boss, parola- parolaBoss).
Toti isi pot sterge contul.

Exista o harta a Lumii cu statiile si liniile existente, cu un click pe statii se pot afla informatii despre statie.

Se poate selecta o ruta in particular, si va fi deschisa o noua pagina cu harta rutei respective, precum si informatii despre statii.

Hartile sunt calculate in mod dinamic cu un API pe baza unor adrese din baza de date.

Securitatea este asigurata de captcha-uri, precum si criptari in baza de date.

# Baza de date

CLIENTI: username, nume, prenume, email, parola, rol

BILETE:tip bilet, id_client, data cumparare, data activare, data expirare

TIPURI BILETE:nume tip, valabilitate, pret

VEHICULE:tip vehicul, id_sofer, id_traseu, pozitie

TIPURI VEHICULE:nume, data, capacitate combustibil

SOFERI:nume, prenume, salariu, id_client (NULL)

STATII: locatie, statie precedenta, statie urmatoare, capat1 traseu, capat2 traseu

VIZITARE_STATIE: statie, data vizitarii, ora vizitarii

TRASEE: nume, dimensiune, nr. statii

LOCATII: nume, adresa

ACTION_LOGS: tip actiune, data

# Mod de utilizare

se poate creea un cont printr-un formular, asa apare un client nou in baza de date 

conturile sunt de trei tipuri: client, sofer si administrator; numai o lista predefinita poate avea cont de admin

se poate contacta detinatorul aplicatiei printr-un formular de email

harta si locatiile de pe harta sunt calculate in mod dinamic la incarcarea paginii

soferii pot modifica statia la care se afla din aplicatie

adminul poate adauga vedea lista de clienti, o poate exporta si poate importa printr-un excel o lista noua de clienti, fara parole, acestea urmand sa fie adaugate ulterior
