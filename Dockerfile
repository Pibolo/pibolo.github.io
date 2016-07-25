# Build docker:  sudo docker build --tag sraleik/mon_cv .
# Run:  docker run -d -p 80:80 -e ALLOW_OVERRIDE=true -v /var/run/mysqld/mysqld.sock:/var/run/mysqld/mysqld.sock --name mon_cv sraleik/mon_cv
# Run en dev:  docker run -d -p 80:80 -e ALLOW_OVERRIDE=true -e GIT_COMMIT=dev -v (pwd):/app --name mon_cv sraleik/mon_cv

FROM       sraleik/x64-apache:trusty

RUN rm -rf /app
WORKDIR /
RUN git clone https://github.com/Pibolo/pibolo.github.io.git app
ADD run.sh /run.sh

WORKDIR /app

RUN php composer.phar install --no-interaction

EXPOSE 80

ENTRYPOINT ["bash"]

CMD ["-l", "/run.sh"]
