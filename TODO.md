1 - accessibilità su tutte le tabelle: vedere il file overleaf per dettagli su come implementarla
2 - ora il fatto che un evento duri tutta la giornata lavorativa è rappresentato dal fatto che abbia durata zero: un giorno sarebbe bello se nella form di modifica del luogo si potesse scegliere fra durata in ore oppure direttamente tutta la giornata, questo però va fatto in javascript (cliccando su uno dei due mostra un input appropriato). Inoltre sarebbe magari anche da implementare anche nel databse ma in realtà non è necessario in quanto questo è un corso di tecnologie web
- aggiongere una migliore formattazione in js(+html) dell'inserimento dell'indirizzo e del telefono di un luogo. in generale controllare con js che tutti gli inserimenti siano sensati.
- modificare bene tutti i titoli delle pagine
- togliere il display di AM/PM quando si inserisce una durata (tipo modifica/inserimento di un evento) tramite CSS: un link che può essere d'aiuto: https://stackoverflow.com/questions/24867625/how-to-make-a-time-input-with-out-am-pm
-per accessibilità: mettere un link muto che vada da prima dell header della pagina direttamente al content
-modificare il database: inserire trigger per cui quando un biglietto viene rimosso viene automaticamente aumentato il unmero di posti disponibili di 1. inoltre mettere tutte le politiche di delete cascade
- controllare che tutti i caratteri tipo < e > oppure & siano messi con la notazione $parolacheloidentificainUNICODE;
- riformulare le query per fare in modo che quello che si va a leggere siano solo gli attributi veramente interessanti e non TUTTI
- chiudere tutti gli hr e br: va scritto <hr /> e non <hr>
