# TODO: posamezni sprejemni testi v zgodbi se morajo dodajati v alinejah (vsak svojo)
# BUG: dodaj zahtevo, da si uporabnik ob prvi prijavi spremeni geslo (ali pa ga sam naredi)
#I guess DONE: koledar popravi v slo format datume (dd.mm.yyyy namesto dd/mm/yyyy)
# idk DONE: debug prikaz validacijskih errorjev

## UI
# yes DONE: mora biti vidna vloga
# yes DONE: mora biti viden zadnji datum in ura prijave
# yes DONE: dodaj feedback formam (potrditev, opozorilo) - make timed alerts !!!
# yes DONE: naredi add user hidden za navadne uporabnike
# yes DONE: razlike za UI za različne uporabniške vloge !!!
# yes DONE: dodaj logout !!!

## GENERAL FORM
# yes DONE: dodaj atribute dodajanju uporabnika: ime, priimek, email
# yes DONE: potrditev gesla (+ pokaži zahteve gesla)
# yes DONE: testni uporabniki morajo imeti prava imena

## STORY
# yes DONE: business value mora biti 1-10
# yes DONE: podvajanje imen zgodb mora biti case-insensitive
# yes DONE: dodajanje zgodbe: šifra zgodbe se doda avtomatsko (#N)

## SPRINT
# yes DONE: spremeni opozorilo na koledarju v slovenščino
# yes DONE: dodaj napis, da je dodajanje sprinta v točkah
# yes DONE: debug preverjanja prekrivanja sprinta (sprint se ne more začeti na isti dan kot se prejšnji konča)
# yes DONE: začetek sprinta se ne sme začeti na nedeljo

## PROJECT
# yes DONE: ustvarjanje projekta: član razvojne skupine je lahko tudi scrum master
# yes DONE: prikaži napako, če se ime projekta podvaja




TODO popravki
#DONE - prikaži datum v formatu dd.mm.yyyy
#DONE- zlovdaj stran sprint tudi če ni aktivnega sprinta !!!!
# yes DONE: dodaj da je pri nalogah časovna zahtevnost v urah
# yes DONE: naloga se lahko doda brez zadolženega člana

#Seznam nalog
# yes DONE: naloge morajo biti oštevilčene
# yes DONE: v seznamu se mora videti koliko ur je še do konca naloge
# yes DONE: spodaj mora biti seštevek koliko ur je še do konca
# yes DONE: najprej se napiše začetna ocena zahtevnosti
# yes DONE: nato se odšteva
# yes DONE: doda se še delo
# yes DONE: username naj bo zraven imena naloge

#- handle zaključevanje sprinta !!!
# yes DONE: dodaj velocity na kartico k sprintu
#DONE- ali je ocenjevanje časovne zahtevnosti v urah ali točkah - Done (napisou v urah pa je uredu)

#Seznam zahtev
# yes DONE: placeholder v katerem sprintu so bile sprejete
#- ločen zavihek za won't have this time
#DONE- fix blue coloration for sprint bug
#- razmak zgodbami ki so v sprintu in tistimi ki niso

# yes DONE: ure se vpisujejo za vsak dan posebej

#ZADNJI POPRAVKI:
#2 Urejanje uporabnikov
<<<<<<< HEAD
- administrator lahko ureja podatke uporabnikov, ne le sistemske pravice -> JURE
=======
#- administrator lahko ureja podatke uporabnikov, ne le sistemske pravice
>>>>>>> 33a12d114c178668d03f5afa2e3851fa73dc0c36

#27 Seznam zahtev
#- won't have this time v ločenem zavihku (dodaj)

#20 Zaključevanje nalog 
#-DONE: dodaj možnost, da se naloga spet odpre

#26 Zavračanje zgodb
#- pri zavrnitvi se mora vpisati razlog (možnost vnosa večih vrstic)
#- doda se pod komentarje ali opis (posebna sekcija)