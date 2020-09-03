<h1>Replica AirBnb</h1>
<p>Repo del progetto realizzato a fine corso.</p>
<br>
<h4>Introduzione</h4>
<p>
    BoolBnB è una applicazione per trovare e gestire l’affitto di appartamenti.
Attraverso BoolBnB i proprietari di appartamento possono inserire le informazioni degli appartamenti che vogliono affittare per cercare utenti interessati.
Gli utenti che vogliono mettere in affitto un appartamento devono registrarsi alla piattaforma; una volta registrati hanno la possibilità di inserire uno o più appartamenti.
Gli utenti interessati ad un appartamento, utilizzando i filtri di una apposita pagina di ricerca, vedono una lista di possibili appartamenti e cliccando su ognuno possono vedere una pagina di dettaglio.
Una volta trovata l’appartamento desiderato, l’utente interessato può contattare l’utente proprietario per fare domande.

Inoltre, i proprietari di un appartamento possono decidere di pagare per sponsorizzare l’annuncio del proprio appartamento per fare in modo che il loro annuncio sia maggiormente in evidenza rispetto a quelli non sponsorizzati.
</p>
<br>
<h4>Requisiti Tecnici</h4>
<ul>
    <li>(RT1) Client-side Validation: tutti gli input inseriti dell’utente devono essere controllati client-side (oltre che server-side) per un controllo di veridicità (es. un numero di stanze deve essere positivo)</li>
    <li>(RT2) Salvataggio informazioni di geografiche: i dati riguardanti l’ubicazione degli appartamenti devono essere salvati sul database con latitudine e longitudine. Per ottenere latitudine e longitudine a partire da un indirizzo e allo stesso modo visualizzare il punto sulla mappa, utilizzare tomtom: https://developer.tomtom.com/</li>
    <li>(RT3) Sistema di Pagamento: il sistema di pagamento da utilizzare è braintree (https://www.braintreepayments.com/ ). Il sistema permette di simulare pagamenti senza essere approvati formalmente e senza utilizzare vere carte di credito.</li>
    <li>(RT4) Il sito deve essere responsive: il sito deve essere correttamente visibile da desktop e da smartphone</li>
</ul>
<br>
<h4>Requisiti Funzionali</h4>
<p>Nel dettaglio, la piattaforma deve soddisfare i seguenti requisiti funzionali (RF) che vengono dettagliati nelle pagine successive:
    <ul>
        <li>(RF1) Permettere ai proprietari di appartamento di registrarti alla piattaforma</li>
        <li>(RF2) Permettere ai proprietari di appartamento registrati di aggiungere un appartamento alla piattaforma</li>
        <li>(RF3) Permette ai visitatori di ricercare una appartamento</li>
        <li>(RF4) Permettere ai visitatori di vedere i dettagli di un appartamento</li>
        <li>(RF5) Permettere ai visitatori di scrivere al proprietario di un appartamento per chiedere informazioni</li>
        <li>(RF6) Permettere ai proprietari di appartamento registrati di vedere le richieste ricevute</li>
        <li>(RF7) Permettere ai proprietari di appartamento registrati di vedere statistiche riguardo gli annunci dei propri appartamenti</li>
        <li>(RF8) Permettere ai proprietari di appartamento registrati di sponsorizzare il propria appartamento</li>
    </ul>
</p>
<br>
<h4>A seguire alcuni screenshot delle funzionalità</h4>
<div style="width:640px">
    <h5>Home page, ricerca e slider degli appartamenti sponsorizzati</h5>
    <p>La pagina iniziale è caratterizzata da dal form di ricerca, uno lista di appartamenti sponsorizzati e una sezione a comparsa dei risultati generati dalla ricerca.</p>
    <img style="width:100%" src="https://github.com/Boolean-Team2/progetto-finale-airbnb/blob/master/screens/screen1.jpg">
</div>
<hr>
<div style="width:640px">
    <h5>Ricerca appartamento</h5>
    <p>Il form nella home restitusce una serie di appartamenti nella zona e raggio di distanza indicati, inoltre possono essere filtrati aggiungendo dettagli come numero di letti, stanze e servizi.</p>
    <img style="width:100%" src="https://github.com/Boolean-Team2/progetto-finale-airbnb/blob/master/screens/screen10.jpg">
</div>
<hr>
<div style="width:640px">
    <h5>Pagina del dettaglio dell'appartamento</h5>
    <p>Sono presenti le caratteristiche principali della struttura e relativi servizi e informazioni del proprietario. Viene data la possibilità di contattare il proprietario via chat o per messaggio, il quale riceverà una mail in caso di messaggio privato, ed infine si può vedere la posizione sulla mappa e gli appartamenti vicini nel raggio di 10 km.</p>
    <img style="width:100%" src="https://github.com/Boolean-Team2/progetto-finale-airbnb/blob/master/screens/scree2.png">
</div>
<hr>
<div style="width:640px">
    <h5>Chat in realtime con gli altri utenti</h5>
    <p>Questo è stato un bonus al progetto. E' stato utilizzato pusher per far funzionare il tutto. Gli utenti si possono scambiare messaggi, in tempo reale tra di loro, i quali vengono salvati nel database in modo persistente.</p>
    <img style="width:100%" src="https://github.com/Boolean-Team2/progetto-finale-airbnb/blob/master/screens/screen3.png">
</div>
<hr>
<div style="width:640px">
    <h5>Informazioni personali utente</h5>
    <p>In questa sezione si possono consultare e modificare i dati personali dell'utente registrato.</p>
    <img style="width:100%" src="https://github.com/Boolean-Team2/progetto-finale-airbnb/blob/master/screens/screen4.png">
</div>
<hr>
<div style="width:640px">
    <h5>Statistiche appartamenti</h5>
    <p>In questa sezione si possono consultare le statistiche globali di tutti gli appartamenti.</p>
    <img style="width:100%" src="https://github.com/Boolean-Team2/progetto-finale-airbnb/blob/master/screens/screen6.png">
    <br>
    <p>In questa sezione si possono consultare le statistiche del singolo appartamento.</p>
    <img style="width:100%" src="https://github.com/Boolean-Team2/progetto-finale-airbnb/blob/master/screens/screen9.png">
</div>
<hr>
<div style="width:640px">
    <h5>Informazioni appartamenti</h5>
    <p>In questa sezione si possono consultare le informazioni degli appartamenti.</p>
    <img style="width:100%" src="https://github.com/Boolean-Team2/progetto-finale-airbnb/blob/master/screens/screen5.png">
</div>
<hr>
<div style="width:640px">
    <h5>Informazioni pagamenti</h5>
    <p>In questa sezione si possono consultare le informazioni dei pagamenti.</p>
    <img style="width:100%" src="https://github.com/Boolean-Team2/progetto-finale-airbnb/blob/master/screens/screen7.png">
</div>
<hr><div style="width:640px">
    <h5>Informazioni messaggi</h5>
    <p>In questa sezione si possono consultare le informazioni e lo stato dei messaggi ricevuti ordinati per data di arrivo.</p>
    <img style="width:100%" src="https://github.com/Boolean-Team2/progetto-finale-airbnb/blob/master/screens/screen8.png">
</div>
