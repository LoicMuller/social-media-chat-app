# Initialisation du projet

Premièrement, il faut faire un git clone du projet

`git clone https://github.com/LoicMuller/social-media-chat-app.git` 

Il faut entrer dans le dossier du projet

`cd social-media-chat-app/`

Ensuite, il faut installer Composer

`sudo apt install composer`

Vérifier que php est bien installé

`php -v`

Installer php-xml afin d'éviter des erreurs lors de l'installation des dépendances

`sudo apt-get install php-xml`

Editer le fichier .env 

```
APP_ENV=dev
APP_SECRET=app-secret (32 caractères)

DATABASE_URL=mysql://db_username:db_password@127.0.0.1:3306/db_name?serverVersion=5.7

SLACK_WEBHOOK_URL=votre-webhook-slack
DISCORD_WEBHOOK_URL=votre-webhook-discord
```

Installer les composants ( les dossiers var et vendor doivent apparaître après cette commande )

`composer install`

Installer curl / yarn / npm

```
sudo apt update
sudo apt install curl yarn npm
```

Mettre à jour yarn 

`sudo curl --compressed -o- -L https://yarnpkg.com/install.sh | bash`

Vérifier sa version

`yarn --version`

Installer les packages 

`npm install`

Si besoin, exécuter les commandes suivantes 

```
yarn build
yarn encore dev
yarn watch
```

Créer la base de données à l'aide du fichier .env

`php bin/console doctrine:database:create`

Créer le schema de la base à partir des entités présentes dans le projet

`php bin/console doctrine:schema:create`

Démarrer le serveur symfony

`php -S 127.0.0.1:8000 -t ./public/`
