# Pibolo cv projet

## Launch project in dev mode

launch this at the root of this project :

```
docker run -d -p 1111:80 -e ALLOW_OVERRIDE=true -e GIT_COMMIT=dev -v (pwd):/app --name mon_cv sraleik/mon_cv
```

- -d for deamonize, launch the docker in the background
- the website will be accessible here -> localhost:1111
- ALLOW_OVERRIDE allow url rewritting, optional
- GIT_COMMIT=dev launch the docker in developpment mode. 'dev' is the only word that can't be a branch. It's a key word. It will not checkout to dev.
- -v (pwd):/app link the docker folder /app to your code on your host machine. So you can modify your code from outside the container `warning`: (pwd) will only work on fish and if your in this project folder. If your not you can put an absolute path instead

## Launch in production

```
docker run -d -p 80:80 -e ALLOW_OVERRIDE=true -e GIT_COMMIT=master --name mon_cv sraleik/mon_cv
```

- GIT_COMMIT=master, the container will checkout to master (or any other branch except dev) and pull, if your production branch is another name change this parameter (ex: GIT_COMMIT=production)


## Mise en production

```
docker rm -f mon_cv
docker run -d -p 80:80 -e ALLOW_OVERRIDE=true -e GIT_COMMIT=master --name mon_cv sraleik/mon_cv
```

## Get inside the container

```
docker exec -it mon_cv /bin/bash
```

## Rebuild the docker image

before rebuilding make sur to have your repository clean, no pending modification

```
docker build -t pibolo/mon_cv .
```
- -t pour tag
