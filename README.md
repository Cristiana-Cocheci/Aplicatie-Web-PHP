# https://neverlanes.alwaysdata.net/

# Descriere
O aplicatie a unei companii de transport in comun.

Aplicatia are mai multe functionalitati:

Clientii se pot loga si isi pot vedea biletele sau abonamentele

Exista o harta a Lumii cu statiile si liniile existente, cu un click pe statii se pot afla informatii despre statie.

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

se poate creea un cont printr-un formular, asa apare un client nou in baza de date (client demo: username- DoryDi, parola- parolaDorel)

conturile sunt de trei tipuri: client, sofer si administrator; numai o lista predefinita poate avea cont de admin

se poate contacta detinatorul aplicatiei printr-un formular de email

harta si locatiile de pe harta sunt calculate in mod dinamic la incarcarea paginii

soferii pot modifica statia la care se afla din aplicatie

adminul poate adauga vedea lista de clienti, o poate exporta si poate importa printr-un excel o lista noua de clienti, fara parole, acestea urmand sa fie adaugate ulterior
