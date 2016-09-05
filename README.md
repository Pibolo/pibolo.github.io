# Pibolo cv projet

## Launch project in dev mode

launch this at the root of this project :

```
docker run -d -p 3000:3000 -e ALLOW_OVERRIDE=true -v (pwd):/app -e MAILGUN_API_KEY=<key-BLABLA> -e MAIL_DOMAIN=<sandboxBLABLA.mailgun.org> -e MAIL_TO=jeremy.alluin@gmail.com -e GIT_COMMIT=dev --name cv_pibolo sraleik/cv_pibolo:latest
```

- -d for deamonize, launch the docker in the background
- the website will be accessible here -> localhost:3000 , it's a browserSync server, so any modification on .less and .php file
- ALLOW_OVERRIDE allow url rewritting, optional
- -v (pwd):/app link the docker folder `/app` to your code on your host machine. So you can modify your code from outside the container `warning`: (pwd) will only work on fish (use $(pwd) for bash) and if your in this project folder. If your not you can put an absolute path instead
- GIT_COMMIT=dev launch the docker in developpment mode. 'dev' is the only word that can't be a branch. It's a key word. It will not checkout to dev.
- in dev mode, npm and composer dependancies will be create in your (pwd) folder. Don't worry it's okay

## Launch in production

```
docker run -d -p 80:80 -e ALLOW_OVERRIDE=true -e MAILGUN_API_KEY=<key-BLABLA> -e MAIL_DOMAIN=<sandboxBLABLA.mailgun.org> -e MAIL_TO=jeremy.alluin@gmail.com -e GIT_COMMIT=master --name cv_pibolo sraleik/cv_pibolo:latest
```

- GIT_COMMIT=master, the container will checkout to master (or any other branch except dev) and pull, if your production branch is another name change this parameter (ex: GIT_COMMIT=production)


## Mise en production

```
docker rm -f cv_pibolo
docker run -d -p 80:80 -e ALLOW_OVERRIDE=true -e MAILGUN_API_KEY=<key-BLABLA> -e MAIL_DOMAIN=<sandboxBLABLA.mailgun.org> -e MAIL_TO=jeremy.alluin@gmail.com -e GIT_COMMIT=master --name cv_pibolo sraleik/cv_pibolo:latest
```

No git pull necessary. The container will take care of that

## Recette

- créer une branch recette

```
docker run -d -p 1111:80 -e ALLOW_OVERRIDE=true -e MAILGUN_API_KEY=<key-BLABLA> -e MAIL_DOMAIN=<sandboxBLABLA.mailgun.org> -e MAIL_TO=jeremy.alluin@gmail.com -e GIT_COMMIT=recette --name cv_pibolo_recette sraleik/cv_pibolo:latest
```

pour l'instant le code est sur la branch mailgun je te laisse tester on mergera après
pareille pour le docker, c'est sur docker sraleik/cv_pibolo:test pour casser la prod

## Docker logs, to watch what's going on inside the container

```
docker logs -f cv_pibolo
```

## Get inside the container

```
docker exec -it cv_pibolo /bin/bash
```

## Rebuild the docker image

before rebuilding make sur to have your repository clean, no pending modification

```
docker build -t sraleik/cv_pibolo .
```
- -t pour tag

Sans cache :

```
docker build --no-cache -t sraleik/cv_pibolo .
```

## Get last version of docker image

```
docker pull sraleik/cv_pibolo
```

## Launch gulp task

In Development mode, launch Gulp command to watch changes whith BrowserSync. Launch command :

```
gulp watch
```
