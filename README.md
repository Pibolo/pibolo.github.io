# Pibolo cv projet

## Launch project in dev mode

launch this a the root of this project :

```
docker run -d -p 1111:80 -e ALLOW_OVERRIDE=true -e GIT_COMMIT=dev -v (pwd):/app --name mon_cv sraleik/mon_cv
```

- -d for deamonize, launch the docker in the background
- the website will be accessible here localhost:1111
- ALLOW_OVERRIDE allow url rewritting, optional
- GIT_COMMIT=dev launch the docker in developpment mode
- -v (pwd):/app link the docker folder /app to your code on your host machine. So you can modify your code from outside the container

## Launch in production

```
docker run -d -p 80:80 -e ALLOW_OVERRIDE=true -e GIT_COMMIT=master --name mon_cv sraleik/mon_cv
```
