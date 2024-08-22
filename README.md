# MyGym

## :exclamation: Introduzione
> MyGym è un programma molto semplice creato per chi si allena a casa e vuole crearsi la propria scheda di allenamento personalizzata. <br />
> Il programma non contiene un sistema di accesso e creazione di account, pertanto è necessario scaricarlo e avviarlo sul proprio dispositivo.
> Questa prima versione contiene solo le funzioni basiche per l'uso quotidiano, il programma verrà aggiornato in futuro con l'implementazione di nuove pagine e nuove funzioni.

> Per avviarlo e usarlo è necessario seguire i passaggi sotto elencati

## :gear: Passaggi per avviare MyGym
> Questa procedura da per scontato che phpmyadmin, Visual Studio Code e xampp siano installati.
1. Scaricare lo .zip file da GitHub ed estrarre tutto nella cartella htdocs di xampp
2. Aprire nel browser phpmyadmin e andare sulla pagina SQL, dove dovrete inserire lo script SQL presente nel file database.sql, questo creerà il vostro database personale
3. Ora dovete collegare il database al programma: andate nel file config/constants.php e modificate le varie voci come spiegato direttamente nel file
4. Finito, ora potete avviare il programma e creare le vostre schede di allenamento personalizzate e avviarle!
> Vi starete chiedendo...perché questi passaggi invece di un sito pubblicato con sistema di account?
> Molto semplice, l'idea era di un software open source aperto a modifiche e a suggerimenti, pertanto potete modificare codice e database a vostro piacere. 

## :books: Guida al sito
> Il sito contiene inizialmente 2 pagine, la home e la dashboard:
> - Nella home vengono visualizzate le nostre schede di allenamento
> - Nella dashboard si possono creare, modificare ed eliminare le schede <br />

> Ecco delle immagini del sito:

 - Creazione di una scheda
<img src="https://cdn.discordapp.com/attachments/905081533717692426/1276099872801427506/Screenshot_2024-08-22_104347.png?ex=66c84c1e&is=66c6fa9e&hm=7023e409917c568bf210ee39a34473dc212e17b76d052d608640672c689f11f2&" >

 - Dashboard
> Ogni scheda ha il suo pannello dove si possono aggiungere, rimuovere e modificare esercizi
<img src="https://media.discordapp.net/attachments/905081533717692426/1276099873359527947/Screenshot_2024-08-22_104422.png?ex=66c84c1e&is=66c6fa9e&hm=b8dbe34fd153a777a3dda525ab2e2176781b83dece0c087350fc3b30414a5150&=&format=webp&quality=lossless&width=1191&height=670" >

- Home
> Qui vengono visualizzate le proprie schede, con possibilità di vedere la lista di esercizi e di avviare la scheda.
<img src="https://media.discordapp.net/attachments/905081533717692426/1276099873778700310/Screenshot_2024-08-22_104441.png?ex=66c84c1e&is=66c6fa9e&hm=a2e038d97a8f46e8f864a104ddca1be47f7b8405bf979152416440345d574051&=&format=webp&quality=lossless&width=1191&height=670" >

- Start
> Questa è la pagina che viene aperta quandos si avvia una scheda, inizialmente ci sono 10 secondi di preparazione. In ogni momento si può mettere in pausa e ricominciare l'allenamento. Ogni esercizio dopo il tempo di lavoro ha il relativo tempo di recupero.
<img src="https://media.discordapp.net/attachments/905081533717692426/1276099874240331826/Screenshot_2024-08-22_104450.png?ex=66c84c1e&is=66c6fa9e&hm=65fb2da299b8f6b857eccd5bc33080e721fce6b772aed95fa7250484a1681016&=&format=webp&quality=lossless&width=1191&height=670" >
