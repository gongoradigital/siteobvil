# Installation avec accès SSH

La procédure suivante a été testée sur les serveurs OBVIL. Un administrateur averti saura transposer à son architecture.

Ce site dépend de deux librairies qui doivent être installée, les projets Teinte (service web) et Livrable (epub). Pour les installer dans le dossier web de votre serveur comme des frères de gongora 
git clone https://github.com/oeuvres/Teinte.git
git clone https://github.com/oeuvres/Livrable.git


```
# Dans le dossier web de votre serveur hhtp.
# Créer à l’avance le dossier de destination avec les bons droits
mkdir gongora
# assurez-vous que le dossier appartient à un groupe où vous êtes
# donnez-vous les droits d’y écrire
# l’option +s permet de propager le nom du groupe dans le dossier
chmod -R g+sw gongora

# Aller chercher les sources de cet entrepôt
# ne pas oublier --recursive, cet entrepôt tire d’autres modules de gongoradigital (polemos et gongoraobra)
git clone --recursive https://github.com/gongoradigital/siteobvil.git gongora

# rentrer dans le dossier
cd gongora
# donner des droits d’écriture à votre serveur sur ce dossier, ici, l’utilisateur apache
# . permet de toucher les fichiers cachés, et notamment, ce qui est dans .git
sudo chown -R apache .
# copier la conf par défaut 
cp _conf.php conf.php
# modifier le mot de passe 
vi conf.php
```

Dans la ligne
"pass" => null
remplacer null par une chaîne entre guillemets
"pass" => "MonMotDePasseQueJeNeRetiensJamais"

Aller voir votre site dans un navigateur, ex:
http://obvil.paris-sorbonne.fr/corpus/gongora
Si aucun texte apparaît, c’est normal, vous êtes invité à visiter la page d’administration

Erreur connue, un message très répété à la mise à jour en ligne
warning: unable to access '/home/user/.config/git/config': Permission denied
warning: unable to access '/home/user/.gitconfig': Permission denied
Vu avec git version 1.7.12.4. Contournement, autoriser Apache à faire le listing du home de l’utilisateur user. En principe, c'est une très mauvaise idée de sécurité. Mais le bug ne s’est vu que sur un seul serveur avec cette version de git.

Si votre dossier/site ne s’appelle pas gongora, modifier https://github.com/gongoradigital/siteobvil/blob/master/.htaccess en conséquence.

# Administration

http://obvil.paris-sorbonne.fr/corpus/gongosite/pull.php
Avec le mot de passe fixé ci-dessus, appuyez sur le bouton mettre à jour.

Le programme délivrera deux séquences d’informations

* les messages de la mise à jour distante : un git pull un peu complexe en raison de des sous-modules, cf. https://github.com/gongoradigital/siteobvil/blob/master/_conf.php
* la liste des fichiers qui seront transformés, avec si nécessaires les messages d’erreurs. La transformation kindle est très exigeante, elle refuse le moindre lien mort.

En général, les erreurs proviennent de fichiers XML mal formés. Parfois, il y a des erreurs plus discrètes de structure qui 
