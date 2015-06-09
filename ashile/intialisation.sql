Le script a débuté sur mer. 03 juin 2015 13:52:22 RET
]0;root@supernova-LIFEBOOK-AH532: /var/www/html/data/appli/ashileroot@supernova-LIFEBOOK-AH532:/var/www/html/data/appli/ashile# ifconfig
eth0      Link encap:Ethernet  HWaddr 5c:9a:d8:67:9f:86  
          UP BROADCAST MULTICAST  MTU:1500  Metric:1
          Packets reçus:0 erreurs:0 :0 overruns:0 frame:0
          TX packets:0 errors:0 dropped:0 overruns:0 carrier:0
          collisions:0 lg file transmission:1000 
          Octets reçus:0 (0.0 B) Octets transmis:0 (0.0 B)

lo        Link encap:Boucle locale  
          inet adr:127.0.0.1  Masque:255.0.0.0
          adr inet6: ::1/128 Scope:Hôte
          UP LOOPBACK RUNNING  MTU:65536  Metric:1
          Packets reçus:979 erreurs:0 :0 overruns:0 frame:0
          TX packets:979 errors:0 dropped:0 overruns:0 carrier:0
          collisions:0 lg file transmission:0 
          Octets reçus:2795818 (2.7 MB) Octets transmis:2795818 (2.7 MB)

wlan0     Link encap:Ethernet  HWaddr 68:5d:43:34:4f:fe  
          inet adr:192.168.1.14  Bcast:192.168.1.255  Masque:255.255.255.0
          adr inet6: fe80::6a5d:43ff:fe34:4ffe/64 Scope:Lien
          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
          Packets reçus:1324 erreurs:0 :0 overruns:0 frame:0
          TX packets:1022 errors:0 dropped:0 overruns:0 carrier:0
          collisions:0 lg file transmission:1000 
          Octets reçus:722906 (722.9 KB) Octets transmis:132865 (132.8 KB)

]0;root@supernova-LIFEBOOK-AH532: /var/www/html/data/appli/ashileroot@supernova-LIFEBOOK-AH532:/var/www/html/data/appli/ashile# apt-get install g it
Lecture des listes de paquets… 0%Lecture des listes de paquets… 100%Lecture des listes de paquets... Fait
Construction de l'arbre des dépendances… 0%Construction de l'arbre des dépendances… 0%Construction de l'arbre des dépendances… 50%Construction de l'arbre des dépendances… 50%Construction de l'arbre des dépendances       
Lecture des informations d'état… 0%  Lecture des informations d'état… 0%Lecture des informations d'état... Fait
Les paquets supplémentaires suivants seront installés : 
  git-man liberror-perl
Paquets suggérés :
  git-daemon-run git-daemon-sysvinit git-doc git-el git-email git-gui gitk
  gitweb git-arch git-bzr git-cvs git-mediawiki git-svn
Les NOUVEAUX paquets suivants seront installés :
  git git-man liberror-perl
