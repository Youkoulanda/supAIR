--> La répartition du travail sur le TP4 portant sur Ajax et JQuery et sur l'application finale (fonctionnalités supplémentaires le cas échéant)

Rivet Aurélien:
        - Gestion de l'ajout de messages sur le mur

Salas Daniel:
        - Gestion de l'envoi de messages sur le chat et de son rafraichissement

--> toutes les explications que vous voudrez sur les fonctionnalités de votre application, notamment si elles n'étaient pas demandées
        - Les mises à jour dynamiques du chat et du mur sont "intelligentes", elles ne rechargent pas tout le contenu, elle ajoutent seulement les nouveaux éléments.

Rien n’est prévu dans l’architecture du projet pour savoir à qui se rapporte les “j’aime” d’un message, par conséquent la fonction “j’aime” ajoute simplement 1 au nombre de j’aime d’un message et il est possible d’aimer à l’infini (impossible de vérifier si on a déjà aimé).

--> l'URL sur le serveur pédago01a permettant d'accéder à votre application (sur une des sessions du binôme) pour évaluation
        https://pedago01a.univ-avignon.fr/~uapv1103353/squelette/supAIR.php

À noter l’utilisation d’un pré-processeur css qui permet d’étendre de manière intéressante les possibilités basiques du css, avec quelques ajouts de syntaxe bienvenus tels que l’imbrication des sélecteurs, l’utilisation de variables ou encore l’héritage de propriétés. Le préprocesseur utilisé est compass et se base la syntaxe scss. Ainsi, le fichier css que nous avons écrit est sass/screen.scss qui est compilé à la volée (un démon surveille les modifications du fichier) en css/screen.css.

Les détails sur les fonctions sont dans les commentaires du code.
