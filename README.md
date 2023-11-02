# Aplicatie-Web-PHP
Proiect PHP+MySQL

**Descriere:**
  O aplicatie a unei companii de transport in comun. 
  Aplicatia are mai multe functionalitati:
    
    - clientii se pot loga si pot "cumpara" bilete sau abonamente
    
    - exista o harta a Orasului cu statiile si liniile existente, cu un click pe statii se pot afla informatii despre statie si despre cand soseste urmatorul vehicul. 
    
    - pe baza clickurilor pe statii, detinatorul aplicatiei va avea acces la stadiul de "aglomerare" al traseelor in fiecare zi

**Baza de date:**
  * **CLIENTI**: nume, prenume, email, parola
  
  * **BILETE**: tip bilet, data cumparare, data activare, data expirare
  
  * (mai multi clienti au mai multe bilete)

 * **VEHICULE**: detalii vehicul,sofer, traseu curent, locatie actuala(va fi actualizata in permanenta l aun anumit interval de timp)
  
 * **STATII**: locatie, statie precedenta, statie urmatoare, capat1 traseu, capat2 traseu
  
 * **VIZITARE_STATIE**: statie, data vizitarii, ora vizitarii

**Mod de utilizare**
  - se poate creea un cont printr-un formular, asa apare un client nou in baza de date
  - atunci cand o statie este accesata, aceasta informatie e transmisa catre baza de date
  - la un interval de timp setat, in timpul activitatii site-ului, locatiile autobuzelor trebuie modificate in baza de date
  - timpul in care urmatorul autobuz ajunge in statie este determinat printr-un query in baza de date asupra tabelului de vehicule
