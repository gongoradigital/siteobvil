Le résultat à obtenir : http://obvil.paris-sorbonne.fr/corpus/gongora/

# Administration


http://obvil.paris-sorbonne.fr/corpus/gongosite/pull.php
(mot de passe confidentiel)

Le programme délivrera deux séquences d’informations

* les messages de la mise à jour distante : un git pull un peu complexe en raison de des sous-modules, cf. https://github.com/gongoradigital/siteobvil/blob/master/_conf.php
* la liste des fichiers qui seront transformés, avec si nécessaires les messages d’erreurs. La transformation kindle est très exigeante, elle refuse le moindre lien mort. En général, les erreurs proviennent de fichiers XML mal formés. Parfois, il y a des erreurs de structure qui surprennent la transformation kindle.


# Installation avec accès SSH

La procédure d’installation du site Gongora suit en partie les principes d’un site Teinte tel que décrit ici https://github.com/oeuvres/Teinte, avec des différences tenant à la complexité du projet. Les explications qui suivent s’adressent à un administrateur système habitué à Apache (ou à son serveur http préféré), à git, et qui a au moins installé un projet simple avec succès selon instruction décrites pour Teinte.

## Explication de la structure git 

Le site de publication agrège trois types de sources, qui demandent trois types différents de publication :

* la polémique gongorine, dans https://github.com/gongoradigital/polemos
* la poésie de Gongora, dans https://github.com/gongoradigital/gongoraobra
* le théâtre de Gongora (aussi dans https://github.com/gongoradigital/gongoraobra)

L'import de ces modules est assuré par le mécanisme git des submodules, https://git-scm.com/book/en/v2/Git-Tools-Submodules. Il en résulte que l’instruction de mise à jour des fichiers sur le serveur n’est pas un simple git pull mais : `git submodule foreach git pull origin gh-pages 2>&1` (cf. [_conf.php](_conf.php)). Dans la page d’administration, il en résute des messages de mise à jour comme suit :

```
Entering 'gongoraobra'
From https://github.com/gongoradigital/gongoraobra
 * branch            gh-pages   -> FETCH_HEAD
Already up-to-date.
Entering 'polemos'
From https://github.com/gongoradigital/polemos
 * branch            gh-pages   -> FETCH_HEAD
Already up-to-date.
```
## URL propres et redirections Apache

cp _.htaccess .htaccess
Modifier RewriteBase

## Théâtre et Dramagraph

`php ../Dramagraph/Base.php gongora_teatro.sqlite ../gongoraobra/gongora_firmezasisabela.xml ../gongoraobra/gongora_comediavenatoria.xml ../gongoraobra/gongora_doctorcarlino.xml`

## TODO, poésie

