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

]0;root@supernova-LIFEBOOK-AH532: /var/www/html/data/appli/ashileroot@supernova-LIFEBOOK-AH532:/var/www/html/data/appli/ashile# apt-get install g 



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




Sélection du paquet liberror-perl précédemment désélectionné.
(Lecture de la base de données... 
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
]0;root@supernova-LIFEBOOK-AH532: /var/www/html/data/appli/ashileroot@supernova-LIFEBOOK-AH532:/var/www/html/data/appli/ashile# git config --glob 
]0;root@supernova-LIFEBOOK-AH532: /var/www/html/data/appli/ashileroot@supernova-LIFEBOOK-AH532:/var/www/html/data/appli/ashile# git config --glob 
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