0 mis à jour, 3 nouvellement installés, 0 à enlever et 498 non mis à jour.
Il est nécessaire de prendre 3 346 ko dans les archives.
Après cette opération, 21,6 Mo d'espace disque supplémentaires seront utilisés.
Souhaitez-vous continuer ? [O/n] 
0% [En cours]             0% [Connexion à re.archive.ubuntu.com]0% [Connexion à re.archive.ubuntu.com]0% [Connexion à re.archive.ubuntu.com]0% [Connexion à re.archive.ubuntu.com]0% [Connexion à re.archive.ubuntu.com]0% [Connexion à re.archive.ubuntu.com]0% [Connexion à re.archive.ubuntu.com]0% [Connexion à re.archive.ubuntu.com]0% [Connexion à re.archive.ubuntu.com]0% [Connexion à re.archive.ubuntu.com]0% [Connexion à re.archive.ubuntu.com]0% [Connexion à re.archive.ubuntu.com]                                       0% [Attente des fichiers d'en-tête]                                    Réception de : 1 http://re.archive.ubuntu.com/ubuntu/ trusty/main liberror-perl all 0.17-1.1 [21,1 kB]
                                    0% [1 liberror-perl 1 189 B/21,1 kB 6%]                                       1% [En cours]             Réception de : 2 http://re.archive.ubuntu.com/ubuntu/ trusty-updates/main git-man all 1:1.9.1-1ubuntu0.1 [698 kB]
             1% [2 git-man 1 187 B/698 kB 0%]                                3% [2 git-man 70,3 kB/698 kB 10%]                                 8% [2 git-man 255 kB/698 kB 36%]                                11% [2 git-man 335 kB/698 kB 48%]20% [2 git-man 638 kB/698 kB 91%]                                 21% [En cours]              Réception de : 3 http://re.archive.ubuntu.com/ubuntu/ trusty-updates/main git amd64 1:1.9.1-1ubuntu0.1 [2 627 kB]
              22% [3 git 1 185 B/2 627 kB 0%]22% [3 git 30,0 kB/2 627 kB 1%]                               25% [3 git 103 kB/2 627 kB 4%]28% [3 git 204 kB/2 627 kB 8%]                              34% [3 git 419 kB/2 627 kB 16%]                               41% [3 git 638 kB/2 627 kB 24%]                                     223 kB/s 8s47% [3 git 845 kB/2 627 kB 32%]                                     223 kB/s 7s53% [3 git 1 070 kB/2 627 kB 41%]                                   223 kB/s 6s59% [3 git 1 244 kB/2 627 kB 47%]                                   223 kB/s 6s65% [3 git 1 447 kB/2 627 kB 55%]                                   223 kB/s 5s71% [3 git 1 670 kB/2 627 kB 64%]                                   223 kB/s 4s80% [3 git 1 961 kB/2 627 kB 75%]                                   223 kB/s 2s87% [3 git 2 176 kB/2 627 kB 83%]                                   223 kB/s 2s89% [3 git 2 272 kB/2 627 kB 87%]                                   223 kB/s 1s98% [3 git 2 572 kB/2 627 kB 98%]                                   223 kB/s 0s100% [En cours]                                                     223 kB/s 0s                                                                               3 346 ko réceptionnés en 16s (200 ko/s)
Sélection du paquet liberror-perl précédemment désélectionné.
(Lecture de la base de données... (Lecture de la base de données... 5%(Lecture de la base de données... 10%(Lecture de la base de données... 15%(Lecture de la base de données... 20%(Lecture de la base de données... 25%(Lecture de la base de données... 30%(Lecture de la base de données... 35%(Lecture de la base de données... 40%(Lecture de la base de données... 45%(Lecture de la base de données... 50%(Lecture de la base de données... 55%(Lecture de la base de données... 60%(Lecture de la base de données... 65%(Lecture de la base de données... 70%(Lecture de la base de données... 75%(Lecture de la base de données... 80%(Lecture de la base de données... 85%(Lecture de la base de données... 90%(Lecture de la base de données... 95%(Lecture de la base de données... 100%(Lecture de la base de données... 233127 fichiers et répertoires déjà installés.)
Préparation du décompactage de .../liberror-perl_0.17-1.1_all.deb ...
Décompactage de liberror-perl (0.17-1.1) ...
Sélection du paquet git-man précédemment désélectionné.
Préparation du décompactage de .../git-man_1%3a1.9.1-1ubuntu0.1_all.deb ...
Décompactage de git-man (1:1.9.1-1ubuntu0.1) ...
Sélection du paquet git précédemment désélectionné.
Préparation du décompactage de .../git_1%3a1.9.1-1ubuntu0.1_amd64.deb ...
Décompactage de git (1:1.9.1-1ubuntu0.1) ...
Traitement déclenché pour  man-db (2.6.7.1-1ubuntu1) ...
Paramétrage de liberror-perl (0.17-1.1) ...
Paramétrage de git-man (1:1.9.1-1ubuntu0.1) ...
Paramétrage de git (1:1.9.1-1ubuntu0.1) ...
]0;root@supernova-LIFEBOOK-AH532: /var/www/html/data/appli/ashileroot@supernova-LIFEBOOK-AH532:/var/www/html/data/appli/ashile# git config --glob al user.name "keranviramoutou"
]0;root@supernova-LIFEBOOK-AH532: /var/www/html/data/appli/ashileroot@supernova-LIFEBOOK-AH532:/var/www/html/data/appli/ashile# git config --glob al user.email " [Kkeran.viramoutou@iclou[Kd[Kud.com"
]0;root@supernova-LIFEBOOK-AH532: /var/www/html/data/appli/ashileroot@supernova-LIFEBOOK-AH532:/var/www/html/data/appli/ashile# git
usage: git [--version] [--help] [-C <path>] [-c name=value]
           [--exec-path[=<path>]] [--html-path] [--man-path] [--info-path]
           [-p|--paginate|--no-pager] [--no-replace-objects] [--bare]
           [--git-dir=<path>] [--work-tree=<path>] [--namespace=<name>]
           <command> [<args>]

Les commandes git les plus utilisées sont :
   add        Ajouter le contenu de fichiers dans l'index
   bisect     Trouver par recherche binaire la modification qui a introduit un bogue
   branch     Lister, créer ou supprime